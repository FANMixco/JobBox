<h2 class="tright"><?php echo $this->lang->line('txt_events'); ?></h2>
<br/>
<?php    
    echo printTable(
		$this->lang->line('txt_search'),
		$this->lang->line('header_my_events'),$events,array(name,'Place',eventDate),
		array('event','event',idEvent,$this->lang->line('txt_actions')),
		'events'
		);
    echo '<br/><br/>';
    /* If there are messages, show them!*/
    if ($message = $this->session->flashdata('message'))
        echo '<h5 class="message message-info medium">'.$message.'</h5>';
?>