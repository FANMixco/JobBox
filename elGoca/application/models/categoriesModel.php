<?php
class CategoriesModel extends CI_Model{
	/* Call the Model constructor */
	function __construct(){parent::__construct();}
	
	/* gets all the categories */
	function getCategories(){return $this->db->get(categories)->result_array();}
	
}
?>
