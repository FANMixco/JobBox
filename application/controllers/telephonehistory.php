<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Telephonehistory extends CI_Controller {

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
			$this->form_validation->set_rules('type',$this->lang->line('lbl_type'),'required');
			$this->form_validation->set_rules('telephone',$this->lang->line('lbl_telephone'),'required');
                        if ($this->form_validation->run()):
				$this->_set_user();
				redirect('user/registered');
			endif;
		endif;	
		//load the resources
		$this->load->helper('js');
		$data = array(
			'title'		=> $this->lang->line('txt_register'),
			'mainView'	=> 'forms/history/telephone_history/add',
			'scripts'	=> jQuery_UI()			
		);
		$this->load->view('template/wrapper',$data);
	}

        
        function _set_academichistory(){ 
            $data = array(
                'start_date'		=> $this->input->post('start_date'),
                'end_date'		=> $this->input->post('end_date'),
                'type'		=> $this->input->post('type'),
                'country_code'		=> $this->input->post('country_code'),
                'state_int_code'		=> $this->input->post('state_int_code'),
                'state_loc_code'		=> $this->input->post('state_loc_code'),
                'telephone'		=> $this->input->post('telephone'),
                'idUser'		=> $this->session->userdata('idUser')
            );
            
            return $this->telephoneHistoryModel->registerTelephoneHistory($data);
        }       
}        