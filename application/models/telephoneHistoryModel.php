<?php
/*--------------------------------------------------------------------------*/
/*  User's Status 							 								*/
/*																			*/
/*	0 => Deleted															*/
/*	1 => Active 															*/
/*																			*/
/*--------------------------------------------------------------------------*/
class TelephoneHistoryModel extends CI_Model{
    	/*--------------------------------------------------------------------------*/
	/*  __construct ==> Call the Model constructor 								*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function __construct(){parent::__construct();}	
	
	/*--------------------------------------------------------------------------*/
	/*  getUser ==> gets the info of a specific user 							*/
	/*  $user : user's ID 														*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function getTelephoneHistoryModel($user){
		return $this->db->get_where('telephone_history_vw',array(idUser => $user,status => 1))->row_array();
	}

	/*--------------------------------------------------------------------------*/
	/*  registerUser ==> Insert an user 		 	 							*/
	/*  $userInfo : Array containing the info of the user						*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function registerTelephoneHistory($userInfo){
		$this->db->insert('Telephone_History',$userInfo);
		return $this->db->insert_id();
	}
        
}