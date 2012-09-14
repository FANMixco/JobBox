<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Academichistory extends CI_Controller {

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
			$this->form_validation->set_rules('startDate',$this->lang->line('start_date'),'required|valid_date');			
			$this->form_validation->set_rules('endDate',$this->lang->line('end_date'),'valid_date');
			$this->form_validation->set_rules('school',$this->lang->line('school'),'required');
			$this->form_validation->set_rules('academicLevel',$this->lang->line('academic_level'),'required');
			$this->form_validation->set_rules('academicMajor',$this->lang->line('academic_major'),'required');
                        if ($this->form_validation->run()):
				$this->_set_user();
				redirect('user/registered');
			endif;
		endif;	
		//load the resources
		$this->load->model('schoolModel');
		$this->load->model('academicLevelModel');
		$this->load->model('academicMajorModel');
		$this->load->helper('js');
		$data = array(
			'title'		=> $this->lang->line('txt_register'),
			'mainView'	=> 'forms/history/academic_history/add',
			'schools'	=> getDropDown($this->schoolModel->getSchools(),'idSchool','School'),
			'academic_levels'	=> getDropDown($this->academicLevelModel->getAcademicLevels(),'idAcademic_Level','Academic_Level'),
			'academic_majors'	=> getDropDown($this->academicMajorModel->getAcademicMajors(),'idAcademic_Major','Academic_Major'),
			'scripts'	=> jQuery_UI()			
		);
		$this->load->view('template/wrapper',$data);
	}

        
        function _set_academichistory($user=NULL){ 
            $data = array(
                'start_date'		=> $this->input->post('start_date'),
                'end_date'		=> $this->input->post('end_date'),
                'school'		=> $this->input->post('school'),
                'academic_level'		=> $this->input->post('academic_level'),
                'academic_major'		=> $this->input->post('academic_major'),
                'speciality'		=> $this->input->post('speciality'),
                'completed_years'		=> $this->input->post('completed_years'),
                'title_years'		=> $this->input->post('title_years'),
                'idUser'		=> $this->session->userdata('idUser')
            );
            
            return ($user==NULL)?$this->academicHistoryModel->registerAcademicHistory($data):$this->academicHistoryModel->updateAcademicHistory($user,$data);
        }       
}        