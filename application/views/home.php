<<<<<<< HEAD
<style type="text/css">
    #Advanced_Search{
         display:none;
    }
</style>

<script type="text/javascript">
    $("#btn_advanced_search").click(function () {
        $("#Advanced_Search").fadeIn("slow");
    });
</script>

<button type="submit" id="btn_advanced_search">
    <?php echo $this->lang->line('advanced_search'); ?>            	
</button>

<div id="Advanced_Search">
    <table>
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
                ?>
            </td>
            <td>
                <?php echo form_label($this->lang->line('lbl_job_area')); ?>
            </td>
            <td>
            <td><?php echo form_dropdown('job_area',$job_areas,$this->input->post('job_area')); ?></td>
        </tr>
        <tr colspan="4">
            <td>
                <button type="submit">
                    <?php echo $this->lang->line('txt_search'); ?>            	
                </button>                
            </td>
        </tr>
    </table>
</div>
=======
<button type="submit" id="btn_advanced_search">
    <?php echo $this->lang->line('txt_advanced_search'); ?>            	
</button>
>>>>>>> myProfile 1.0

<div id="Advanced_Search" style="display:none;">
    <table>
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
                ?>
            </td>
            <td>
                <?php echo form_label($this->lang->line('lbl_job_area')); ?>
            </td>
            <td>
            <td><?php echo form_dropdown('job_area',$job_areas,$this->input->post('job_area')); ?></td>
        </tr>
        <tr colspan="4">
            <td>
                <button type="submit">
                    <?php echo $this->lang->line('txt_search'); ?>            	
                </button>                
            </td>
        </tr>
    </table>
</div>
<?php 
	echo printList(
		$this->lang->line('txt_search'),
		NULL,
		$this->lang->line('msg_no_jobs'),		
		$jobs,
		array(idJob,jobName,desc),
		array('job/view',idJob),
		'jobs'
	); 
?>

<script type="text/javascript">
    $("#btn_advanced_search").click(function () {
        $("#Advanced_Search").show("slow");
    });
</script>
