<?php

class AcademicLevelModel extends CI_Model{
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
	function getAcademicLevels(){
		return $this->db->get_where('academic_levels',array(status => 1))->result_array();
	}

        
	function delete($academic_level){
		$this->db->where(array(idAcademic_Level => $academic_level));
		$this->db->update('Academic_Levels',array(status => 0));
		return $this->db->affected_rows();
	}        
}

?>
