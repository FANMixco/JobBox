<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* The first step must be identify which template classes to use */
$templateClasses= (isset($banner))?
array('header' => 'bg-head-banner', 'header_main' => 'bg-head-main-banner'):
array('header' => 'bg-head', 'header_main' => 'bg-head-main');

/* load the header */
$this->load->view('home_template/header',$templateClasses);

$this->load->view($mainView,$templateClasses);

/* load the footer */
$this->load->view('home_template/footer',$templateClasses);