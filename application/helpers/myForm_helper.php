<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/* --------------------------------------------------------------------------	*/
/* getDropDown - gets an array ready to use for the form_dropdown function 		*/
/*																				*/
/* $vals 		- array containing a result set 								*/
/* $keyIndex 	- Index of the $vals array that's gonna be used as key			*/
/* $vals 		- Index of the $vals array that's gonna be used as value		*/
/*																				*/
/* NOTE: key is the value of the dropdown and value it's the message displayed	*/
/*																				*/
/* --------------------------------------------------------------------------	*/

function getDropDown($vals, $keyIndex, $valIndex){
	$dropDown = array();
	foreach($vals as $val):
		$dropDown[$val[$keyIndex]] = $val[$valIndex];
	endforeach;
	return $dropDown;
}

/* --------------------------------------------------------------------------	*/
/* changeDateFormat - changes the format of the specified date 			 		*/
/*																				*/
/* $date 		- string containing the date to format							*/
/* $ddmmyy 		- Boolean that determines whether the value returned must be	*/
/*					in dd/mm/yyyy format or in yyyy-mm-dd format 				*/
/*																				*/
/* RETURNS => A string with the date in a specific format 						*/
/*																				*/
/* --------------------------------------------------------------------------	*/
function changeDateFormat($date,$ddmmyy=false){
	if ($ddmmyy):
		//Divide the date
		$year 	= substr($date,0,4);		
		$month 	= substr($date,5,2);
		$day 	= substr($date,8,2);		
		return $day.'/'.$month.'/'.$year;
	else:
		//Divide the date
		$day 	= substr($date,0,2);
		$month 	= substr($date,3,2);
		$year 	= substr($date,6);
		return $year.'-'.$month.'-'.$day;
	endif;	
}

/* --------------------------------------------------------------------------	*/
/* getTime 	- Creates an array for time selection 			 			 		*/
/*																				*/
/* RETURNS 	- Array containing three elements:									*/
/*				[Hours] => 1-12 												*/
/*				[Minutes] => 00-59 												*/
/*				[am] => am-pm 	 												*/
/*																				*/
/* --------------------------------------------------------------------------	*/
function getTime(){	
	$time = array('Hours' => array(),'Minutes' => array(),'am' => array('AM' => 'AM', 'PM' => 'PM'));
	//get the hours
	for($i=1;$i<13;$i++): $time['Hours'][$i] = ($i<10) ?'0'.$i:$i;endfor;
	//get the minutes
	for($i=0;$i<60;$i++): $time['Minutes'][$i] = ($i<10) ?'0'.$i:$i;endfor;
	
	return $time;
}

/* --------------------------------------------------------------------------	*/
/* encodeID - Encodes an ID to use it in an URL				 			 		*/
/*																				*/
/* $id 		- ID to encode														*/
/*																				*/
/* --------------------------------------------------------------------------	*/
function encodeID($id){
	$ci =& get_instance();
	$ci->load->library('encrypt');
	return str_replace('%2F',uri_replace,urlencode($ci->encrypt->encode($id)));	
}

/* --------------------------------------------------------------------------	*/
/* decodeID - Decodes an ID coming from an URL				 			 		*/
/*																				*/
/* $id 		- ID to decode														*/
/*																				*/
/* --------------------------------------------------------------------------	*/
function decodeID($id){
	$ci =& get_instance();
	$ci->load->library('encrypt');
	return $ci->encrypt->decode(urldecode(str_replace(uri_replace,'%2F',$id)));
}

/* --------------------------------------------------------------------------	*/
/* truncate - Truncates a string with the limit specified	 			 		*/
/*																				*/
/* $string	- String to analyze													*/
/* $limit	- Maximum length of the string										*/
/*																				*/
/* --------------------------------------------------------------------------	*/
function truncate($string,$limit){
	return (strlen($string)>$limit)?substr($string,0,$limit).'...':$string;
}

