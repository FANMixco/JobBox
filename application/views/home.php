<h1><?php echo $this->lang->line('txt_home'); ?></h1>
<br />
<?php echo printList($this->lang->line('txt_search'),'Oferta',$this->lang->line('msg_no_events'),$jobs,array(Position_Name,Description,Start_Date,End_Date,City,Type,Salary,Requirements,Job_Area)); ?>