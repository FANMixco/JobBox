<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coursehistory extends CI_Controller {

	/*--------------------------------------------------------------------------*/
	/*  __construct ==> Call the Model constructor 								*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function __construct(){parent::__construct(); $this->load->model('courseHistoryModel');}	

	
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
			$this->form_validation->set_rules('course',$this->lang->line('start_date'),'required|valid_date');			
			$this->form_validation->set_rules('startDate',$this->lang->line('lbl_start_date'),'required|valid_date');			
			$this->form_validation->set_rules('endDate',$this->lang->line('lbl_end_date'),'valid_date');
			$this->form_validation->set_rules('school',$this->lang->line('lbl_school'),'required');
			$this->form_validation->set_rules('country',$this->lang->line('lbl_country'),'required');
                        if ($this->form_validation->run()):
				$this->_set_coursehistory();
				redirect('user/registered');
			endif;
		endif;	
		//load the resources
		$this->load->model('schoolModel');
		$this->load->model('countryModel');
		$this->load->helper('js');
		$data = array(
			'title'		=> $this->lang->line('txt_register'),
			'mainView'	=> 'forms/history/course_history/add',
			'schools'	=> getDropDown($this->schoolModel->getSchools(),'idSchool','School'),
			'countries'	=> getDropDown($this->countryModel->getCountries(),'idCountry','Country'),
			'scripts'	=> jQuery_UI()			
		);
		$this->load->view('template/wrapper',$data);
	}

        
        function _set_coursehistory(){ 
            $data = array(
                'start_date'		=> $this->input->post('start_date'),
                'end_date'		=> $this->input->post('end_date'),
                'hours'		=> $this->input->post('hours'),
                'school'		=> $this->input->post('school'),
                'scholarship'		=> $this->input->post('scholarship'),
                'country'		=> $this->input->post('country'),
                'scholarship'		=> $this->input->post('scholarship'),
                'user'		=> $this->session->userdata('idUser'),
                'comments'		=> $this->input->post('comments')
            );
            
            return $this->academicHistoryModel->registerAcademicHistory($data);
        }       
}        