<h2><label><?php echo $this->lang->line('txt_job_desc'); ?></label></h2>
<p><?php echo $job['Description']; ?></p>
<br/>
<h2><label><?php echo $this->lang->line('txt_job_reqs'); ?></label></h2>
<p><?php echo $job['Requirements']; ?></p>
<br/>
<table>
	<tr>
		<td><?php echo form_label($this->lang->line('lbl_city')); ?></td>
		<td><?php echo $job['City']; ?></td>
	</tr>	
	<tr>
		<td><?php echo form_label($this->lang->line('lbl_publish_date')); ?></td>
		<td><?php echo $job['Start_Date']; ?></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('lbl_salary')); ?></td>
		<td><?php echo $job['Salary']; ?></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('lbl_type')); ?></td>
		<td><?php echo $job['Type']; ?></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('lbl_job_area')); ?></td>
		<td><?php echo $job['Job_Area']; ?></td>
	</tr>	
</table>
<br/><br/><br/>
<a href="javascript:history.go(-1)" class="btn"><?php echo $this->lang->line('txt_go_back'); ?></a>
<?php 
	if ($this->session->userdata(Level)!=1):
		echo ($this->jobModel->hasApplied($this->session->userdata(idUser),$job['idJob'])==0)?
			anchor('job/apply/'.encodeID($job['idJob']),$this->lang->line('txt_apply'), array('class' => 'btn right')): 
			anchor('javascript:void(0)',$this->lang->line('txt_app_sent'), array('class' => 'btn right'));
	else:
		echo anchor('job/edit',$this->lang->line('txt_edit'), array('class' => 'btn right'));
	endif;
?>