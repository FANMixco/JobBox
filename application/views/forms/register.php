<h1><?php echo $this->lang->line('txt_register') ?></h1><hr /><br/>
<p><?php echo $this->lang->line('msg_register') ?></p>
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
</table>
<?php echo validation_errors('<h5 class="message message-error" style="max-width:45%">','</h5>'); ?>
<?php echo form_close(); ?>
