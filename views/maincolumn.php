<?php

if(!isset($infinitescrollpath)){$infinitescrollpath = "";}

?>

<style>

.container-maincolumn {
	
	position: relative; 
	display: inline-block; 
	float: left; 
	background-color: #EDF0F0;
	width: 100%;
	
}

.celltopdiv {
	
	position: relative;
	display: inline-block;
	margin: 0; 
	padding: 0;
	background-position: center;
	background-size: 100% auto;
	float: left;
	margin-top: 0;
	overflow: hidden;
	
}

.cellbottomdiv {
	
	position: relative;
	display: inline-block;
	margin: 0; 
	padding: 0;
	float: left;
	margin-top: 0;
	text-align: center;
	
}

.titlecontainer {
	
	position: relative;
	display: inline-block;
	text-align: left;
	width: 90%;
	font-size: 0.9em;
	font-weight: 500;
	color: #333333;
	margin-top: 20px;
	margin-bottom: 20px; 
	
}

.desccontainer {
	
	position: relative;
	display: inline-block;
	text-align: left;
	width: 90%;
	font-size: 0.6em;
	font-weight: 300;
	color: #777777;
	margin-top: -10px;
	margin-bottom: 10px;
	
}

.datecontainer {
	
	position: relative;
	display: inline-block;
	text-align: left;
	width: 90%;
	font-size: 0.4em;
	font-weight: 500;
	color: rgba( 135, 135, 145, 1);
	margin-top: 5px;
	margin-bottom: 10px;
	
}

.categorycontainer {
	
	position: relative;
	display: inline-block;
	text-align: left;
	width: 90%;
	font-size: 0.3em;
	font-weight: 500;
	margin-top: 10px;
	margin-bottom: -10px; 
	text-transform: uppercase;
	color: rgba( 135, 135, 145, 1);
	
}

.reusableCell1 {
	
	display: inline-block;
	position: relative;
	overflow: hidden;
	border: 0;
	border-radius: 6px;
	
}

.featuredvideoclass {
	
	position: absolute;
	display: inline-block; 
	margin: 0;
	padding: 0;
	top: 0;
	height: 100%;
	width: auto;
	float: left;
	margin-top: -34.5%;
	margin-left: -20%;
	
}

.videoclass {
	
	position: absolute;
	display: inline-block; 
	margin: 0;
	padding: 0;
	top: 0;
	height: 100%;
	width: auto;
	float: left;
	/*margin-top: -34.5%;
	margin-left: -20%;*/
	
}

.youtubelink {
	z-index: 1;
	cursor: pointer;
	position: absolute; 
	display: inline-block;
	width: 100%;
	height: 100%;
	margin: 0;
	padding: 0;
	top: 0;
	left: 0;
	background: transparent;
	border: 0;
}




.maincolumn1 {
	display: inline-block;
	position: relative;
	margin: 0;
	padding: 0;
	width: 100%;
	max-width: 1200px;
	background-color: #EDF0F0;
}
.maincolumn1 .container {
	position: relative;
	display: inline-block;
	margin: 0;
	padding: 0;
	width: 100%;
}

</style>

<div class="maincolumn1">
	<div class="container">
	<!-- <script>console.log(<?php echo sizeof($maincolumnarray) ?>)</script> -->
		<?php for($a=0;$a<sizeof($maincolumnarray);$a++){ ?>
			<?php $cell6id=$maincolumnarray[$a]['id']; $cell6mediatype=$maincolumnarray[$a]['type']; $cell6category=$maincolumnarray[$a]['category']; $cell6date=$maincolumnarray[$a]['formatted_date']; $cell6image=str_replace("uploads", "uploads/thumbs2", $maincolumnarray[$a]['featured_imagepath']); $cell6title=$maincolumnarray[$a]['title']; $isfeatured=false; $cell6desc = $maincolumnarray[$a]['html_text']; $cell6price = $maincolumnarray[$a]['price']; include $docroot.'/reusables/views/cell_6.php'; ?>
		<?php } ?>
	</div>
</div>

<!-- <div class='container-maincolumn' style='font-family: Muli, sans-serif;'>
	<div id='reusableTableDiv'></div>
</div> -->

<script>
//var productobjectsid = '<?php /*echo $maincolumnid*/ ?>'; 
var articlesarray = <?php echo json_encode($maincolumnarray) ?>;
var scrolledtobottom = false;
var track_page=0;
var inputarray = <?php echo json_encode($maincolumnarray) ?>;
var cellsinrow = 2;

var track_page = 1; //track user scroll as page number, right now page number is 1
var loading  = false; //prevents multiple loads
var scrolledtobottom = false;

var lastindex = inputarray.length-1;
var lastcelldict = inputarray[lastindex];
var lastid = lastcelldict['id'];  

