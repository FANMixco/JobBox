<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*--------------------------------------------------------------------------*/
/*  Places (Controller) ==> Controls all the functionality related to places*/
/*																			*/
/*--------------------------------------------------------------------------*/
class Coupon extends CI_Controller {
	/*--------------------------------------------------------------------------*/
	/*  __construct ==> Call the CI_Controller constructor						*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function __construct(){
		parent::__construct();	
		//The user must be logged in to see this page
		if ($this->session->userdata('Credentials')!=Credentials || $this->session->userdata(Level)>2) redirect('logout');
		//load the resources
		$this->load->model('couponModel');
	}
	
	/*--------------------------------------------------------------------------*/
	/*  add ==> Inserts an event or displays the addEvent form					*/
	/*																			*/
	/*  NOTE: The values are received with POST 	 							*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function add(){
		if ($this->input->post()):
			//Validate
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name',$this->lang->line('txt_name'),'required');
			$this->form_validation->set_rules('event',$this->lang->line('txt_event'),'required');
			$this->form_validation->set_rules('description',$this->lang->line('txt_description'),'required');
			$this->form_validation->set_rules('restrictions',$this->lang->line('txt_restrictions'),'required');
			$this->form_validation->set_rules('regPrice',$this->lang->line('txt_reg_price'),'required|numeric');
			$this->form_validation->set_rules('couponPrice',$this->lang->line('txt_coupon_price'),'required|numeric');
			$this->form_validation->set_rules('startDate',$this->lang->line('txt_start_date'),'required|valid_date');
			$this->form_validation->set_rules('endDate',$this->lang->line('txt_end_date'),'required|valid_date');
			$this->form_validation->set_rules('totalQty',$this->lang->line('txt_total_qty'),'required|is_natural_no_zero');
			//I'll validate the hours too!! First the startHour
			$this->form_validation->set_rules('startHour',$this->lang->line('txt_hour'),'required|valid_hour');
			$this->form_validation->set_rules('startMinute',$this->lang->line('txt_minute'),'required|valid_minute');
			$this->form_validation->set_rules('startAMPM',$this->lang->line('txt_AMPM'),'required|valid_AMPM');
			//Next, the endHour
			$this->form_validation->set_rules('endHour',$this->lang->line('txt_hour'),'required|valid_hour');
			$this->form_validation->set_rules('endMinute',$this->lang->line('txt_minute'),'required|valid_minute');
			$this->form_validation->set_rules('endAMPM',$this->lang->line('txt_AMPM'),'required|valid_AMPM');
			if ($this->form_validation->run()) redirect('coupon/images/'.encodeID($this->_setCoupon())); //Add & redirect!			
		endif;
		//Load the resources		
		$this->load->model('eventModel');
		$this->load->helper('js');
		$data = array(
			'title'		=> $this->lang->line('txt_new_coupon'),
			'mainView'	=> 'coupons/add',
			'datePicker'=> datePicker(),
			'time'		=> getTime(),
			'events'	=> getDropDown($this->eventModel->getUserEvents($this->session->userdata(idUser)),idEvent,name)
		);
		$this->load->view('inner_template/wrapper',$data);
	}
	
	/*--------------------------------------------------------------------------*/
	/*  edit ==> Edits a coupon or displays the editCoupon form					*/
	/*																			*/
	/*  NOTE: The values are received with POST 	 							*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function edit($coupon){
		if ($this->input->post()):
			//Validate
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name',$this->lang->line('txt_name'),'required');
			$this->form_validation->set_rules('event',$this->lang->line('txt_event'),'required');
			$this->form_validation->set_rules('description',$this->lang->line('txt_description'),'required');
			$this->form_validation->set_rules('restrictions',$this->lang->line('txt_restrictions'),'required');
			$this->form_validation->set_rules('regPrice',$this->lang->line('txt_reg_price'),'required|numeric');
			$this->form_validation->set_rules('couponPrice',$this->lang->line('txt_coupon_price'),'required|numeric');
			$this->form_validation->set_rules('startDate',$this->lang->line('txt_start_date'),'required|valid_date');
			$this->form_validation->set_rules('endDate',$this->lang->line('txt_end_date'),'required|valid_date');
			$this->form_validation->set_rules('totalQty',$this->lang->line('txt_total_qty'),'required|is_natural_no_zero');
			//I'll validate the hours too!! First the startHour
			$this->form_validation->set_rules('startHour',$this->lang->line('txt_hour'),'required|valid_hour');
			$this->form_validation->set_rules('startMinute',$this->lang->line('txt_minute'),'required|valid_minute');
			$this->form_validation->set_rules('startAMPM',$this->lang->line('txt_AMPM'),'required|valid_AMPM');
			//Next, the endHour
			$this->form_validation->set_rules('endHour',$this->lang->line('txt_hour'),'required|valid_hour');
			$this->form_validation->set_rules('endMinute',$this->lang->line('txt_minute'),'required|valid_minute');
			$this->form_validation->set_rules('endAMPM',$this->lang->line('txt_AMPM'),'required|valid_AMPM');
			if ($this->form_validation->run()):
				$this->_setCoupon(decodeID($coupon));
				redirect('coupon/images/'.$coupon); //Edit & redirect!
			endif;
		endif;
		//Load the resources		
		$this->load->model('eventModel');
		$this->load->helper('js');
		$data = array(
			'title'		=> $this->lang->line('txt_edit_coupon'),
			'mainView'	=> 'coupons/edit',
			'datePicker'=> datePicker(),
			'time'		=> getTime(),
			'coupon'	=> $this->couponModel->getCoupon(decodeID($coupon)),
			'events'	=> getDropDown($this->eventModel->getUserEvents($this->session->userdata(idUser)),idEvent,name)
		);
		$this->load->view('inner_template/wrapper',$data);
	}
	
	/*--------------------------------------------------------------------------*/
	/*  delete ==> Deletes the event specified 									*/
	/*																			*/
	/*  $event - Encoded event's ID 			 	 							*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function delete($coupon){
		if ($this->couponModel->delete(decodeID($coupon)))
			$this->session->set_flashdata('message',$this->lang->line('msg_coupon_deleted'));
		redirect('admin');
	}
	
	/*--------------------------------------------------------------------------*/
	/*  images ==> Allows image upload-cropping 								*/
	/*																			*/
	/*  $coupon: Encoded place's ID 				 	 							*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function images($coupon){
		$mainView = 'coupons/images';
		/* The ID of the event is obtained using a session var, so I have to check that the user is editing just one event at a time. */
		if (!$this->session->userdata('eCoupon'))$this->session->set_userdata('eCoupon',decodeID($coupon)); //If the session var is not set, set it!
		elseif ($this->session->userdata('eCoupon')!= decodeID($coupon))$mainView = 'coupons/noEdit';				
					
