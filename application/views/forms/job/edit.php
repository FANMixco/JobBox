<?php echo $title; ?></h1><hr/><br/>
<?php echo form_open(); ?>
<table>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_position_name')); ?>
        </td>
        <td><?php echo form_input('position_name',$job[position_name]); ?></td>
        <td class="required"></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_description')); ?>
        </td>
        <td><?php echo form_textarea('description',$job[description]); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_start_date')); ?>
        </td>
        <td><?php echo form_input('start_date',$job[start_date]); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_end_date')); ?>
        </td>
        <td><?php echo form_input('end_date',$job[end_date]); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_country')); ?>
        </td>
        <td>
        <td><?php echo form_dropdown('country',$countries,$job[country]); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_state')); ?>
        </td>
        <td>
        <td><?php echo form_dropdown('state',$states,$job[state]); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_city')); ?>
        </td>
        <td>
        <td><?php echo form_dropdown('city',$cities,$job[city]); ?></td>
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
                 echo form_dropdown('type',$options,$job[type]); 
             ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_salary')); ?>
        </td>
        <td><?php echo form_input('salary',$job[salary]); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_requirements')); ?>
        </td>
        <td><?php echo form_textarea('requirements',$job[requirements]); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_job_area')); ?>
        </td>
        <td>
        <td><?php echo form_dropdown('job_area',$job_areas,$job[job_area]); ?></td>
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