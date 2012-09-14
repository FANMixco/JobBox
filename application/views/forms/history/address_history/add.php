<h1><?php echo $title; ?></h1><hr/><br/>
<?php echo form_open(); ?>
<table>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_start_date')); ?>
        </td>
        <td><?php echo form_input('start_date',$this->input->post('start_date'), 'class="datepicker"'); ?></td>
        <td class="required"></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_end_date')); ?>
        </td>
        <td><?php echo form_input('end_date',$this->input->post('end_date'), 'class="datepicker"'); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_address')); ?>
        </td>
        <td><?php echo form_textarea('address',$this->input->post('address')); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_country')); ?>
        </td>
        <td>
        <td><?php echo form_dropdown('country',$countries,$this->input->post('country'),'id="country"'); ?></td>
        <td class="required"></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_state')); ?>
        </td>
        <td>
        <td><select id="state" name="state"></select></td>
        <td class="required"></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_city')); ?>
        </td>
        <td>
        <td><select id="city" name="city"></select></td>
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
<script type="text/javascript">
	$( ".datepicker" ).datepicker({ dateFormat: "dd/mm/yy" });
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