<h1><?php echo $title; ?></h1><hr/><br/>
<h2><?php echo $this->lang->line('txt_step_1').' - '.$this->lang->line('txt_coupon_info'); ?></h2>
<img src="<?php echo base_url('files/temp_images/punch.png'); ?>" class="ad-right" />
<?php echo form_open(); ?>
<table>
	<tr>
		<td><?php echo form_label($this->lang->line('label_name')); ?></td>
		<td><?php echo form_input('name',$this->input->post('name')); ?></td>
		<td class="required"></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('label_event')); ?></td>
		<td><?php echo form_dropdown('event',$events,$this->input->post('event')); ?></td>
		<td class="required"></td>
	</tr>
    <tr>
		<td><?php echo form_label($this->lang->line('label_description')); ?></td>
		<td><?php echo form_textarea('description',$this->input->post('description')); ?></td>
        <td class="required"></td>		
	</tr> 
    <tr>
		<td><?php echo form_label($this->lang->line('label_restrictions')); ?></td>
		<td><?php echo form_textarea('restrictions',$this->input->post('restrictions')); ?></td>
        <td class="required"></td>		
	</tr>
    <tr>
		<td><?php echo form_label($this->lang->line('label_reg_price')); ?></td>
		<td><?php echo form_input('regPrice',$this->input->post('regPrice')); ?></td>		
        <td class="required"></td>
	</tr>
    <tr>
		<td><?php echo form_label($this->lang->line('label_coupon_price')); ?></td>
		<td><?php echo form_input('couponPrice',$this->input->post('couponPrice')); ?></td>		
        <td class="required"></td>
	</tr>
    <tr>
		<td><?php echo form_label($this->lang->line('label_start_date')); ?></td>
		<td><?php echo form_input(array('name' => 'startDate','id' => 'datepicker','value' => $this->input->post('startDate'))); ?></td>
		<td class="required"></td>
	</tr>
    <tr>
		<td><?php echo form_label($this->lang->line('label_start_hour')); ?></td>
		<td>
			<?php 
				echo form_dropdown('startHour',$time['Hours'],$this->input->post('startHour'),'class="mini" style="margin-right:5px;"');
				echo '<b>:</b>';
				echo form_dropdown('startMinute',$time['Minutes'],$this->input->post('startMinute'),'class="mini" style="margin:0 5px;"');
				echo '<b>:</b>';
				echo form_dropdown('startAMPM',$time['am'],$this->input->post('startAMPM'),'class="mini" style="margin-left:5px;"');
			?>
        </td>
		<td class="required"></td>
	</tr>
    <tr>
		<td><?php echo form_label($this->lang->line('label_end_date')); ?></td>
		<td><?php echo form_input(array('name' => 'endDate','id' => 'endDate','value' => $this->input->post('endDate'))); ?></td>
		<td class="required"></td>
	</tr> 
    <tr>
		<td><?php echo form_label($this->lang->line('label_end_hour')); ?></td>
		<td>
			<?php 
				echo form_dropdown('endHour',$time['Hours'],$this->input->post('endHour'),'class="mini" style="margin-right:5px;"');
				echo '<b>:</b>';
				echo form_dropdown('endMinute',$time['Minutes'],$this->input->post('endMinute'),'class="mini" style="margin:0 5px;"');
				echo '<b>:</b>';
				echo form_dropdown('endAMPM',$time['am'],$this->input->post('endAMPM'),'class="mini" style="margin-left:5px;"');
			?>
        </td>
		<td class="required"></td>
	</tr>   	        
    <tr>
		<td><?php echo form_label($this->lang->line('label_total_qty')); ?></td>
		<td><?php echo form_input('totalQty',$this->input->post('totalQty')); ?></td>
        <td class="required"></td>
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
<?php echo $datePicker; //print the calendar ?>
<script type="text/javascript">
	$('#endDate').datepicker({dateFormat:"dd/mm/yy"});
</script>