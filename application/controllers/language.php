<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	/*--------------------------------------------------------------------------*/
	/*  __construct ==> Call the Model constructor 								*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function __construct(){parent::__construct(); $this->load->model('userModel');}	

	
	public function index()
	{
		echo '<h1>ESTE ES EL CONTROLADOR DE LOS IDIOMAS!!</h1>';
	}
        
        public function register(){
		if ($this->input->post()):
			//load the validation library
			$this->load->library('form_validation');			
			$this->form_validation->set_rules('language',$this->lang->line('txt_language'),'required');			
			if ($this->form_validation->run()):
				$this->_set_user();
				redirect('user/registered');
			endif;
		endif;	
		//load the resources
		$this->load->helper('js');
		$data = array(
			'mainView'	=> 'forms/language/add',
			'scripts'	=> jQuery_UI()			
		);
		$this->load->view('template/wrapper',$data);
            
        }
}