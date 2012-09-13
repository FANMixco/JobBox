<h2 class="tright"><?php echo $this->lang->line('txt_places'); ?></h2>
<br/>
<?php    
    echo printTable(
		$this->lang->line('txt_search'),
		$this->lang->line('header_my_places'),$places,array(name,Category,type),
		array('place','place',idPlace,$this->lang->line('txt_actions')),
		'places'
		);
    echo '<br/><br/>';
    /* If there are messages, show them!*/
    if ($message = $this->session->flashdata('message'))
        echo '<h5 class="message message-info medium">'.$message.'</h5>';
?>