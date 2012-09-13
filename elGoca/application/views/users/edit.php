<h2 class="tright"><?php echo $this->lang->line('txt_user_edit') ?></h2><br/>
<?php echo form_open(); ?>

<table>
	<tr>
		<td><?php echo form_label($this->lang->line('label_user')); ?></td>
		<td><?php echo form_input(array('name' => 'username','value' => $user[userName],'readonly' => 'readonly')); ?></td>
		<td class="required"></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('label_name')); ?></td>
		<td><?php echo form_input('name',$user[name]); ?></td>
		<td class="required"></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('label_surname')); ?></td>
		<td><?php echo form_input('surname',$user[surname]); ?></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('label_birth_date')); ?></td>
		<td><?php echo form_input(array('name' => 'birthDate','id' => 'datepicker','value' => changeDateFormat($user[birthDate],true))); ?></td>
		<td class="required"></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('label_email')); ?></td>
		<td><?php echo form_input(array('name' => 'eMail','value' => $user[eMail],'readonly' => 'readonly')); ?></td>		
		<td class="required"></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('label_phone')); ?></td>
		<td><?php echo form_input('phone',$user[phone]); ?></td>
	</tr>	
	<tr>
		<td><?php echo form_label($this->lang->line('label_country')); ?></td>
		<td><?php echo form_dropdown('country',$countries,$user[userCountry]); ?></td>
		<td class="required"></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('label_state')); ?></td>
		<td><?php echo form_input('state',$user[state]); ?></td>		
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('label_city')); ?></td>
		<td><?php echo form_input('city',$user[city]); ?></td>
	</tr>	
	<tr>
		<td><?php echo form_label($this->lang->line('label_fav_cats')); ?></td>
		<td class="tleft">
			<?php 
				foreach($categories as $category):
					echo form_checkbox('cats[]',$category[idCategory],in_array($category[idCategory],$userCats)).$category[Category].'<br/>';
				endforeach; 
			?>
		</td>
	</tr>	
	<tr>
		<td colspan="2"><br/>        
        	<?php 
				$userType = array('admins','commercial','publicist','visitor');
				echo anchor('user/admin/'.$userType[$user[Level]-1],$this->lang->line('txt_go_back'),array('class' => 'btn')); 
			?>
        	<button type="submit" class="btn-black">
            	<i class="icon icon-ok"></i>
            	<?php echo $this->lang->line('txt_update'); ?>            	
            </button>
        </td>
	</tr>	
</table>
<?php echo validation_errors('<h5 class="message message-error" style="max-width:45%">','</h5>'); ?>
<br/>
<?php echo form_close(); ?>

<?php echo $datePicker; //print the calendar ?>
<script type="text/javascript">
	$( "#datepicker" ).datepicker({ dateFormat: "dd/mm/yy" });
</script>