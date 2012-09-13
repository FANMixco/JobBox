<h1><?php echo $title; ?></h1><hr/><br/>
<h2 class="tright"><?php echo $this->lang->line('txt_user_commercial'); ?></h2><br/>

<?php  
	/* If there are messages, show them!*/
    if ($message = $this->session->flashdata('message'))
        echo '<h5 class="message message-info medium">'.$message.'</h5><br/><br/>';		
?>

<h2><?php echo $this->lang->line('txt_my_places'); ?></h2>
<?php	
	echo anchor('place/add',$this->lang->line('txt_new_place'),array('class' => 'action-button add right'));
	echo '<br/>';
	echo printTable($this->lang->line('txt_search_my_places'),$this->lang->line('header_my_places'),$userPlaces,array(name,Category,type),array('place','place',idPlace,$this->lang->line('txt_actions')));
?>
<br/><br/>
<h2><?php echo $this->lang->line('txt_my_events'); ?></h2>
<?php
	echo anchor('event/add',$this->lang->line('txt_new_event'),array('class' => 'action-button add right'));
	echo '<br/>';
	echo printTable($this->lang->line('txt_search_my_events'),$this->lang->line('header_my_events'),$userEvents,array(name,'Place',eventDate,eventHour),array('event','event',idEvent,$this->lang->line('txt_actions')),'MyEvents');
?>
<br/><br/>
<h2><?php echo $this->lang->line('txt_my_coupons'); ?></h2>
<?php	
	echo anchor('coupon/add',$this->lang->line('txt_new_coupon'),array('class' => 'action-button add right'));
	echo '<br/>';
	echo printTable($this->lang->line('txt_search_my_coupons'),$this->lang->line('header_my_coupons'),$userCoupons,array(name,'Event',startDate,endDate),array('coupon','coupon',idCoupon,$this->lang->line('txt_actions')),'MyCoupons');
?>
<br/><br/>