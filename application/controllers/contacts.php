<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacts extends CI_Controller {

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
			$this->form_validation->set_rules('contact',$this->lang->line('lbl_contact'),'required');
                        if ($this->form_validation->run()):
				$this->_set_user();
				redirect('user/registered');
			endif;
		endif;	
		//load the resources
		$this->load->helper('js');
		$data = array(
			'title'		=> $this->lang->line('txt_register'),
			'mainView'	=> 'forms/history/contacts/add',
			'scripts'	=> jQuery_UI()			
		);
		$this->load->view('template/wrapper',$data);
	}

        
        function _set_academichistory(){ 
            $data = array(
                'contact'		=> $this->input->post('contact'),
                'primary'		=> $this->input->post('primary'),
                'reference'		=> $this->input->post('reference'),
                'type_1'		=> $this->input->post('type_1'),
                'country_code_1'		=> $this->input->post('country_code_1'),
                'state_int_code_1'		=> $this->input->post('state_int_code_1'),
                'state_loc_code_1'		=> $this->input->post('state_loc_code_1'),
                'telephone_1'		=> $this->input->post('telephone_1'),
                'type_2'		=> $this->input->post('type_2'),
                'country_code_2'		=> $this->input->post('country_code_2'),
                'state_int_code_2'		=> $this->input->post('state_int_code_2'),
                'state_loc_code_2'		=> $this->input->post('state_loc_code_2'),
                'telephone_2'		=> $this->input->post('telephone_2'),
                'idUser'		=> $this->session->userdata('idUser')
            );
            
            return $this->contactsModel->registerContact($data);
        }       
}        