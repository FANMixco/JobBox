<link rel="stylesheet" type="text/css" href="<?php echo base_url('styles/singleCoupon.css'); ?>" />
<h1><?php echo $this->lang->line('txt_coupon'); ?></h1><hr/><br/><br/>

<!-- Coupon-Images -->
<div class="slider-wrap">
    <div id="main-photo-slider" class="csw">
        <div class="panelContainer">
        	<?php 
				//Get the coupon images
				$dir="files/coupon/images/".$coupon[idCoupon].'/';
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
			//Get the coupon images
			$dir="files/coupon/thumbs/".$coupon[idCoupon].'/';
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
<!-- Coupon-Img -->
<table id="couponImg" cellspacing="0" cellpadding="0" border="0">
<tr>
    <td class="cuponc_content">
    <!-- Contenido -->
    <table cellspacing="0" cellpadding="0" border="0">
        <tr>
        <td>
            <table>
                <tr>
                    <td valign="top" style="width:100px;"><label><?php echo $this->lang->line('label_coupon_number'); ?></label></td>
                    <td><?php echo sprintf('%1$04d',$coupon['couponNumber']); ?></td>                                                    
                <tr>
                <tr>
                    <td valign="top"><label><?php echo $this->lang->line('label_coupon_code'); ?></label></td>
                    <td><?php echo substr(md5($coupon[idCoupon]),$coupon[idCoupon]%4,6); ?></td>
                <tr>                    
                <td colspan="2" style="border-bottom:#D9D9D9 solid 1px;width:175px;height:5px;"><p></p>
                </td></tr>								
                <tr><td colspan="2" style="border-top:#fff solid 1px;width:175px;height:5px;"><p></p>
                </td></tr>						
                </tr>
                <tr>
                    <td valign="top" colspan="2">
                        <label><?php echo $this->lang->line('label_time_left'); ?></label><br>
                        <?php
							$now = date('Y-m-d H:i');
							if ($coupon[startDate]>$now || $coupon[endDate]<$now):
								echo '<p>'.$this->lang->line('msg_coupons_unavailable').'</p>';
							else:
								//Get the time left
								$hour = substr($coupon[endDate],strlen($coupon[endDate])-8,2);
								$minutes = substr($coupon[endDate],strlen($coupon[endDate])-5,2);
								echo ($coupon['daysLeft']).$this->lang->line('txt_days');								
								echo '<br/>';
								echo $hour.$this->lang->line('txt_hours');
								echo '<br/>';
								echo $minutes.$this->lang->line('txt_hours');
							endif;
						?>                        
                    </td>
                </tr>						
            </table>
        </td>
        <td>
            <table>
                <tr>				
                    <td class="cuponc_content_image" >
                        <center>
                        <span class="cuponc_content_image_text"><?php echo $coupon[couponPrice] ?></span>
                        <a class="btn" href="<?php echo base_url('coupons/exchange/'.encodeID($coupon[idCoupon])); ?>"><?php echo $this->lang->line('txt_ex_coupon'); ?></a>
                        </center>
                    </td>
                    <td width="20px"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <center>
                            <?php echo mailto($coupon['eventMail'],'<img src="'.base_url("images/icons/e-mail_mini.png").'"/>'); ?>
                            <a href="http://<?php echo $coupon[FB]; ?>" target="_blank"><img src="<?php echo base_url('images/icons/facebook_mini.png'); ?>"></a>
                            <a href="http://<?php echo $coupon[Twitter]; ?>" target="_blank"><img src="<?php echo base_url('images/icons/twitter_mini.png'); ?>"></a>
                            <a href="http://<?php echo $coupon[FB]; ?>" target="_blank"><img src="<?php echo base_url('images/icons/like_mini.png'); ?>"></a>
                        </center>                            
                    </td>
                </tr>
            </table>
        </td>
        </tr>
      </table>
    </td>
</tr>
<tr>
		<td class="cuponc_content_footer">
		<!-- footer -->
			<table cellspacing="0" cellpadding="0" border="0">
				<tr>
				<td class="cuponc_content_footer_link">
					<a href="<?php echo base_url('coupons/viewAll/'.encodeID($coupon[idPlace])); ?>"><?php echo $this->lang->line('txt_view_coupons'); ?></a>
				</td>
				</tr>
			</table>
		</td>
</tr>
</table>

<!-- Coupon Info -->
<div style="width:300px;">
    <h2><?php echo $coupon[name];?></h2><br/>
    <p><?php echo $coupon[description];?></p>
    <table class="desc" width="300px;">	
        <tr>
            <td><label><?php echo $this->lang->line('label_reg_price'); ?></label></td>
            <td><?php echo $coupon[regPrice]; ?></td>
        </tr>
        <tr>
            <td><label><?php echo $this->lang->line('label_discount'); ?></label></td>
            <td><?php echo ($discount=$coupon[regPrice]-$coupon[couponPrice])*100/$coupon[regPrice]; ?>%</td>
        </tr>
        <tr>
            <td><label><?php echo $this->lang->line('label_savings'); ?></label></td>
            <td><?php echo $discount; ?></td>
        </tr>
        <tr>
            <td><label><?php echo $this->lang->line('label_place'); ?></label></td>
            <td><?php echo anchor('places/view/'.encodeID($coupon[idPlace]),$coupon['Place']); ?></td>
        </tr>
        <tr>
            <td><label><?php echo $this->lang->line('label_website'); ?></label></td>
            <td><a href="http://<?php echo $coupon[Website]; ?>" target="_blank"><?php echo $coupon[Website]; ?></a></td>
        </tr>
        <tr>
            <td><label><?php echo $this->lang->line('label_email'); ?></label></td>
            <td><?php echo mailto($coupon[eMail],$coupon[eMail]); ?></td>
        </tr>        
    </table>
    <br /><br/>
    <h2><?php echo $this->lang->line('txt_restrictions');?></h2><br/>
    <p><?php echo $coupon[restrictions];?></p>
</div>