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
		$data = array(
			'title'		=> $this->lang->line('txt_register'),
			'mainView'	=> 'forms/register'			
		);
		$this->load->view('template/wrapper',$data);
	}
}

