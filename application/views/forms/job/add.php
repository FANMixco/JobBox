<script src=<?php echo base_url('scripts/WYSWYG/nicEdit.js') ?>></script>
<script type="text/javascript">
    bkLib.onDomLoaded(function() {
            new nicEditor({buttonList : ['bold','italic','underline','strikethrough','left','center','right','justify','ol','ul','fontFamily','fontSize','indent','outdent','forecolor','bgcolor','subscript','superscript','link','unlink']}).panelInstance('position_name');
    });
</script>
	
<?php echo $title; ?></h1><hr/><br/>
<?php echo form_open(); ?>
<table>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_position_name')); ?>
        </td>
        <td><?php echo form_input('position_name',$this->input->post('position_name')); ?></td>
        <td class="required"></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_description')); ?>
        </td>
        <td><?php echo form_textarea('description',$this->input->post('description')); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_start_date')); ?>
        </td>
        <td><?php echo form_input('start_date',$this->input->post('start_date')); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_end_date')); ?>
        </td>
        <td><?php echo form_input('end_date',$this->input->post('end_date')); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_country')); ?>
        </td>
        <td>
        <td><?php echo form_dropdown('country',$countries,$this->input->post('country')); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_state')); ?>
        </td>
        <td>
        <td><?php echo form_dropdown('state',$states,$this->input->post('state')); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_city')); ?>
        </td>
        <td>
        <td><?php echo form_dropdown('city',$cities,$this->input->post('city')); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_type')); ?>
        </td>
        <td>
        <td><?php
                 $options=array(
                     'Tiempo Completo'=>'Tiempo Completo',
                     'Medio Completo'=>'Medio Completo',
                     'Por temporada'=>'Por temporada'                     
                 );
                 echo form_dropdown('type',$options,$this->input->post('type')); 
             ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_salary')); ?>
        </td>
        <td><?php echo form_input('salary',$this->input->post('salary')); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_requirements')); ?>
        </td>
        <td><?php echo form_textarea('requirements',$this->input->post('requirements')); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_job_area')); ?>
        </td>
        <td>
        <td><?php echo form_dropdown('job_area',$job_areas,$this->input->post('job_area')); ?></td>
    </tr>
    <tr>
        <td colspan="2"><br/>
            <?php echo anchor('admin',$this->lang->line('txt_go_back'),array('class' => 'btn')); ?>
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