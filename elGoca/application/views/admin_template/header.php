<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title><?php echo $this->lang->line('elGoca').' - '.$title; ?></title>
	<!-- Styles -->
	<link rel="stylesheet" href="<?php echo base_url('styles/template.css'); ?>" type="text/css" media="screen" charset="utf-8">
	<link rel="stylesheet" href="<?php echo base_url('styles/shared.css'); ?>" type="text/css" media="screen" charset="utf-8">
	<!-- Admin Style -->
	<link rel="stylesheet" href="<?php echo base_url('styles/admin.css'); ?>" type="text/css" media="screen" charset="utf-8">
    <!-- Buttons Style -->
	<link rel="stylesheet" href="<?php echo base_url('styles/buttons.css'); ?>" type="text/css" media="screen" charset="utf-8">
	<!-- JS -->
	<script type="text/javascript" src="<?php echo base_url('scripts/jquery-1.7.2.min.js'); ?>"></script>
	<?php if(isset($scripts)) echo $scripts; ?>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#users-menu').click(function(){
				var submenu = $('#users-submenu');
				if (submenu.css('display') == 'none'){submenu.show(500);}
				else{submenu.hide(500);}
			});
		});
	</script>
</head>
<body>
	<div id="wrapper">				
		<div id="header">
			<div id="header-main">
				<a href="<?php echo base_url(); ?>"><img id="logo" src="<?php echo base_url('images/system/logo.png'); ?>" /></a>
				<div id="header-right">
					<div id="header-search">
						<?php echo form_open(); ?>
							<input type="text" placeholder="<?php echo $this->lang->line('txt_search'); ?>">
							<input type="submit" value=""/>
						<?php echo form_close(); ?>
					</div>
					<div style="margin-top:11px;">
					<?php 
                                                echo anchor('admin','<i class="icon icon-admin"></i>',array('class' => 'admin','style' => 'margin-right:5px;'));
						echo anchor('user/edit/'.encodeID($this->session->userdata(idUser)),'&raquo; '.$this->session->userdata(name),array('style' => 'margin-right:15px;'));
						echo anchor('logout','&raquo; '.$this->lang->line('txt_logout'));
					?>
					</div>
				</div>				
			</div>				
		</div>
		<!-- Header -->
		<div id="<?php echo $header; ?>"></div>	
		<!-- Content -->
		<div id="content-admin">
			<h1><?php echo $title; ?></h1><hr/><br/>
			<ul id="admin-menu">
				<li class="admin">
					<i class="icon admin-icon"></i>
					<?php echo $this->lang->line('txt_admin'); ?>
				</li>
				<li><a href="#"><?php echo $this->lang->line('txt_contents'); ?></a></li>
				<li>
					<a id="users-menu" href="javascript:void(0)"><?php echo $this->lang->line('txt_users'); ?></a>
					<ul id="users-submenu" style="display:none;margin-left:10px;">
						<li><?php echo anchor(base_url('user/admin/visitor'),$this->lang->line('txt_user_visitor')); ?></li>
						<li><?php echo anchor(base_url('user/admin/commercial'),$this->lang->line('txt_user_commercial')); ?></li>
						<li><?php echo anchor(base_url('user/admin/publicist'),$this->lang->line('txt_user_publicist')); ?></li>
						<li><?php echo anchor(base_url('user/admin/admins'),$this->lang->line('txt_user_admins')); ?></li>
					</ul>
				</li>
				<li><a href="#"><?php echo $this->lang->line('txt_publicity'); ?></a></li>
				<li><a href="<?php echo base_url('event'); ?>"><?php echo $this->lang->line('txt_events'); ?></a></li>					
				<li><a href="#"><?php echo $this->lang->line('txt_coupons'); ?></a></li>
				<li><a href="<?php echo base_url('place'); ?>"><?php echo $this->lang->line('txt_places'); ?></a></li>
				<li><a href="#"><?php echo $this->lang->line('txt_reports'); ?></a></li>				
			</ul>
            <div id="main-content">