<h1><?php echo $this->lang->line('txt_coupons') ?></h1><hr /><br/>
<img src="<?php echo base_url('files/temp_images/punch.png'); ?>" class="ad-right" />
<p><?php echo $this->lang->line('msg_no_coupons_left'); ?></p><br/>
<?php echo anchor(base_url('coupons/view/'.encodeID($idCoupon)),$this->lang->line('txt_go_back')); ?>