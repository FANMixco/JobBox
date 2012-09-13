<script src=<?php echo base_url('scripts/WYSWYG/nicEdit.js') ?>></script>
<style>
	textarea{ width:100%;}
</style>
<?php echo form_open(); ?>
<table>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_position_name')); ?>
        </td>
        <td class="required"><?php echo form_input('position_name',$this->input->post('position_name')); ?></td>
		<td class="tright">
            <?php echo form_label($this->lang->line('lbl_country')); ?>
        </td>
        <td><?php echo form_dropdown('country',$countries,$this->input->post('country'),'id="country"'); ?></td>
    </tr>      
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_end_date')); ?>
        </td>
        <td class="required"><?php echo form_input('end_date',$this->input->post('end_date'), 'id="datepicker"'); ?></td>
		<td class="tright">
            <?php echo form_label($this->lang->line('lbl_birth_province')); ?>
        </td>
        <td><select id="state" name="state"></select></td>
    </tr>
    <tr>
		<td>
            <?php echo form_label($this->lang->line('lbl_salary')); ?>
        </td>
        <td><?php echo form_input('salary',$this->input->post('salary')); ?></td>        
		<td class="tright">
            <?php echo form_label($this->lang->line('lbl_city')); ?>
        </td>
        <td><select id="city" name="city"></select></td>
    </tr>
	<tr>
		<td>
            <?php echo form_label($this->lang->line('lbl_type')); ?>
        </td>
        <td><?php
                 $options=array(
                     'Tiempo Completo'=>'Tiempo Completo',
                     'Medio Completo'=>'Medio Completo',
                     'Por temporada'=>'Por temporada'                     
                 );
                 echo form_dropdown('type',$options,$this->input->post('type')); 
             ?></td>
        <td class="tright">
            <?php echo form_label($this->lang->line('lbl_job_area')); ?>
        </td>
        <td><?php echo form_dropdown('job_area',$job_areas,$this->input->post('job_area')); ?></td>
    </tr>
	<tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_description')); ?>
        </td>
        <td colspan="3"><?php echo form_textarea('description',$this->input->post('description')); ?></td>
    </tr> 
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_requirements')); ?>
        </td>
        <td colspan="3"><?php echo form_textarea('requirements',$this->input->post('requirements'),array('id' => 'posRequirements','name' => 'posRequirements')); ?></td>
    </tr>    
    <tr>
        <td colspan="4"><br/>
            <?php echo anchor('job',$this->lang->line('txt_go_back'),array('class' => 'btn')); ?>
                <button type="submit" class="btn-black">
                    <i class="icon icon-ok"></i>
                    <?php echo $this->lang->line('txt_save'); ?>            	
                </button>
        </td>
    <tr>
</table>
<?php echo validation_errors('<h5 class="message message-error" style="max-width:45%">','</h5>'); ?>
<br/>
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
	
	bkLib.onDomLoaded(nicEditors.allTextAreas);
/*	bkLib.onDomLoaded(function() {
            new nicEditor({buttonList : ['bold','italic','underline','strikethrough','left','center','right','justify','ol','ul','fontFamily','fontSize','indent','outdent','forecolor','bgcolor','subscript','superscript','link','unlink']}).panelInstance('posRequirements');
    });*/
</script>