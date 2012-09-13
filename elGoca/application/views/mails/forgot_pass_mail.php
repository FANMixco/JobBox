<!DOCTYPE HTML>
<html lang="en">
<head>
	<title><?php echo $this->lang->line('mail_forgot_subject'); ?></title>
</head>
<body>
	<h1><?php echo $this->lang->line('mail_forgot_title'); ?></h1>	
	<p><?php echo $this->lang->line('mail_forgot_msg'); ?></p><br/>
	<table>
		<tr>
			<td><?php echo $this->lang->line('label_user'); ?></td>
			<td><?php echo $username; ?></td>
		</tr>
		<tr>
			<td><?php echo $this->lang->line('label_pass'); ?></td>
			<td><?php echo $password; ?></td>
		</tr>
	</table><br/>
	<p><?php echo $this->lang->line('mail_forgot_msg_2'); ?></p>	
	<center><?php echo anchor(base_url('login'),$this->lang->line('mail_goto_goca')); ?></center><br/>	
	<p><?php echo $this->lang->line('mail_forgot_msg_3'); ?></p>
</body>
</html>