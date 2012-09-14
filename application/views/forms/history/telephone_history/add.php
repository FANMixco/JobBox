<h1><?php echo $title; ?></h1><hr/><br/>
<?php echo form_open(); ?>
<table>
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
            <?php echo form_label($this->lang->line('lbl_type')); ?>
        </td>
        <td>
        <td><?php
                 $options=array(
                     'Casa'=>'Casa',
                     'Oficina'=>'Oficina',
                     'Móvil'=>'Móvil'                     
                 );
                 echo form_dropdown('type',$options,$this->input->post('type')); 
             ?></td>
        <td class="required"></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_country_code')); ?>
        </td>
        <td><?php echo form_input('country_code',$this->input->post('country_code')); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_state_int_code')); ?>
        </td>
        <td><?php echo form_input('state_int_code',$this->input->post('state_int_code')); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_state_loc_code')); ?>
        </td>
        <td><?php echo form_input('state_loc_code',$this->input->post('state_loc_code')); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_telephone')); ?>
        </td>
        <td><?php echo form_input('telephone',$this->input->post('telephone')); ?></td>
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