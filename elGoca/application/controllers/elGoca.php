<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*--------------------------------------------------------------------------*/
/*  ElGoca (Controller) ==> Controls all the functionality related to home	*/
/*																			*/
/*--------------------------------------------------------------------------*/
class ElGoca extends CI_Controller {

	/*--------------------------------------------------------------------------*/
	/*  __construct ==> Call the CI_Controller constructor						*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function __construct(){
		parent::__construct();		
		$this->load->helper('js'); //load the js helper
	}
	
	/*--------------------------------------------------------------------------*/
	/*  index ==> Displays the home view 									*/
	/*																			*/
	/*  !IMPORTANT - The parameters passed to the getCatPlaces() function must	*/
	/*  				match with the cateogries of the places 				*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	public function index()
	{
		//Load the resources
		$this->load->model('placeModel');
		$this->load->model('eventModel');
		$data = array(			
			'title' 		=> $this->lang->line('home'), 
			'mainView' 		=> 'home', 
			'scripts'		=> videoPlayer().jCarouselLite().Calendar(),
			'events'		=> $this->eventModel->getCurrentEvents(),
			'todayEvents'	=> $this->eventModel->getDateEvents(''),
			'movies'		=> $this->placeModel->getCatPlaces(1),
			'food'			=> $this->placeModel->getCatPlaces(2),
			'bar'			=> $this->placeModel->getCatPlaces(3),
			'hobbies'		=> $this->placeModel->getCatPlaces(4),
			'culture'		=> $this->placeModel->getCatPlaces(5),			
			'banner'		=> 'files/temp_images/banner-head.jpg'
		);
		$this->load->view('home_template/wrapper',$data);
	}
	
	/*--------------------------------------------------------------------------*/
	/*  getEvents ==> gets the events of a specific date 			 			*/	
	/*  $date - Obviously, the date to filter 									*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	public function getEvents($date,$display=false){
		$this->load->model('eventModel');		
                $events = $this->eventModel->getDateEvents($date);
                if (!$display):
                    $data = array();
                    if (!empty($events)):
                        $i=0;
                        foreach($events as $event):
                            $data['event_'.$i] = array('id' => encodeID($event[idEvent]),'name' => $event[name]);
                        endforeach;
                    else:
                        $data['response'] = $this->lang->line('msg_no_date_events');                
                    endif;
                    $this->output->set_content_type('application/json');
                    $this->output->set_output(json_encode($data));
                else:                    
                    $data = array(
                            'title' 		=> $this->lang->line('txt_search'),
                            'mainView'		=> 'inner/eventSearch',                            
                            'events'		=> $this->eventModel->search($date),
                            'scripts'		=> jlist()
                    );
                    $this->load->view('inner_template/wrapper',$data);
                endif;
                                
	}
	
	/*--------------------------------------------------------------------------*/
	/*  register ==> Display the register_info view & validates the user info	*/
	/*  $user_type : type of the user to be added. It can be:					*/
	/*	   NULL : The user type hasn't been selected. Display the register_info	*/
	/*	  			view 														*/
	/*	   visitor : Registered user. Basic search of places, events & coupons	*/	
	/*	   commercial : commercial user 										*/
	/*	   publicist : publicist user 											*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	public function register($user_type=NULL){
		if ($this->input->post()):
			//1.Validate
			$this->load->library('form_validation');
			$this->form_validation->set_rules('username',$this->lang->line('txt_user'),'required|is_unique['.users.'.'.userName.']');
			$this->form_validation->set_rules('name',$this->lang->line('txt_name'),'required');		
			$this->form_validation->set_rules('birthDate',$this->lang->line('txt_birth_date'),'required|valid_date');
			$this->form_validation->set_rules('eMail',$this->lang->line('txt_email'),'required|valid_email|is_unique['.users.'.'.eMail.']');
			$this->form_validation->set_rules('country',$this->lang->line('txt_country'),'required');
			$this->form_validation->set_rules('pass',$this->lang->line('txt_pass'),'required|matches[pass_match]');
			if ($this->form_validation->run()):
				$this->_add_user($user_type);				
				redirect('user/registered');
			endif;
		endif;
		$data['title'] 		= $this->lang->line('elGoca').' - '.$this->lang->line('txt_register');
		$data['mainView'] 	= ($user_type==NULL)? 'register/register_info': 'register/register';
		if ($user_type!=NULL):
			$this->load->model('countriesModel'); //load the countries model
			$this->load->model('categoriesModel'); //load the categories model
			$data['datePicker'] = datePicker();
			$data['user_type'] 	= $user_type;			
			$data['categories']	= $this->categoriesModel->getCategories();
			$data['countries']	= getDropDown($this->countriesModel->getCountries(),idCountry,Country);
		endif;
		$this->load->view('inner_template/wrapper',$data);
	}
	
	/*--------------------------------------------------------------------------*/
	/*  registered ==> Displays the user registered notification view 			*/	
	/*																			*/
	/*--------------------------------------------------------------------------*/
	public function registered(){
		$data['title'] 		= $this->lang->line('txt_register');
		$data['mainView'] 	= 'register/user_registered';
		$this->load->view('inner_template/wrapper',$data);
	}
	
