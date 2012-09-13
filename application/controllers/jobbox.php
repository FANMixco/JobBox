<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jobbox extends CI_Controller {

	/*--------------------------------------------------------------------------*/
	/*  index ==> HOME! Displays the current jobs ordered by most recent		*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	public function index()
	{
		$this->load->model('jobModel');
		$data = array(
			'title'		=>	$this->lang->line('txt_home'),
			'mainView'	=> 	'home',
			'jobs'		=> 	$this->jobModel->getRecentJobs()
		);
		$this->load->view('template/wrapper',$data);
	}
	
	/*--------------------------------------------------------------------------**
	**  login ==> Initializes an user's session 								**
	**	$username => Username													**
	**	$password => User's password											**
	**																			**
	** 	NOTE: The params are received with POST									**
	**																			**
	**--------------------------------------------------------------------------*/
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
			else:
				$data['error'] = 1;
			endif;
		endif;		
		$data['title'] 		= $this->lang->line('txt_login');
		$data['mainView'] 	= 'forms/sign_in';
		$this->load->view('template/wrapper',$data);
	}
	
	/*--------------------------------------------------------------------------**
	**  admin ==> Displays the dashboard for each type of user					**
	**																			**
	**																			**
	**--------------------------------------------------------------------------*/
	public function admin(){
		if ($this->session->userdata('Credentials')!=Credentials) redirect('logout');
		switch($this->session->userdata(idLevel)){
			case 1:
				break;
			case 2:
			default:
				break;
		}
	}
}

