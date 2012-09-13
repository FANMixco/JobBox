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
		
}
?>
