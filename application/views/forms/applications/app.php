<div id="applications">	
<div id="search-container">
<table>
<tr><td class="searcher_admin">
	<label><?php echo $this->lang->line('txt_search'); ?></label>
	<input class="search" id="searcher1" type="text" placeholder="<?php echo $this->lang->line('txt_search'); ?>">
</td>
</tr>
<tr><td>&nbsp;</td></tr>
</table>
		
<table class="data-table" width="100%">
<thead>
<!-- Headers -->
<tr>
<?php foreach($this->lang->line('header_app') as $header): ?>
	<th><?php echo $header; ?></th>
<?php endforeach; ?>
<th><?php echo $this->lang->line('txt_actions') ?></th>
</tr>
    			</thead>
    			<!-- Data -->
    			<tbody class="list">
<?php foreach($apps as $app): ?>
	<td><?php echo $app['Name']; ?></td>
	<td><?php echo $app['App_Date']; ?></td>
	<td><?php echo anchor(base_url('applications/check/').'/'.encodeID($app['idJob']).'/'.encodeID($app['idUser']),$this->lang->line('txt_view'),array('class' => 'icon view')); ?></td>
<?php endforeach; ?>
</tbody>
    		</table>
			
			<ul class="paging">
                <li id=""><div class="page"><a class="active" href="javascript:function Z(){Z=\'\'}Z()">1</a></div></li>
                <li id=""><div class="page"><a class="" href="javascript:function Z(){Z=\'\'}Z()">2</a></div></li>
                <li id=""><div class="page">...</div></li>
                <li id=""><div class="page"><a class="" href="javascript:function Z(){Z=\'\'}Z()">9</a></div></li>
                <li id=""><div class="page"><a class="" href="javascript:function Z(){Z=\'\'}Z()">10</a></div></li>
            </ul>
			</div></div>
			<script type="text/javascript">	
	        var options = {
	    	    valueNames: [ "Name,App_Date" ],
	    	    page: 5,
	    	    plugins: [    	        
	    	        [ "paging", {    	            
	    	            pagingClass: "paging",
	    	            innerWindow: 1,
	            	    outerWindow: 2
	    	        } ]
	    	    ]
	        };	        
			var dataList = new List("applications", options);        
		</script>
		<br/><br/>
<?php echo anchor(base_url('job/applications'),$this->lang->line('txt_go_back')); ?>