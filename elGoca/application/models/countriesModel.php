<?php
class CountriesModel extends CI_Model{
	/* Call the Model constructor */
	function __construct(){parent::__construct();}
	
	/* gets all the countries */
	function getCountries(){return $this->db->get(countries)->result_array();}
	
}
?>
