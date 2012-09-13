<?php if ($this->session->userdata(Level)==1): ?>
<h2><?php echo $this->lang->line('txt_step_1').' - '.$this->lang->line('txt_event_info'); ?></h2>
<?php else: ?>
<h1><?php echo $title; ?></h1><hr/><br/>
<h2><?php echo $this->lang->line('txt_step_1').' - '.$this->lang->line('txt_event_info'); ?></h2>
<img src="<?php echo base_url('files/temp_images/punch.png'); ?>" class="ad-right" />
<?php endif; ?>

<?php echo form_open(); ?>
<table>	
	<tr>
		<td><?php echo form_label($this->lang->line('label_name')); ?></td>
		<td><?php echo form_input('name',$event[name]); ?></td>
		<td class="required"></td>
	</tr>
    <tr>
		<td><?php echo form_label($this->lang->line('label_description')); ?></td>
		<td><?php echo form_textarea('description',$event[description]); ?></td>
		<td class="required"></td>
	</tr>
    <tr>
		<td><?php echo form_label($this->lang->line('label_place')); ?></td>
		<td><?php echo form_dropdown('place',$places,$event[eventPlace]); ?></td>
		<td class="required"></td>
	</tr>
    <tr>
		<td><?php echo form_label($this->lang->line('label_price')); ?></td>
		<td><?php echo form_input('price',$event[price]); ?></td>		
        <td class="required"></td>
	</tr>
    <tr>
		<td><?php echo form_label($this->lang->line('label_event_date')); ?></td>
		<td><?php echo form_input(array('name' => 'eventDate','id' => 'datepicker','value' => changeDateFormat($event[eventDate],true))); ?></td>
		<td class="required"></td>
	</tr>
    <tr>
		<td><?php echo form_label($this->lang->line('label_hour')); ?></td>
		<td>
			<?php 
				echo form_dropdown('eventHour',$time['Hours'],substr($event[eventHour],0,2),'class="mini" style="margin-right:5px;"');
				echo '<b>:</b>';
				echo form_dropdown('eventMinute',$time['Minutes'],substr($event[eventHour],3,2),'class="mini" style="margin:0 5px;"');
				echo '<b>:</b>';
				echo form_dropdown('eventAMPM',$time['am'],substr($event[eventHour],6,2),'class="mini" style="margin-left:5px;"');
			?>
        </td>
		<td class="required"></td>
	</tr>
    <tr>
		<td><?php echo form_label($this->lang->line('label_website')); ?></td>
		<td><?php echo form_input('website', $event[Website]); ?></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('label_email')); ?></td>
		<td><?php echo form_input('eMail', $event[eMail]); ?></td>		
	</tr>	
	<tr>
		<td><?php echo form_label($this->lang->line('label_fb')); ?></td>
		<td><?php echo form_input('fb',$event[FB]); ?></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('label_twitter')); ?></td>
		<td><?php echo form_input('twitter',$event[Twitter]); ?></td>
	</tr>
    <tr>
		<td colspan="2"><br/>
        	<?php echo anchor($link,$this->lang->line('txt_go_back'),array('class' => 'btn')); ?>
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