		$this->load->helper('js');
		$data = array(
			'title'		=> $this->lang->line('txt_image_selection'),
			'mainView'	=> $mainView,
			'coupon'	=> $coupon,
			'jUpload'	=> jUpload()
		);
		$this->load->view('inner_template/wrapper',$data);
	}

	/*--------------------------------------------------------------------------*/
	/*  uploadImages ==>Uploads the image of the coupon using the jUpload plugin*/	
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function uploadImages($file=NULL){		
		/*
		 * jQuery File Upload Plugin PHP Example 5.7
		 * https://github.com/blueimp/jQuery-File-Upload
		 *
		 * Copyright 2010, Sebastian Tschan
		 * https://blueimp.net
		 *
		 * Licensed under the MIT license:
		 * http://www.opensource.org/licenses/MIT
		 */
		error_reporting(E_ALL | E_STRICT);		

		//load the upload library		
		$this->load->library('jUpload/uploadHandler');		

		/*NOTE: The name of the folder MUST be the same as the controller*/
		$upload_handler = new UploadHandler(null,'coupon',$this->session->userdata('eCoupon'));

		header('Pragma: no-cache');
		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Content-Disposition: inline; filename="files.json"');
		header('X-Content-Type-Options: nosniff');
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: OPTIONS, HEAD, GET, POST, PUT, DELETE');
		header('Access-Control-Allow-Headers: X-File-Name, X-File-Type, X-File-Size');

		switch ($_SERVER['REQUEST_METHOD']) {
		    case 'OPTIONS':
		        break;
		    case 'HEAD':
		    case 'GET':		    	
		        $upload_handler->get();
		        break;
		    case 'POST':		    	
		        if (isset($_REQUEST['_method']) && $_REQUEST['_method'] === 'DELETE') {
		            $upload_handler->delete();
		        } else {
					//1. Upload the image
		            $upload_handler->post();
					//2. Add the record to the database. The ID of the place is obtained through the session var 'eCoupon'
					
		        }
		        break;
		    case 'DELETE':
		    	if($file ==NULL)break;
		        $upload_handler->delete($file);
		        break;
		    default:
		        header('HTTP/1.1 405 Method Not Allowed');
		}
	}
	
	/*--------------------------------------------------------------------------*/
	/*  _setCoupon ==> Inserts/Edits a coupon with its basic info				*/
	/*																			*/
	/*	$coupon - Optional parameter. It specifies if the user is edittin' or 	*/
	/*			  adding a new coupon. If its value is NULL, the user is addin'	*/
	/*			  Otherwhise, the user is edittin' 								*/
	/*																			*/
	/*  RETURNS: The ID of the inserted coupon 	 	 							*/	
	/*  NOTE: The values are received with POST 	 							*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function _setCoupon($coupon = NULL){
		//Format the date-time
		if ($this->input->post('startAMPM')=='PM'):
			$startHour = ($this->input->post('startHour')==12)?'00':$this->input->post('startHour')+12;
		else:
			$startHour = $this->input->post('startHour');
		endif;
		if ($this->input->post('endAMPM')=='PM'):
			$endHour = ($this->input->post('endHour')==12)?'00':$this->input->post('endHour')+12;
		else:
			$endHour = $this->input->post('endHour');
		endif;
		$data = array(			
			name			=> $this->input->post('name'),
			couponEvent		=> $this->input->post('event'),
			description 	=> $this->input->post('description'),
			restrictions 	=> $this->input->post('restrictions'),
			regPrice		=> $this->input->post('regPrice'),
			couponPrice		=> $this->input->post('couponPrice'),
			startDate		=> changeDateFormat($this->input->post('startDate')).' '.$startHour.':'.$this->input->post('startMinute').':00',
			endDate			=> changeDateFormat($this->input->post('endDate')).' '.$endHour.':'.$this->input->post('endMinute').':00',
			Qty 			=> $this->input->post('totalQty')			
		);
		//Insert-Update the event
		return ($coupon==NULL)? $this->couponModel->addCoupon($data):$this->couponModel->updateCoupon($coupon,$data);
	}

}
?>