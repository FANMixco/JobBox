<h1><?php echo $title; ?></h1><hr/><br/>
<?php echo form_open(); ?>
<table>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_contact')); ?>
        </td>
        <td><?php echo form_input('contact',$this->input->post('contact')); ?></td>
        <td class="required"></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_primary')); ?>
        </td>
        <td><?php
                 $options=array(
                     'TRUE'=>'S&iacute;',
                     'FALSE'=>'No'                     
                 );
                 echo form_dropdown('primary',$options,$this->input->post('primary')); 
             ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_reference')); ?>
        </td>
        <td><?php
                 $options=array(
                     'TRUE'=>'S&iacute;',
                     'FALSE'=>'No'                     
                 );
                 echo form_dropdown('reference',$options,$this->input->post('reference')); 
             ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_type_1')); ?>
        </td>
        <td><?php
                 $options=array(
                     'Tiempo Completo'=>'Tiempo Completo',
                     'Medio Completo'=>'Medio Completo',
                     'Por temporada'=>'Por temporada'                     
                 );
                 echo form_dropdown('type_1',$options,$this->input->post('type_1')); 
             ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_country_code_1')); ?>
        </td>
        <td><?php echo form_input('country_code_1',$this->input->post('country_code_1')); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_state_int_code_1')); ?>
        </td>
        <td><?php echo form_input('state_int_code_1',$this->input->post('state_int_code_1')); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_state_loc_code_1')); ?>
        </td>
        <td><?php echo form_input('state_loc_code_1',$this->input->post('state_loc_code_1')); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_telephone_1')); ?>
        </td>
        <td><?php echo form_input('telephone_1',$this->input->post('telephone_1')); ?></td>
    </tr>
   <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_type_2')); ?>
        </td>
        <td><?php
                 $options=array(
                     'Tiempo Completo'=>'Tiempo Completo',
                     'Medio Completo'=>'Medio Completo',
                     'Por temporada'=>'Por temporada'                     
                 );
                 echo form_dropdown('type_2',$options,$this->input->post('type_2')); 
             ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_country_code_2')); ?>
        </td>
        <td><?php echo form_input('country_code_2',$this->input->post('country_code_2')); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_state_int_code_2')); ?>
        </td>
        <td><?php echo form_input('state_int_code_2',$this->input->post('state_int_code_2')); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_state_loc_code_2')); ?>
        </td>
        <td><?php echo form_input('state_loc_code_2',$this->input->post('state_loc_code_2')); ?></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label($this->lang->line('lbl_telephone_2')); ?>
        </td>
        <td><?php echo form_input('telephone_2',$this->input->post('telephone_2')); ?></td>
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