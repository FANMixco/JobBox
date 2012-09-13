<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Country extends CI_Controller {

	/*--------------------------------------------------------------------------*/
	/*  __construct ==> Call the Model constructor 								*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function __construct(){parent::__construct(); $this->load->model('countryModel');}		
	
	/*--------------------------------------------------------------------------**
	**  getStates ==> gets the states that belong to a country					**
	**																			**
	**--------------------------------------------------------------------------*/
	public function getStates($country){
		$states = $this->countryModel->getCountryStates($country);
		if (!empty($states)):
			//Construct the string for the <select>
			$resp='';
			foreach($states as $state):
				$resp .= '<option value="'.$state[idState].'">'.$state[state].'</option>';
			endforeach;
			echo $resp;
		else:
			echo '';
		endif;
	}
	
	/*--------------------------------------------------------------------------**
	**  getCities ==> gets the cities that belong to a state					**
	**																			**
	**--------------------------------------------------------------------------*/
	public function getCities($state){
		$cities = $this->countryModel->getStateCities($state);
		print_r($cities);
		if (!empty($cities)):
			//Construct the string for the <select>
			$resp='';
			foreach($cities as $city):
				$resp .= '<option value="'.$city[idCity].'">'.$city[city].'</option>';
			endforeach;
			echo $resp;
		else:
			echo '';
		endif;
	}
}

