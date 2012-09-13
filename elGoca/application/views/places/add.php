<h1><?php echo $title; ?></h1><hr/><br/>
<h2><?php echo $this->lang->line('txt_step_1').' - '.$this->lang->line('txt_place_info'); ?></h2>
<img src="<?php echo base_url('files/temp_images/punch.png'); ?>" class="ad-right" />
<?php echo form_open(); ?>
<table>	
	<tr>
		<td><?php echo form_label($this->lang->line('label_name')); ?></td>
		<td><?php echo form_input('name',$this->input->post('name')); ?></td>
		<td class="required"></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('label_category')); ?></td>
		<td><?php echo form_dropdown('category',$categories,$this->input->post('category')); ?></td>
		<td class="required"></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('label_type')); ?></td>
		<td><?php echo form_input('type',$this->input->post('type')); ?></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('label_description')); ?></td>
		<td><?php echo form_textarea('description',$this->input->post('description')); ?></td>
		<td class="required"></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('label_capacity')); ?></td>
		<td><?php echo form_input('capacity',$this->input->post('capacity')); ?></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('label_price')); ?></td>
		<td><?php echo form_input('price',$this->input->post('price')); ?></td>		
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
		<td><?php echo form_label($this->lang->line('label_address')); ?></td>
		<td><?php echo form_textarea('address',$this->input->post('address')); ?></td>
		<td class="required"></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('label_phone')); ?></td>
		<td><?php echo form_input('phone',$this->input->post('phone')); ?></td>		
	</tr>
    <tr>
		<td><?php echo form_label($this->lang->line('label_website')); ?></td>
		<td><?php echo form_input('website',$this->input->post('website')); ?></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('label_email')); ?></td>
		<td><?php echo form_input('eMail',$this->input->post('eMail')); ?></td>		
	</tr>	
	<tr>
		<td><?php echo form_label($this->lang->line('label_fb')); ?></td>
		<td><?php echo form_input('fb',$this->input->post('fb')); ?></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('label_twitter')); ?></td>
		<td><?php echo form_input('twitter',$this->input->post('twitter')); ?></td>
	</tr>		
	<tr>
		<td colspan="2"><br/>
        	<?php echo anchor('admin',$this->lang->line('txt_go_back'),array('class' => 'btn')); ?>
        	<button type="submit" class="btn-black">
            	<i class="icon icon-ok"></i>
            	<?php echo $this->lang->line('txt_save'); ?>            	
            </button>
        </td>
	</tr>	
</table>
<?php echo validation_errors('<h5 class="message message-error" style="max-width:45%">','</h5>'); ?>
<br/>
<?php echo form_close(); ?>