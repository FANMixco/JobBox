<!DOCTYPE HTML>
<html lang="en">
<head>
	<title><?php echo $this->lang->line('title_home'); ?></title>
</head>
<body>
	<h1><?php echo $this->lang->line('title_home'); ?></h1>
	<h3><?php echo $this->lang->line('msg_congrats'); ?></h3>	
	<p><?php echo $this->lang->line('mail_user_created'); ?></p><br/>
	<?php //The replace_constant is just a random string to avoid / and URL segmentation ?>
	<center><?php echo anchor(base_url('user/activate/'.$idUser),$this->lang->line('mail_activate')); ?></center><br/>
	<p><?php echo $this->lang->line('mail_user_forget'); ?></p>
	<table>
		<tr>
			<td><?php echo $this->lang->line('label_user'); ?></td>
			<td><?php echo $username; ?></td>
		</tr>
		<tr>
			<td><?php echo $this->lang->line('label_pass'); ?></td>
			<td><?php echo $password; ?></td>
		</tr>
	</table>
</body>
</html>