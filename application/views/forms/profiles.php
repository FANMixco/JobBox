<?php 
	echo printList(
		$this->lang->line('txt_search'),
		NULL,
		$this->lang->line('msg_no_profiles'),		
		$users,
		array(idUser,'First_Name','Last_Name_1','City'),
		array('user/profile',idUser),
		'users',
		true
	);
?>