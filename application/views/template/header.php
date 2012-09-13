<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $this->lang->line('jobbox').' - '.$title; ?></title>
<!-- Styles -->
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('styles/template.css'); ?>" />
<!-- Scripts -->
<script type="text/javascript" src="<?php echo base_url('scripts/jquery-1.7.2.min.js'); ?>" ></script>
<?php if (isset($scripts)) echo $scripts; ?>
</head>

<body>

<div id="header">
	<img id="logo-siman" src="<?php echo base_url('images/system/logo-siman.png'); ?>" />
	<div>
		<?php
			if ($this->session->userdata('Credentials')==Credentials):
				echo anchor(base_url('user/logout'),$this->lang->line('txt_register'));
				echo anchor('javascript:void(0)',$this->lang->line('txt_login'),array('id' => 'login'));
			else:
				echo anchor(base_url('user/register'),$this->lang->line('txt_register'));
				echo anchor('javascript:void(0)',$this->lang->line('txt_login'));
				//Login Form
				echo '<div id="login-panel" style="display:none;">';
				echo form_open('login');
				echo '<table>
					<tr>
						<td>'.form_label($this->lang->line('lbl_user')).'</td>
						<td>'.form_input('username').'</td>
					</tr>
					<tr>
						<td>'.form_label($this->lang->line('lbl_pass')).'</td>
						<td>'.form_input('password').'</td>
					</tr>
				</table>';				
				echo form_close();
				//Script
				echo '<script type="text/javascript">
					$("#login").click(function(){
						$("login-panel").slideToogle(200);
					});
				</script>';
				echo '</div>';
			endif;			
		?>
		<br/>
		<img id="logo" src="<?php echo base_url('images/system/logo.png'); ?>" />
		<h1><?php echo $this->lang->line('jobbox'); ?></h1>		
	</div>
</div><!-- /header -->

<div id="content">