	/*--------------------------------------------------------------------------*/
	/*  editUser ==> Displays the view to edit the user (no-admin mode)			*/	
	/*																			*/
	/*--------------------------------------------------------------------------*/
	public function editUser(){
		//The user must be logged in to see this page
		if ($this->session->userdata('Credentials')!=Credentials) redirect('logout');
		$user = $this->session->userdata(idUser);
		if ($this->input->post()):
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name',$this->lang->line('txt_name'),'required');		
			$this->form_validation->set_rules('birthDate',$this->lang->line('txt_birth_date'),'required|valid_date');
			$this->form_validation->set_rules('country',$this->lang->line('txt_country'),'required');
			if ($this->form_validation->run())$this->_updateUser($user);				
		endif;

		//load the necessary resources
		$this->load->model('userModel');
		$this->load->model('countriesModel');
		$this->load->model('categoriesModel');
		$this->load->helper('js');
		$data = array(
			'mainView'	=> 'inner/edit',				
			'title'		=> $this->lang->line('txt_users'),
			'datePicker'=> datepicker(),
			'categories'=> $this->categoriesModel->getCategories(),			
			'user'		=> $this->userModel->getUser($user),			
			'userCats'	=> $this->userModel->getUserCats($user),
			'countries' => getDropDown($this->countriesModel->getCountries(),idCountry,Country)
		);
		$this->load->view('inner_template/wrapper',$data);	
	}
	
	/*--------------------------------------------------------------------------*/
	/*  changePassword ==> Changes the password of an user 						*/

	/*																			*/
	/*--------------------------------------------------------------------------*/
	public function changePassword()
	{
		$user = $this->session->userdata(idUser);
		if ($this->input->post()):
			$this->load->library('form_validation');
			$this->form_validation->set_rules('currentPass',$this->lang->line('txt_pass'),'required');
			$this->form_validation->set_rules('newPass',$this->lang->line('txt_new_pass'),'required|matches[pass_match]');
			if ($this->form_validation->run()):
				$this->load->model('userModel');
				$userInfo = $this->userModel->getUser($user);
				//Check that the current pass matches the pass in the db
				if ($userInfo[password]==md5($this->input->post('currentPass'))):
					//Update the pass
					$this->userModel->updatePass($user,md5($this->input->post('newPass')));
					$this->session->set_flashdata('message',$this->lang->line('msg_pass_changed'));
					redirect('users/passwordChanged');
				else:
					$message = $this->lang->line('msg_wrong_pass');
				endif;
			endif;
		endif;
		$data = array(
			'title' 		=> $this->lang->line('txt_users'),
			'mainView'		=> 'inner/changePass'
		);
		if (isset($message))$data['message'] = $message;
		$this->load->view('inner_template/wrapper',$data);
	}
	
	/*--------------------------------------------------------------------------*/
	/*  passChanged ==> Displays the password changed notification view 		*/	
	/*																			*/
	/*--------------------------------------------------------------------------*/
	public function passChanged(){
		$data['title'] 		= $this->lang->line('txt_users');
		$data['mainView'] 	= 'inner/passChanged';
		$this->load->view('inner_template/wrapper',$data);
	}
	
