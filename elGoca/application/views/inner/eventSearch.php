<h1><?php echo $this->lang->line('txt_events'); ?></h1><hr/><br/><br/>
<?php echo printList($this->lang->line('txt_search'),'event',$this->lang->line('msg_no_events'),$events,array(idEvent,name,description), array('events/view/',idEvent),'events'); ?>