<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	
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
			$this->form_validation->set_rules('firstName',$this->lang->line('txt_name'),'required');			
			$this->form_validation->set_rules('firstSurname',$this->lang->line('txt_surname'),'required');
			$this->form_validation->set_rules('idDoc',$this->lang->line('txt_surname'),'required');						
			$this->form_validation->set_rules('birthDate',$this->lang->line('txt_birth_date'),'required|valid_date');
			$this->form_validation->set_rules('username',$this->lang->line('txt_user'),'required|is_unique['.users.'.'.userName.']');
		endif;	
		//load the resources
		$this->load->helper('js');
		$this->load->model('honorificModel');
		$this->load->model('religionModel');
		$this->load->model('countryModel');
		$data = array(
			'title'		=> $this->lang->line('txt_register'),
			'mainView'	=> 'forms/register',
			'honorifics'=> getDropDown($this->honorificModel->getHonorifics(),idHonorific,honorific),
			'religions'	=> getDropDown($this->religionModel->getReligions(),idReligion,religion),
			'countries'	=> getDropDown($this->countryModel->getCountries(),idCountry,country),
			'scripts'	=> jQuery_UI()			
		);
		$this->load->view('template/wrapper',$data);
	}
}

