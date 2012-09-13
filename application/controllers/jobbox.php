<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jobbox extends CI_Controller {

	/*--------------------------------------------------------------------------*/
	/*  index ==> HOME! Displays the current jobs ordered by most recent		*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	public function index()
	{
		$this->load->model('jobModel');
		$this->load->helper('js');
		$data = array(
			'title'		=>	$this->lang->line('txt_home'),
			'mainView'	=> 	'home',
			'scripts'	=> jlist(),
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
				$this->session->set_userdata(name,$user['First_Name'].' '.$user['Last_Name_1']);
				$this->session->set_userdata('Credentials',Credentials);
				//Redirect!
				if ($this->session->userdata('job'))redirect('job/view/'.$job);
				redirect('admin');
			else:
				$data['error'] = 1;
			endif;
		endif;		
		$data['title'] 		= $this->lang->line('txt_login');
		$data['mainView'] 	= 'forms/sign_in';
		$this->load->view('template/wrapper',$data);
	}
	
	/*--------------------------------------------------------------------------*/
	/*  logout ==> Terminates an user's session									*/	
	/*																			*/
	/*--------------------------------------------------------------------------*/
	public function logout(){
		$this->session->unset_userdata(idUser);
		$this->session->unset_userdata(Level);
		$this->session->unset_userdata(name);
		$this->session->sess_destroy();
		
		redirect('login');
	}
	
	/*--------------------------------------------------------------------------**
	**  admin ==> Displays the dashboard for each type of user					**
	**																			**
	**																			**
	**--------------------------------------------------------------------------*/
	public function admin(){
		if ($this->session->userdata('Credentials')!=Credentials) redirect('logout');
		switch($this->session->userdata(Level)){
			case 1:
				$data = array(
					'title'		=>	$this->lang->line('txt_dashboard'),
					'mainView'	=> 	'forms/dashboard'
				);				
				break;
			case 2:
			default:
				$this->load->helper('js');
				$this->load->model('userModel');
				$data = array(
					'title'		=>	$this->lang->line('txt_my_profile'),
					'mainView'	=> 	'forms/profile',
					'scripts'	=>  jQuery_UI(),
					'user'		=>  $this->userModel->getUser($this->session->userdata(idUser))
				);
				break;
		}
		$this->load->view('template/wrapper',$data);
	}
}

