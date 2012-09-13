<?php 
	echo anchor(base_url('job/add'),$this->lang->line('txt_new_job'),array('class' => 'right'));
	echo '<br/><br/>';
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