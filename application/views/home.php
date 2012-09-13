<h1><?php echo $this->lang->line('txt_home'); ?></h1><hr />
<br />
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