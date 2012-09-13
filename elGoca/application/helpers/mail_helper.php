<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

	function generalMail($from=NULL,$fromName,$to,$subject,$message){
		$ci =& get_instance();
		$ci->load->config('mail');
		$mailSettings = $ci->config->item('generalMail');
		if ($from==NULL)$from = $mailSettings['smtp_user'];
		$ci->load->library('email',$mailSettings); //Load email library
		/*e-mail parameters*/
		$ci->email->set_newline("\r\n");
		$ci->email->from($from,$fromName);
		$ci->email->to($to); 
		$ci->email->subject($subject);
		$ci->email->message($message);
		$ci->email->send();
	}	

?>