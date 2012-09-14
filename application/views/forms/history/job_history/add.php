<h1><?php echo $title; ?></h1><hr/><br/>
<?php echo form_open(); ?>
<table>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_company')); ?>
        </td>
        <td><?php echo form_input('company',$this->input->post('company')); ?></td>
        <td class="required"></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_job_area')); ?>
        </td>
        <td><?php echo form_dropdown('job_area',$job_areas,$this->input->post('job_area')); ?></td>
        <td class="required"></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_job_sector')); ?>
        </td>
        <td><?php echo form_dropdown('job_sector',$job_sectors,$this->input->post('job_sector')); ?></td>
        <td class="required"></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_start_date')); ?>
        </td>
        <td><?php echo form_input('start_date',$this->input->post('start_date')); ?></td>
        <td class="required"></td>
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
        <td><?php echo form_dropdown('country',$countries,$this->input->post('country')); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_employee_number')); ?>
        </td>
        <td><?php echo form_input('employee_number',$this->input->post('employee_number')); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_salary')); ?>
        </td>
        <td><?php echo form_input('salary',$this->input->post('salary')); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_activities')); ?>
        </td>
        <td><?php echo form_textarea('activities',$this->input->post('activities')); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_boss')); ?>
        </td>
        <td><?php echo form_input('boss',$this->input->post('boss')); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_boss_position')); ?>
        </td>
        <td><?php echo form_input('boss_position',$this->input->post('boss_position')); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_address')); ?>
        </td>
        <td><?php echo form_input('address',$this->input->post('address')); ?></td>
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