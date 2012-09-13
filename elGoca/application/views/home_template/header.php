<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title><?php echo $title; ?></title>
	<!-- Styles -->
	<link rel="stylesheet" href="styles/template.css" type="text/css" media="screen" charset="utf-8">
	<!-- Home CSS -->
	<link rel="stylesheet" href="styles/home.css" type="text/css" media="screen" charset="utf-8">
        <!-- Buttons CSS -->        
	<link rel="stylesheet" href="styles/buttons.css" type="text/css" media="screen" charset="utf-8">
	<!--[if IE]>
	<style type="text/css">ol#footer-nav>:first-child{padding-left:18px;}</style>
	<![endif]-->
	<!-- JS -->
	<script type="text/javascript" src="scripts/jquery-1.7.2.min.js"></script>
	<!-- Plugins -->
	<?php if (isset($scripts)) echo $scripts;?>
</head>
<body>
	<div id="wrapper">				
		<div id="header">
			<div id="header-main">
				<a href="./"><img id="logo" src="images/system/logo.png" /></a>
				<div id="header-right">
					<div id="header-search">
						<?php echo form_open('Search'); ?>
							<input type="text" name="criteria" placeholder="<?php echo $this->lang->line('txt_search'); ?>">
							<input type="submit" value=""/>
						<?php echo form_close(); ?>
					</div>
					<div style="margin-top:11px;">
					<?php 
						if ($this->session->userdata('Credentials')):
                                                        echo anchor('admin','<i class="icon icon-admin"></i>',array('class' => 'admin','style' => 'margin-right:5px;'));
							echo anchor('users/edit','&raquo; '.$this->session->userdata(name),array('style' => 'margin-right:15px;'));
							echo anchor('logout','&raquo; '.$this->lang->line('txt_logout'));
						else:                                                        
							echo anchor('register','&raquo; '.$this->lang->line('txt_register'),array('style' => 'margin-right:15px;'));
							echo anchor('login','&raquo; '.$this->lang->line('txt_login'));
						endif;						
					?>
					</div>
				</div>				
			</div>				
		</div>
		<!-- Header -->
		<div id="<?php echo $header; ?>"></div>
		<?php if (isset($banner)): ?>
			<!-- Banner -->
			<div class="banner"><img class="banner" src="<?php echo $banner; ?>" /></div>
		<?php endif; ?>	
