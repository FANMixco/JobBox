<h1><?php echo $this->lang->line('txt_coupons') ?></h1><hr /><br/>
<img src="<?php echo base_url('files/temp_images/punch.png'); ?>" class="ad-right" />
<h2><?php echo $this->lang->line('msg_congrats'); ?></h2><br/>
<p><?php echo $this->lang->line('msg_coupon_exchanged'); ?></p><br/>
<center><label style="font-size:15px;"><?php echo substr(md5($idCoupon.$this->session->userdata(idUser)),0,6); ?></label></center><br/>
<?php echo anchor(base_url('coupons/view/'.encodeID($idCoupon)),$this->lang->line('txt_go_back')); ?>