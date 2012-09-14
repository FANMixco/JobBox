<?php if ($app['Recruiter']!=NULL): ?>
<table>
	<tr>
		<td><?php echo form_label($this->lang->line('lbl_user')); ?></td>
		<td><?php echo $app['Name'] ?></td>
		<td class="tright"><?php echo form_label($this->lang->line('lbl_applied_job')); ?></td>
		<td><?php echo $app['Position_Name'] ?></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('lbl_reason')); ?></td>
		<td>
			<?php echo $app['Reason'] ?>
		</td>
		<td class="tright"><?php echo form_label($this->lang->line('lbl_origin')); ?></td>
		<td>
			<?php echo $app['Origin'] ?>
		</td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('lbl_contact')); ?></td>
		<td><?php echo $app['Contact'] ?></td>
		<td class="tright"><?php echo form_label($this->lang->line('lbl_chosen')); ?></td>
		<td><?php echo form_checkbox('chosen','',$app['Chosen']) ?></td>
	</tr>
</table>
<br/><br/>
<?php echo anchor(base_url('applications/view').'/'.encodeID($app['idJob']),$this->lang->line('txt_go_back')); ?>
<?php else: ?>
<?php echo form_open(); ?>
<table>
	<tr>
		<td><?php echo form_label($this->lang->line('lbl_user')); ?></td>
		<td><?php echo $app['Name'] ?></td>
		<td class="tright"><?php echo form_label($this->lang->line('lbl_applied_job')); ?></td>
		<td><?php echo $app['Position_Name'] ?></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('lbl_reason')); ?></td>
		<td>
			<select name="reason">
				<option value="Temporal"><?php echo $this->lang->line('txt_temp') ?></option>
				<option value="Permanente"><?php echo $this->lang->line('txt_perm') ?></option>
			</select>
		</td>
		<td class="tright"><?php echo form_label($this->lang->line('lbl_origin')); ?></td>
		<td>
			<select name="origin">
				<option value="Bolsa"><?php echo $this->lang->line('txt_bag') ?></option>
				<option value="Otros"><?php echo $this->lang->line('txt_other') ?></option>
			</select>
		</td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('lbl_contact')); ?></td>
		<td><?php echo form_input('contact',$this->input->post('contact')) ?></td>
		<td class="tright"><?php echo form_label($this->lang->line('lbl_chosen')); ?></td>
		<td><?php echo form_checkbox('chosen','',$this->input->post('chosen')) ?></td>
	</tr>
	<tr>
		<td colspan="4"><?php echo form_submit(array('name' => 'approve','class' => 'btn','value' => $this->lang->line('txt_send'))) ?></td>
	</tr>
</table>
<?php echo form_close(); ?>
<?php endif; ?>