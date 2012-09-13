<h1><?php echo $this->lang->line('txt_places'); ?></h1><hr/><br/><br/>

<!-- Place-Images -->
<div class="slider-wrap">
    <div id="main-photo-slider" class="csw">
        <div class="panelContainer">
        	<?php 
				//Get the place images
				$dir="files/place/images/".$place[idPlace].'/';
				$imgThumb=NULL;
				$first=true;
				if (is_dir($dir)):
					if ($dh = opendir($dir)):
						while (($file = readdir($dh)) !== false) {
							if ($file !='.' && $file !='..'):
								$img = base_url($dir.$file);
								if ($first): $imgThumb = $img; $first=false; endif;
								echo'
								<div class="panel">
									<div class="wrapper"><img src="'.$img.'" alt="temp" /></div>
								</div>';
							endif;
						}
						closedir($dh);									
					endif;
				endif;
			?>             
        </div>
    </div>
    
    <div id="movers-row">    
    	<?php 
			//Get the place images
			$dir="files/place/thumbs/".$place[idPlace].'/';
			if (is_dir($dir)):
				if ($dh = opendir($dir)):
					$i=1;
					while (($file = readdir($dh)) !== false) {
						if ($file !='.' && $file !='..'):
							$img = base_url($dir.$file);
							echo'<div class="mover"><a href="#'.$i++.'" class="cross-link"><img src="'.$img.'" class="nav-thumb" alt="temp-thumb" /></a></div>';
						endif;
					}
					closedir($dh);									
				endif;
			endif;
		?>        
    </div>
</div>

<!-- Place Info -->
<h2><?php echo $place[name];?></h2><br/>
<table width="295px;" class="desc">	
	<tr>
    	<td><label><?php echo $this->lang->line('label_type'); ?></label></td>
        <td><?php echo $place[type]; ?></td>
    </tr>
    <tr>
    	<td><label><?php echo $this->lang->line('label_price'); ?></label></td>
        <td><?php echo $place[price]; ?></td>
    </tr>
    <tr>
    	<td><label><?php echo $this->lang->line('label_capacity'); ?></label></td>
        <td><?php echo $place[capacity].$this->lang->line('txt_people'); ?></td>
    </tr>
    <tr>
    	<td><label><?php echo $this->lang->line('label_phone'); ?></label></td>
        <td><?php echo $place[phone]; ?></td>
    </tr>
    <tr>
    	<td><label><?php echo $this->lang->line('label_website'); ?></label></td>
        <td><a href="http://<?php echo $place[Website]; ?>" target="_blank"><?php echo $place[Website]; ?></a></td>
    </tr>
    <tr>
    	<td><label><?php echo $this->lang->line('label_email'); ?></label></td>
        <td><?php echo $place[eMail]; ?></td>
    </tr>
    <tr>
    	<td colspan="3" >
        	<div style="margin-top:40px;">
            	<a href="http://<?php echo $place[FB]; ?>" target="_blank"><img src="<?php echo base_url('images/misc/fb.png'); ?>" style="vertical-align:middle;" /></a>
                <a href="http://<?php echo $place[Twitter]; ?>" target="_blank"><img src="<?php echo base_url('images/misc/twitter.png'); ?>" style="vertical-align:middle;" /></a>
                <?php echo anchor('places/events/'.encodeID($place[idPlace]),$this->lang->line('txt_view_events'),array('class' => 'btn')); ?>
            </div>        	
        </td>
    </tr>
</table>

<!-- Place Description & Location -->
<div style="margin-top:40px;">	
	<p><?php echo $place[description];?></p><br /><br />
    <div id="map_canvas_view" class="center"></div>
    <label><?php echo $this->lang->line('txt_place_location'); ?></label>
    <p><?php echo $place[address]; ?></p>
    <br/><br/>
    <label><?php echo $this->lang->line('txt_area'); ?></label>
    <p><?php echo $place[state].', '.$place[Country]; ?></p>
</div>