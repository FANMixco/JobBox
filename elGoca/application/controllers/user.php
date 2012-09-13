<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	/*--------------------------------------------------------------------------*/
	/*  __construct ==> Call the CI_Controller constructor						*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function __construct(){
		parent::__construct();
		$this->load->model('userModel');		
	}
	
	/*--------------------------------------------------------------------------*/
	/*  activate ==> Activates an user account 									*/
	/*  $user : user ID 				 	 									*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function activate($user){
		//decode the user ID & activate the user
		$user = decodeID($user);

		if ($this->userModel->activate($user)):
			$data = array(
				'title' 	=> $this->lang->line('elGoca').' - '.$this->lang->line('txt_user_activated'),
				'mainView'	=> 'register/user_activated'
			);
			$this->load->view('inner_template/wrapper',$data);
		else:			
			show_404();
		endif;
	}

	/*--------------------------------------------------------------------------*/
	/*  forgotPassword ==> Resets the password and sends a notification email	*/
	/*  $username : username			 	 									*/
	/*  $email 	  : user's email address	 	 								*/
	/*																			*/
	/*  NOTE: This function is called with AJAX. The params are received using	*/
	/*		   POST																*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function forgotPassword(){
		$username 	= $this->input->post('user');
		$email 		= $this->input->post('email');		
		//Set a temporal password.
		if ($pass = $this->userModel->resetPass($username,$email)):			
			//Send the notification email		
			$this->load->helper('mail');			
			$data = array(
				'username' 		=> $username,
				'password'		=> $pass
			);			
			$mailBody = $this->load->view('mails/forgot_pass_mail',$data,true);			
			generalMail($this->lang->line('mail_user'),$this->lang->line('mail_user'),$email,$this->lang->line('mail_forgot_subject'),$mailBody);
			echo 1;
		else:
			echo 0;
		endif;
	}
	
	/*--------------------------------------------------------------------------*/
	/*  admin ==> Obtains the list of users of a specific type					*/
	/*  $userType : Type of the users that are gonna be retrieved from the 		*/
	/*				database. The possible values are:							*/
	/*				- Visitor													*/
	/*				- Commercial												*/
	/*				- Publicist													*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function admin($userType='visitor'){
		//The user must be logged in to see this page
		if ($this->session->userdata('Credentials')!=Credentials) redirect('logout');
		//Get the numeric type of the user
		$customFields = array();
		switch($userType){
			case 'admins':
				$type 			= 1;
				$fields 		= array(name,'Username');
				$table_headers 	= $this->lang->line('header_admin_users');
				$subtitle 		= $this->lang->line('txt_user_admins');
				break;
			case 'commercial':
				$type 			= 2;
				$fields 		= array(name,'place','event','coupon');
				$table_headers 	= $this->lang->line('header_commercial_users');				
				$subtitle 		= $this->lang->line('txt_user_commercial');
				$customFields 	= array('fields' => array(array('icon view',$this->lang->line('txt_view'),'user/view/',idUser)));
				break;
			case 'publicist':
				$type 			= 3;
				$fields 		= array(name,'campaign');
				$table_headers 	= $this->lang->line('header_publicist_users');
				$subtitle 		= $this->lang->line('txt_user_publicist');
				break;
			case 'visitor':
			default:
				$type 			= 4;
				$fields 		= array(name,'coupon');
				$table_headers 	= $this->lang->line('header_visitor_users');
				$subtitle 		= $this->lang->line('txt_user_visitor');
				$customFields 	= array('fields' => array(array('icon coupon',$this->lang->line('txt_coupons'),'user/view/',idUser)));
				break;
		}		
		$this->load->helper('js');
		$data = array(
			'title'			=> $this->lang->line('title_admin_users'),
			'mainView'		=> 'users/admin',
			'subtitle'		=> $subtitle,			
			'scripts'		=> jlist(),
			'fields' 		=> $fields,
			'table_headers'	=> $table_headers,
			'customFields'	=> $customFields,
			'users'			=> $this->userModel->getUsers($type)
		);		
		$this->load->view('admin_template/wrapper',$data);
	}
	
	/*--------------------------------------------------------------------------*/
	/*  view ==> Displays the detail of a specific user 						*/
	/*  $user 		: Encoded user's ID 				 	 					*/
	/*																			*/
	/*	NOTE: The info to be displayed is filtered by the user type				*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function view($user){
		$idUser = decodeID($user);
		//Get the type of the user
		$user = $this->userModel->getUser($idUser);		
		//If the user is commercial, display its places, events and coupons
		switch($user[Level]){
			case 2:
				//load the resources
				$this->load->model('placeModel');
				$this->load->model('eventModel');
				$this->load->model('couponModel');
				$this->load->helper('js');
				$data = array(
					'title'			=> $this->lang->line('title_admin_users'),
					'mainView'		=> 'users/viewCommercial',
					'scripts' 		=> jlist(),
					'userPlaces'	=> $this->placeModel->getUserPlaces($idUser),
					'userEvents'	=> $this->eventModel->getUserEvents($idUser),
					'userCoupons'	=> $this->couponModel->getUserCoupons($idUser),
				);				
				break;
			case 4:
				$data = array(
					'title'			=> $this->lang->line('title_admin_users'),
					'mainView'		=> 'users/viewVisitors',
					'scripts' 		=> jlist(),
					'userCoupons'	=> $this->userModel->getUserCoupons($idUser),
				);
				break;
			default:
				redirect('user/admin/visitor');
		}
		
		$this->load->view('admin_template/wrapper',$data);
	}

	/*--------------------------------------------------------------------------*/
	/*  edit ==> Gets an user info or updates it. 								*/
	/*  $user 	: ID of the user to update (encoded)					 		*/		
	/*																			*/
	/*  NOTE: The values are received through POST 						 		*/
	/*																			*/	
	/*--------------------------------------------------------------------------*/
	function edit($user){
		//The user must be logged in to see this page
		if ($this->session->userdata('Credentials')!=Credentials || $this->session->userdata(Level)!=1) redirect('logout');

		if ($this->input->post()):
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name',$this->lang->line('txt_name'),'required');		
			$this->form_validation->set_rules('birthDate',$this->lang->line('txt_birth_date'),'required|valid_date');
			$this->form_validation->set_rules('country',$this->lang->line('txt_country'),'required');
			if ($this->form_validation->run()):
				$this->_updateUser($user);
				redirect('user/admin/'.$this->_getUserLevel(decodeID($user)));
			endif;
		endif;

		//load the necessary resources
		$this->load->model('countriesModel');
		$this->load->model('categoriesModel');
		$this->load->helper('js');
		$data = array(
			'mainView'	=> 'users/edit',				
			'title'		=> $this->lang->line('title_admin_users'),
			'datePicker'=> datepicker(),
			'categories'=> $this->categoriesModel->getCategories(),			
			'user'		=> $this->userModel->getUser(decodeID($user)),			
			'userCats'	=> $this->userModel->getUserCats(decodeID($user)),
			'countries' => getDropDown($this->countriesModel->getCountries(),idCountry,Country)
		);
		$this->load->view('admin_template/wrapper',$data);	
	}

	/*--------------------------------------------------------------------------*/
	/*  delete ==> Deletes an user (Marks it as deleted)						*/
	/*  $user 	: ID of the user to delete (encoded)					 		*/	
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function delete($user){
		$idUser = decodeID($user);
		$level = $this->_getUserLevel($idUser);
		if ($this->userModel->delete($idUser))
			$this->session->set_flashdata('message',$this->lang->line('msg_user_deleted'));

		redirect('user/admin/'.$level);
	}

	/*--------------------------------------------------------------------------*/
	/*  _getUserLevel ==> gets the level of a specific user						*/
	/*  $idUser 	: ID of the user. It musn't be encoded 				 		*/
	/*  $number 	: Boolean. Determines if the function must return a string	*/
	/*					or a number. String is default.							*/
	/*																			*/	
	/*--------------------------------------------------------------------------*/
	function _getUserLevel($idUser,$number=false){		
		$user = $this->userModel->getUser($idUser);
		if ($number) return $user[Level];
		
		$userType = array('admins','commercial','publicist','visitor');
		return $userType[$user[Level]-1];
	}

	/*--------------------------------------------------------------------------*/
	/*  _updateUser  ==> Updates the user's info 								*/
	/*  $user 	: ID of the user which info is gonna be updated			 		*/	
	/*																			*/
	/*  NOTE: The values are received using POST 								*/	
	/*--------------------------------------------------------------------------*/
	function _updateUser($user){
		$user = decodeID($user);
		//Update the user's info
		$data = array(
			name 		=> $this->input->post('name'),
			surname 	=> $this->input->post('surname'),
			birthDate 	=> changeDateFormat($this->input->post('birthDate')),			
			phone 		=> $this->input->post('phone'),
			userCountry	=> $this->input->post('country'),
			state 		=> $this->input->post('state'),
			city 		=> $this->input->post('city')
		);
		$this->userModel->update($user,$data);

		//Update the fav cats
		$this->userModel->updateUserCats($user,$this->input->post('cats'));

		$this->session->set_flashdata('message',$this->lang->line('msg_user_updated'));
	}
	
}

?>