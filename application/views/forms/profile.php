<div id="tabs">
	<ul>
		<li><a href="#tabs-1"><?php echo $this->lang->line('txt_my_info'); ?></a></li>
		<li><a href="#tabs-2"><?php echo $this->lang->line('txt_ac_history'); ?></a></li>
		<li><a href="#tabs-3"><?php echo $this->lang->line('txt_job_history'); ?></a></li>
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
		<p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
	</div>
	<div id="tabs-3">
		<p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
		<p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
	</div>
</div>

<script>
$(function() {
	$( "#tabs" ).tabs();
});
</script>