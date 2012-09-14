<h1><?php echo $title; ?></h1><hr/><br/>
<?php echo form_open(); ?>
<table>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_company')); ?>
        </td>
        <td><?php echo form_input('company',$job_history[company]); ?></td>
        <td class="required"></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_job_area')); ?>
        </td>
        <td><?php echo form_dropdown('job_area',$job_areas,$job_history[job_area]); ?></td>
        <td class="required"></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_job_sector')); ?>
        </td>
        <td><?php echo form_dropdown('job_sector',$job_sectors,$job_history[job_sector]); ?></td>
        <td class="required"></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_end_date')); ?>
        </td>
        <td><?php echo form_input('end_date',$job_history[end_date]); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_start_date')); ?>
        </td>
        <td><?php echo form_input('start_date',$job_history[start_date]); ?></td>
        <td class="required"></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_end_date')); ?>
        </td>
        <td><?php echo form_input('end_date',$job_history[end_date]); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_country')); ?>
        </td>
        <td><?php echo form_dropdown('country',$countries,$job_history[country]); ?></td>
        <td class="required"></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_employee_number')); ?>
        </td>
        <td><?php echo form_input('employee_number',$job_history[employee_number]); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_salary')); ?>
        </td>
        <td><?php echo form_input('salary',$job_history[salary]); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_activities')); ?>
        </td>
        <td><?php echo form_textarea('activities',$job_history[activities]); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_boss')); ?>
        </td>
        <td><?php echo form_input('boss',$job_history[boss]); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_boss_position')); ?>
        </td>
        <td><?php echo form_input('boss_position',$job_history[boss_position]); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_address')); ?>
        </td>
        <td><?php echo form_input('address',$job_history[address]); ?></td>
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