/* --------------------------------------------------------------------------	*/
/* writeSingleImage - Searches an image in the directory 	 			 		*/
/*																				*/
/* $class 	- Determines wheter the image must be search in the place directory	*/
/* 				or in the event dir.											*/
/* $dirSegment 	- The last segment of the directory 							*/
/* $attributes 	- String with the attributes of: 							*/
/*                  [0] <a> 							*/
/*                  [1] <img> 							*/
/*																				*/
/* RETURNS: string with the <img> tag		 									*/
/*																				*/
/* --------------------------------------------------------------------------	*/
function writeSingleImage($class,$data,$index,$IDIndex,$attributes=array('','')){
	$img = '<img src="'.base_url('images/misc/unavailable.jpg').'" />';
	
	//Get the first image of the directory
	if (isset($data[$index])):
		$dir="files/".$class."/images/".$data[$index][$IDIndex].'/';		
		if (is_dir($dir)):
			if ($dh = opendir($dir)):
				while (($file = readdir($dh)) !== false) {
					if ($file !='.' && $file !='..'):
						//To generate the link, just add an 's' to $class
						$img = '<a href="'.base_url($class.'s/view/'.encodeID($data[$index][$IDIndex])).'" '.$attributes[0].'><img src="'.base_url($dir.$file).'" '.$attributes[1].' /></a>';
						break;
					endif;
				}
				closedir($dh);									
			endif;
		endif;
	endif;	
	return $img;
}

/* --------------------------------------------------------------------------	*/
/* printList - Displays a table in list-format				 			 		*/
/*																				*/
/* $searchText 	- String that will be shown in the search option				*/
/* $directory 	- The directory where the function will search the image		*/
/*					If this var is NULL, the function won't display any image.	*/
/* $noRecordsMsg- Message to display when there are no records					*/
/* $data 		- Result array containing the data to print						*/
/* $indexes 	- Array containing all the indexes that are gonna be printed.	*/
/*					The function assumes:										*/
/*					[0] => ID 													*/
/*					[1] => name													*/
/*					[2] => description											*/
/* $linkData	- Array containing the info necessary for writing the URLS.		*/
/*				The values are threatened as follows: 							*/
/*				[0]. It will be url to write 					 				*/
/*				[1]. key Index of the element. If null, don't write it			*/
/* $divName		- The ID of the div that contains the records					*/
/*																				*/
/* --------------------------------------------------------------------------	*/
function printList($searchText,$directory=NULL,$noRecordsMsg,$data,$indexes,$linkData,$divName='records',$users=false){
	$ci =& get_instance();
	/*Initialize the vars*/
	$table = '';
	$tableData = '';
	
	if (!empty($data)):		
		/* Start getting the info */
		/**********************Pagination****************************/		
		$paging = '<center><ul class="paging">
                <li id=""><div class="page"><a class="active" href="javascript:function Z(){Z=\'\'}Z()">1</a></div></li>
                <li id=""><div class="page"><a class="" href="javascript:function Z(){Z=\'\'}Z()">2</a></div></li>
                <li id=""><div class="page">...</div></li>
                <li id=""><div class="page"><a class="" href="javascript:function Z(){Z=\'\'}Z()">9</a></div></li>
                <li id=""><div class="page"><a class="" href="javascript:function Z(){Z=\'\'}Z()">10</a></div></li>
            </ul></center>';
        $pagingScript = '
        <script type="text/javascript">	
	        var options = {
	    	    valueNames: [ "name" ],
	    	    page: '.resultsPerPage.',
	    	    plugins: [    	        
	    	        [ "paging", {    	            
	    	            pagingClass: "paging",
	    	            innerWindow: 1,
	            	    outerWindow: 2
	    	        } ]
	    	    ]
	        };	        
			var dataList = new List("'.$divName.'", options);        
		</script>
        ';		
		/**********************Table-data****************************/
		foreach ($data as $record):
			$tableData .= '<tr>'; //Open the row
			if ($directory!=NULL):
				//Get the first image of the directory
				$dir="files/".$directory."/thumbs/".$record[$indexes[0]].'/';
				if (is_dir($dir)):
					if ($dh = opendir($dir)):
						while (($file = readdir($dh)) !== false) {
							if ($file !='.' && $file !='..'):
								$img = base_url($dir.$file);
								break;
							endif;
						}
						closedir($dh);									
					endif;
				endif;
				$tableData .= '<td><div class="thumb"><img src="'.$img.'" /></td>'; //Add the image
			endif;			
			//Get the link
			$link = anchor($linkData[0].'/'.encodeID($record[$linkData[1]]),$ci->lang->line('txt_view').' [+]');
			$tableData .= ($users==false)? '<td><h2 class="name">'.anchor($linkData[0].'/'.encodeID($record[$linkData[1]]),$record[$indexes[1]]).'</h2>
				<p>'.truncate($record[$indexes[2]],210).'</p>'.$link.'</td>':
				'<td><h2 class="name">'.anchor($linkData[0].'/'.encodeID($record[$linkData[1]]),$record[$indexes[1]].' '.$record[$indexes[2]]).'</h2><p>'.truncate($record[$indexes[3]],210).'</p>'.$link.'</td>';  //Add the info;  //Add the info
			
			$tableData .= '</tr>'; //Close the row
		endforeach;
		/**********************Table-Structure****************************/
		/*$table .= '<div id="'.$divName.'" class="records">
            <div id="search-container">
                <label>'.$searchText.'</label>
                <input class="search" placeholder="'.$ci->lang->line('txt_search').'"><i class="icon appended-search-icon"></i>                
            </div>
    		<table width="100%">
			<!-- Data -->
   			<tbody class="list">';*/
  		$table .= '	<div id="'.$divName.'" class="records">	
  		<div id="search-container">
  		<div class="searcher_label" ><div style="height:10px;font-size:1px;">&nbsp;</div>
			<p>'.$ci->lang->line('txt_search').'</p></div>
				<div id="searcherbox">
					    <input class="search" id="searcher" type="text" placeholder="'.$ci->lang->line('txt_search').'">
				</div>
			</div>
				
    		<div class="searcher_list" style="padding-top:49px;">
    		<table width="100%">
			<!-- Data -->
   			<tbody class="list">'; 
   			
   						
		$table .= $tableData;
		
		$table .='</tbody>
    		</table></div>';

    	$table .= $paging; //Add the paging links            
		$table .= '</div>';
		$table .= $pagingScript; //Add the paging script
	else:
		$table = '<br/><h5 class="message message-info medium left">'.$noRecordsMsg.'</h5>';
	endif;
	return $table;
}

