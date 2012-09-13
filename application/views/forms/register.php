<p><?php echo $this->lang->line('msg_register') ?></p><br/><br/>
<?php echo form_open(); ?>
<table>
	<tr>
		<td><?php echo form_label($this->lang->line('lbl_first_name')); ?></td>
		<td><?php echo form_input('firstName',$this->input->post('firstName')); ?></td>
		<td class="required"></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('lbl_second_name')); ?></td>
		<td><?php echo form_input('secondName',$this->input->post('secondName')); ?></td>
		<td class="required"></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('lbl_first_surname')); ?></td>
		<td><?php echo form_input('firstSurname',$this->input->post('firstSurname')); ?></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('lbl_birth_date')); ?></td>
		<td><?php echo form_input(array('name' => 'birthDate','id' => 'datepicker','value' => $this->input->post('birthDate'))); ?></td>
		<td class="required"></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('lbl_second_surname')); ?></td>
		<td><?php echo form_input('secondSurname',$this->input->post('secondSurname')); ?></td>
		<td class="required"></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo form_submit(array('name'=>'register','value' => $this->lang->line('txt_enter'),'class' =>'btn'));?></td>
	</tr>
</table>
<?php echo validation_errors('<h5 class="message message-error" style="max-width:45%">','</h5>'); ?>
<?php echo form_close(); ?>
