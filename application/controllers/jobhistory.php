<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jobhistory extends CI_Controller {

	/*--------------------------------------------------------------------------*/
	/*  __construct ==> Call the Model constructor 								*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function __construct(){parent::__construct(); $this->load->model('userModel');}	

	
	public function index()
	{
		echo '<h1>ESTE ES EL CONTROLADOR DE USUARIOS!!</h1>';
	}
	
	/*--------------------------------------------------------------------------**
	**  register ==> Register an user			 								**
	**																			**
	**--------------------------------------------------------------------------*/
	public function register(){
		if ($this->input->post()):
			//load the validation library
			$this->load->library('form_validation');
			$this->form_validation->set_rules('startDate',$this->lang->line('lbl_start_date'),'required|valid_date');			
			$this->form_validation->set_rules('endDate',$this->lang->line('lbl_end_date'),'valid_date');
			$this->form_validation->set_rules('company',$this->lang->line('lbl_company'),'required');
			$this->form_validation->set_rules('job_area',$this->lang->line('lbl_job_area'),'required');
			$this->form_validation->set_rules('job_sector',$this->lang->line('lbl_job_sector'),'required');
                        if ($this->form_validation->run()):
				$this->_set_user();
				redirect('user/registered');
			endif;
		endif;	
		//load the resources
		$this->load->model('schoolModel');
		$this->load->model('countryModel');
		$this->load->model('jobModel');
		$this->load->helper('js');
		$data = array(
			'title'		=> $this->lang->line('txt_register'),
			'mainView'	=> 'forms/history/job_history/add',
			'schools'	=> getDropDown($this->schoolModel->getSchools(),'idSchool','School'),
			'countries'	=> getDropDown($this->countryModel->getCountries(),'idCountry','Country'),
			'job_areas'	=> getDropDown($this->jobModel->getJobAreas(),'idJob_Area','Job_Area'),
			'job_sectors'	=> getDropDown($this->jobModel->getJobSectors(),'idJob_Sector','Job_Sector'),
			'scripts'	=> jQuery_UI()			
		);
		$this->load->view('template/wrapper',$data);
	}

        
        function _set_jobhistory(){ 
            $data = array(
                'start_date'		=> $this->input->post('start_date'),
                'end_date'		=> $this->input->post('end_date'),
                'country'		=> $this->input->post('country'),
                'employee_number'		=> $this->input->post('employee_number'),
                'salary'		=> $this->input->post('salary'),
                'activities'		=> $this->input->post('activities'),
                'boss'		=> $this->input->post('boss'),
                'boss_position'		=> $this->input->post('boss_position'),
                'address'		=> $this->input->post('address'),
                'idUser'		=> $this->session->userdata('idUser')
            );
            
            return $this->jobHistoryModel->registerJobHistory($data);
        }       
}        