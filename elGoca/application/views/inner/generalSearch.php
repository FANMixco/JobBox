<h1><?php echo $this->lang->line('txt_events'); ?></h1><hr/><br/><br/>
<?php echo printList($this->lang->line('txt_search'),'event',$this->lang->line('msg_no_events'),$events,array(idEvent,name,description), array('events/view/',idEvent),'events'); ?>

<h1><?php echo $this->lang->line('txt_places'); ?></h1><hr/><br/><br/>
<?php echo printList($this->lang->line('txt_search'),'place',$this->lang->line('msg_no_events'),$places,array(idPlace,name,description), array('places/view/',idPlace),'places'); ?>

<h1><?php echo $this->lang->line('txt_coupons'); ?></h1><hr/><br/><br/>
<?php echo printList($this->lang->line('txt_search'),'coupon',$this->lang->line('msg_no_coupons'),$coupons,array(idCoupon,name,description), array('coupons/view/',idCoupon),'coupons'); ?>