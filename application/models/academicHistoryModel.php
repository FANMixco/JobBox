<?php
/*--------------------------------------------------------------------------*/
/*  User's Status 							 								*/
/*																			*/
/*	0 => Deleted															*/
/*	1 => Active 															*/
/*																			*/
/*--------------------------------------------------------------------------*/
class AcademicModel extends CI_Model{
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
	function getAcademicHistoryModel($user){
		return $this->db->get_where('academic_history_vw',array(idUser => $user,status => 1))->row_array();
	}

	/*--------------------------------------------------------------------------*/
	/*  registerUser ==> Insert an user 		 	 							*/
	/*  $userInfo : Array containing the info of the user						*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function registerAcademicHistory($userInfo){
		$this->db->insert(academic_history,$userInfo);
		return $this->db->insert_id();
	}
        
}