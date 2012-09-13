<link rel="stylesheet" type="text/css" href="styles/register.css" />
<h1 class="title"><?php echo $this->lang->line('txt_register') ?></h1><hr /><br/><br/>
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
<ol id="register-type">
	<li class="visitor">		
		<img src="images/misc/visitor-ribbon.png" />								
		<div>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.<br/><br/>
			<span class="benefits visitor"><?php echo $this->lang->line('txt_benefits') ?></span>
			</p>			
			<div class="sub-div">
				<ol class="benefits-list">
					<li>Lorem ipsum dolor sit amet</li>
					<li>Consectetur adipisicing elit</li>
					<li>Sed do eiusmod tempor</li>
					<li>Incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, </li>
					<li>Quis nostrud exercitation ullamco laboris nisi ut aliquip.</li>
				</ol>				
			</div><br/>
			<?php echo anchor('register/visitor',$this->lang->line('txt_register'),array('class' => 'register register-visitor')); ?>
		</div>
	</li>
	<li class="commerce">		
		<img src="images/misc/commercial-ribbon.png" />				
		<div>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.<br/><br />
			<span class="benefits commercial"><?php echo $this->lang->line('txt_benefits') ?></span>
			</p>			
			<div class="sub-div">
				<ol class="benefits-list">
					<li>Lorem ipsum dolor sit amet</li>
					<li>Consectetur adipisicing elit</li>
					<li>Sed do eiusmod tempor</li>
					<li>Incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, </li>
					<li>Quis nostrud exercitation ullamco laboris nisi ut aliquip.</li>
				</ol>				
			</div><br/>
			<?php echo anchor('register/commercial',$this->lang->line('txt_register'),array('class' => 'register register-commercial')); ?>
		</div>		
	</li>
	<li class="promote">
		<img src="images/misc/publicist-ribbon.png" />		
		<div>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.<br/><br/>
			<span class="benefits publicist"><?php echo $this->lang->line('txt_benefits') ?></span>
			</p>			
			<div class="sub-div">
				<ol class="benefits-list">
					<li>Lorem ipsum dolor sit amet</li>
					<li>Consectetur adipisicing elit</li>
					<li>Sed do eiusmod tempor</li>
					<li>Incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, </li>
					<li>Quis nostrud exercitation ullamco laboris nisi ut aliquip.</li>
				</ol>				
			</div><br/>
			<?php echo anchor('register/publicist',$this->lang->line('txt_register'),array('class' => 'register register-publicist')); ?>
		</div>		
	</li>
</ol>
<br/>