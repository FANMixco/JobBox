<?php

class LevelModel extends CI_Model{
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
	function getLevel(){
		return $this->db->get_where('levels',array(status => 1))->result_array();
	}

        
	function delete($level){
		$this->db->where(array(idLevel => $level));
		$this->db->update(levels,array(status => 0));
		return $this->db->affected_rows();
	}
}

?>
