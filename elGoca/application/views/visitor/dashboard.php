<h1><?php echo $title; ?></h1><hr/><br/>
<h2 class="tright"><?php echo $this->lang->line('txt_user_visitor'); ?></h2><br/>

<?php  
	/* If there are messages, show them!*/
    if ($message = $this->session->flashdata('message'))
        echo '<h5 class="message message-info medium">'.$message.'</h5><br/><br/>';		
?>

<h2><?php echo $this->lang->line('txt_my_exchanged_coupons'); ?></h2>
<?php echo printTable(
        $this->lang->line('txt_search_my_coupons'),
        $this->lang->line('header_exchanged_coupons'),
        $userCoupons,
        array(name,'event',eventDate,'place'),
        NULL,
        'MyCoupons');?>
<br/><br/>

<center>
    <?php
        echo anchor('users/edit',$this->lang->line('txt_edit_my_info').' &raquo;',array('class' => 'btn','style' => 'margin-right:4px;'));
        echo anchor('users/changePassword',$this->lang->line('txt_change_pass').' &raquo;',array('class' => 'btn'));
    ?>
</center>