<h1><?php echo $this->lang->line('txt_users') ?></h1><hr /><br/>
<h2><?php echo $this->lang->line('txt_pass_changed'); ?></h2>
<p><?php echo $this->lang->line('msg_pass_changed'); ?></p>
<img src="<?php echo base_url('files/temp_images/punch.png'); ?>" class="ad-right" />
<br/>
<?php echo anchor(base_url('users/edit'),$this->lang->line('txt_go_back')); ?>