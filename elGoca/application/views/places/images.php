<?php if ($this->session->userdata(Level)!=1): ?><h1><?php echo $title; ?></h1><hr/><br/><?php endif; ?>
<h2><?php echo $this->lang->line('txt_step_3').' - '.$this->lang->line('txt_image_selection'); ?></h2><br/>
<?php echo form_open_multipart('place/uploadImages',array('id' => 'fileupload')); ?>
	<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
    <div class="row fileupload-buttonbar">
        <div class="span7">
            <!-- The fileinput-button span is used to style the file input field as button -->
            <span class="btn fileinput-button">
                <i class="icon icon-add"></i>
                <?php echo $this->lang->line('txt_add_files'); ?>                
                <input type="file" name="files[]" multiple>
            </span>                            
            <button type="submit" class="btn start">
                <i class="icon icon-upload"></i>
                <?php echo $this->lang->line('txt_upload'); ?>
            </button>
            <button type="reset" class="btn cancel">
                <i class="icon icon-cancel"></i>
                <?php echo $this->lang->line('txt_cancel'); ?>
            </button>
            <button type="button" class="btn delete">
                <i class="icon icon-del"></i>
                <?php echo $this->lang->line('txt_del'); ?>
            </button>
            <input type="checkbox" class="toggle">
        </div>
        <!-- The global progress information -->
        <div class="span5 fileupload-progress fade">
            <!-- The global progress bar -->
            <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                <div class="bar" style="width:0%;"></div>
            </div>
            <!-- The extended global progress information -->
            <div class="progress-extended">&nbsp;</div>
        </div>
    </div>
    <!-- The loading indicator is shown during file processing -->
    <div class="fileupload-loading"></div>
    <br>
    <!-- The table listing the files available for upload/download -->
    <table role="presentation" class="table table-striped big"><tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody></table>
    <br/><br/>
    <!-- modal-gallery is the modal dialog used for the image gallery -->
    <div id="modal-gallery" class="modal modal-gallery hide fade" data-filter=":odd">
        <div class="modal-header">
            <a class="close" data-dismiss="modal">&times;</a>
            <h3 class="modal-title"></h3>
        </div>
        <div class="modal-body"><div class="modal-image"></div></div>
        <div class="modal-footer">
            <a class="btn modal-download" target="_blank">
                <i class="icon icon-download"></i>
                <span><?php echo $this->lang->line('txt_download'); ?></span>
            </a>
            <a class="btn modal-slideshow" data-slideshow="5000">
                <i class="icon-play icon-white"></i>
                <span><?php echo $this->lang->line('txt_slide'); ?></span>
            </a>
            <a class="btn btn-black modal-prev"><?php echo $this->lang->line('txt_prev'); ?></a>
            <a class="btn-black modal-next"><?php echo $this->lang->line('txt_next'); ?></a>
        </div>
    </div>
    <!-- Buttons! -->   
    <center>
        <?php 
			echo anchor('place/location/'.$place,$this->lang->line('txt_go_back'),array('class' => 'btn','style' => 'margin-right:5px;')); 
			echo anchor($link,'<i class="icon icon-ok"></i>'.' '.$this->lang->line('txt_finish'),array('class' => 'btn-black','style' => 'margin-right:5px;')); 
		?>        
    </center>
<?php echo form_close(); ?>

<?php echo $jUpload; ?>