	/*--------------------------------------------------------------------------*/
	/*  viewPlaces ==> Displays the places that belong to the category specified*/
	/* 				If no category is given, select all the places 				*/
	/*																			*/
	/*  $category - ID of the category. Default = 0 							*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	public function viewPlaces($category='')
	{
		//load th resources
		$this->load->model('placeModel');
		$this->load->helper('js');
		$data = array(
			'title' 		=> $this->lang->line('txt_places'),
			'mainView'		=> 'inner/places',
			'scripts'		=> jlist()
		);
		if ($category==''):
			$data['places'] = $this->placeModel->getPlaces();
		else:
			$catID = array('movies' => 1,'food' => 2,'bar' => 3,'hobbies' => 4,'culture' => 5);
			$data['places'] = $this->placeModel->getCatPlaces($catID[$category]);
		endif;
		$this->load->view('inner_template/wrapper',$data);
	}
	
	/*--------------------------------------------------------------------------*/
	/*  viewPlace ==> Displays a single place 									*/
	/*																			*/
	/*  $place - Encoded ID of the place 			 							*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	public function viewPlace($place)
	{
		$this->load->model('placeModel');
		$placeInfo = $this->placeModel->getPlace(decodeID($place));
		$data = array(
			'title' 		=> $this->lang->line('txt_events'),
			'mainView'		=> 'inner/place',
			'scripts'		=> Coda().maps($placeInfo[latitude],$placeInfo[longitude]),
			'place'			=> $placeInfo
		);
		$this->load->view('inner_template/wrapper',$data);
	}
	
	/*--------------------------------------------------------------------------*/
	/*  viewEvents ==> Displays all the events 									*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	public function viewEvents($place=NULL)
	{
		//load the resources
		$this->load->model('eventModel');
		$this->load->helper('js');
		$data = array(
			'title' 		=> $this->lang->line('txt_events'),
			'mainView'		=> 'inner/events',
			'scripts'		=> jlist()
		);
		$data['events'] = ($place==NULL)? $this->eventModel->getCurrentEvents(): $this->eventModel->getPlaceEvents(decodeID($place));
		$this->load->view('inner_template/wrapper',$data);
	}
	
	/*--------------------------------------------------------------------------*/
	/*  viewEvent ==> Displays a single event 									*/
	/*																			*/
	/*  $event - Encoded ID of the event 			 							*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	public function viewEvent($event)
	{
		$this->load->model('eventModel');
		$this->load->model('couponModel');
		$data = array(
			'title' 		=> $this->lang->line('txt_events'),
			'mainView'		=> 'inner/event',
			'scripts'		=> jCycle(),
			'event'			=> $this->eventModel->getEvent(decodeID($event)),
			'coupons'		=> $this->couponModel->getEventCoupons(decodeID($event))
		);
		$this->load->view('inner_template/wrapper',$data);
	}
	
	/*--------------------------------------------------------------------------*/
	/*  viewCoupons ==> Displays all the coupons that belong to a place 		*/
	/*																			*/
	/*  $place - Encoded ID of the place 			 							*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	public function viewCoupons($place)
	{
		$this->load->model('couponModel');
		$data = array(
			'title' 		=> $this->lang->line('txt_events'),
			'mainView'		=> 'inner/coupons',
			'scripts'		=> jlist(),
			'coupons'		=> $this->couponModel->getPlaceCoupons(decodeID($place))
		);
		$this->load->view('inner_template/wrapper',$data);
	}
	
	/*--------------------------------------------------------------------------*/
	/*  viewCoupon ==> Displays a single coupon									*/
	/*																			*/
	/*  $coupon - Encoded ID of the coupon 			 							*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	public function viewCoupon($coupon)
	{
		$this->load->model('couponModel');
		$data = array(
			'title' 		=> $this->lang->line('txt_events'),
			'mainView'		=> 'inner/coupon',
			'scripts'		=> Coda(),
			'coupon'		=> $this->couponModel->getCouponEx(decodeID($coupon))
		);
		$this->load->view('inner_template/wrapper',$data);
	}
	
	/*--------------------------------------------------------------------------*/
	/*  exchangeCoupon ==> Exchanges a single coupon							*/
	/*																			*/
	/*  $coupon - Encoded ID of the coupon 			 							*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	public function exchangeCoupon($coupon)
	{
		$this->load->model('couponModel');
		if ($this->session->userdata('Credentials')!=Credentials):
			$this->session->set_userdata('exCoupon',$coupon);
			redirect('login');
		endif;
                $this->session->unset_userdata('exCoupon');
		//1. Check that there are coupons left
		$idCoupon = decodeID($coupon);
		$myCoupon = $this->couponModel->getCouponEx($idCoupon);
		$mainView = 'inner/noCoupons';
		if ($myCoupon[Qty]>$myCoupon['couponNumber']):
			//2. Check that the user hasn't exchanged any coupons before			
			if (!$this->couponModel->hasExchanged($idCoupon,$this->session->userdata(idUser))):
				$this->couponModel->exchange($idCoupon,$this->session->userdata(idUser));
				$mainView = 'inner/couponExchanged';
			else:
				$mainView = 'inner/couponAlreadyExchanged';
			endif;
		endif;
		$data = array(
			'title' 		=> $this->lang->line('txt_coupons'),
			'mainView'		=> $mainView,
			'idCoupon'		=> $idCoupon
		);
		$this->load->view('inner_template/wrapper',$data);
	}
	
	/*--------------------------------------------------------------------------*/
	/*  search ==> Searches & returns all matches with the criteria				*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	public function search()
	{		
		$this->load->model('eventModel');
		$this->load->model('placeModel');
                $this->load->model('couponModel');
		
		$data = array(
			'title' 		=> $this->lang->line('txt_search'),
			'mainView'		=> 'inner/generalSearch',
			'scripts'		=> jlist(),
			'events'		=> $this->eventModel->search($this->input->post('criteria')),
			'places'		=> $this->placeModel->search($this->input->post('criteria')),
                        'coupons'		=> $this->couponModel->search($this->input->post('criteria'))
		);
		$this->load->view('inner_template/wrapper',$data);
	}		

	/*--------------------------------------------------------------------------*/
	/*  login ==> Initializes an user's session 								*/
	/*  $username : username			 	 									*/
	/*  $pass 	  : user's password 		 	 								*/
	/*																			*/
	/*  NOTE: The params are received using	POST 								*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	public function login(){
		if ($this->input->post()): //If the info has been sent...		
			$this->load->model('userModel');
			$user = $this->userModel->login($this->input->post('username'),md5($this->input->post('password')));
			if (!empty($user)): //The info is correct!
				$this->session->set_userdata(idUser,$user[idUser]);
				$this->session->set_userdata(Level,$user[Level]);
				$this->session->set_userdata(name,$user[name].' '.$user[surname]);
				$this->session->set_userdata('Credentials',Credentials);
				//Redirect!
				redirect('admin');				
			else:
				$this->session->set_flashdata('message',$this->lang->line('txt_no_login'));
				redirect('login');
			endif;
		else:
			$data = array(
				'title'		=> $this->lang->line('elGoca').' - '.$this->lang->line('txt_login'),
				'mainView'	=> 'register/login'
			);
			$this->load->view('inner_template/wrapper',$data);
		endif;		
	}
	
	/*--------------------------------------------------------------------------*/
	/*  logout ==> Terminates an user's session									*/	
	/*																			*/
	/*--------------------------------------------------------------------------*/
	public function logout(){
		$this->session->unset_userdata(idUser);
		$this->session->unset_userdata(Level);
		$this->session->unset_userdata(name);
		$this->session->sess_destroy();
		
		redirect('login');
	}
	
