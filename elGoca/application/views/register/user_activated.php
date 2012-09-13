<h1><?php echo $this->lang->line('txt_user_activated') ?></h1><hr /><br/><br/>
<h2><?php echo $this->lang->line('msg_congrats'); ?></h2>
<p><?php echo $this->lang->line('msg_user_activated') ?></p>
<br /><br />
<img src="<?php echo base_url('files/temp_images/punch.png'); ?>" class="ad-right" />
<?php $this->load->view('register/sign_in'); ?>