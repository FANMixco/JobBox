<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Inner template */

/* The first step must be identify which template classes to use */
$templateClasses= (isset($banner))?
array('header' => 'bg-head-banner', 'header_main' => 'bg-head-main-banner'):
array('header' => 'bg-head', 'header_main' => 'bg-head-main');

/* Load the header */
$this->load->view('inner_template/header',$templateClasses);

/* Main View */
$this->load->view($mainView);

/* Load the footer */
$this->load->view('inner_template/footer');