var firstposts = <?php echo json_encode($maincolumnarray) ?>;
// if(device=='mobile'){
// 	populatemaintable(firstposts,adsetdict);
// }else{
	populatemaintable(firstposts,firstposts.length);
// }
setupinfinitescroll('<?php echo $infinitescrollpath ?>');

function populatemaintable(inputarray,difference,cellsinrow){
	
	// var cellarray = new Array();
	// 		articlesarray = inputarray;
			
	// 		var myTableDiv = document.getElementById("reusableTableDiv")
	// 	    	var table = document.createElement('TABLE')
	// 	    	var tableBody = document.createElement('TBODY');
	// 	    	tableBody.id = 'reusableTableBody';
			
	// 		table.id = 'reusableTable';
	// 		table.style.borderSpacing = "20px";
			
	// 	    	table.appendChild(tableBody);
	// 	    	myTableDiv.appendChild(table);
		    	
	// 	    	//for(i=0;i<inputarray.length;i++){
	// 		for(i=inputarray.length-difference;i<inputarray.length;i++){
	// 			var celldiv = document.createElement('div');
	// 			celldiv.id = 'celldiv_'.concat(i);
	// 			var celltype = 1;
	// 			var theindex = i;
	// 			inputdict = inputarray[i];
	// 			Javascript:setupTableCell(celltype,inputdict,theindex,celldiv);
	// 			cellarray.push(celldiv);
	// 		}
	// 		if(cellsinrow==null){ var cellsinrow=2;}
	// 		Javascript:addDefaultTable(cellarray, cellsinrow );
			
	// 		for( i=0;i<inputarray.length;i++ ){
			
	// 				var inputdict = inputarray[i];
	// 				var type = inputdict['type'];
	// 				var path = inputdict['imagepath'];
	// 				var div = document.getElementById('celltopdiv_'.concat(i));
					
	// 				updateifvideo(type, path, div);
	// 		}
	// 		$('.reusableCell1').click(function(){
	// 		//alert(this.id);
	// 			articleclicked(this,articlesarray);
	// 		});
			
}

function addDefaultTable(cellarray, cellsinrow ) {

	var myTableDiv = document.getElementById("reusableTableDiv")
    	/*var table = document.createElement('TABLE')
    	var tableBody = document.createElement('TBODY')
	
	table.id = 'reusableTable';
	table.style.borderSpacing = "20px";
	
    	table.appendChild(tableBody);*/
    	var table = document.getElementById('reusableTable');
    	var tableBody = document.getElementById('reusableTableBody');
    	
    	
    //TABLE ROWS
    
    var anumber = 1;
    
    //alert(cellarray.length);
    
    for (a = 0; a < cellarray.length; a++) {
    //for (i = 0; i < 5; i++) {
        var tr = document.createElement('TR');
        
        	var td = document.createElement('TD');
        	
        	
        	for(b = 0; b < cellsinrow; b++){
        		
        		if( b != 0 ){
        			a = a+1;
        		}
        		
        		//var celldivid = "celldiv_".concat(a);
        		
        		var thiscell = cellarray[a];
        		thiscell.className = 'reusablecelldiv';
        		
        		//thiscell.id = "reusablecellindex_".concat(a);
        		
        		if( (a) >= (cellarray.length - 1) ){
        			
        			b = cellsinrow.length;
        			
        		}
        		
        		td.appendChild(thiscell);
        		//alert();
        		
        		/*var test = document.createElement('div');
        		test.id = 'testcell';
        		test.style.backgroundColor = "red";
        		
        		if( (a+1) > cellarray.length ){
        			
        			b = cellsinrow.length;
        			
        		}
        		
        		
        		td.appendChild(test);*/
        		
        	}
        	
        	
        	
        	tr.appendChild(td);
  		
  	
  	
  	//}
        
        tableBody.appendChild(tr);
    }  
    //myTableDiv.appendChild(table);
    
}

