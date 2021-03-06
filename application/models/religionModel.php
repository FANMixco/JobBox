<?php

class ReligionModel extends CI_Model{
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
	function getReligions(){
		return $this->db->get_where('religions',array(status => 1))->result_array();
	}
        
	function delete($religion){
		$this->db->where(array(idReligion => $religion));
		$this->db->update(religions,array(status => 0));
		return $this->db->affected_rows();
	}
        
}


?>