<h1><?php echo $this->lang->line('txt_coupons') ?></h1><hr /><br/>
<p><?php echo $this->lang->line('msg_coupon_al_exchanged'); ?></p><br/>
<img src="<?php echo base_url('files/temp_images/punch.png'); ?>" class="ad-right" />
<?php echo anchor(base_url('coupons/view/'.encodeID($idCoupon)),$this->lang->line('txt_go_back')); ?>