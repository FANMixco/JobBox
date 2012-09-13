<h2><?php echo $this->lang->line('txt_user_ex_coupons'); ?></h2>
<?php	
	echo printTable($this->lang->line('txt_search'),$this->lang->line('header_user_coupons'),$userCoupons,array(name,'coupon','event','place'));
?>