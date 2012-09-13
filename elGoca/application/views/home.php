<div id="<?php echo $header_main; ?>">
	<video width="445" height="270" src="temp_video.mp4" type="video/mp4" 
	id="video-player" class="left" poster="temp_image.jpg" controls="controls" preload="none"></video>

	<ol id="buttons">
		<li class="events"><a href="events">				
			<img src="images/home/menu/events.png" />
			<h4 class="button"><?php echo $this->lang->line('txt_events'); ?></h4>
		</a></li>
		<li class="movies"><a href="movies">
			<img src="images/home/menu/movies.png" />
			<h4 class="button"><?php echo $this->lang->line('txt_movies'); ?></h4>
		</a></li>
		<li class="food"><a href="restaurants">
			<img src="images/home/menu/food.png" />
			<h4 class="button"><?php echo $this->lang->line('txt_food'); ?></h4>
		</a></li>			
		<li class="bar"><a href="bar">
			<img src="images/home/menu/bar.png" />
			<h4 class="button"><?php echo $this->lang->line('txt_bar'); ?></h4>
		</a></li>
		<li class="hobbies"><a href="hobbies">
			<img src="images/home/menu/hobbies.png" />
			<h4 class="button"><?php echo $this->lang->line('txt_hobbies'); ?></h4>
		</a></li>
		<li class="culture"><a href="culture">
			<img src="images/home/menu/culture.png" />
			<h4 class="button"><?php echo $this->lang->line('txt_culture'); ?></h4>
		</a></li>
	</ol>
