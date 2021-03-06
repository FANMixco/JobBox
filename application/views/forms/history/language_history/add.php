<h1><?php echo $title; ?></h1><hr/><br/>
<?php echo form_open(); ?>
<table>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_language')); ?>
        </td>
        <td><?php echo form_dropdown('language',$language,$this->input->post('language')); ?></td>
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
            <?php echo form_label($this->lang->line('lbl_conversation_level')); ?>
        </td>
        <td><?php echo form_dropdown('conversation_level',$language_level,$this->input->post('conversation_level')); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_undestanding_level')); ?>
        </td>
        <td><?php echo form_dropdown('undestanding_level',$language_level,$this->input->post('undestanding_level')); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_writing_level')); ?>
        </td>
        <td><?php echo form_dropdown('writing_level',$language_level,$this->input->post('writing_level')); ?></td>
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