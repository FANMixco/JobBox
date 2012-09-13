<?php echo $geocode; ?>
<?php if ($this->session->userdata(Level)!=1): ?><h1><?php echo $title; ?></h1><hr/><br/><?php endif; ?>
<h2><?php echo $this->lang->line('txt_step_2').' - '.$this->lang->line('txt_place_location'); ?></h2>
<br/><br/>
<form onsubmit="codeAddress(); return false;">
<input type="text" id="address" placeholder="<?php echo $this->lang->line('txt_search'); ?>" />
<input type="submit" value="<?php echo $this->lang->line('txt_search'); ?>" />
</form><br/>
<div id="map_canvas" class="center"></div><br/><br/>
<?php echo form_open(); ?>
	<input type="hidden" id="latitude" name="latitude" />	
	<input type="hidden" id="longitude" name="longitude" />	
	<center>		
	<?php echo anchor('place/edit/'.$place,$this->lang->line('txt_go_back'),array('class' => 'btn','style' => 'margin-right:5px;'));
	?>
	<button type="submit" class="btn-black">
		<i class="icon icon-ok"></i>
		<?php echo $this->lang->line('txt_save'); ?>
	</button>
	</center>
<?php echo form_close(); ?>
