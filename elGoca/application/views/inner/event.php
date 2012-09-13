<link rel="stylesheet" type="text/css" href="<?php echo base_url('styles/coupon.css'); ?>" />
<h1><?php echo $this->lang->line('txt_events'); ?></h1><hr/><br/><br/>
<h2><?php echo $event[name];?></h2><br/>
<p><?php echo $event[description];?></p><br />

<div class="ss2_wrapper">

	<a href="#" class="slideshow_prev"><span>Previous</span></a>
    <a href="#" class="slideshow_next"><span>Next</span></a>

        
    <!--div class="slideshow_paging"></div-->
    
    <!--div class="slideshow_box">

        <div class="data"></div>
    </div-->
    
    <div id="slideshow" class="slideshow">
        <?php 
			//Get the event images
			$dir="files/event/images/".$event[idEvent].'/';
			if (is_dir($dir)):
				if ($dh = opendir($dir)):
					while (($file = readdir($dh)) !== false) {
						if ($file !='.' && $file !='..'):
							$img = base_url($dir.$file);
							echo'
							<div class="slideshow_item">
								<div class="image"><a href="#"><img src="'.$img.'" alt="photo 2" /></a></div>            
							</div>';
						endif;
					}
					closedir($dh);									
				endif;
			endif;
		?>                                                                
    </div>

</div><!-- .ss2_wrapper -->

<table width="350px;">
	<tr>
    	<td colspan="3">
        	<a href="http://<?php echo $event[FB]; ?>" target="_blank"><img src="<?php echo base_url('images/misc/fb.png'); ?>" /></a>
            <a href="http://<?php echo $event[Twitter]; ?>" target="_blank"><img src="<?php echo base_url('images/misc/twitter.png'); ?>" /></a>
        </td>
    </tr>
	<tr>
    	<td><label><?php echo $this->lang->line('label_event_date'); ?></label></td>
        <td><?php echo changeDateFormat($event[eventDate],true); ?></td>
    </tr>
    <tr>
    	<td><label><?php echo $this->lang->line('label_hour'); ?></label></td>
        <td><?php echo $event[eventHour]; ?></td>
    </tr>
    <tr>
    	<td><label><?php echo $this->lang->line('label_place'); ?></label></td>
        <td><?php echo anchor('places/view/'.encodeID($event[eventPlace]),$event['place']); ?></td>
    </tr>
    <tr>
    	<td><label><?php echo $this->lang->line('label_website'); ?></label></td>
        <td><a href="http://<?php echo $event[Website]; ?>" target="_blank"><?php echo $event[Website]; ?></a></td>
    </tr>
    <tr>
    	<td><label><?php echo $this->lang->line('label_contact'); ?></label></td>
        <td><?php echo $event[eMail]; ?></td>
    </tr>
</table>
<br/><br/>
<?php $i=0; foreach($coupons as $coupon): //Print the coupons ?>
	<table cellspacing="0" cellpadding="0" border="0" class="cupon_table">
    <tr>
            <td class="cupon_content">
            <!-- Contenido -->
            <table cellspacing="0" cellpadding="0" border="0" class="cupon_table" width="100%">
                <tr><td valign="top">
                    <label><?php echo $coupon[name]; ?></label>
                    <p><?php echo $coupon[description]; ?></p>
                
                <td class="cupon_content_image" >
                <?php echo writeSingleImage('coupon',$coupons,$i++,idCoupon); ?>
                </td></tr>
            </table>
            </td>
    </tr>
    <tr>
            <td class="cupon_content_footer">
            <!-- footer -->
            <table cellspacing="0" cellpadding="0" border="0" class="cupon_table">
                <tr><td>
                    <?php echo mailto($event[eMail],'<img src="'.base_url("images/icons/e-mail_mini.png").'">'); ?>
                    <a href="http://<?php echo $event[FB]; ?>" target="_blank"><img src="<?php echo base_url('images/icons/facebook_mini.png'); ?>"></a>
                    <a href="http://<?php echo $event[Twitter]; ?>" target="_blank"><img src="<?php echo base_url('images/icons/twitter_mini.png'); ?>"></a>
                    <a href="http://<?php echo $event[FB]; ?>" target="_blank"><img src="<?php echo base_url('images/icons/like_mini.png'); ?>"></a>
                </td>
                <td class="cupon_content_footer_link">
                    <a href="<?php echo base_url('coupons/view/'.encodeID($coupon[idCoupon])); ?>"><?php echo $this->lang->line('txt_ex_coupon'); ?></a>
                </td>
                </tr>
            </table>
            </td>
    </tr>
    </table><br/><br/>
<?php endforeach;?>

<script type="text/javascript">
	$('#slideshow').cycle({
		fx: 'fade',		
		speed:  900, 
		timeout: 5000, 
		//pager: '.ss2_wrapper .slideshow_paging', 
		prev: '.ss2_wrapper .slideshow_prev',
		next: '.ss2_wrapper .slideshow_next',
		/*before: function(currSlideElement, nextSlideElement) {
			var data = $('.data', $(nextSlideElement)).html();
			$('.ss2_wrapper .slideshow_box').stop(true, true).animate({ bottom:'-110px'}, 400, function(){
				$('.ss2_wrapper .slideshow_box .data').html(data);
			});
			$('.ss2_wrapper .slideshow_box').delay(100).animate({ bottom:'0'}, 400);
		}*/
	});
	
	$('.ss2_wrapper').mouseenter(function(){
		$('#slideshow').cycle('pause');
		$('.ss2_wrapper .slideshow_prev').stop(true, true).animate({ opacity:'0.5'}, 200);
		$('.ss2_wrapper .slideshow_next').stop(true, true).animate({ opacity:'0.5'}, 200);
	}).mouseleave(function(){
		$('#slideshow').cycle('resume');
		$('.ss2_wrapper .slideshow_prev').stop(true, true).animate({ opacity:'0'}, 200);
		$('.ss2_wrapper .slideshow_next').stop(true, true).animate({ opacity:'0'}, 200);
	});
	$('a[href="#"]').click(function(event){ 
		event.preventDefault(); // Disable all links that point to "#"
	});
	
</script>