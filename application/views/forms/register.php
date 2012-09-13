<p><?php echo $this->lang->line('msg_register') ?></p><br/><br/>
<?php echo form_open(); ?>
<h2><?php echo $this->lang->line('txt_system_access') ?></h2>
<table>
	<tr>		
		<td><?php echo form_label($this->lang->line('lbl_email')); ?></td>
		<td class="required"><?php echo form_input('eMail',$this->input->post('eMail')); ?></td>
		<td class="tright"><?php echo form_label($this->lang->line('lbl_user')); ?></td>
		<td class="required"><?php echo form_input('username',$this->input->post('username')); ?></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('lbl_pass')); ?></td>
		<td class="required"><?php echo form_password('password',$this->input->post('password')); ?></td>
		<td class="tright"><?php echo form_label($this->lang->line('lbl_pass_confirm')); ?></td>
		<td class="required"><?php echo form_password('passConfirm',$this->input->post('passConfirm')); ?></td>		
	</tr>
	<tr>
		<td colspan="5"><h2><?php echo $this->lang->line('txt_personal_info') ?></h2></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('lbl_first_name')); ?></td>
		<td class="required"><?php echo form_input('firstName',$this->input->post('firstName')); ?></td>
		<td class="tright"><?php echo form_label($this->lang->line('lbl_second_name')); ?></td>
		<td><?php echo form_input('secondName',$this->input->post('secondName')); ?></td>		
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('lbl_first_surname')); ?></td>
		<td class="required"><?php echo form_input('firstSurname',$this->input->post('firstSurname')); ?></td>
		<td class="tright"><?php echo form_label($this->lang->line('lbl_second_surname')); ?></td>
		<td><?php echo form_input('secondSurname',$this->input->post('secondSurname')); ?></td>		
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('lbl_married_name')); ?></td>
		<td><?php echo form_input('marriedName',$this->input->post('marriedName')); ?></td>
		<td class="tright"><?php echo form_label($this->lang->line('lbl_birth_date')); ?></td>
		<td><?php echo form_input(array('name' => 'birthDate','id' => 'datepicker','value' => $this->input->post('birthDate'))); ?></td>		
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('lbl_sex')); ?></td>
		<td><?php echo form_dropdown('sex',array('M' => $this->lang->line('txt_male'),'F' => $this->lang->line('txt_female')),$this->input->post('sex')); ?></td>
		<td class="tright"><?php echo form_label($this->lang->line('lbl_honorific')); ?></td>
		<td><?php echo form_dropdown('honorific',$honorifics,$this->input->post('honorific')); ?></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('lbl_birth_country')); ?></td>
		<td><?php echo form_dropdown('country',$countries,$this->input->post('country'),'id="country"'); ?></td>
		<td class="tright"><?php echo form_label($this->lang->line('lbl_birth_province')); ?></td>
		<td><select id="state" name="state"></select></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('lbl_birth_city')); ?></td>
		<td><select id="city" name="city"></select></td>
	</tr>
	<tr>
		<td colspan="5"><h2 style="margin-top:10px;"><?php echo $this->lang->line('txt_docs') ?></h2></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('lbl_document')); ?></td>
		<td class="required"><?php echo form_input('idDoc',$this->input->post('idDoc')); ?></td>
		<td class="tright"><?php echo form_label($this->lang->line('lbl_passport')); ?></td>
		<td><?php echo form_input('passport',$this->input->post('passport')); ?></td>				
	</tr>
	<tr>				
		<td><?php echo form_label($this->lang->line('lbl_nit')); ?></td>
		<td class="required"><?php echo form_input('nit',$this->input->post('nit')); ?></td>
		<td class="tright"><?php echo form_label($this->lang->line('lbl_isss')); ?></td>
		<td><?php echo form_input('isss',$this->input->post('isss')); ?></td>
	</tr>	
	<tr>
		<td colspan="5"><h2 style="margin-top:10px;"><?php echo $this->lang->line('txt_other_info') ?></h2></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('lbl_height')); ?></td>
		<td>
			<?php 
				echo form_input('height',$this->input->post('height')); 
				echo form_dropdown('heightUnit',
					array('m' => $this->lang->line('txt_meter'),'ft' => $this->lang->line('txt_feet')),
					$this->input->post('heightUnit'),
					'style="margin-left:5px; width:65px;"'); 
			?>
		</td>
		<td class="tright"><?php echo form_label($this->lang->line('lbl_religion')); ?></td>
		<td><?php echo form_dropdown('religion',$religions,$this->input->post('religion')); ?></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('lbl_weight')); ?></td>
		<td>
			<?php 
				echo form_input('weight',$this->input->post('weight')); 
				echo form_dropdown('weightUnit',
					array('lb' => $this->lang->line('txt_pounds'),'kg' => $this->lang->line('txt_kgs')),
					$this->input->post('weightUnit'),
					'style="margin-left:5px; width:65px;"'); 
			?>
		</td>
	</tr>
	<tr>
		<td colspan="5">
			<?php echo form_submit(array('name'=>'register','value' => $this->lang->line('txt_send'),'class' =>'btn','style'=> 'margin-top:15px;'));?>
		</td>
	</tr>
</table>
<?php echo validation_errors('<h5 class="message message-error" style="max-width:45%">','</h5>'); ?>
<?php echo form_close(); ?>

<script type="text/javascript">
	$( "#datepicker" ).datepicker({ dateFormat: "dd/mm/yy" });
	var State = $("#state").val();
	var City = $("#city").val();
	
	if (State!=null && City!=null)
	{
		$('#state').removeAttr('disabled');
		$('#city').removeAttr('disabled');
	}			
	
	$("#country").change(function () {
		var Value = $("#country").val();
		if (Value == "null")
		{
			$('#state').attr('disabled','disabled');
			$('#city').attr('disabled','disabled');
			$("#city").empty();
		}
		else
			$('#state').removeAttr('disabled');
		$("#state").empty();
		$.get("<?php echo base_url('country/getStates'); ?>"+ '/'+ Value, function(data){$("#state").html(data)});
	});
	
	$("#state").change(function () {
		var Value = $("#state").val();
		if (Value == "null")
			$('#city').attr('disabled','disabled');                       
		else
			$('#city').removeAttr('disabled');
		$("#city").empty();
		$.get("<?php echo base_url('country/getCities'); ?>"+ '/'+ Value, function(data){$("#city").append(data)});
	});
</script>
