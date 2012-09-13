<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jobbox extends CI_Controller {

	
	public function index()
	{
		$data = array(
			'title'		=>	$this->lang->line('jobbox'),
			'mainView'	=> 	'home'
		);
		$this->load->view('template/wrapper',$data);
	}
}