	/*--------------------------------------------------------------------------*/
	/*  admin ==> The user has logged in! Grant the privileges. 				*/	
	/*																			*/
	/*--------------------------------------------------------------------------*/
	public function admin(){
		//The user must be logged in to see this page
		if ($this->session->userdata('Credentials')!=Credentials) redirect('logout');
		//Unset the session vars
		$this->session->unset_userdata('ePlace');
		$this->session->unset_userdata('eEvent');
		$this->session->unset_userdata('eCoupon');
		//Load the resources
		$this->load->helper('js');
		//Determine which view is the proper one.
		switch($this->session->userdata(Level)){
			case 1:
				$data = array(
					'title' 	=> $this->lang->line('txt_admon'),
					'mainView'	=> 'admin/dashboard'					
				);
				$this->load->view('admin_template/wrapper',$data);
				break;
			case 2:
				$this->load->model('placeModel');
				$this->load->model('eventModel');
				$this->load->model('couponModel');				
				$idUser = $this->session->userdata(idUser);
				$data = array(
					'title' 		=> $this->lang->line('txt_admon'),
					'mainView'		=> 'commercial/dashboard',
					'scripts' 		=> jlist(),
					'userPlaces'	=> $this->placeModel->getUserPlaces($idUser),
					'userEvents'	=> $this->eventModel->getUserEvents($idUser),
					'userCoupons'	=> $this->couponModel->getUserCoupons($idUser)
				);
				$this->load->view('inner_template/wrapper',$data);
				break;
			case 3:
				$data = array('title' => $this->lang->line('txt_admon'),'mainView'	=> 'admin/dashboard');
				break;
			case 4: //Registered user
			default:
				//Check if the user is exchanging a coupon
				if ($this->session->userdata('exCoupon')) redirect('coupons/exchange/'.$this->session->userdata('exCoupon'));
                                $this->load->model('couponModel');
                                $data = array(
                                    'title' 		=> $this->lang->line('txt_admon'),
                                    'mainView'		=> 'visitor/dashboard',
                                    'scripts' 		=> jlist(),                                    
                                    'userCoupons'	=> $this->couponModel->getExchangedCoupons($this->session->userdata(idUser))
				);
				$this->load->view('inner_template/wrapper',$data);				
				break;
		}				
	}