function setupTableCell(celltype, inputdict, theindex, thisdiv) {
	
	if(celltype == 1){
		//just an button with text and background image
		
		//alert(thisdiv);
		
		var mediatype = inputdict['type'];
		
		var buttonwidth = 350;
		var buttonheight = 350;
		if(mediatype != 'youtube'){
		
		var backgroundimg = inputdict['featured_imagepath'];
		backgroundimg = backgroundimg.replace("https://theanywherecard.com/entrenash/media/uploads/", "https://theanywherecard.com/entrenash/media/uploads/thumbs2/");
		var buttontitle = inputdict['title'];
		
		
		//var categorytext = inputdict['category'];
		
		var prehref = '';
		if(mediatype != 'podcast'){
			prehref = '/post?p=';
		}else{
			prehref = '/brand-forward?p=';
		}
		var thehref = prehref.concat(inputdict['id']);
		
		//alert(thehref);
		
		//var thelink = document.createElement('a');
		//thelink.href = thehref;
		
		var thebutton = document.createElement('div');
		thebutton.className = 'reusableCell1';
		thebutton.id = "reusablecellbutton_".concat(theindex);
		var backgroundimagestring = "url(".concat(backgroundimg);
		var backgroundimagestring2 = backgroundimagestring.concat(")");
		//thebutton.style.backgroundImage = backgroundimagestring2;
		thebutton.style.width = buttonwidth;
		//thebutton.style.height = buttonheight;
		thebutton.style.padding = 0;
		var buttontextnode = document.createTextNode(buttontitle);
		//var categorytextnode = document.createTextNode(categorytext);
		//thebutton.appendChild(buttontextnode);
		
		var topdiv = document.createElement('div');
		topdiv.className = 'celltopdiv';
		topdiv.id = 'celltopdiv_'.concat(theindex);
		topdiv.style.backgroundImage = backgroundimagestring2;
		topdiv.style.width = buttonwidth;
		$(topdiv).css({'background-repeat': 'no-repeat', 'background-size': 'cover'});
		topdiv.style.height = 225;
		thebutton.appendChild(topdiv);
		
		var bottomdiv = document.createElement('div');
		bottomdiv.className = 'cellbottomdiv';
		bottomdiv.style.width = buttonwidth;
		//bottomdiv.style.height = 125;
		//bottomdiv.style.backgroundColor = 'red';
		thebutton.appendChild(bottomdiv);
		
		var categorycontainer = document.createElement('div');
		categorycontainer.className = 'categorycontainer';
		bottomdiv.appendChild(categorycontainer);
		$(categorycontainer).text(inputdict['category']);
		
		var titlecontainer = document.createElement('div');
		titlecontainer.className = 'titlecontainer';
		bottomdiv.appendChild(titlecontainer);
		titlecontainer.appendChild(buttontextnode);
		
		if( inputdict['description'] == null || inputdict['description'] == "" ){
			
		}else{
			var desccontainer = document.createElement('div');
			desccontainer.className = 'desccontainer';
			bottomdiv.appendChild(desccontainer);
			$(desccontainer).text(inputdict['description']);
		}
		
		var datecontainer = document.createElement('div');
		datecontainer.className = 'datecontainer';
		bottomdiv.appendChild(datecontainer);
		
		if(inputdict['formatted_date'] == null || inputdict['formatted_date']==""){
			$(datecontainer).text(inputdict['price']);
			$(datecontainer).css({'font-weight': '500', 'font-size': '0.5em', 'color': '#333333'});
		}else{
			$(datecontainer).text(inputdict['formatted_date']);
		}
		
		if(inputdict['can_buy']=='1'){
			//make this optional later
			var buybutton = document.createElement('button');
			$(buybutton).text("Buy");
			buybutton.className = 'buybutton';
			$(buybutton).css({'position': 'absolute', 'display': 'inline-block', 'bottom': '10px', 'right': '15px', 'background-color': '#20B7C9', 'border': '0', 'border-radius': '3px', 'color': 'white', 'width': '35px', 'height': '18px', 'font-size': '0.4em', 'font-weight': '500', 'cursor': 'pointer'});
			bottomdiv.appendChild(buybutton);
		}
		
			thisdiv.appendChild(thebutton);
		}else{
			//for youtube videos
			var thiscontainer = document.createElement('div');
			$(thiscontainer).css({'position': 'relative', 'display': 'inline-block', 'width': buttonwidth, 'height': buttonheight });
			thisdiv.appendChild(thiscontainer);
			
			var youtubehref = inputdict['imagepath'];
			var n = youtubehref.lastIndexOf('?v=');
			var startpoint = youtubehref.indexOf('?v=') + 3;
			var endpoint = youtubehref.indexOf('&', startpoint);
			var result;
			
			if(endpoint == '-1'){
				startpoint=youtubehref.indexOf('.be/')+4;
				endpoint=youtubehref.indexOf('?list=',startpoint);
			}
			
			if(endpoint != '-1'){
				result = youtubehref.substring(startpoint, endpoint);
			}else{
				result = youtubehref.substring(n + 3);
			}
			youtubehref = "https://www.youtube.com/embed/"+result+"?controls=0";
			
			var thevideo = '<iframe width='+buttonwidth+' height='+buttonheight+' src='+youtubehref+'></iframe>';
			var theframe = document.createElement('div');
			theframe.className = 'youtubediv';
			$(theframe).css({'position': 'relative', 'display': 'inline-block', 'width': buttonwidth, 'height': buttonheight, 'margin': '0', 'padding': '0'});
			theframe.innerHTML = thevideo;
			thiscontainer.appendChild(theframe);
			
			var youtubelink = document.createElement('button');
			youtubelink.className = 'youtubelink';
			youtubelink.id = theindex;
			thiscontainer.appendChild(youtubelink);
			
		}
		
		
		//bottomdiv.appendChild(buttontextnode);
		//thelink.appendChild(thebutton);
		
		thisdiv.style.display = "inline-block";
		thisdiv.style.position = "relative";
		//thisdiv.appendChild(thelink);
		
		$(thebutton).css({'cursor': 'default'});
		
		return thisdiv;
		
	}else if(celltype == 2){
		//image on left; title to the right of img; desc under title; time on far right; entirety is a link.
		
	}
	
}

