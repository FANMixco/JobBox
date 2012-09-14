<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

function jQuery_UI(){
	$jUI ='
	<!-- jQuery-UI -->
	<script type="text/javascript" src="'.base_url('scripts/jQuery-UI/js/jquery-ui-1.8.23.custom.min.js').'"></script>
	<link rel="stylesheet" href="'.base_url('scripts/jQuery-UI/css/ui-darkness/jquery-ui-1.8.23.custom.css').'" type="text/css" media="screen" charset="utf-8">
	';
	return $jUI;
}

function jlist(){
	$jlist ='
	<!-- list.js -->
	<script type="text/javascript" src="'.base_url('resources/list/list.js').'"></script>
	<script type="text/javascript" src="'.base_url('resources/list/list.paging.js').'"></script>
	';
	return $jlist;	
}

function charts(){
	$charts ='
	<!-- highcharts.js -->
	<script type="text/javascript" src="'.base_url('resources/highcharts/highcharts.js').'"></script>
	<script type="text/javascript" src="'.base_url('resources/highcharts/exporting.js').'"></script>
	';
	return $charts;	
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