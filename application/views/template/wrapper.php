<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Load the header
$this->load->view('template/header');

//Load the mainView
$this->load->view($mainView);

//Load the footer
$this->load->view('template/footer');

?>