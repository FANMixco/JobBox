<h2><?php echo $this->lang->line('txt_user_places'); ?></h2>
<?php	
	echo printTable($this->lang->line('txt_search'),$this->lang->line('header_my_places'),$userPlaces,array(name,Category,type));
?>
<br/><br/>
<h2><?php echo $this->lang->line('txt_user_events'); ?></h2>
<?php
	echo printTable($this->lang->line('txt_search'),$this->lang->line('header_my_events'),$userEvents,array(name,'Place',eventDate,eventHour),NULL,'Events');
?>
<br/><br/>
<h2><?php echo $this->lang->line('txt_user_coupons'); ?></h2>
<?php	
	echo printTable($this->lang->line('txt_search'),$this->lang->line('header_my_coupons'),$userCoupons,array(name,'Event',startDate,endDate),NULL,'Coupons');
?>
<br/><br/>
<?php echo anchor('user/admin/commercial', $this->lang->line('txt_go_back'),array('class' => 'btn')); ?>