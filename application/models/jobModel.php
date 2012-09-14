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
	**  getJobApps ==> gets the total apps for each job							**
	**																			**
	**	RETURNS: Result array													**
	**																			**
	**--------------------------------------------------------------------------*/
	function getJobApps(){
		$sql = "Select a.idJob, COUNT(a.idJob) total_applications,
			j.Position_Name 
			From jobs j, applications a
			Where NOW() Between j.Start_Date AND j.End_Date
			And a.idJob = j.idJob
			Group By a.idJob";
		return $this->db->query($sql)->result_array();
	}
	
	/*--------------------------------------------------------------------------**
	**  getJobApps ==> gets the applications for a job							**
	**																			**
	**	RETURNS: Result array													**
	**																			**
	**--------------------------------------------------------------------------*/
	function getApps($job){
		$sql = "SELECT a.idUser, a.idJob,
		DATE_FORMAT(App_Date, '%d/%m/%Y') App_Date,		
		CONCAT(First_Name,' ',Last_Name_1) Name
		FROM applications a, users
		Where a.idUser = users.idUser 
		AND idJob=?";
		$params = array($job);
		return $this->db->query($sql,$params)->result_array();
	}
	
	/*--------------------------------------------------------------------------**
	**  getApp ==> gets a single application									**
	**																			**
	**	RETURNS: Result array													**
	**																			**
	**--------------------------------------------------------------------------*/
	function getApp($job,$user){
		$sql = "Select a.*, CONCAT(u.First_Name,' ',u.Last_Name_1) Name,
		Position_Name		
		FROM applications a, users u, jobs j
		WHERE u.idUser = a.idUser
		and j.idJob = a.idJob
		AND a.idJob=?
		AND a.idUser=?";
		$params = array($job,$user);
		return $this->db->query($sql,$params)->row_array();
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
	**  getJobsPerArea ==> gets all the jobs ordered by most recent				**
	**																			**
	**	RETURNS: Result array													**
	**																			**
	**--------------------------------------------------------------------------*/
	function getJobsPerArea(){
		$sql = "select ja.Job_Area, count(a.idJob) total from applications a, jobs j, job_areas ja
			Where a.idJob = j.idJob
			AND j.idJob_Area = ja.idJob_Area
			GROUP BY ja.idJob_Area";
		return $this->db->query($sql)->result_array();
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

	function getJobSectors(){
		return $this->db->get_where('job_sectors',array(status => 1))->result_array();
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
	/*  updateApp ==> Updates an app 	 										*/
	/*  $data : Array containing the info of the job							*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function updateApp($job,$user,$data){
		$this->db->where(array('idJob'	=> $job,idUser => $user));
		$this->db->update('applications',$data);
		return $this->db->affected_rows();
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

        
	function delete($job){
		$this->db->where(array(idJob => $job));
		$this->db->update(jobs,array(status => 0));
		return $this->db->affected_rows();
	}
        
}


?>