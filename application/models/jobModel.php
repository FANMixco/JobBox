<?php

class JobModel extends CI_Model{
	/*--------------------------------------------------------------------------*/
	/*  __construct ==> Call the Model constructor 								*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function __construct(){parent::__construct();}	
	
	/*--------------------------------------------------------------------------**
	**  getJob ==> gets a single job											**
	**	$job - ID of the job													**
	**																			**
	**	RETURNS: Result array													**
	**																			**
	**--------------------------------------------------------------------------*/
	function getJob($job){
		return $this->db->get_where('jobs_vw',array('idJob' => $job, status => 1))->row_array();
	}
	
	/*--------------------------------------------------------------------------**
	**  getRecentJobs ==> gets all the jobs ordered by most recent				**
	**																			**
	**	RETURNS: Result array													**
	**																			**
	**--------------------------------------------------------------------------*/
	function getRecentJobs(){
		return $this->db->get('recent_jobs_vw')->result_array();
	}
	
	/*--------------------------------------------------------------------------**
	**  getJobAreas ==> gets all the job areas									**
	**																			**
	**	RETURNS: Result array													**
	**																			**
	**--------------------------------------------------------------------------*/
	function getJobAreas(){
		return $this->db->get_where('job_areas',array(status => 1))->result_array();
	}
	
	/*--------------------------------------------------------------------------**
	**  apply ==> Creates an user appplication									**
	**	$data - data of the application											**
	**																			**
	**	RETURNS: Result array													**
	**																			**
	**--------------------------------------------------------------------------*/
		/* Application status:
		1: User Application Sent
		2: Application Approved
		3: Selected!*/
	function apply($data){
		$this->db->insert('applications',$data);
		return $this->db->insert_id();
	}
	
	function hasApplied($user,$job){
		return $this->db->get_where('applications',array(idUser => $user,'idJob'=> $job))->num_rows();
	}
	
	/*--------------------------------------------------------------------------*/
	/*  add ==> Insert a job 		 	 										*/
	/*  $data : Array containing the info of the job							*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function add($data){
		$this->db->insert('jobs',$data);
		return $this->db->insert_id();
	}
}


?>