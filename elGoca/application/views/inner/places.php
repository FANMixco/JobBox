<h1><?php echo $this->lang->line('txt_places'); ?></h1><hr/><br/><br/>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
<img class="inner-ad" style="margin-bottom:42px;" src="files/temp_images/ad_2.png" />

<?php echo printList($this->lang->line('txt_search'),'place',$this->lang->line('msg_no_places'),$places,array(idPlace,name,description), array('places/view/',idPlace)); ?>
