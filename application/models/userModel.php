<?php
/*--------------------------------------------------------------------------*/
/*  User's Status 							 								*/
/*																			*/
/*	0 => Deleted															*/
/*	1 => Active 															*/
/*																			*/
/*--------------------------------------------------------------------------*/
class UserModel extends CI_Model{
	/*--------------------------------------------------------------------------*/
	/*  __construct ==> Call the Model constructor 								*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function __construct(){parent::__construct();}	

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
	/*  registerUser ==> Insert an user 		 	 							*/
	/*  $userInfo : Array containing the info of the user						*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function registerUser($userInfo){
		$this->db->insert(users,$userInfo);
		return $this->db->insert_id();
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
		
}
?>
