<center>
<?php echo form_open('login'); ?>
<table>
	<tr>
		<td><?php echo form_label($this->lang->line('lbl_user')); ?></td>
		<td><?php echo form_input('username'); ?></td>
	</tr>
	<tr>
		<td><?php echo form_label($this->lang->line('lbl_pass')); ?></td>
		<td><?php echo form_password('password'); ?></td>
	</tr>
	<tr>
		<td colspan="2"><a id="forgotPass" href="javascript:void(0)"><?php echo $this->lang->line('txt_forgot_pass'); ?></a></td>
	</tr>
	<?php if ($msg = $this->session->flashdata('message')): ?>
	<tr>
		<td colspan="2"><h5 class="message message-error"><?php echo $msg; ?></h5></td>
	</tr>
	<?php endif; ?>
	<tr>
		<td colspan="2"><br/><?php echo form_submit(array('name' => 'login','value' => $this->lang->line('txt_enter'),'class' => 'submit-btn')); ?></td>
	</tr>
</table>
<?php 
	/* If there are messages, show them!*/
    if (isset($error))echo '<h5 class="message message-info medium">'.$this->lang->line('msg_no_login').'</h5><br/><br/>';
	echo form_close(); 
?>
<br/>
<h5 id="Info" class="message message-info" style="display:none;max-width:370px;"><?php echo $this->lang->line('msg_pass_reseted'); ?></h5>
<br/>
<div id="forgotPassForm" style="display:none;max-width:370px;float:left;">
	<h2 style="text-align:justify;"><?php echo $this->lang->line('txt_forgot_pass'); ?></h2><hr/><br/>
	<p><?php echo $this->lang->line('msg_pass_forget'); ?></p><br/>
	<table>
		<tr>
			<td><?php echo form_label($this->lang->line('lbl_user')); ?></td>
			<td><?php echo form_input(array('id' => 'username')); ?></td>					
		</tr>
		<tr>
			<td style="text-align:right;"><?php echo form_label($this->lang->line('lbl_email')); ?></td>
			<td><?php echo form_input(array('id' => 'email')); ?></td>
		</tr>
		<tr>
			<td colspan="2">
				<br/>
				<input type="button" id="rememberPass" value="<?php echo $this->lang->line('txt_recover'); ?>" class="submit-btn" />		
			</td>
		</tr>
	</table><br/>
	<h5 id="wrongInfo" class="message message-error" style="display:none;"><?php echo $this->lang->line('msg_forgot_no_match'); ?></h5>
</div>
</center>
<script type="text/javascript">
	$(document).ready(function(){
		$('#forgotPass').click(function(){
			$('#forgotPassForm').show(1000);
		});

		//Send the forgot pass mail with AJAX
		$('#rememberPass').click(function(){					
			$.post("<?php echo base_url('user/forgotPassword/'); ?>",{
				user:  $('#username').val(),
				email: $('#email').val()
			},function(response){
				if (response==1){$('#Info').css('display','inline-block');$('#forgotPassForm').hide(1000);}
				else{$('#wrongInfo').css('display','inline-block');}
			});
		});		
	});
</script>