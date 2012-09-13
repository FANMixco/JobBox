<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*--------------------------------------------------------------------------*/
/*  Places (Controller) ==> Controls all the functionality related to places*/
/*																			*/
/*--------------------------------------------------------------------------*/
class Place extends CI_Controller {
	/*--------------------------------------------------------------------------*/
	/*  __construct ==> Call the CI_Controller constructor						*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function __construct(){
		parent::__construct();	
		//The user must be logged in to see this page
		if ($this->session->userdata('Credentials')!=Credentials || $this->session->userdata(Level)>2) redirect('logout');
		//load the resources
		$this->load->model('placeModel');
	}
        
        /*--------------------------------------------------------------------------*/
	/*  index ==> Place Administration Detail                                   */
	/*									    */
	/*--------------------------------------------------------------------------*/
        function index(){
            if ($this->session->userdata(Level)!=1)redirect('logout');
            //Unset the session vars
            $this->session->unset_userdata('ePlace');                        
            $this->load->helper('js');
            $data = array(
                'title'     => $this->lang->line('txt_admin'),
                'mainView'  => 'places/admin',
                'places'    => $this->placeModel->getUserPlaces(),
                'scripts'   => jlist()
            );
            $this->load->view('admin_template/wrapper',$data);            
        }

	/*--------------------------------------------------------------------------*/
	/*  add ==> Inserts a place or displays the addPlace form					*/
	/*																			*/
	/*  NOTE: The values are received with POST 	 							*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function add(){
		if ($this->input->post()):
			//Validate
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name',$this->lang->line('txt_name'),'required');
			$this->form_validation->set_rules('category',$this->lang->line('txt_category'),'required');
			$this->form_validation->set_rules('description',$this->lang->line('txt_description'),'required');
			$this->form_validation->set_rules('country',$this->lang->line('txt_country'),'required');
			$this->form_validation->set_rules('address',$this->lang->line('txt_address'),'required');						
			if ($this->form_validation->run()) redirect('place/location/'.encodeID($this->_setPlace())); //Add & redirect!			
		endif;
		//Load the resources
		$this->load->model('countriesModel');
		$this->load->model('categoriesModel');
		$data = array(
			'title'		=> $this->lang->line('txt_new_place'),
			'mainView'	=> 'places/add',
			'categories'=> getDropDown($this->categoriesModel->getCategories(),idCategory,Category),
			'countries'	=> getDropDown($this->countriesModel->getCountries(),idCountry,Country)
		);
		$this->load->view('inner_template/wrapper',$data);
	}

	/*--------------------------------------------------------------------------*/
	/*  edit ==> Edits a place or shows the form 			 					*/
	/*																			*/
	/*  $place - Encoded place's ID 			 			 					*/
	/*																			*/
	/*  NOTE: The values are received with POST 	 							*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function edit($place){
		if ($this->input->post()):
			//Validate
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name',$this->lang->line('txt_name'),'required');
			$this->form_validation->set_rules('category',$this->lang->line('txt_category'),'required');
			$this->form_validation->set_rules('description',$this->lang->line('txt_description'),'required');
			$this->form_validation->set_rules('country',$this->lang->line('txt_country'),'required');
			$this->form_validation->set_rules('address',$this->lang->line('txt_address'),'required');						
			if ($this->form_validation->run()):				
				$this->_setPlace(decodeID($place));
				redirect('place/location/'.$place); //Update & redirect!			
			endif;
		endif;
		//Load the resources
		$this->load->model('countriesModel');
		$this->load->model('categoriesModel');
                if ($this->session->userdata(Level)==1):                                    
                    $template   = 'admin';
                    $link       = 'place';                    
                else:
                    $template   = 'inner';
                    $link       = 'admin';                    
                endif;
                
		$data = array(
			'title'		=> $this->lang->line('txt_edit_place'),
			'mainView'	=> 'places/edit',
			'place'		=> $this->placeModel->getPlace(decodeID($place)),                        
			'categories'    => getDropDown($this->categoriesModel->getCategories(),idCategory,Category),
			'countries'	=> getDropDown($this->countriesModel->getCountries(),idCountry,Country),
                        'link'          => $link
		);
		$this->load->view($template.'_template/wrapper',$data);
	}
	
	/*--------------------------------------------------------------------------*/
	/*  delete ==> Deletes the place specified 									*/
	/*																			*/
	/*  $place - Encoded place's ID 			 	 							*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function delete($place){
		if ($this->placeModel->delete(decodeID($place)))
			$this->session->set_flashdata('message',$this->lang->line('msg_place_deleted'));
		$redir = ($this->session->userdata(Level)==1)?'place':'admin';
		redirect($redir);
	}

	/*--------------------------------------------------------------------------*/
	/*  location ==> Updates the location of the place specified.				*/
	/*					Displays the g-maps view 								*/
	/*																			*/
	/*  $place: Encoded place's ID 				 	 							*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function location($place){
		if ($this->input->post()):
			//Although the info comes from a hidden input, I will validate it
			if ($this->input->post()):
				//Validate
				$this->load->library('form_validation');
				$this->form_validation->set_rules('latitude',$this->lang->line('txt_latitude'),'required|numeric');
				$this->form_validation->set_rules('longitude',$this->lang->line('txt_longitude'),'required|numeric');
				if ($this->form_validation->run()):
					$this->_updateLocation(decodeID($place));
					redirect('place/images/'.$place);
				endif;
			endif;
		endif;
                $template   = ($this->session->userdata(Level)==1)?'admin':'inner';                    
		$this->load->helper('js');                
		$data = array(
			'title'		=> $this->lang->line('txt_place_location'),
			'mainView'	=> 'places/location',
			'place'		=> $place,
			'geocode'	=> setmap($this->placeModel->getLocation(decodeID($place)))
		);		
		$this->load->view($template.'_template/wrapper',$data);
	}

	/*--------------------------------------------------------------------------*/
	/*  images ==> Allows image upload-cropping 								*/
	/*																			*/
	/*  $place: Encoded place's ID 				 	 							*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function images($place){
		$mainView = 'places/images';
		/* The ID of the place is obtained using a session var, so I have to check that the user is editing just one place at a time. */
		if (!$this->session->userdata('ePlace'))$this->session->set_userdata('ePlace',decodeID($place)); //If the session var is not set, set it!
		elseif ($this->session->userdata('ePlace')!= decodeID($place))$mainView = 'places/noEdit';				
                
