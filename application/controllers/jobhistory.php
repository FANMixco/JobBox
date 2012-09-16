<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jobhistory extends CI_Controller {

	/*--------------------------------------------------------------------------*/
	/*  __construct ==> Call the Model constructor 								*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function __construct(){parent::__construct(); $this->load->model('jobHistoryModel');}	

	
	public function index()
	{
		echo '<h1>ESTE ES EL CONTROLADOR DE JOBS!!</h1>';
	}
	
	/*--------------------------------------------------------------------------**
	**  register ==> Register an user			 								**
	**																			**
	**--------------------------------------------------------------------------*/
	public function register(){
		if ($this->input->post()):
			//load the validation library
			$this->load->library('form_validation');
			$this->form_validation->set_rules('start_date',$this->lang->line('lbl_start_date'),'required|valid_date');			
			$this->form_validation->set_rules('end_date',$this->lang->line('lbl_end_date'),'valid_date');
			$this->form_validation->set_rules('company',$this->lang->line('lbl_company'),'required');
			$this->form_validation->set_rules('job_area',$this->lang->line('lbl_job_area'),'required');
			$this->form_validation->set_rules('job_sector',$this->lang->line('lbl_job_sector'),'required');
                        if ($this->form_validation->run()):
				$this->_set_jobhistory();
				redirect('admin');
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
                'Start_Date'		=> $this->input->post('start_date'),
                'End_Date'		=> $this->input->post('end_date'),
                'idCountry'		=> $this->input->post('country'),
                'Employee_Number'		=> $this->input->post('employee_number'),
                'Salary'		=> $this->input->post('salary'),
                'Activities'		=> $this->input->post('activities'),
                'Boss'		=> $this->input->post('boss'),
                'Boss_Position'		=> $this->input->post('boss_position'),
                'Address'		=> $this->input->post('address'),
                'idUser'		=> $this->session->userdata('idUser'),
                'idJob_Area'        => $this->input->post('job_area'),
                'idJob_Sector'        => $this->input->post('job_sector'),
                'Start_Position'    => $this->input->post('start_position'),
                'End_Position'    => $this->input->post('end_position'),
                'Company'    => $this->input->post('company')
            );
            
            return $this->jobHistoryModel->registerJobHistory($data);
        }       
}        