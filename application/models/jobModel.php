<?php

class JobModel extends CI_Model{
	/*--------------------------------------------------------------------------*/
	/*  __construct ==> Call the Model constructor 								*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function __construct(){parent::__construct();}	
	
	/*--------------------------------------------------------------------------**
	**  getRecentJobs ==> gets all the jobs ordered by most recent				**
	**																			**
	**	RETURNS: Result array													**
	**																			**
	**--------------------------------------------------------------------------*/
	function getRecentJobs(){
		return $this->db->get('recent_jobs_vw')->result_array();
	}
}


?>