                if ($this->session->userdata(Level)==1):
                    $template   =  'admin';
                    $link       =  'place';
                else:
                    $template   =  'inner';
                    $link       =  'admin';
                endif; 
                
		$this->load->helper('js');
		$data = array(
			'title'		=> $this->lang->line('txt_image_selection'),
			'mainView'	=> $mainView,
			'place'		=> $place,
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
		$upload_handler = new UploadHandler(null,'place',$this->session->userdata('ePlace'));

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
					//2. Add the record to the database. The ID of the place is obtained through the session var 'ePlace'
					
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
	/*  _setPlace ==> Inserts/Edits a place with its basic info					*/
	/*																			*/
	/*	$place - Optional parameter. It specifies if the user is edittin' or 	*/
	/*				adding a new place.	If its value is NULL, the user is addin'*/
	/*				Otherwhise, the user is edittin' 							*/
	/*																			*/
	/*  RETURNS: The ID of the inserted place 	 	 							*/	
	/*  NOTE: The values are received with POST 	 							*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function _setPlace($place = NULL){
		//Prepare the data
		$data = array(
			owner		=> $this->session->userdata(idUser),
			name		=> $this->input->post('name'),
			placeCat	=> $this->input->post('category'),
			type		=> $this->input->post('type'),
			description => $this->input->post('description'),
			capacity 	=> $this->input->post('capacity'),
			price 		=> $this->input->post('price'),
			placeCountry=> $this->input->post('country'),
			state 		=> $this->input->post('state'),
			city 		=> $this->input->post('city'),
			address 	=> $this->input->post('address'),
			phone 	 	=> $this->input->post('phone'),
			eMail 	 	=> $this->input->post('eMail'),
			Website		=> $this->input->post('website'),
			FB	 		=> $this->input->post('fb'),
			Twitter		=> $this->input->post('twitter')
		);
		//Insert-Update the place
		return ($place==NULL)? $this->placeModel->addPlace($data):$this->placeModel->updatePlace($place,$data);
	}

	/*--------------------------------------------------------------------------*/
	/*  _updateLocation ==> Updates the location of the place specified.			*/	
	/*																			*/
	/*  $place: Place's ID 				 	 							*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function _updateLocation($place){
		$data = array(
			latitude 	=> $this->input->post('latitude'),
			longitude 	=> $this->input->post('longitude'),
		);
		$this->placeModel->updatePlace($place,$data);
	}
}

?>