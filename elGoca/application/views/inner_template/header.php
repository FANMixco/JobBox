<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title><?php echo $this->lang->line('elGoca').' - '.$title; ?></title>
	<!-- Styles -->
	<link rel="stylesheet" href="<?php echo base_url('styles/template.css'); ?>" type="text/css" media="screen" charset="utf-8">
	<link rel="stylesheet" href="<?php echo base_url('styles/shared.css'); ?>" type="text/css" media="screen" charset="utf-8">
	<!-- Inner CSS -->
	<link rel="stylesheet" href="<?php echo base_url('styles/inner.css'); ?>" type="text/css" media="screen" charset="utf-8">
	<!-- Buttons -->
	<link rel="stylesheet" href="<?php echo base_url('styles/buttons.css'); ?>" type="text/css" media="screen" charset="utf-8">
	<!--[if IE]>
	<style type="text/css">ol#footer-nav>:first-child{padding-left:18px;}</style>
	<![endif]-->
	<!-- JS -->
	<script type="text/javascript" src="<?php echo base_url('scripts/jquery-1.7.2.min.js'); ?>"></script>    
	<!-- jShowOff -->
	<script type="text/javascript" src="<?php echo base_url('resources/jShowOff/jquery.jshowoff.min.js'); ?>"></script>
	<link rel="stylesheet" href="<?php echo base_url('resources/jShowOff/jshowoff.css'); ?>" type="text/css" media="screen" charset="utf-8">
    <?php if(isset($scripts)) echo $scripts; ?>
	<script type="text/javascript">		
		$(document).ready(function(){ $('#slider').jshowoff({hoverPause:true}); });
	</script>
</head>
<body>
	<div id="wrapper">		
		<div id="header">
			<div id="header-main">
				<a href="<?php echo base_url(); ?>"><img id="logo" src="<?php echo base_url('images/system/logo.png'); ?>" /></a>
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
		<!-- Head main -->		
		<div id="<?php echo $header_main; ?>">
			<ol id="buttons">
				<li class="events"><a href="<?php echo base_url('events'); ?>">							
					<h4 class="button"><?php echo $this->lang->line('txt_events'); ?></h4>
				</a></li>
				<li class="movies"><a href="<?php echo base_url('movies'); ?>">			
					<h4 class="button"><?php echo $this->lang->line('txt_movies'); ?></h4>
				</a></li>
				<li class="food"><a href="<?php echo base_url('restaurants'); ?>">			
					<h4 class="button"><?php echo $this->lang->line('txt_food'); ?></h4>
				</a></li>			
				<li class="bar"><a href="<?php echo base_url('bar'); ?>">			
					<h4 class="button"><?php echo $this->lang->line('txt_bar'); ?></h4>
				</a></li>
				<li class="hobbies"><a href="<?php echo base_url('hobbies'); ?>">			
					<h4 class="button"><?php echo $this->lang->line('txt_hobbies'); ?></h4>
				</a></li>
				<li class="culture"><a href="<?php echo base_url('culture'); ?>">			
					<h4 class="button"><?php echo $this->lang->line('txt_culture'); ?></h4>
				</a></li>
			</ol>
			<div id="slider">
				<div>
					<img src="<?php echo base_url(); ?>files/temp_images/slide_1.png" />
					<span class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
				</div>
				<div>
					<img src="<?php echo base_url(); ?>files/temp_images/slide_2.png" />
					<span class="desc">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</span>
				</div>
			</div>			
		</div>
		
		<!-- Content -->
		<div id="content">
			<div id="content-main">
				<div id="banner-left">
					<img src="<?php echo base_url(); ?>files/temp_images/banner-left.png" />
				</div>
				<div id="main-content">