	/*--------------------------------------------------------------------------*/
	/*  _add_user ==> Adds a new user to the database and marks it as 			*/	
	/* 					Registered 												*/
	/*																			*/
	/*  $user_type : type of the user to be added. Its possible values are the 	*/
	/*					same as the register function 							*/ 
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function _add_user($userType){
		/* User-Level */
		/* 1 ==> Admin */
		/* 2 ==> Commercial User */
		/* 3 ==> Publicist */
		/* 4 ==> Visitor */		
		if ($userType=='publicist'):
			$Level = 3;
		else:
			$Level = ($userType=='commercial')?2:4;
		endif;
		/*load the user model & register the user*/
		$this->load->model('userModel');
		$userInfo = array(
			Level 		=> $Level,
			userName 	=> $this->input->post('username'),
			password 	=> md5($this->input->post('pass')),
			name 		=> $this->input->post('name'),
			surname 	=> $this->input->post('surname'),
			birthDate 	=> changeDateFormat($this->input->post('birthDate')),
			eMail 		=> $this->input->post('eMail'),
			phone 		=> $this->input->post('phone'),
			userCountry	=> $this->input->post('country'),
			state 		=> $this->input->post('state'),
			city 		=> $this->input->post('city'),
			status 		=> 2//By default, users are added with status 2 which means: Registered
		);

		$user = $this->userModel->registerUser($userInfo);
		//Set the user's fav categories
		$this->userModel->setUserCats($user,$this->input->post('cats'));	
		/*Send the activation email*/	
		$this->load->helper('mail');
		/*1.get the mail-body (content)*/
		$data = array(
			'idUser' 	=> encodeID($user),
			'username'	=> $this->input->post('username'),
			'password'	=> $this->input->post('pass')
		);
		$mailBody = $this->load->view('mails/activation_mail',$data,true);		
		/*2.Send the email*/				
		generalMail(NULL,$this->lang->line('mail_user'), $this->input->post('eMail'),$this->lang->line('title_home'),$mailBody);
	}
	
	/*--------------------------------------------------------------------------*/
	/*  _updateUser  ==> Updates the user's info 								*/
	/*  $user 	: ID of the user which info is gonna be updated			 		*/	
	/*																			*/
	/*  NOTE: The values are received using POST 								*/	
	/*--------------------------------------------------------------------------*/
	function _updateUser($user){
		//$user = decodeID($user);
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
		$this->load->model('userModel');
		$this->userModel->update($user,$data);

		//Update the fav cats
		$this->userModel->updateUserCats($user,$this->input->post('cats'));

		$this->session->set_flashdata('message',$this->lang->line('msg_user_updated'));
	}
	
}

/* End of file elGoca.php */
/* Location: ./application/controllers/elGoca.php */