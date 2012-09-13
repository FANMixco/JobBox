<?php

class EventModel extends CI_Model{
	/*--------------------------------------------------------------------------*/
	/*  __construct ==> Call the Model constructor 								*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function __construct(){parent::__construct();}
	
	/*--------------------------------------------------------------------------*/
	/*  getCurrentEvents ==> gets all the in-coming events						*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function getCurrentEvents(){
		return $this->_execQuery();
	}
	
	/*--------------------------------------------------------------------------*/
	/*  getDateEvents ==> gets all the events of a specific date				*/
	/*  $date 	- Date to filter. Default is today								*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function getDateEvents($date=''){
		if ($date == '')$date=date('Y-m-d');
		$this->db->select(idEvent.','.name);
		$this->db->like(eventDate,$date);
		$this->db->order_by(eventDate,'ASC');
		return $this->db->get_where(events,array(status => 1))->result_array();		
	} 
	
	/*--------------------------------------------------------------------------*/
	/*  getPlaceEvents ==> gets all the events of a place						*/
	/*  $place 	- Place's ID													*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function getPlaceEvents($place){
		$this->db->where(eventPlace,$place);
		return $this->_execQuery();
	}
	
	/*--------------------------------------------------------------------------*/
	/*  getEvent ==> gets an event 												*/	
	/*																			*/
	/*  $event 	- Event's ID													*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function getEvent($event){
		$this->db->select('e.*, p.'.name.' place');
		$this->db->select("DATE_FORMAT(EventDate, '%h:%i %p') EventHour",false);
		$this->db->where(eventPlace.' = p.'.idPlace,NULL,false);
		return $this->db->get_where(events." e,".places." p",array(idEvent => $event))->row_array();
	}
	
	/*--------------------------------------------------------------------------*/
	/*  getUserEvents ==> gets all the events that belong to the user			*/	
	/*																			*/
	/*  $user 	- User"s ID														*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function getUserEvents($user=NULL){
		return ($user==NULL)?  $this->db->get(eventsView)->result_array() : $this->db->get_where(eventsView,array(owner => $user))->result_array();
	}
	
	/*--------------------------------------------------------------------------*/
	/*  addEvent ==> Inserts a new Event with the data provided 				*/
	/*																			*/
	/*  $data 	- Array containing the info of the event						*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function addEvent($data){
		$this->db->insert(events,$data);
		return $this->db->insert_id();
	}
	
	/*--------------------------------------------------------------------------*/
	/*  updateEvent ==> Updates the info of the Event 			 				*/	
	/*																			*/
	/*  $event 	- Event's ID 													*/
	/*  $data 	- Array containing the new info of the Event					*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function updateEvent($event,$data){
		$this->db->where(array(idEvent => $event));
		$this->db->update(events,$data);
		return $event;
	}
	
	/*--------------------------------------------------------------------------*/
	/*  delete ==> Deletes a Event (Marks it as deleted)						*/
	/*  $event 	: ID of the Event to delete 								 	*/	
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function delete($event){
		$this->db->where(array(idEvent => $event));
		$this->db->update(events,array(status => 0));
		return $this->db->affected_rows();
	}
	
	/*--------------------------------------------------------------------------*/
	/*  search ==> Searches events that match the criteria				*/
	/*  $criteria 	: Filter of the search 								 		*/	
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function search($criteria){
		$this->db->like(name,$criteria);
                $this->db->or_like(eventDate,$criteria);
		return $this->_execQuery();
	}
	
	/*--------------------------------------------------------------------------*/
	/*  _execQuery ==> Executes a query returning the current events			*/
	/*																			*/
	/*  NOTE: This function is used by getCurrentEvents(), getPlaceEvents(), 	*/
	/*			and search														*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function _execQuery(){
		$this->db->where(eventDate.'>=NOW()',NULL, false);
		$this->db->order_by(eventDate,'ASC');
		return $this->db->get_where(events,array(status => 1))->result_array();
	}
}

?>