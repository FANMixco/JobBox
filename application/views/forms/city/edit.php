<h1><?php echo $title; ?></h1><hr/><br/>
<?php echo form_open(); ?>
<table>
    <tr>
        <td>
            <?php echo form_label("Municipio"); ?>
        </td>
        <td><?php echo form_input('ncity',$city[ncity]); ?></td>
        <td class="required"></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label("Departamento"); ?>
        </td>
        <td><?php echo form_dropdown('state',$states,$city[state]); ?></td>
        <td class="required"></td>
    </tr>
    <tr>
        <td>
            <?php echo form_label("Código Postal"); ?>
        </td>
        <td><?php echo form_input('zipcode',$city[zipcode]); ?></td>
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