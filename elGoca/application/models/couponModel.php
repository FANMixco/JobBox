<?php

class CouponModel extends CI_Model{
	/*--------------------------------------------------------------------------*/
	/*  __construct ==> Call the Model constructor 								*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function __construct(){parent::__construct();}
	
	/*--------------------------------------------------------------------------*/
	/*  getCoupon ==> gets a coupon												*/	
	/*																			*/
	/*  $coupon - Coupon's ID													*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function getCoupon($coupon){
		$this->db->select('*');
		$this->db->select("DATE_FORMAT(StartDate, '%h:%i %p') StartHour",false);
		$this->db->select("DATE_FORMAT(EndDate, '%h:%i %p') EndHour",false);
		return $this->db->get_where(coupons,array(idCoupon => $coupon))->row_array();
	}
	
	/*--------------------------------------------------------------------------*/
	/*  getCouponEx ==> gets a coupon from the extended view					*/	
	/*																			*/
	/*  $coupon - Coupon's ID													*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function getCouponEx($coupon){		
		return $this->db->get_where(couponsViewEx,array(idCoupon => $coupon))->row_array();
	}
	
	/*--------------------------------------------------------------------------*/
	/*  getUserCoupons ==> gets all the coupons that belong to the user			*/	
	/*																			*/
	/*  $user 	- User's ID														*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function getUserCoupons($user){		
		return $this->db->get_where(couponsView,array(owner => $user))->result_array();
	}
	
	/*--------------------------------------------------------------------------*/
	/*  getEventCoupons ==> gets all the coupons that belong to the event		*/	
	/*																			*/
	/*  $event 	- Event's ID													*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function getEventCoupons($event){
		$this->db->where('NOW() BETWEEN '.startDate.' AND '.endDate,NULL,false);		
		return $this->db->get_where(coupons,array(couponEvent => $event,status => 1))->result_array();
	}
	
	/*--------------------------------------------------------------------------*/
	/*  getPlaceCoupons ==> gets all the coupons that belong to the place		*/	
	/*																			*/
	/*  $place 	- Place's ID													*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function getPlaceCoupons($place){
		$this->db->select('c.*');
		$this->db->from(coupons.' c, '.events.' e, '.places.' p');
		$this->db->where(couponEvent.' = '.idEvent,NULL,false);
		$this->db->where(eventPlace.' = '.idPlace,NULL,false);
                $this->db->where('NOW() BETWEEN '.startDate.' AND '.endDate,NULL,false);
		$this->db->where(array('c.'.status => 1,'e.'.status => 1,'p.'.status => 1,idPlace => $place));
		return $this->db->get()->result_array();
	}
	
	/*--------------------------------------------------------------------------*/
	/*  addCoupon ==> Inserts a new Coupon with the data provided 				*/
	/*																			*/
	/*  $data 	- Array containing the info of the Coupon						*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function addCoupon($data){
		$this->db->insert(coupons,$data);
		return $this->db->insert_id();
	}

	/*--------------------------------------------------------------------------*/
	/*  updateCoupon ==> Updates the info of the Coupon 		 				*/	
	/*																			*/
	/*  $coupon - Coupon's ID 													*/
	/*  $data 	- Array containing the new info of the Coupon					*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function updateCoupon($coupon,$data){
		$this->db->where(array(idCoupon => $coupon));
		$this->db->update(coupons,$data);
		return $coupon;
	}
	
	/*--------------------------------------------------------------------------*/
	/*  delete ==> Deletes a Coupon (Marks it as deleted)						*/
	/*  $coupon 	: ID of the Coupon to delete 						 		*/	
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function delete($coupon){
		$this->db->where(array(idCoupon => $coupon));
		$this->db->update(coupons,array(status => 0));
		return $this->db->affected_rows();
	}
        
        /*--------------------------------------------------------------------------*/
	/*  search ==> Searches all the coupons that match the criteria				*/
	/*																			*/
	/*  $criteria : Criteia of the search 									 	*/	
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function search($criteria){		
		$this->db->select('c.*');
		$this->db->from(coupons.' c, '.events.' e');
		$this->db->where(couponEvent.' = '.idEvent,NULL,false);		
                $this->db->where('NOW() BETWEEN '.startDate.' AND '.endDate,NULL,false);
		$this->db->where(array('c.'.status => 1,'e.'.status => 1));
                $this->db->like('c.'.name,$criteria);
		return $this->db->get()->result_array();
	}
	
	/*--------------------------------------------------------------------------*/
	/*  exchange ==> Exchanges a coupon (Inserts it in coupons per user)		*/
	/*  $coupon 	: ID of the Coupon to exchange 						 		*/
	/*  $user 		: ID of the user that is exchanging the coupon		 		*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function exchange($coupon,$user){
		$this->db->insert(CouponsPerUser,array(idUserCoupon => $coupon, idCUser => $user, code => substr(md5($coupon.$user),0,6)));		
	}
	
	/*--------------------------------------------------------------------------*/
	/* hasExchanged ==> Verifies if an user has exchanged a coupon 				*/
	/*  $coupon 	: ID of the Coupon 									 		*/
	/*  $user 		: ID of the user 									 		*/
	/*																			*/
	/*  RETURNS	: (int) number of rows. Must be zero in order to exchange					 		*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function hasExchanged($coupon,$user){
		return $this->db->get_where(CouponsPerUser,array(idUserCoupon => $coupon, idCUser => $user))->num_rows();
	}
        
        /*--------------------------------------------------------------------------*/
	/* getExchangedCoupons ==> gets all the coupons that an user has exchanged 				*/	
	/*  $user 		: ID of the user 									 		*/
	/*																			*/
	/*  RETURNS	: RESULT ARRAY  				 		*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
        function getExchangedCoupons($user=NULL){
            return ($user!=NULL)? $this->db->get_where(exCouponsView,array(idCUser => $user, status => 1))->result_array()
                    :$this->db->get_where(exCouponsView,array(status => 1))->result_array();
        }
	
}

?>