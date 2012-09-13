<h1><?php echo $title; ?></h1><hr/><br/>
<h2><?php echo $this->lang->line('txt_step_1').' - '.$this->lang->line('txt_coupon_info'); ?></h2>
<img src="<?php echo base_url('files/temp_images/punch.png'); ?>" class="ad-right" />
<?php echo form_open(); ?>
<table>
	<tr>
		<td><?php echo form_label($this->lang->line('label_name')); ?></td>
		<td><?php echo form_input('name',$coupon[name]); ?></td>
		<td class="required"></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('label_event')); ?></td>
		<td><?php echo form_dropdown('event',$events,$coupon[couponEvent]); ?></td>
		<td class="required"></td>
	</tr>
     <tr>
		<td><?php echo form_label($this->lang->line('label_description')); ?></td>
		<td><?php echo form_textarea('description',$coupon[description]); ?></td>
        <td class="required"></td>		
	</tr>
    <tr>
		<td><?php echo form_label($this->lang->line('label_restrictions')); ?></td>
		<td><?php echo form_textarea('restrictions',$coupon[restrictions]); ?></td>
        <td class="required"></td>		
	</tr>
    <tr>
		<td><?php echo form_label($this->lang->line('label_reg_price')); ?></td>
		<td><?php echo form_input('regPrice',$coupon[regPrice]); ?></td>		
        <td class="required"></td>
	</tr>
    <tr>
		<td><?php echo form_label($this->lang->line('label_coupon_price')); ?></td>
		<td><?php echo form_input('couponPrice',$coupon[couponPrice]); ?></td>		
        <td class="required"></td>
	</tr>
    <tr>
		<td><?php echo form_label($this->lang->line('label_start_date')); ?></td>
		<td><?php echo form_input(array('name' => 'startDate','id' => 'datepicker','value' =>  changeDateFormat($coupon[startDate],true))); ?></td>
		<td class="required"></td>
	</tr>
    <tr>
		<td><?php echo form_label($this->lang->line('label_start_hour')); ?></td>
		<td>
			<?php 
				echo form_dropdown('startHour',$time['Hours'],substr($coupon[startHour],0,2),'class="mini" style="margin-right:5px;"');
				echo '<b>:</b>';
				echo form_dropdown('startMinute',$time['Minutes'],substr($coupon[startHour],3,2),'class="mini" style="margin:0 5px;"');
				echo '<b>:</b>';
				echo form_dropdown('startAMPM',$time['am'],substr($coupon[startHour],6,2),'class="mini" style="margin-left:5px;"');
			?>
        </td>
		<td class="required"></td>
	</tr>
    <tr>
		<td><?php echo form_label($this->lang->line('label_end_date')); ?></td>
		<td><?php echo form_input(array('name' => 'endDate','id' => 'endDate','value' => changeDateFormat($coupon[endDate],true))); ?></td>
		<td class="required"></td>
	</tr> 
    <tr>
		<td><?php echo form_label($this->lang->line('label_end_hour')); ?></td>
		<td>
			<?php 
				echo form_dropdown('endHour',$time['Hours'],substr($coupon[endHour],0,2),'class="mini" style="margin-right:5px;"');
				echo '<b>:</b>';
				echo form_dropdown('endMinute',$time['Minutes'],substr($coupon[endHour],3,2),'class="mini" style="margin:0 5px;"');
				echo '<b>:</b>';
				echo form_dropdown('endAMPM',$time['am'],substr($coupon[endHour],6,2),'class="mini" style="margin-left:5px;"');
			?>
        </td>
		<td class="required"></td>
	</tr>   	        
    <tr>
		<td><?php echo form_label($this->lang->line('label_total_qty')); ?></td>
		<td><?php echo form_input('totalQty',$coupon[Qty]); ?></td>
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