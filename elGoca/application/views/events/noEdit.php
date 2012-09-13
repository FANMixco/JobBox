<h1><?php echo $title; ?></h1><hr/><br/>
<h2><?php echo $this->lang->line('txt_step_3').' - '.$this->lang->line('txt_image_selection'); ?></h2><br/>

<h5 class="message message-error"><?php echo $this->lang->line('msg_no_edit'); ?></h5><br/><br/>
<center>
<?php 
	echo anchor('event/edit/'.$event,$this->lang->line('txt_go_back'),array('class' => 'btn','style' => 'margin-right:5px;'));
	echo anchor('event/images/'.$event,$this->lang->line('txt_try_again'),array('class' => 'btn','style' => 'margin-right:5px;'));
	echo anchor('admin/',$this->lang->line('txt_cancel'),array('class' => 'btn'));
?>
</center>