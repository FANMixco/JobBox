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
				echo '<a id="login" href="javascript:void(0)">'.$this->lang->line('txt_login').'</a>';
			else:
				echo anchor('user/register',$this->lang->line('txt_register'));
				echo '<a id="login" href="javascript:void(0)">'.$this->lang->line('txt_login').'</a>';
				//Login Form
				echo '<div id="login-panel" style="display:none;"><br/>';
				echo form_open('login');
				echo '<table width="100%">
					<tr><td>'.form_label($this->lang->line('lbl_user')).'</td></tr>
					<tr><td>'.form_input('username').'</td></tr>
					<tr><td>'.form_label($this->lang->line('lbl_pass')).'</td></tr>
					<tr><td>'.form_input('password').'</td></tr>
					<tr><td style="text-align:right;">'.form_submit('login',$this->lang->line('txt_enter')).'</td>
				</table>';
				echo form_close();
				//Script
				echo '<script type="text/javascript">
					$("#login").click(function(){
						var panel = $("#login-panel");
						if (panel.css("display") == "none"){$("#login").css("background-color","#666666");}
						else{$("#login").css("background-color","black");}
						panel.slideToggle(200);						
					});
				
					$(document).keydown(function(e) {
						if (e.keyCode == 27) {
							$("#login-panel").hide(0);
							$("#login").css("background-color","black");
						}
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