<h1><?php echo $this->lang->line('txt_register') ?></h1><hr /><br/>
<h2><?php echo $this->lang->line('msg_congrats'); ?></h2>
<p><?php echo $this->lang->line('msg_user_registered'); ?></p>
<img src="<?php echo base_url('files/temp_images/punch.png'); ?>" class="ad-right" />
<?php echo anchor(base_url('./'),$this->lang->line('txt_go_back')); ?>