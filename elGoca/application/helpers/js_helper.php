<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

function videoPlayer(){
	$video_player = '
	<!-- Video Player -->
	<script type="text/javascript" src="resources/player/mediaelement-and-player.min.js"></script>
	<link rel="stylesheet" href="resources/player/mediaelementplayer.min.css" type="text/css" media="screen" charset="utf-8">
	';
	return $video_player;
}

function jCarouselLite(){
	$jCarousel = '
	<!-- jCarousel -->
	<script type="text/javascript" src="resources/jCarousel-lite/jcarousellite_1.0.1.pack.js"></script>
	<script type="text/javascript" src="resources/jCarousel-lite/captify.tiny.js"></script>
	<link rel="stylesheet" href="resources/jCarousel-lite/jCarousel.css" type="text/css" media="screen" charset="utf-8">
	';
	return $jCarousel;
}

function Calendar(){
	$Calendar ='
	<!-- Calendar -->
	<script type="text/javascript" src="'.base_url('resources/jQuery-UI/jquery-ui-1.8.21.custom.min.js').'"></script>
	<link rel="stylesheet" href="'.base_url('resources/jQuery-UI/jquery-ui-1.8.21.custom.css').'" type="text/css" media="screen" charset="utf-8">
	';
	return $Calendar;
}
/* The date picker is basically the Calendar. The only difference it's the css */
function datePicker(){
	$datePicker = '
	<!-- Date Picker -->
	<script type="text/javascript" src="'.base_url('resources/jQuery-UI/jquery-ui-1.8.21.custom.min.js').'"></script>
	<link rel="stylesheet" href="'.base_url('resources/jQuery-UI/dtpicker-jquery-ui-1.8.21.custom.css').'" type="text/css" media="screen" charset="utf-8">
	<script type="text/javascript">
		$( "#datepicker" ).datepicker({ dateFormat: "dd/mm/yy" });
	</script>
	';
	
	return $datePicker;
}

function jShowOff(){
	$jShowOff ='
	<!-- jShowOff -->
	<script type="text/javascript" src="resources/jShowOff/jquery.jshowoff.min.js"></script>
	<link rel="stylesheet" href="resources/jShowOff/jshowoff.css" type="text/css" media="screen" charset="utf-8">
	';
	return $jShowOff;	
}

function jCycle(){
	$jCycle ='
	<!-- jQuery-Cycle -->
	<script type="text/javascript" src="'.base_url("resources/jQuery-Cycle/js/jquery.cycle.all.js").'"></script>
	<script type="text/javascript" src="'.base_url("resources/jQuery-Cycle/js/jquery.easing.1.3.js").'"></script>
	<link rel="stylesheet" href="'.base_url("resources/jQuery-Cycle/css/slideshows.css").'" type="text/css" media="screen" charset="utf-8">
	';
	return $jCycle;	
}

function jlist(){
	$jlist ='
	<!-- list.js -->
	<script type="text/javascript" src="'.base_url('resources/list/list.js').'"></script>
	<script type="text/javascript" src="'.base_url('resources/list/list.paging.js').'"></script>
	';
	return $jlist;	
}

