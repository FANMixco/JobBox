<?php 
	echo printTable($this->lang->line('txt_search'),
	$this->lang->line('header_apps'),$apps,array('Position_Name','total_applications'),array(NULL,NULL,NULL,$this->lang->line('txt_actions')),
	'applications',
	array('fields' => array('icon view',$this->lang->line('txt_view'),'applications/view','idJob'), 'conditions' => array()
	));
?>