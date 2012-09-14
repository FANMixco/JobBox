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
			$this->form_validation->set_rules('startDate',$this->lang->line('lbl_start_date'),'required|valid_date');			
			$this->form_validation->set_rules('endDate',$this->lang->line('lbl_end_date'),'valid_date');
			$this->form_validation->set_rules('email',$this->lang->line('lbl_email'),'required');
                        if ($this->form_validation->run()):
				$this->_set_user();
				redirect('user/registered');
			endif;
		endif;	
		$this->load->helper('js');
		$data = array(
			'title'		=> $this->lang->line('txt_register'),
			'mainView'	=> 'forms/history/email_history/add',
			'scripts'	=> jQuery_UI()			
		);
		$this->load->view('template/wrapper',$data);
	}

        
        function _set_emailhistory($user=NULL){ 
            $data = array(
                'start_date'		=> $this->input->post('start_date'),
                'end_date'		=> $this->input->post('end_date'),
                'email'		=> $this->input->post('email'),
                'type'		=> $this->input->post('type'),
                'idUser'		=> $this->session->userdata('idUser')
            );
            
            return $this->emailHistoryModel->registerEmailHistory($data);
        }       
}        