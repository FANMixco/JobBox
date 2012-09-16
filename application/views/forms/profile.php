<div id="tabs">
	<ul>
		<li><a href="#tabs-1"><?php echo $this->lang->line('txt_my_info'); ?></a></li>
		<li><a href="#tabs-2"><?php echo $this->lang->line('txt_ac_history'); ?></a></li>
		<li><a href="#tabs-3"><?php echo $this->lang->line('txt_job_history'); ?></a></li>
                <li><a href="#tabs-4"><?php echo $this->lang->line('txt_contact_history'); ?></a></li>
                <li><a href="#tabs-5"><?php echo $this->lang->line('txt_references'); ?></a></li>
	</ul>
	<div id="tabs-1">
		<table>
			<tr>						
				<td class="tright"><?php echo form_label($this->lang->line('lbl_user')); ?></td>
				<td><?php echo $user[idUser]; ?></td>
				<td colspan="3"></td>
			</tr>			
			<tr>
				<td colspan="5"><h2><?php echo $this->lang->line('txt_personal_info') ?></h2></td>
			</tr>
			<tr>
				<td><?php echo form_label($this->lang->line('lbl_first_name')); ?></td>
				<td><?php echo $user['First_Name']; ?></td>
				<td class="tright"><?php echo form_label($this->lang->line('lbl_second_name')); ?></td>
				<td><?php echo $user['Middle_Name']; ?></td>		
			</tr>
			<tr>
				<td><?php echo form_label($this->lang->line('lbl_first_surname')); ?></td>
				<td><?php echo $user['Last_Name_1']; ?></td>
				<td class="tright"><?php echo form_label($this->lang->line('lbl_second_surname')); ?></td>
				<td><?php echo $user['Last_Name_2']; ?></td>		
			</tr>
			<tr>
				<td><?php echo form_label($this->lang->line('lbl_married_name')); ?></td>
				<td><?php echo $user['Married_Name']; ?></td>
				<td class="tright"><?php echo form_label($this->lang->line('lbl_birth_date')); ?></td>
				<td><?php echo changeDateFormat($user['Birthdate'],true); ?></td>		
			</tr>
			<tr>
				<td><?php echo form_label($this->lang->line('lbl_sex')); ?></td>
				<td><?php echo $user['Sex']; ?></td>
				<td class="tright"><?php echo form_label($this->lang->line('lbl_honorific')); ?></td>
				<td><?php echo $user['Honorific']; ?></td>
			</tr>
			<tr>
				<td><?php echo form_label($this->lang->line('lbl_birth_country')); ?></td>
				<td><?php echo $user['Country']; ?></td>
				<td class="tright"><?php echo form_label($this->lang->line('lbl_birth_province')); ?></td>
				<td><?php echo $user['State']; ?></td>
			</tr>
			<tr>
				<td><?php echo form_label($this->lang->line('lbl_birth_city')); ?></td>
				<td><?php echo $user['City']; ?></td>
			</tr>
			<tr>
				<td colspan="5"><h2 style="margin-top:10px;"><?php echo $this->lang->line('txt_docs') ?></h2></td>
			</tr>
			<tr>
				<td><?php echo form_label($this->lang->line('lbl_document')); ?></td>
				<td><?php echo $user['idDocument']; ?></td>
				<td class="tright"><?php echo form_label($this->lang->line('lbl_passport')); ?></td>
				<td><?php echo $user['Passport']; ?></td>				
			</tr>
			<tr>				
				<td><?php echo form_label($this->lang->line('lbl_nit')); ?></td>
				<td><?php echo $user['NIT']; ?></td>
				<td class="tright"><?php echo form_label($this->lang->line('lbl_isss')); ?></td>
				<td><?php echo $user['ISSS']; ?></td>
			</tr>	
			<tr>
				<td colspan="5"><h2 style="margin-top:10px;"><?php echo $this->lang->line('txt_other_info') ?></h2></td>
			</tr>
			<tr>
				<td><?php echo form_label($this->lang->line('lbl_height')); ?></td>
				<td><?php echo $user['Height'].$user['H_Unit_Type'];?></td>
				<td class="tright"><?php echo form_label($this->lang->line('lbl_religion')); ?></td>
				<td><?php echo $user['Religion']; ?></td>
			</tr>
			<tr>
				<td><?php echo form_label($this->lang->line('lbl_weight')); ?></td>
				<td><?php echo $user['Weight'].$user['W_Unit_Type'];?></td>
			</tr>			
		</table>
	</div>
	<div id="tabs-2">
               
            <?php 
               echo '<h2 class="tright">'.$this->lang->line('txt_education').'</h2>';
            echo printTable($this->lang->line('txt_search'),
	$this->lang->line('header_ac_history'),$acHistory,array('Academic_Major','School','Academic_Level','Start_Date','End_Date'),
                    NULL,'acHistory'
	);
                if ($this->session->userdata(Level)!=1) echo anchor('academichistory/register',$this->lang->line('txt_new'),array('class' =>'btn right'));
                echo '<br/><br/><br/>';
                echo '<h2 class="tright">'.$this->lang->line('txt_courses').'</h2>';
                echo printTable($this->lang->line('txt_search'),
	$this->lang->line('header_course_history'),$courseHistory,array('Course','School','Hours','Scholarship'),
                    NULL,'courseHistory'
	);
                if ($this->session->userdata(Level)!=1) echo anchor('coursehistory/register',$this->lang->line('txt_new'),array('class' =>'btn right'));
        ?> 
            <div class="clear"></div>
	</div>
	<div id="tabs-3">
		<?php echo printTable($this->lang->line('txt_search'),
	$this->lang->line('header_job_history'),$jHistory,array('Start_Position','End_Position','Company','Job_Area'),
                       NULL,'jHistory'
	);
                if ($this->session->userdata(Level)!=1) echo anchor('jobhistory/register',$this->lang->line('txt_new'),array('class' =>'btn right'));
        ?>  
               <div class="clear"></div>
	</div>
        <div id="tabs-4">                
            <h2 class="tright"><?php echo $this->lang->line('txt_emails'); ?></h2>
		<?php echo printTable($this->lang->line('txt_search'),
	$this->lang->line('header_email_history'),$emailHistory,array('Email','Type','Start_Date','End_Date'),
                       NULL,'emailHistory'
	);
                if ($this->session->userdata(Level)!=1) echo anchor('coursehistory/register',$this->lang->line('txt_new'),array('class' =>'btn right'));
                echo'<br/><br/><br/>';
                echo '<h2 class="tright">'.$this->lang->line('txt_phones').'</h2>';
                echo printTable($this->lang->line('txt_search'),
	$this->lang->line('header_tel_history'),$telHistory,array('Telephone','Country_Code','State_Int_Code','State_Loc_Code','Type'),
                       NULL,'telHistory'
	);
                if ($this->session->userdata(Level)!=1) echo anchor('coursehistory/register',$this->lang->line('txt_new'),array('class' =>'btn right'));
                
                echo'<br/><br/><br/>';
                echo '<h2 class="tright">'.$this->lang->line('txt_addresses').'</h2>';
                echo printTable($this->lang->line('txt_search'),
	$this->lang->line('header_add_history'),$addHistory,array('Address','City','Start_Date','End_Date'),
                       NULL,'addHistory'
	);
                if ($this->session->userdata(Level)!=1) echo anchor('coursehistory/register',$this->lang->line('txt_new'),array('class' =>'btn right'));
                
        ?> 
               
            <div class="clear"></div>
	</div>
        <div id="tabs-5">
		<?php echo printTable($this->lang->line('txt_search'),
	$this->lang->line('header_contact_history'),$contactHistory,array('Contact','City','Address','Telephone_1'),
                       NULL,'contactHistory'
	);
                   if ($this->session->userdata(Level)!=1) echo anchor('coursehistory/register',$this->lang->line('txt_new'),array('class' =>'btn right'));
        ?>  
            <div class="clear"></div>
	</div>
</div>

<?php if ($this->session->userdata(Level)==1): ?>
	<br/>
	<a id="addTo" href="javascript:void(0)" class="right"><?php echo $this->lang->line('txt_add_job_profile'); ?></a><br/>
	<div id="addTo-panel" class="right" style="display:none;">
		<?php echo form_open('job/addTo','',array('user' => encodeID($user[idUser]))); ?>
			<?php echo form_dropdown('job',$jobs); ?>
			<?php echo form_submit(array('name' => 'addTo', 'value' => $this->lang->line('txt_send'))); ?>
		<?php echo form_close(); ?>
	</div>
	<script>
		$('#addTo').click(function(){
			$('#addTo-panel').show('fast');
		});
	</script>
<?php endif; ?>

<script>
$(function() {
	$( "#tabs" ).tabs();
});
</script>