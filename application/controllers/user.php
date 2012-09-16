<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	/*--------------------------------------------------------------------------*/
	/*  __construct ==> Call the Model constructor 								*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function __construct(){parent::__construct(); $this->load->model('userModel');}	

	
	public function index()
	{
		echo '<h1>ESTE ES EL CONTROLADOR DE USUARIOS!!</h1>';
	}
	
	/*--------------------------------------------------------------------------**
	**  register ==> Register an user			 								**
	**																			**
	**--------------------------------------------------------------------------*/
	public function register(){
		if ($this->input->post()):
			//load the validation library
			$this->load->library('form_validation');			
			$this->form_validation->set_rules('firstName',$this->lang->line('txt_name'),'required');			
			$this->form_validation->set_rules('firstSurname',$this->lang->line('txt_surname'),'required');
			$this->form_validation->set_rules('idDoc',$this->lang->line('txt_surname'),'required');						
			$this->form_validation->set_rules('birthDate',$this->lang->line('txt_birth_date'),'required|valid_date');
			$this->form_validation->set_rules('eMail',$this->lang->line('txt_email'),'required|valid_email|is_unique['.users.'.eMail]');
			$this->form_validation->set_rules('username',$this->lang->line('txt_user'),'required|is_unique['.users.'.idUser]');
			$this->form_validation->set_rules('password',$this->lang->line('txt_pass'),'required|matches[passConfirm]');
			if ($this->form_validation->run()):
				$this->_set_user();
				redirect('user/registered');
			endif;
		endif;	
		//load the resources
		$this->load->helper('js');
		$this->load->model('honorificModel');
		$this->load->model('religionModel');
		$this->load->model('countryModel');
		$data = array(
			'title'		=> $this->lang->line('txt_register'),
			'mainView'	=> 'forms/register',
			'honorifics'=> getDropDown($this->honorificModel->getHonorifics(),idHonorific,honorific),
			'religions'	=> getDropDown($this->religionModel->getReligions(),idReligion,religion),
			'countries'	=> getDropDown($this->countryModel->getCountries(),idCountry,country),
			'scripts'	=> jQuery_UI()			
		);
		$this->load->view('template/wrapper',$data);
	}
	
	/*--------------------------------------------------------------------------*/
	/*  registered ==> Displays the user registered notification view 			*/	
	/*																			*/
	/*--------------------------------------------------------------------------*/
	public function registered(){
		$data['title'] 		= $this->lang->line('msg_congrats');
		$data['mainView'] 	= 'forms/registered';
		$this->load->view('template/wrapper',$data);
	}
	
	public function profiles(){
		$this->load->helper('js');
		$data = array(
			'title'		=> $this->lang->line('txt_profiles'),
			'mainView'	=> 'forms/profiles',
			'scripts'	=>  jlist(),
			'users'		=> $this->userModel->getUsers()
		);
		$this->load->view('template/wrapper',$data);
	}
	
	public function profile($profile){
		$this->load->helper('js');
		$this->load->model('jobModel');
                $idUser = decodeID($profile);
                $this->load->model('academicHistoryModel');
                                $this->load->model('courseHistoryModel');
                                $this->load->model('jobHistoryModel');
                                $this->load->model('emailHistoryModel'); 
                                $this->load->model('telephoneHistoryModel'); 
                                $this->load->model('addressHistoryModel'); 
                                $this->load->model('contactModel');  
		$data = array(
			'title'		=>	$this->lang->line('txt_my_profile'),
			'mainView'	=> 	'forms/profile',
			'scripts'	=>  jQuery_UI().jlist(),
			'user'		=>  $this->userModel->getUser(decodeID($profile)),
			'jobs'		=> 	getDropDown($this->jobModel->getRecentJobs(),'idJob','Position_Name'),
                        'acHistory'     =>  $this->academicHistoryModel->getAcademicHistoryModel($idUser),
                                        //'acHistory'     =>  $this->academicHistoryModel->getAcademicHistoryModel($this->session->userdata(idUser)),
                                        'jHistory'     =>  $this->jobHistoryModel->getJobHistoryModel($idUser),
                                        'emailHistory'     =>  $this->emailHistoryModel->getEmailcHistoryModel($idUser),
                                        'telHistory'    => $this->telephoneHistoryModel->getTelephoneHistoryModel($idUser),
                                        'addHistory'    => $this->addressHistoryModel->getAddressHistoryModel($idUser),
                                        'contactHistory'    => $this->contactModel->getContactHistoryModel($idUser),
                                        'courseHistory'    => $this->courseHistoryModel->getCourseHistoryModel($idUser)
		);
		$this->load->view('template/wrapper',$data);
	}
	
	/*--------------------------------------------------------------------------**
	**  _set_user ==> Sets an user's basic information			 				**
	**	$user : ID of the user to update. If NULL, the info will be inserted	**
	**																			**
	**--------------------------------------------------------------------------*/
	function _set_user($user=NULL){
		$city = ($this->input->post('city')!=0)? $this->input->post('city'): NULL;
		$data = array(
			'idUser'		=> $this->input->post('username'),
			'Password' 		=> md5($this->input->post('password')),
			'eMail' 		=> $this->input->post('eMail'),
			'idLevel'		=> 2, //level = 2 ==> Normal User
			'First_Name'	=> $this->input->post('firstName'),
			'Middle_Name'	=> $this->input->post('secondName'),
			'Last_Name_1'	=> $this->input->post('firstSurname'),
			'Last_Name_2'	=> $this->input->post('secondSurname'),
			'Married_Name'	=> $this->input->post('marriedName'),
			'Birthdate'		=> changeDateFormat($this->input->post('birthDate')),
			'Birth_City'	=> $city,
			'idHonorific'	=> $this->input->post('honorific'),
			'Sex'			=> $this->input->post('sex'),
			'idReligion'	=> $this->input->post('religion'),
			'idDocument'	=> $this->input->post('idDoc'),
			'Passport'		=> $this->input->post('passport'),
			'ISSS'			=> $this->input->post('isss'),
			'NIT'			=> $this->input->post('nit'),
			'Height'		=> $this->input->post('height'),
			'H_Unit_Type'	=> $this->input->post('heightUnit'),
			'Weight'		=> $this->input->post('weight'),
			'W_Unit_Type'	=> $this->input->post('weightUnit'),			
		);
		
		return ($user==NULL)?$this->userModel->registerUser($data):$this->userModel->update($user,$data);
	}
}

