<h2 class="tright"><?php echo $subtitle; ?></h2>
<br/>
<?php    
    echo printTable(
		$this->lang->line('txt_search_users'),
		$table_headers,$users,$fields,
		array('user','user',idUser,$this->lang->line('txt_actions')),
		'users'	,
		$customFields
		);
    echo '<br/><br/>';
    /* If there are messages, show them!*/
    if ($message = $this->session->flashdata('message'))
        echo '<h5 class="message message-info medium">'.$message.'</h5>';
?>