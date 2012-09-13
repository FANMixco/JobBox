<?php

class PlaceModel extends CI_Model{
	/*--------------------------------------------------------------------------*/
	/*  __construct ==> Call the Model constructor 								*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function __construct(){parent::__construct();}
	
	/*--------------------------------------------------------------------------*/
	/*  getPlace ==> gets a place 												*/	
	/*																			*/
	/*  $place 	- Place's ID													*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function getPlace($place){
		$this->db->select('p.*,c.'.Country);
		$this->db->where(placeCountry.' = c.'.idCountry,NULL,false);
		return $this->db->get_where(places." p, ".countries." c",array(idPlace => $place))->row_array();
	}
	
	/*--------------------------------------------------------------------------*/
	/*  getPlaces ==> gets all the places 										*/	
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function getPlaces(){
		return $this->_PlacesQuery();		
	}
	
	/*--------------------------------------------------------------------------*/
	/*  getCatPlaces ==> gets all the places that belong to the specified 		*/
	/* 						category											*/		
	/*																			*/
	/* 	$category - ID of the category 											*/		
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function getCatPlaces($category){
		$this->db->where(idCategory,$category);		
		return $this->_PlacesQuery();
	}	

	/*--------------------------------------------------------------------------*/
	/*  getUserPlaces ==> gets all the places that belong to the user			*/	
	/*																			*/
	/*  $user 	- User's ID														*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function getUserPlaces($user=NULL){		
		return ($user==NULL)?$this->db->get(placesView)->result_array():$this->db->get_where(placesView,array(owner => $user))->result_array();
	}

	/*--------------------------------------------------------------------------*/
	/*  getLocation ==> gets the latitude & longitude of a place 				*/	
	/*																			*/
	/*  $place 	- Place's ID													*/
	/*																			*/
	/*  RETURNS: Array containing [latitude,longitude]							*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function getLocation($place){
		$this->db->select(latitude.','.longitude);
		return $this->db->get_where(places,array(idPlace => $place))->row_array();
	}

	/*--------------------------------------------------------------------------*/
	/*  addPlace ==> Inserts a new Place with the data provided 				*/
	/*																			*/
	/*  $data 	- Array containing the info of the place						*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function addPlace($data){
		$this->db->insert(places,$data);
		return $this->db->insert_id();
	}

	/*--------------------------------------------------------------------------*/
	/*  updatePlace ==> Updates the info of the place 			 				*/	
	/*																			*/
	/*  $place 	- Place's ID 													*/
	/*  $data 	- Array containing the new info of the place					*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function updatePlace($place,$data){
		$this->db->where(array(idPlace => $place));
		$this->db->update(places,$data);
		return $place;
	}
	
	/*--------------------------------------------------------------------------*/
	/*  delete ==> Deletes a place (Marks it as deleted)						*/
	/*																			*/
	/*  $place 	: ID of the place to delete 								 	*/	
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function delete($place){
		$this->db->where(array(idPlace => $place));
		$this->db->update(places,array(status => 0));
		return $this->db->affected_rows();
	}
	
	/*--------------------------------------------------------------------------*/
	/*  search ==> Searches all the places that match the criteria				*/
	/*																			*/
	/*  $criteria : Criteia of the search 									 	*/	
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function search($criteria){
		$this->db->like(name,$criteria);
		//$this->db->or_like(Category,$criteria);		
		return $this->_PlacesQuery();
	}
	
	/*--------------------------------------------------------------------------*/
	/*  addImg ==> Adds an image of the place specified			 				*/	
	/*																			*/
	/*  $place 	- Place's ID 													*/
	/*																			*/
	/*  NOTE: This function has been deprecated									*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	/*function addImg($place){
	}*/
	
	/*--------------------------------------------------------------------------*/
	/*  _PlacesQuery => Establish some common parts of the query		*/
	/*																			*/
	/*  NOTE: This function is used by getPlaces & getCatPlaces				 	*/	
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function _PlacesQuery(){
		//Select p.*, c.category from places p, categories c where c.idcategory = p.idcategory and p.status=1
		$this->db->select('p.*');
		$this->db->select('c.'.Category);
		$this->db->from(places.' p,'.categories.' c');
		$this->db->where('c.'.idCategory.'=p.'.placeCat,NULL,false);
		$this->db->where('p.'.status,1);
		$this->db->order_by(idPlace,'DESC');
		return $this->db->get()->result_array();
	}
	
}