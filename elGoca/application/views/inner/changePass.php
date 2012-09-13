<h1><?php echo $this->lang->line('txt_users') ?></h1><hr/><br/>
<h2><?php echo $this->lang->line('txt_change_pass') ?></h2><br/>
<img src="<?php echo base_url('files/temp_images/punch.png'); ?>" class="ad-right" />
<?php echo form_open(); ?>
<table>
	<tr>
		<td><?php echo form_label($this->lang->line('label_pass')); ?></td>
		<td><?php echo form_password('currentPass'); ?></td>
		<td class="required"></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('label_new_pass')); ?></td>
		<td><?php echo form_password('newPass'); ?></td>
		<td class="required"></td>
	</tr>
    <tr>
		<td><?php echo form_label($this->lang->line('label_pass_confirm')); ?></td>
		<td><?php echo form_password('pass_match'); ?></td>
		<td class="required"></td>
	</tr>
	<tr>
		<td colspan="2"><br/>                	
        	<?php 
				echo anchor('users/edit',$this->lang->line('txt_go_back'),array('class' => 'btn')); 
			?>
        	<button type="submit" class="btn-black">
            	<i class="icon icon-ok"></i>
            	<?php echo $this->lang->line('txt_update'); ?>            	
            </button>            
        </td>
	</tr>	
</table>
<?php 
	/* If there are messages, show them!*/
	if (isset($message) || ($message = $this->session->flashdata('message'))):
		echo '<h5 class="message message-error medium left">'.$message.'</h5><br/><br/><br/>';
	endif;
	echo validation_errors('<br/><h5 class="message message-error left" style="max-width:45%;">','</h5><br/>'); 
?>
<br/>
<?php echo form_close(); ?>