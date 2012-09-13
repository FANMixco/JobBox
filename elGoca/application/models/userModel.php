<?php
/*--------------------------------------------------------------------------*/
/*  User's Status 							 								*/
/*																			*/
/*	0 => Deleted															*/
/*	1 => Active 															*/
/*	2 => Registered															*/
/*																			*/
/*--------------------------------------------------------------------------*/
class UserModel extends CI_Model{
	/*--------------------------------------------------------------------------*/
	/*  __construct ==> Call the Model constructor 								*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function __construct(){parent::__construct();}
	
	/*--------------------------------------------------------------------------*/
	/*  getUser ==> Get an specific user 	 									*/
	/*  $user : user ID 				 	 									*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function getUser($user){		
		return $this->db->get_where(users,array(idUser => $user))->row_array();
	}

	/*--------------------------------------------------------------------------*/
	/*  registerUser ==> Insert an user 		 	 							*/
	/*  $userInfo : Array containing the info of the user						*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function registerUser($userInfo){
		$this->db->insert(users,$userInfo);
		return $this->db->insert_id();
	}

	/*--------------------------------------------------------------------------*/
	/*  activate ==> Activates an user account	 	 							*/
	/*  $user : User's ID. 														*/	
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function activate($user){		
		//change the status of the user
		$this->db->where(array(idUser => $user,status => 2));
		$this->db->update(users,array(status => 1));
		return $this->db->affected_rows();
	}

	/*--------------------------------------------------------------------------*/
	/*  setUserCats ==> Inserts the favorite categories of the specified user	*/
	/*  $user : User's ID. 														*/	
	/*  $cats : Array containig the IDs of the categories chosen by the user.	*/	
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function setUserCats($user,$cats){		
		if (!empty($cats)):
			foreach ($cats as $cat):
				$this->db->insert(CatsPerUser,array(idCatUser => $user, idCat => $cat));
			endforeach;
		endif;
	}

	/*--------------------------------------------------------------------------*/
	/*  getUserCats ==> Gets the favorite categories of the specified user 		*/
	/*  $user : User's ID. 														*/
	/*																			*/
	/*  RETURNS: Array containing the cats										*/			
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function getUserCats($user){
		$this->db->select("GROUP_CONCAT(".idCat." SEPARATOR '|') userCats",false);
		return explode('|',$this->db->get_where(CatsPerUser,array(idCatUser => $user))->row()->userCats);
	}

	/*--------------------------------------------------------------------------*/
	/*  updateUserCats ==> Delete the favorite categories of the specified user	*/
	/*  $user : User's ID. 														*/	
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function updateUserCats($user,$cats){		
		$this->db->delete(CatsPerUser,array(idCatUser => $user));
		$this->setUserCats($user,$cats);
	}
	
	/*--------------------------------------------------------------------------*/
	/*  getUserCoupons ==> Gets the list of the coupons exchanged by the user	*/
	/*  $user : User's ID. 														*/
	/*																			*/
	/*  RETURNS: Array containing the coupons									*/			
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function getUserCoupons($user){
		return $this->db->get(userCouponView)->result_array();
	}
	
	/*--------------------------------------------------------------------------*/
	/*  resetPass ==> Reset the password		 	 							*/
	/*  $username 	: username 													*/
	/*  $email 		: User's email												*/
	/*																			*/
	/*  Tasks:																	*/
	/*  1. Check if the info is correct. 										*/
	/*     The username and the email must coincide								*/	
	/*  2. Update the password according to the algorithm:						*/
	/*     2.1. Password = substr(MD5(substr(md5(name),3)+						*/
	/*						substr(md5(username),3)),8)							*/
	/*																			*/	
	/*--------------------------------------------------------------------------*/
	function resetPass($user,$email){
		//Step 1 ==> Check		
		$user = $this->db->get_where(users,array(userName => $user,eMail => $email))->row_array();
		if (empty($user)) return 0; //The info doesn' match		
		//Step 2 ==> Update the Password		
		$userPass = substr(md5($user[name]),0,3).substr(md5($user[password]),0,3).substr(md5($user[userName]),0,3);
		$sql= "Update ".users." SET ".password." = MD5(?) WHERE ".idUser." = ? ";
		$params = array($userPass,$user[idUser]);				
		$this->db->query($sql,$params);
		return $userPass;
	}
	
	/*--------------------------------------------------------------------------*/
	/*  updatePass ==> Updates the password		 	 							*/
	/*  $user 		: User's ID													*/
	/*  $password	: New Password												*/
	/*																			*/
	/*	NOTE: The password must be already in MD5 								*/
	/*																			*/	
	/*--------------------------------------------------------------------------*/
	function updatePass($user,$password){
		$this->db->where(idUser,$user);			
		$this->db->update(users,array(password => $password));
		return $this->db->affected_rows();
	}

	/*--------------------------------------------------------------------------*/
	/*  login ==> Initializes an user session	 	 							*/
	/*  $user : Username 														*/
	/*  $pass : User's Password													*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function login($user,$pass){
		return $this->db->get_where(users,array(userName => $user,password => $pass, status => 1))->row_array();
	}
	
	/*--------------------------------------------------------------------------*/
	/*  getUsers ==> Retrieves all active user's of a specific type				*/
	/*  $type : The type of the users to query									*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function getUsers($type){
		$views = array(adminView,commercialView,publicistView,registeredView);
		return $this->db->get($views[$type-1])->result_array();
	}

	/*--------------------------------------------------------------------------*/
	/*  delete ==> Deletes an user (Marks it as deleted)						*/
	/*  $user 	: ID of the user to delete 								 		*/	
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function delete($user){
		$this->db->where(array(idUser => $user));
		$this->db->update(users,array(status => 0));
		return $this->db->affected_rows();
	}

	/*--------------------------------------------------------------------------*/
	/*  update ==> Updates the user's info 										*/
	/*  $data 	: ARRAY containing the new info							 		*/	
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function update($user,$data){
		$this->db->where(array(idUser => $user));
		$this->db->update(users,$data);		
	}
	
}
?>