function Coda(){
	$coda ='
	<!-- coda-slider -->
	<script type="text/javascript" src="'.base_url('resources/coda/coda-slider.1.1.1.pack.js').'"></script>
	<script type="text/javascript" src="'.base_url('resources/coda/jquery-easing-1.3.pack.js').'"></script>
	<script type="text/javascript" src="'.base_url('resources/coda/jquery-easing-compatibility.1.2.pack.js').'"></script>
	<link rel="stylesheet" href="'.base_url("resources/coda/style.css").'" type="text/css" media="screen" charset="utf-8">
	<script type="text/javascript">
	
		var theInt = null;
		var $crosslink, $navthumb;
		var curclicked = 0;
		
		theInterval = function(cur){
			clearInterval(theInt);
			
			if( typeof cur != \'undefined\' )
				curclicked = cur;
			
			$crosslink.removeClass("active-thumb");
			$navthumb.eq(curclicked).parent().addClass("active-thumb");
				$(".stripNav ul li a").eq(curclicked).trigger(\'click\');
			
			theInt = setInterval(function(){
				$crosslink.removeClass("active-thumb");
				$navthumb.eq(curclicked).parent().addClass("active-thumb");
				$(".stripNav ul li a").eq(curclicked).trigger(\'click\');
				curclicked++;
				if( 6 == curclicked )
					curclicked = 0;
				
			}, 3000);
		};
		
		$(function(){
			
			$("#main-photo-slider").codaSlider();
			
			$navthumb = $(".nav-thumb");
			$crosslink = $(".cross-link");
			
			$navthumb
			.click(function() {
				var $this = $(this);
				theInterval($this.parent().attr(\'href\').slice(1) - 1);
				return false;
			});
			
			theInterval();
		});
	</script>	
	';
	return $coda;
}

function maps($x,$y){
	if (!is_numeric($x))$x = -34.397;
	if (!is_numeric($y))$y = 150.644;
	$maps ='
	<!-- Google-Maps -->
	<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=true"></script>
	<script type="text/javascript">
		var map;
		function initialize() {
		  var latlng = new google.maps.LatLng('.$x.', '.$y.');
		  var myOptions = {
		    zoom: 18,
		    center: latlng,
		    mapTypeId: google.maps.MapTypeId.ROADMAP
		  };
		  var map = new google.maps.Map(document.getElementById("map_canvas_view"), myOptions);
		  marker = new google.maps.Marker({
			map:map,
			position: latlng
		  });
		}

	  	$(document).ready(function () {
		  initialize();
		});
	</script>
	';

	return $maps;
}

function setmap($coordinates){
	//If the coordinates are set, get them & set them as default. If they are not, get the user location with HTML 5
	if ($coordinates[latitude]!=NULL && $coordinates[longitude]!=NULL):
		$lat 	= $coordinates[latitude];
		$lng 	= $coordinates[longitude];
		$zoom 	= 17;
		$initCall = '$(document).ready(function(){initialize();});';
	else:
		$lat 	= 13.7;
		$lng 	= -89.2;
		$zoom 	= 8;
		$initCall = '
		function coordinates(position) {
			  lat 	= position.coords.latitude;
			  long 	= position.coords.longitude;
			  latlng = new google.maps.LatLng(lat,long);
			  map.setCenter(latlng);
			  marker.setPosition(latlng);			  
  			  updateMarkerPosition(latlng); // Update current position info.
			}	
		  
		  $(document).ready(function () {		  	  	 
			  initialize();
			  navigator.geolocation.getCurrentPosition(coordinates);			  
			});
		';
	endif;
	$setmap = '
	<!-- Google-Maps -->
	<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=true"></script>
	<script type="text/javascript">
		  var geocoder;
		  var map;
		  var marker;
		  var lat;
		  var long;
		  function initialize() {
		    geocoder = new google.maps.Geocoder();		    
		    var latlng = new google.maps.LatLng('.$lat.','.$lng.');
		    var mapOptions = {
		      zoom: '.$zoom.',
		      center: latlng,
		      mapTypeId: google.maps.MapTypeId.ROADMAP
		    }
		    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
		    marker = new google.maps.Marker({
			    map:map,
			    draggable:true,
			    animation: google.maps.Animation.DROP,
			    position: latlng
			  });
			google.maps.event.addListener(marker, "click", toggleBounce);
			// Update current position info.
  			updateMarkerPosition(latlng);
  			google.maps.event.addListener(marker, "drag", function() {updateMarkerPosition(marker.getPosition());});			 
			google.maps.event.addListener(marker, "dragend", function() {geocodePosition(marker.getPosition());});
		  }

		  function codeAddress() {
		    var address = document.getElementById("address").value;
		    geocoder.geocode( { "address": address}, function(results, status) {
		      if (status == google.maps.GeocoderStatus.OK) {
		        map.setCenter(results[0].geometry.location);
		        marker.setPosition(results[0].geometry.location);
				updateMarkerPosition(results[0].geometry.location);
		      } else {
		        alert("Geocode was not successful for the following reason: " + status);
		      }
		    });
		  }

		  function toggleBounce() {

			  if (marker.getAnimation() != null) {
			    marker.setAnimation(null);
			  } else {
			    marker.setAnimation(google.maps.Animation.BOUNCE);
			  }
			}

		  function updateMarkerPosition(latLng) {		  	
			  document.getElementById("latitude").value =latLng.lat();
			  document.getElementById("longitude").value =latLng.lng();
			}
	'.$initCall.'
			
	</script>
	';
	return $setmap;
}

function jUpload(){	
	$jUpload = '
		<!-- jUpload -->
		<link rel="stylesheet" href="' . base_url() . 'resources/jUpload/css/jquery.fileupload-ui.css">
		<!-- Image Gallery -->
		<link rel="stylesheet" href="' . base_url() . 'resources/jUpload/css/bootstrap-image-gall.css">
		<script src="' . base_url() . 'resources/jUpload/js/vendor/jquery.ui.widget.js"></script>
		<!-- The Templates plugin is included to render the upload/download listings -->
		<script src="'.base_url("resources/jUpload/js/tmpl.min.js").'"></script>
		<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
		<script src="'.base_url("resources/jUpload/js/load-image.min.js").'"></script>		
		<!-- The Canvas to Blob plugin is included for image resizing functionality -->
		<script src="'.base_url("resources/jUpload/js/canvas-to-blob.min.js").'"></script>				
		<script src="' . base_url() . 'resources/jUpload/js/jquery.iframe-transport.js"></script>
		<script src="' . base_url() . 'resources/jUpload/js/jquery.fileupload.js"></script>
		<script src="' . base_url() . 'resources/jUpload/js/jquery.fileupload-fp.js"></script>
		<script src="' . base_url() . 'resources/jUpload/js/jquery.fileupload-ui.js"></script>
		<script src="' . base_url() . 'resources/jUpload/js/locale.js"></script>
		<script src="' . base_url() . 'resources/jUpload/js/main.js"></script>
		<script src="' . base_url() . 'resources/jUpload/js/bootstrap.js"></script>
		<script src="' . base_url() . 'resources/jUpload/js/bootstrap-image-gall.js"></script>
		<!-- Shim to make HTML5 elements usable in older Internet Explorer versions -->
		<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->				
		<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE8+ -->
		<!--[if gte IE 8]><script src="js/cors/jquery.xdr-transport.js"></script><![endif]-->
		<!-- The template to display files available for upload -->
		<script id="template-upload" type="text/x-tmpl">
		{% for (var i=0, file; file=o.files[i]; i++) { %}
		    <tr class="template-upload fade">
		        <td class="preview"><span class="fade"></span></td>
		        <td class="name"><span style="display:inline-block;width:75px;">{%=file.name%}</span></td>
		        <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
		        {% if (file.error) { %}
		            <td class="error" colspan="2"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</td>
		        {% } else if (o.files.valid && !i) { %}
		            <td>
		                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div></div>
		            </td>
		            <td class="start">{% if (!o.options.autoUpload) { %}
		                <button class="btn-black">
		                    <i class="icon icon-upload"></i>
		                    <span>{%=locale.fileupload.start%}</span>
		                </button>
		            {% } %}</td>
		        {% } else { %}
		            <td colspan="2"></td>
		        {% } %}
		        <td class="cancel">{% if (!i) { %}
		            <button class="btn-black">
		                <i class="icon icon-cancel"></i>
		                <span>{%=locale.fileupload.cancel%}</span>
		            </button>
		        {% } %}</td>
		    </tr>
		{% } %}
		</script>
		<!-- The template to display files available for download -->
		<script id="template-download" type="text/x-tmpl">
		{% for (var i=0, file; file=o.files[i]; i++) { %}
		    <tr class="template-download fade">
		        {% if (file.error) { %}
		            <td></td>
		            <td class="name"><span>{%=file.name%}</span></td>
		            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
		            <td class="error" colspan="2"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</td>
		        {% } else { %}
		            <td class="preview">{% if (file.thumbnail_url) { %}
		                <a href="{%=file.url%}" title="{%=file.name%}" rel="gallery" download="{%=file.name%}"><img src="{%=file.thumbnail_url%}"></a>
		            {% } %}</td>
		            <td class="name">
		                <a href="{%=file.url%}" title="{%=file.name%}" rel="{%=file.thumbnail_url&&\'gallery\'%}" download="{%=file.name%}">{%=file.name%}</a>
		            </td>
		            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
		            <td colspan="2"></td>
		        {% } %}
		        <td class="delete">
		            <button class="btn-black btn-del" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}">
		                <i class="icon icon-del"></i>
		                <span>{%=locale.fileupload.destroy%}</span>
		            </button>
		            <input type="checkbox" name="delete" value="1">
		        </td>
		    </tr>
		{% } %}
		</script>
	';

	return $jUpload;

}

?>