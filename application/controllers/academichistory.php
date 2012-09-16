<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Academichistory extends CI_Controller {

	/*--------------------------------------------------------------------------*/
	/*  __construct ==> Call the Model constructor 								*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function __construct(){parent::__construct(); $this->load->model('academicHistoryModel');}	

	
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
			$this->form_validation->set_rules('start_date',$this->lang->line('lbl_start_date'),'required|valid_date');			
			$this->form_validation->set_rules('end_date',$this->lang->line('lbl_end_date'),'valid_date');
			$this->form_validation->set_rules('school',$this->lang->line('lbl_school'),'required');
			$this->form_validation->set_rules('academic_level',$this->lang->line('lbl_academic_level'),'required');
			$this->form_validation->set_rules('academic_major',$this->lang->line('lbl_academic_major'),'required');
                        if ($this->form_validation->run()):
				$this->_set_academichistory();
				redirect('admin');
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

        
        function _set_academichistory(){ 
            $data = array(
                'Start_Date'		=> changeDateFormat($this->input->post('start_date')),
                'End_Date'		=> changeDateFormat($this->input->post('end_date')),
                'idSchool'		=> $this->input->post('school'),
                'idAcademic_Level'		=> $this->input->post('academic_level'),
                'idAcademic_Major'		=> $this->input->post('academic_major'),
                'Specialty'		=> $this->input->post('specialty'),
                'Completed_Years'		=> $this->input->post('completed_years'),
                'Title_Years'		=> $this->input->post('title_years'),
                'idUser'		=> $this->session->userdata('idUser')
            );
            
            return $this->academicHistoryModel->registerAcademicHistory($data);
        }       
}        