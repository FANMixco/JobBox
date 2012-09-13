<h1><?php echo $this->lang->line('txt_register') ?></h1><hr /><br/><br/>
<h2>
	<?php 
		if ($user_type=='publicist'):
			echo $this->lang->line('txt_publicist_registry');
		else:
			echo ($user_type=='commercial')?$this->lang->line('txt_commercial_registry'):$this->lang->line('txt_visitor_registry');
		endif;
	 ?>
</h2>
<p>
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
</p>
<br/><br />
<img src="<?php echo base_url('files/temp_images/punch.png'); ?>" class="ad-right" />
<?php echo form_open(); ?>
<table>
	<tr>
		<td><?php echo form_label($this->lang->line('label_user')); ?></td>
		<td><?php echo form_input('username',$this->input->post('username')); ?></td>
		<td class="required"></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('label_name')); ?></td>
		<td><?php echo form_input('name',$this->input->post('name')); ?></td>
		<td class="required"></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('label_surname')); ?></td>
		<td><?php echo form_input('surname',$this->input->post('surname')); ?></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('label_birth_date')); ?></td>
		<td><?php echo form_input(array('name' => 'birthDate','id' => 'datepicker','value' => $this->input->post('birthDate'))); ?></td>
		<td class="required"></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('label_email')); ?></td>
		<td><?php echo form_input('eMail',$this->input->post('eMail')); ?></td>
		<td class="required"></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('label_phone')); ?></td>
		<td><?php echo form_input('phone',$this->input->post('phone')); ?></td>
	</tr>	
	<tr>
		<td><?php echo form_label($this->lang->line('label_country')); ?></td>
		<td><?php echo form_dropdown('country',$countries,$this->input->post('country')); ?></td>
		<td class="required"></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('label_state')); ?></td>
		<td><?php echo form_input('state',$this->input->post('state')); ?></td>		
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('label_city')); ?></td>
		<td><?php echo form_input('city',$this->input->post('city')); ?></td>
	</tr>	
	<tr>
		<td><?php echo form_label($this->lang->line('label_fav_cats')); ?></td>
		<td class="tleft">
			<?php 
				foreach($categories as $category):
					echo form_checkbox('cats[]',$category[idCategory]).$category[Category].'<br/>';
				endforeach; 
			?>
		</td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('label_pass')); ?></td>
		<td><?php echo form_password('pass'); ?></td>
		<td class="required"></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('label_pass_confirm')); ?></td>
		<td><?php echo form_password('pass_match'); ?></td>
		<td class="required"></td>
	</tr>
	<tr>
		<td colspan="2"><br/><?php echo form_submit(array('name' => 'send','value' => $this->lang->line('txt_send'),'class' => 'submit-btn')); ?></td>
	</tr>	
</table>
<?php echo validation_errors('<h5 class="message message-error" style="max-width:45%">','</h5>'); ?>
<br/>
<?php echo form_close(); ?>
<?php echo $datePicker; //print the calendar ?>