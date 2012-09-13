<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Job extends CI_Controller {

	/*--------------------------------------------------------------------------*/
	/*  __construct ==> Call the Model constructor 								*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function __construct(){
		parent::__construct(); 		
		$this->load->model('jobModel');
		$this->load->helper('js');
	}	

	/*--------------------------------------------------------------------------*/
	/*  index ==> Displays the jobs in a list fashion							*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	public function index()
	{		
		if ($this->session->userdata('Credentials')!=Credentials || $this->session->userdata(Level)!=1) redirect('logout');
		$data = array(
			'title' 	=> $this->lang->line('txt_admin_jobs'),
			'mainView'	=> 'forms/job/admin',
			'scripts'	=> jlist(),
			'jobs'		=> 	$this->jobModel->getRecentJobs()		
		);
		$this->load->view('template/wrapper',$data);
	}
	
	/*--------------------------------------------------------------------------*/
	/*  add ==> Adds a new job													*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	public function add()
	{
		if ($this->session->userdata('Credentials')!=Credentials || $this->session->userdata(Level)!=1) redirect('logout');
		if ($this->input->post()):
			//load the validation library
			$this->load->library('form_validation');			
			$this->form_validation->set_rules('position_name',$this->lang->line('txt_name'),'required');
			$this->form_validation->set_rules('end_date',$this->lang->line('txt_birth_date'),'required|valid_date');			
			$this->form_validation->set_rules('requirements',$this->lang->line('txt_requirements'),'required');
			if ($this->form_validation->run()):
				$this->_set_job();
				redirect('job');
			endif;			
		endif;
		$this->load->model('countryModel');
		$data = array(
			'title' 	=> $this->lang->line('txt_new_job'),
			'mainView'	=> 'forms/job/add',
			'scripts'	=> jQuery_UI(),
			'countries'	=> getDropDown($this->countryModel->getCountries(),idCountry,country),
			'job_areas'	=> getDropDown($this->jobModel->getJobAreas(),'idJob_Area','Job_Area'),			
		);
		$this->load->view('template/wrapper',$data);
	}
	
	/*--------------------------------------------------------------------------*/
	/*  view ==> Displays a single job 											*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	public function view($job)
	{		
		$job = $this->jobModel->getJob(decodeID($job));
		if (!empty($job)):
			$data = array(
				'title' 	=> $job['Position_Name'],
				'mainView'	=> 'forms/job/view',
				'job'		=> $job		
			);
		endif;
		$this->load->view('template/wrapper',$data);
	}
	
	/*--------------------------------------------------------------------------*/
	/*  apply ==> Sends an user's application for a job							*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	public function apply($job)
	{		
		if ($this->session->userdata('Credentials')!=Credentials || $this->session->userdata(Level)!=2) redirect('login');
		
	}
	
	/*--------------------------------------------------------------------------**
	**  _set_job ==> Sets a job info							 				**
	**	$job : ID of the job to update. If NULL, the info will be inserted		**
	**																			**
	**--------------------------------------------------------------------------*/
	function _set_job($job=NULL){
		$state = ($this->input->post('state')!=0)? $this->input->post('state'): NULL;
		$city = ($this->input->post('city')!=0)? $this->input->post('city'): NULL;
		$data = array(			
			'Position_Name'		=> $this->input->post('position_name'),
			'Description'		=> $this->input->post('description'),
			'Start_Date'		=> date('Y-m-d'),
			'End_Date'			=> changeDateFormat($this->input->post('end_date')),
			'idCity'			=> $city,
			'Type'				=> $this->input->post('type'),
			'Salary'			=> $this->input->post('salary'),
			'Requirements'		=> $this->input->post('requirements'),
			'idJob_Area'		=> $this->input->post('job_area'),
			'idUser'			=> $this->session->userdata(idUser),						
		);
		
		return ($job==NULL)?$this->jobModel->add($data):$this->jobModel->update($job,$data);
	}
	
}