</div>
<!-- Content -->
<div id="content">
	<div id="content-main">
		<!-- Slider -->
		<div id="list">
			<div class="prev"><img src="images/home/gallery/arrow_left.png" alt="prev" /></div>
					
                            <div class="slider">
                                    <ul>
                                        <?php                                             
                                            //Write exactly 10 images for the slide
                                            for($i=0;$i<10;$i++):
                                                $link = '<a href="javascript:void(0)" title="'.$this->lang->line("txt_unavailable").'"><img src="'.base_url('images/misc/unavailable.jpg').'" alt="'.$this->lang->line("txt_unavailable").'" class="captify" /></a>';
                                                if (isset($events[$i]))
                                                    $link = writeSingleImage('event',$events,$i,idEvent,array('title="'.$events[$i][name].'"','alt="'.truncate($events[$i][description],80).'" class="captify"'));
                                                echo '<li>'.$link.'</li>';
                                            endfor;
                                        ?>                                            
                                    </ul>
                            </div>
			<div class="next"><img src="images/home/gallery/arrow_right.png" alt="next" /></div>
		</div><!-- /slider -->		
		<div class="clear"></div>
		<div id="home-right">			
			<h2 class="title"><?php echo $this->lang->line('txt_calendar'); ?></h2>
			<div id="datepicker"></div>
			<div id="selected-event">
				<h5 class="sub-title" style="margin-bottom:8px;"><?php echo $this->lang->line('txt_selected_event'); ?></h5>
				<div class="left" style="margin-left:8px;margin-right:15px;">
					<h4 id="day"><?php echo date('d'); ?></h4>
					<span id="monthYear">
						<?php 
							$months = $this->lang->line('ar_months');
							echo $months[date('n')-1].' '.date('Y'); 
						?>
					</span>
				</div>
				<ul id="events-date">
                	<?php if (!empty($todayEvents)): ?>
						<li><?php echo anchor('events/view/'.encodeID($todayEvents[0][idEvent]),truncate($todayEvents[0][name],25)); ?></li>
                        <li class="separator"></li>
                        <?php if (isset($todayEvents[1])) echo '<li>'.anchor('events/view/'.encodeID($todayEvents[1][idEvent]),truncate($todayEvents[1][name],25)).'</li>'; ?>									
                    <?php else: ?>
                    	<li><?php echo $this->lang->line('msg_no_date_events'); ?></li>
                    <?php endif; ?>
				</ul>				
				<a id="more-events" href="<?php echo base_url('getEvents/'.date('Y-m-d').'/1'); ?>"><?php echo $this->lang->line('txt_more_events'); ?></a>
			</div>					
			<img class="ads-2" style="margin-bottom:42px;" src="files/temp_images/ad_2.png" />
			<h2 class="title"><?php echo $this->lang->line('txt_recommended'); ?></h2>
			<img class="reco" src="files/temp_images/reco.jpg" />
			<img class="reco right" src="files/temp_images/reco.jpg" />
			<img class="reco" src="files/temp_images/reco.jpg" />
			<img class="reco right" src="files/temp_images/reco.jpg" />
			<img class="reco" src="files/temp_images/reco.jpg" />
			<img class="reco right" src="files/temp_images/reco.jpg" />
			<a class="right" href="#"><?php echo $this->lang->line('txt_more_recommendations'); ?></a>
			<img class="ads-3" src="files/temp_images/another_ad.jpg" />
			<img class="ads-3" src="files/temp_images/another_ad.jpg" />
		</div><!-- /home-right -->		
		<div id="home-main">
			<h2 class="title"><?php echo $this->lang->line('txt_categories'); ?></h2>
			<div class="category-preview">
            	<?php echo writeMainThumb('events',$this->lang->line('txt_events'),array('event',$events,0,idEvent),array($events,name,description),$this->lang->line('txt_unavailable'));?>
				<ol class="thumb-list">
					<?php echo writeThumbs($events,array(idEvent,name),'event',$this->lang->line('txt_unavailable'));?>
				</ol>
			</div><!-- /events-category -->
			<div class="category-preview category-preview-right">
            	<?php echo writeMainThumb('movies',$this->lang->line('txt_movies'),array('place',$movies,0,idPlace),array($movies,name,description),$this->lang->line('txt_unavailable'));?>
				<ol class="thumb-list">
					<?php echo writeThumbs($movies,array(idPlace,name),'place',$this->lang->line('txt_unavailable'));?>
				</ol>
			</div><!-- /movies-category -->
			<img class="ad" src="files/temp_images/ad.png" /><!-- advertising -->
			<div class="category-preview">
				<?php echo writeMainThumb('food',$this->lang->line('txt_food'),array('place',$food,0,idPlace),array($food,name,description),$this->lang->line('txt_unavailable'));?>
				<ol class="thumb-list">
					<?php echo writeThumbs($food,array(idPlace,name),'place',$this->lang->line('txt_unavailable'));?>
				</ol>
			</div><!-- /food-category -->
			<div class="category-preview category-preview-right">
				<?php echo writeMainThumb('bar',$this->lang->line('txt_bar'),array('place',$bar,0,idPlace),array($bar,name,description),$this->lang->line('txt_unavailable'));?>
				<ol class="thumb-list">
					<?php echo writeThumbs($bar,array(idPlace,name),'place',$this->lang->line('txt_unavailable'));?>
				</ol>
			</div><!-- /bar-category -->
			<img class="ad" src="files/temp_images/ad.png" />
			<div class="category-preview">
            	<?php echo writeMainThumb('hobbies',$this->lang->line('txt_hobbies'),array('place',$hobbies,0,idPlace),array($hobbies,name,description),$this->lang->line('txt_unavailable'));?>
				<ol class="thumb-list">
					<?php echo writeThumbs($hobbies,array(idPlace,name),'place',$this->lang->line('txt_unavailable'));?>
				</ol>
			</div><!-- /hobbies-category -->
			<div class="category-preview category-preview-right">
				<?php echo writeMainThumb('culture',$this->lang->line('txt_culture'),array('place',$culture,0,idPlace),array($culture,name,description),$this->lang->line('txt_unavailable'));?>
				<ol class="thumb-list">
					<?php echo writeThumbs($culture,array(idPlace,name),'place',$this->lang->line('txt_unavailable'));?>
				</ol>
			</div><!-- /culture-category -->			
			<div class="clear"><!-- separator line --></div>
		</div><!-- /home-main -->
		<div class="clear" style="height:53px;">&nbsp;<br/><!-- no-separator line --></div>
	</div><!-- /content-main -->	
