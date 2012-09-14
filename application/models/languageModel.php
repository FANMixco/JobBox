<?php

class languageModel extends CI_Model{
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
	function getLanguage(){
		return $this->db->get_where('languages',array(status => 1))->result_array();
	}

        function getLanguageLevel(){
		return $this->db->get_where('language_levels',array(status => 1))->result_array();
	}
        
	function delete($language){
		$this->db->where(array(idLanguage => $language));
		$this->db->update(languages,array(status => 0));
		return $this->db->affected_rows();
	}        
}


?>