<?php

class SchoolModel extends CI_Model{
	/*--------------------------------------------------------------------------*/
	/*  __construct ==> Call the Model constructor 								*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function __construct(){parent::__construct();}	
	
	/*--------------------------------------------------------------------------**
	**  getReligions ==> gets all the religions 								**
	**																			**
	**	RETURNS: Result array													**
	**																			**
	**--------------------------------------------------------------------------*/
	function getSchools(){
		return $this->db->get_where('schools',array(status => 1))->result_array();
	}

        
	function delete($school){
		$this->db->where(array(idSchool => $school));
		$this->db->update(schools,array(status => 0));
		return $this->db->affected_rows();
	}
        
}


?>