function setupinfinitescroll(actionpath){

	window.onscroll = function(ev) {
		if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight-100) {
				
			if(scrolledtobottom == false){
			
            		scrolledtobottom = true;
            		
    			track_page++; //page number increment
    
    			//var lastindex = inputarray.length-1;
    			//var lastcelldict = inputarray[lastindex];
    			// alert([JSON.stringify(articlesarray)])
    			var lastindex = articlesarray.length-1;
    			var lastcelldict = articlesarray[lastindex];
    			var lastid = lastcelldict['id']; 
        
        
        //inputarray = load_contents(lastid,inputarray,actionpath);
        inputarray = load_contents(lastid,articlesarray,actionpath);
        //alert(inputarray.length);
			}
			
			 
		}
	};
}	

function load_contents(lastid,inputarray,actionpath){
// alert(actionpath)
	//var newinputarray = inputarray;
	var newinputarray = new Array();
	for(i=0;i<inputarray.length;i++){
		newinputarray.push(inputarray[i]);
	}
	
	//alert(productobjectsid);
	
    if(loading == false){
		loading = true;  
        //$.post( actionpath, {'beforethisid': lastid, 'productobjectsid': productobjectsid}, function(data){
        $.post( actionpath, {'beforethisid': lastid}, function(data){
            
        	
        
        }).fail(function(xhr, ajaxOptions, thrownError) { 
            // alert(thrownError); 
            loading = false;
            scrolledtobottom = false;
            return null;
        }).done(function( data ) {
        	loading = false;
        	scrolledtobottom = false;
        	// alert(data);
    		var your_data = JSON.parse(data);
            //alert(JSON.stringify(your_data));
            if( your_data.length == 0 ){
            	
            	return null;
            }
            
            for(var i=0; i<your_data.length;i++){
            	
            	newinputarray.push(your_data[i]);
            	
            }
        	
        	articlesarray = newinputarray;
        	
            //alert(inputarray.length);
            //alert(newinputarray.length);
        if(newinputarray.length>20){
        	
        	if(!arraysEqual(inputarray, newinputarray)){
        	
        	var difference = newinputarray.length - inputarray.length;
        	
        	
        		inputarray = newinputarray;
	        	var cellarray = new Array();
				//alert();
				/*for(i=inputarray.length-difference;i<inputarray.length;i++){
					var celldiv = document.createElement('div');
					celldiv.id = 'celldiv_'.concat(i);
					celldiv.className = 'articlecell';
					var celltype = 1;
					var theindex = i;
					
					inputdict = inputarray[i];
					Javascript:setupTableCell(celltype,inputdict,theindex,celldiv);
					cellarray.push(celldiv);
				}
				
				Javascript:addDefaultTable(cellarray,cellsinrow);
				
				for( i=inputarray.length-difference;i<inputarray.length;i++ ){
					var inputdict = inputarray[i];
					var type = inputdict['type'];
					var path = inputdict['featured_imagepath'];
					var div = document.getElementById('celltopdiv_'.concat(i));
					
					updateifvideo(type, path, div);
				}*/
				// populatemaintable(newinputarray,difference);
				// addcell(parent, celldict)
				
				for(var i=inputarray.length-difference; i<inputarray.length; i++){
					Cell6Class.addcell($('.maincolumn1 .container')[0], inputarray[i]);
				}
				$('.reusableCell1').click(function(){
					//alert(this.id);
					articleclicked(this,articlesarray);
				});
				
				
				
		}
	}
            
            return newinputarray
  	});
    }
}

function arraysEqual(arr1, arr2) {
    if(arr1.length !== arr2.length)
        return false;
    for(var i = arr1.length; i--;) {
        if(arr1[i] !== arr2[i])
            return false;
    }

    return true;
}

$('.youtubelink').click(function(){
	var tablearray = <?php echo json_encode($maincolumnarray) ?>;
	var theid = tablearray[this.id]['id'];
	window.location = '?p='+theid;
});

</script>