<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jobbox extends CI_Controller {

	
	public function index()
	{
		$data = array(
			'title'		=>	$this->lang->line('txt_home'),
			'mainView'	=> 	'home'
		);
		$this->load->view('template/wrapper',$data);
	}
	
	public function login(){		
		if ($this->input->post()):
			$this->load->model('userModel');
			$user = $this->userModel->login($this->input->post('username'),md5($this->input->post('password')));
			if (!empty($user)): //The info is correct!
				$this->session->set_userdata(idUser,$user[idUser]);
				$this->session->set_userdata(Level,$user[Level]);
				$this->session->set_userdata(name,$user[name].' '.$user[surname]);
				$this->session->set_userdata('Credentials',Credentials);
				//Redirect!
				redirect('admin');
			endif;
		else:
			$data = array(
				'title'		=> $this->lang->line('txt_login'),
				'mainView'	=> 'general/login'				
			);
		endif;
	}
}