/* --------------------------------------------------------------------------	*/
/* printTable - Displays a table with the info provided		 			 		*/
/*																				*/
/* $searchText 	- String that will be shown in the search option				*/
/* $headers 	- Array containing the list of headers 							*/
/* $data 		- Result array containing the data to print						*/
/* $indexes 	- Array containing all the indexes that are gonna be printed.	*/
/* $linkData	- Array containing the info necessary for writing the URLS.		*/
/*				The values are threatened as follows: 							*/
/*				[0]. It will be the first segment of the edit URL 				*/
/*				[1]. It will be the first segment of delete URL					*/
/*				[2]. Index of the ID in a single row of the $data array			*/
/* $custom		- Info for the custom <td> 										*/
/*				$custom is an array containing the info as follows: 			*/
/*				[fields]. Array containing the info for all the <td>			*/
/*					[0]. <a> class 								 				*/
/*					[1]. Content displayed => <a>content</a>	 				*/
/*					[2]. controller/method						 				*/
/*					[3]. key Index of the element. If null, don't write it		*/
/*				[conditions]. Array containing all the if's that are gonna be 	*/
/*					evaluated. The if's are evaluated the same way as the where */
/*				    method of the db class. 									*/
/*																				*/
/* --------------------------------------------------------------------------	*/
function printTable($searchText,$headers,$data,$indexes,$linkData = NULL,$divName='records',$custom = array('fields' => array(),'conditions' => array())){
	$ci =& get_instance();
	/*Initialize the vars*/
	$table = '';
	$tableHeaders = '';
	$tableData = '';	

	/*Get which links are we going to write*/
	$edit 	= ($linkData[0]!='' && $linkData[0]!=NULL)?1:0;
	$delete = ($linkData[1]!='' && $linkData[1]!=NULL)?1:0;
	$cust	= ($custom!=NULL)?1:0;

	/*Get the colspan*/
	$colspan =  $edit + $delete + $cust; //Intentionally add one colspan

	if (!empty($data)):		
		/* Start getting the info */
		/**********************Pagination****************************/		
		$paging = '<ul class="paging">
                <li id=""><div class="page"><a class="active" href="javascript:function Z(){Z=\'\'}Z()">1</a></div></li>
                <li id=""><div class="page"><a class="" href="javascript:function Z(){Z=\'\'}Z()">2</a></div></li>
                <li id=""><div class="page">...</div></li>
                <li id=""><div class="page"><a class="" href="javascript:function Z(){Z=\'\'}Z()">9</a></div></li>
                <li id=""><div class="page"><a class="" href="javascript:function Z(){Z=\'\'}Z()">10</a></div></li>
            </ul>';
        $pagingScript = '
        <script type="text/javascript">	
	        var options = {
	    	    valueNames: [ "'.implode($indexes,'","').'" ],
	    	    page: '.resultsPerPage.',
	    	    plugins: [    	        
	    	        [ "paging", {    	            
	    	            pagingClass: "paging",
	    	            innerWindow: 1,
	            	    outerWindow: 2
	    	        } ]
	    	    ]
	        };	        
			var dataList = new List("'.$divName.'", options);        
		</script>
        ';
		/**********************Table-headers****************************/
		foreach ($headers as $header): $tableHeaders .='<th>'.$header.'</th>'; endforeach;		
		if ($colspan>1) $tableHeaders .= '<th colspan="'.$colspan.'">'.$linkData[3].'</th>';
		/**********************Table-data****************************/
		foreach ($data as $record):
			$tableData .= '<tr>';

			foreach ($indexes as $index):
				$tableData .= '<td class="'.$index.'">'.$record[$index].'</td>';				
			endforeach;
			//Write the links
			//Edit
			if ($edit) $tableData .= '<td><a class="icon edit" href="'.base_url($linkData[0].'/edit/'.encodeID($record[$linkData[2]])).'" >'.$ci->lang->line('txt_edit').'</a></td>';
			//Delete
			if ($delete) $tableData .= '<td><a class="icon del" href="'.base_url($linkData[1].'/delete/'.encodeID($record[$linkData[2]])).'" >'.$ci->lang->line('txt_del').'</a></td>';
			//Custom - Implementing			
			if (!empty($custom['fields'])): //If there are custom fields to write...
				//1. Evaluate the conditions
				if (!empty($custom['conditions'])):
					//Evaluate each condition. The system will asume one if per field
					$i=0;
					foreach($custom['conditions'] as $key => $field):
						$fields = $custom['fields'][$i];
						if ($record[$key] == $field):
							$keyField = ($fields[3]!=NULL)?$fields[3]:'';
							$tableData .= '<td><a class="'.$fields[0].'" href="'.base_url($fields[2].encodeID($record[$keyField])).'">'.$fields[1].'</a></td>';
						endif;
					endforeach;
				else:
					//Just write the fields				
					//foreach($custom['fields'] as $field):						
						$fields = $custom['fields'];
						$keyField = ($fields[3]!=NULL)?$record[$fields[3]]:'';
						$tableData .= '<td><a class="'.$fields[0].'" href="'.base_url($fields[2].'/'.encodeID($keyField)).'">'.$fields[1].'</a></td>';
					//endforeach;
				endif;
			endif; 			
			$tableData .= '</tr>';
		endforeach;
		/**********************Table-Structure****************************/
		/*$table .= '<div id="'.$divName.'">
            <div id="search-container">
                <label>'.$searchText.'</label>
                <input class="search" placeholder="'.$ci->lang->line('txt_search').'"><i class="icon appended-search-icon"></i>                
            </div>
    		<table class="data-table" width="100%">
    			<thead>
    			<!-- Headers -->
    			<tr>';*/
    	
  		$table .= '	<div id="'.$divName.'">	
			  		<div id="search-container">
  					<table>
  					<tr><td class="searcher_admin">
						<label>'.$searchText.'</label>
						<input class="search" id="searcher1" type="text" placeholder="'.$ci->lang->line('txt_search').'">
					</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
					</table>
						    
			<table class="data-table" width="100%">
    			<thead>
    			<!-- Headers -->
    			<tr>';     	


    	$table .= $tableHeaders; //Add the headers

    	$table .='</tr>
    			</thead>
    			<!-- Data -->
    			<tbody class="list">';

    	$table .= $tableData; //Add the table data
    			
    	$table .='</tbody>
    		</table>';

    	$table .= $paging; //Add the paging links            
		$table .= '</div></div>';
		$table .= $pagingScript; //And finally, add the paging script
	else:
		$table = '<br/><h5 class="message message-info medium">'.$ci->lang->line('msg_no_records').'</h5>';
	endif;

	return $table;
}

?>