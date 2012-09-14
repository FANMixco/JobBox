<?php

class CountryModel extends CI_Model{
	/*--------------------------------------------------------------------------*/
	/*  __construct ==> Call the Model constructor 								*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function __construct(){parent::__construct();}	
	
	/*--------------------------------------------------------------------------**
	**  getCountries ==> gets all the countries									**
	**																			**
	**	RETURNS: Result array													**
	**																			**
	**--------------------------------------------------------------------------*/
	function getCountries(){
		return $this->db->get_where('countries ORDER BY country',array(status => 1))->result_array();
	}
	
	/*--------------------------------------------------------------------------**
	**  getCountryStates ==> gets all the states that belong to a country		**
	**																			**
	**	RETURNS: Result array													**
	**																			**
	**--------------------------------------------------------------------------*/
	function getCountryStates($country){
		return $this->db->get_where('states',array(idCountry => $country,status => 1))->result_array();
	}
	
	/*--------------------------------------------------------------------------**
	**  getStateCities ==> gets all the cities that belong to a state			**
	**																			**
	**	RETURNS: Result array													**
	**																			**
	**--------------------------------------------------------------------------*/
	function getStateCities($state){
		return $this->db->get_where('cities',array(idState => $state,status => 1))->result_array();
	}
}


?>