</div><!-- /content -->
<script type="text/javascript">
	$(document).ready(function(){
		/* Slider */
		$('img.captify').captify({
				// all of these options are... optional
				// ---
				// speed of the mouseover effect
				speedOver: 'fast',
				// speed of the mouseout effect
				speedOut: 'normal',
				// how long to delay the hiding of the caption after mouseout (ms)
				hideDelay: 500,	
				// 'fade', 'slide', 'always-on'
				animation: 'slide',		
				// text/html to be placed at the beginning of every caption
				prefix: '',		
				// opacity of the caption on mouse over
				opacity: '0.7',					
				// the name of the CSS class to apply to the caption box
				className: 'caption-bottom',	
				// position of the caption (top or bottom)
				position: 'bottom',
				// caption span % of the image
				spanWidth: '100%'
			});
		$(".slider").jCarouselLite({
        		btnNext: ".next",
        		btnPrev: ".prev",
        		visible: 5
    		});

		/* Calendar */

		var MonthsStr = "<?php echo implode('|', $this->lang->line('ar_months')) ?>";
		var Months = MonthsStr.split('|');		
		$( "#datepicker" ).datepicker();
		$( "#datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
		$( "#datepicker" ).click(function(){
			var date = $( "#datepicker" ).datepicker('getDate')	
			var day = date.getDate();
			var month = date.getMonth();
			var year = date.getFullYear();
			$('#day').text(day);
			$('#monthYear').text(Months[month]+' '+year);			
			month = (month+1).toString();
			if (month.length<2) month = '0'+month;
                        if (day.toString().length<2) day = '0'+day;
			$.getJSON('getEvents/'+year+'-'+month+'-'+day, function(data) {
                                var i=0;
                                var events = '';
				$.each(data, function(key, event) { 
                                    if (key=='response'){
                                        events += '<li>'+event+'</li>';
                                        return false;
                                    }                                    
                                    events += '<li><a href="<?php echo base_url('events/view') ?>/'+event.id+'">'+event.name+'</a></li>';
                                    events += '<li class="separator"></li>';
                                    if (i++==2) return false;
				});
                                $('#events-date').html(events);
			});
                        $('#events-date').css('max-width',185-$('#monthYear').width());
                        $('#more-events').attr('href','<?php echo base_url('getEvents'); ?>/'+year+'-'+month+'-'+day+'/1');
		});
	});
</script>

<?php 
	/* --------------------------------------------------------------------------	*/
	/* writeMainThumb - Writes the main-thumb 				 	 			 		*/
	/*																				*/
	/* $subclass - The second class for the div 									*/
	/* $text 	 - Text to display 				 									*/
	/* $fnImage  - Array containing the info to run the writeSingleImage function	*/
	/*  			For details, see the function in MyForm_helper					*/
	/* $indexes  - Array containing the indexes to write the info. Expects:			*/
	/*  			[0] - Data 														*/
	/*  			[1] - Name 														*/
	/*  			[2] - Description												*/
	/*																				*/
	/* RETURNS: string with the main thumb div. I write this function here because	*/
	/* 			 it's used only here. 												*/
	/*																				*/
	/* --------------------------------------------------------------------------	*/
	function writeMainThumb($subclass='',$text,$fnImage,$indexes,$unavailable){
		$name = (isset($indexes[0][0][$indexes[1]]))?$indexes[0][0][$indexes[1]]: $unavailable;
		$desc = (isset($indexes[0][0][$indexes[2]]))?$indexes[0][0][$indexes[2]]: $unavailable;
		if (strlen($desc)>150)$desc = substr($desc,0,95).'...';
		return'
		<div class="main-thumb '.$subclass.'">
			<h4>'.$text.'</h4>
			<div>'.writeSingleImage($fnImage[0],$fnImage[1],$fnImage[2],$fnImage[3]).'</div>
		</div>
		<p><label class="name">'.$name.'</label>'.$desc.'</p>
		';
	}
	
	/* --------------------------------------------------------------------------	*/
	/* writeThumbs - Writes the thumbs 						 	 			 		*/
	/*																				*/
	/* $data 	 - Array containing the info 	 									*/
	/* $indexes  - Array containing the indexes to write the info. Expects:			*/
	/*  			[0] - ID 														*/
	/*  			[1] - Name 														*/
	/* $fnImage  - (string) Directory where to search the img 						*/
	/* $unavailable  - String containing the unavailable text						*/
	/*																				*/
	/* RETURNS: string with the thumbs in list format. I write this function here 	*/
	/* 			 because it's used only here. 										*/
	/*																				*/
	/* --------------------------------------------------------------------------	*/
	function writeThumbs($data,$indexes,$fnImage,$unavailable){
		$thumbs ='';
		for($i=1;$i<3;$i++):
			$img='<img src="'.base_url('images/misc/unavailable.jpg').'" />';
			$Name = $unavailable;
			
			if (isset($data[$i])):
				$img = writeSingleImage($fnImage,$data,$i,$indexes[0]);
				$Name = $data[$i][$indexes[1]];
			endif;
			
			$thumbs .= '
			<li>'.$img.'
				<label class="name">'.$Name.'</label>
			</li>
			';
		endfor;
		return $thumbs;
	}
?>