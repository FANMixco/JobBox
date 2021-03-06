<?php

class HonorificModel extends CI_Model{
	/*--------------------------------------------------------------------------*/
	/*  __construct ==> Call the Model constructor 								*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function __construct(){parent::__construct();}	
	
	/*--------------------------------------------------------------------------**
	**  getHonorifics ==> gets all the honorifics 								**
	**																			**
	**	RETURNS: Result array													**
	**																			**
	**--------------------------------------------------------------------------*/
	function getHonorifics(){
		return $this->db->get_where('honorifics',array(status => 1))->result_array();
	}

        
	function delete($honorific){
		$this->db->where(array(idHonorific => $honorific));
		$this->db->update(honorifics,array(status => 0));
		return $this->db->affected_rows();
	}        
}


?>