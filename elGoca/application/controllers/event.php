<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event extends CI_Controller {
	/*--------------------------------------------------------------------------*/
	/*  __construct ==> Call the CI_Controller constructor						*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function __construct(){
		parent::__construct();
		//The user must be logged in to see this page
		if ($this->session->userdata('Credentials')!=Credentials || $this->session->userdata(Level)>2) redirect('logout');
		//load the resources
		$this->load->model('eventModel');	
	}
        
        /*--------------------------------------------------------------------------*/
	/*  index ==> Event Administration Detail                                   */
	/*									    */
	/*--------------------------------------------------------------------------*/
        function index(){            
            if ($this->session->userdata(Level)!=1)redirect('logout');
            //Unset the session vars            
            $this->session->unset_userdata('eEvent');            
            $this->load->helper('js');
            $data = array(
                'title'     => $this->lang->line('txt_admin'),
                'mainView'  => 'events/admin',
                'events'    => $this->eventModel->getUserEvents(),
                'scripts'   => jlist()
            );
            $this->load->view('admin_template/wrapper',$data);            
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
			$this->form_validation->set_rules('place',$this->lang->line('txt_place'),'required');
			$this->form_validation->set_rules('description',$this->lang->line('txt_description'),'required');
			$this->form_validation->set_rules('price',$this->lang->line('txt_price'),'required');
			$this->form_validation->set_rules('eventDate',$this->lang->line('txt_event_date'),'required|valid_date');
			//I'll validate the hour too
			$this->form_validation->set_rules('eventHour',$this->lang->line('txt_hour'),'required|valid_hour');
			$this->form_validation->set_rules('eventMinute',$this->lang->line('txt_minute'),'required|valid_minute');
			$this->form_validation->set_rules('eventAMPM',$this->lang->line('txt_AMPM'),'required|valid_AMPM');
			if ($this->form_validation->run()) redirect('event/images/'.encodeID($this->_setEvent())); //Add & redirect!			
		endif;
		//Load the resources		
		$this->load->model('placeModel');
		$this->load->helper('js');
		$data = array(
			'title'		=> $this->lang->line('txt_new_event'),
			'mainView'	=> 'events/add',
			'datePicker'=> datePicker(),
			'time'		=> getTime(),
			'places'	=> getDropDown($this->placeModel->getUserPlaces($this->session->userdata(idUser)),idPlace,name)
		);
		$this->load->view('inner_template/wrapper',$data);
	}
	
	/*--------------------------------------------------------------------------*/
	/*  edit ==> Edits an event or displays the editEvent form					*/
	/*																			*/
	/*  NOTE: The values are received with POST. As this view is shared	 							*/
        /*      (admin & commercial), I have to do some tasks to determine which		*/
        /*      content to show.                                        		*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function edit($event){
		if ($this->input->post()):
			//Validate
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name',$this->lang->line('txt_name'),'required');
			$this->form_validation->set_rules('place',$this->lang->line('txt_place'),'required');
			$this->form_validation->set_rules('description',$this->lang->line('txt_description'),'required');
			$this->form_validation->set_rules('price',$this->lang->line('txt_price'),'required');
			$this->form_validation->set_rules('eventDate',$this->lang->line('txt_event_date'),'required|valid_date');
			//I'll validate the hour too
			$this->form_validation->set_rules('eventHour',$this->lang->line('txt_hour'),'required|valid_hour');
			$this->form_validation->set_rules('eventMinute',$this->lang->line('txt_minute'),'required|valid_minute');
			$this->form_validation->set_rules('eventAMPM',$this->lang->line('txt_AMPM'),'required|valid_AMPM');
			if ($this->form_validation->run()):
				$this->_setEvent(decodeID($event));
				redirect('event/images/'.$event); //Add & redirect!
			endif;
		endif;
		//Load the resources		
		$this->load->model('placeModel');
		$this->load->helper('js');
                if ($this->session->userdata(Level)==1):                                    
                    $template   = 'admin';
                    $link       = 'event';
                    $places     = getDropDown($this->placeModel->getPlaces(),idPlace,name);
                else:
                    $template   = 'inner';
                    $link       = 'admin';
                    $places     = getDropDown($this->placeModel->getUserPlaces($this->session->userdata(idUser)),idPlace,name);                    
                endif;
                $template = ($this->session->userdata(Level)==1)?'admin':'inner';
		$data = array(
			'title'		=> $this->lang->line('txt_edit_event'),
			'mainView'	=> 'events/edit',
			'datePicker'    => datePicker(),
			'time'		=> getTime(),
			'event'		=> $this->eventModel->getEvent(decodeID($event)),
			'places'	=> $places,
                        'link'          => $link
		);
		$this->load->view($template.'_template/wrapper',$data);
	}
	
	/*--------------------------------------------------------------------------*/
	/*  delete ==> Deletes the event specified 									*/
	/*																			*/
	/*  $event - Encoded event's ID 			 	 							*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function delete($event){
		if ($this->eventModel->delete(decodeID($event)))
			$this->session->set_flashdata('message',$this->lang->line('msg_event_deleted'));
                $redir = ($this->session->userdata(Level)==1)?'event':'admin';
		redirect($redir);
	}
	
	/*--------------------------------------------------------------------------*/
	/*  images ==> Allows image upload-cropping 								*/
	/*																			*/
	/*  $place: Encoded place's ID 				 	 							*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function images($event){
		$mainView = 'events/images';
		/* The ID of the event is obtained using a session var, so I have to check that the user is editing just one event at a time. */
		if (!$this->session->userdata('eEvent'))$this->session->set_userdata('eEvent',decodeID($event)); //If the session var is not set, set it!
		elseif ($this->session->userdata('eEvent')!= decodeID($event))$mainView = 'events/noEdit';
                
                if ($this->session->userdata(Level)==1):
                    $template   =  'admin';
                    $link       =  'event';
                else:
                    $template   =  'inner';
                    $link       =  'admin';
                endif;                        
					
		$this->load->helper('js');
		$data = array(
			'title'		=> $this->lang->line('txt_image_selection'),
			'mainView'	=> $mainView,
			'event'		=> $event,
			'jUpload'	=> jUpload(),
                        'link'          => $link
		);
		$this->load->view($template.'_template/wrapper',$data);
	}

	/*--------------------------------------------------------------------------*/
	/*  uploadImages ==> Uploads the image of the place using the jUpload plugin*/	
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
		$upload_handler = new UploadHandler(null,'event',$this->session->userdata('eEvent'));

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
					//2. Add the record to the database. The ID of the place is obtained through the session var 'eEvent'
					
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
	/*  _setEvent ==> Inserts/Edits an event with its basic info				*/
	/*																			*/
	/*	$event - Optional parameter. It specifies if the user is edittin' or 	*/
	/*				adding a new event.	If its value is NULL, the user is addin'*/
	/*				Otherwhise, the user is edittin' 							*/
	/*																			*/
	/*  RETURNS: The ID of the inserted event 	 	 							*/	
	/*  NOTE: The values are received with POST 	 							*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function _setEvent($event = NULL){
		//Prepare the data
		//Format the date-time
		if ($this->input->post('eventAMPM')=='PM'):
			$hour = ($this->input->post('eventHour')==12)?'00':$this->input->post('eventHour')+12;
		else:
			$hour = $this->input->post('eventHour');
		endif;
		$data = array(			
			name		=> $this->input->post('name'),
			description => $this->input->post('description'),
			eventPlace	=> $this->input->post('place'),
			price 		=> $this->input->post('price'),
			eventDate	=> changeDateFormat($this->input->post('eventDate')).' '.$hour.':'.$this->input->post('eventMinute').':00',
			Website		=> $this->input->post('website'),
			eMail 	 	=> $this->input->post('eMail'),			
			FB	 		=> $this->input->post('fb'),
			Twitter		=> $this->input->post('twitter')			
		);
		//Insert-Update the event
		return ($event==NULL)? $this->eventModel->addEvent($data):$this->eventModel->updateEvent($event,$data);
	}
}

?>