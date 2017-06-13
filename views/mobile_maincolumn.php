<style>


.container-maincolumn {
	
	position: relative; 
	display: inline-block; 
	width: 100%; 
	padding: 0;
	margin: 0;
	background-color: #EDF0F0;
	
}

.celltopdiv {
	
	position: relative;
	display: inline-block;
	margin: 0; 
	padding: 0;
	background-position: center;
	background-size: cover;
	background-repeat: no-repeat;
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
	font-size: 3em;
	font-weight: 500;
	color: #333333;
	margin-top: 20px;
	margin-bottom: 20px; 
	
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


#reusableTableDiv_test {
	
	position: relative; 
	display: inline-block;
	padding: 0;
	margin: 0;
	width: 100%;
	
}

#reusableTable_test {
	
	position: relative; 
	display: inline-block;
	padding: 0;
	margin: 0;
	width: 105%;
	margin-left: -5%;
	
}

.reusablecelldiv {
	
	position: relative; 
	display: inline-block;
	padding: 0;
	margin: 0;
	width: 100%;
	
}

#tr {
	
	margin: 0;
	padding: 0;
	width: 100%;
	left: 0;
}

#td {
	
	
	margin: 0;
	padding: 0;
	left: 0;
	
}

.addiv {
	
	display: inline-block; 
	position: relative;
	width: 100%;
	padding: 0;
	margin: 0;
	background-position: center;
	background-size: 100% 100%;
	background-repeat: no-repeat;
	
}

.sidesmall {
	padding-bottom: 65%;
}

.sidetall {
	padding-bottom: 175%;
}

.youtubediv {
	/*pointer-events: none;*/
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

</style>

<div class='container-maincolumn' style='display: inline-block; min-width: 100%; max-width: 100%; width: 100%; margin: 0; padding: 0;'>
	<div id='reusableTableDiv_test' style='display: inline-block; min-width: 100%; max-width: 100%; width: 100%; margin: 0; padding: 0;'></div>
</div>

<?php

?>

<script>

function populatemaintable(inputarray, adsetdict){
//alert();
	var cellarray = new Array();
			
			for(i=0;i<inputarray.length;i++){
				var celldiv = document.createElement('div');
				celldiv.id = 'celldiv_'.concat(i);
				//celldiv.className = 'mobilemaincell';
				//$(celldiv).css('width', '1000px');
				var celltype = 1;
				var theindex = i;
				inputdict = inputarray[i];
				Javascript:setupTableCell(celltype,inputdict,theindex,celldiv);
				cellarray.push(celldiv);
			}
			
			Javascript:addDefaultTable(cellarray, cellsinrow, adsetdict );
			
			/*for( i=0;i<inputarray.length;i++ ){
			
					var inputdict = inputarray[i];
					var type = inputdict['type'];
					var path = inputdict['imagepath'];
					var div = document.getElementById('celltopdiv_'.concat(i));
					
					//updateifvideo(type, path, div);
			}*/
			
			
			
}

function addDefaultTable(cellarray, cellsinrow, adsetdict ) {

	cellsinrow = 1;

	var myTableDiv = document.getElementById("reusableTableDiv_test")
    	var table = document.createElement('TABLE')
    	var tableBody = document.createElement('TBODY')
    	
    	//$('#reusableTableDiv').css({'max-width': '1000px', 'min-width': '1000px', 'width': '1000px'});
	
	table.id = 'reusableTable_test';
	$(table).css({'min-width': '100%', 'max-width': '100%', 'width': '100%', 'margin': '0', 'padding': '0'});
	$(tableBody).css({'min-width': '100%', 'max-width': '100%', 'width': '100%', 'margin': '0', 'padding': '0'});
	//$(table).css({'background-color':'gray'});
	
	
	table.appendChild(tableBody);
    	
    	var multiplethree = 0;
    	var numberofads = 0;
    //TABLE ROWS
    
    var anumber = 1;
    
    //alert(cellarray.length);
    
    for (a = 0; a < cellarray.length; a++) {
    //for (i = 0; i < 5; i++) {
    
    multiplethree = multiplethree+1;
    
    if( (multiplethree == 8 || a==2) && numberofads<3 && adsetdict != null){
    	numberofads = numberofads+1;
        multiplethree = 0;
        var trtwo = document.createElement('TR');
        		
        var tdtwo = document.createElement('TD');
        
        var thelink = document.createElement('a');
        var addiv = document.createElement('div');
        if(numberofads==1){
        	addiv.className = 'addiv sidesmall'; addiv.style.backgroundImage = 'url('+adsetdict['sidead1']['imagepath']+')';
        	thelink.href = adsetdict['sidead1']['link_path'];
        }
        else if(numberofads==2){
        	addiv.className = 'addiv sidesmall'; addiv.style.backgroundImage = 'url('+adsetdict['sidead2']['imagepath']+')';
        	thelink.href = adsetdict['sidead2']['link_path'];
        }
        else if(numberofads==3){
        	addiv.className = 'addiv sidetall'; addiv.style.backgroundImage = 'url('+adsetdict['sidetall']['imagepath']+')';
        }
        thelink.appendChild(addiv);
        tdtwo.appendChild(thelink);
        		
        //tdtwo.appendChild(addiv);
        trtwo.appendChild(tdtwo);
        tableBody.appendChild(trtwo);
        
        $(addiv).css({'min-width': '100%', 'max-width': '100%', 'width': '100%', 'margin': '0', 'margin-left': '2%', 'margin-bottom': '180px'});
        $(thelink).css({'min-width': '100%', 'max-width': '100%', 'width': '100%', 'padding': '0', 'margin': '0'});
        $(tdtwo).css({'min-width': '100%', 'max-width': '100%', 'width': '100%', 'padding': '0', 'margin': '0'});
        $(trtwo).css({'min-width': '100%', 'max-width': '100%', 'width': '100%', 'padding': '0', 'margin': '0'});
        $(tableBody).css({'min-width': '100%', 'max-width': '100%', 'width': '100%', 'padding': '0', 'margin': '0'});
        
    }
    
        var tr = document.createElement('TR');
        tr.style.padding = 0;
     	tr.id = 'tr';
     	
     	$(tr).css({'min-width': '100%', 'max-width': '100%', 'width': '100%', 'padding': '0', 'margin': '0'});
        
        
        	var td = document.createElement('TD');
        	td.style.padding = '0';
        	td.style.margin = '0';
        	td.id = 'td';
        	$(td).css({'min-width': '100%', 'max-width': '100%', 'width': '100%', 'padding': '0', 'margin': '0'});
        	
        	for(b = 0; b < cellsinrow; b++){
        		
        		if( b != 0 ){
        			a = a+1;
        		}
        		
        		//var celldivid = "celldiv_".concat(a);
        		
        		var thiscell = cellarray[a];
        		thiscell.className = 'reusablecelldiv';
        		$(thiscell).css({'min-width': '100%', 'max-width': '100%', 'width': '100%', 'padding': '0', 'margin': '0'});
        		
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
        tableBody.style.padding = '0';
        tableBody.style.margin = '0';
    }  
    myTableDiv.appendChild(table);
    myTableDiv.style.padding = '0';
    myTableDiv.style.margin = '0';
    
    
    
   //alert($('#reusableTableDiv').width());
}

function setupTableCell(celltype, inputdict, theindex, thisdiv) {
	
	if(celltype == 1){
		//just an button with text and background image
		
		//alert(thisdiv);
		
		var width = $(window).width();
		$(thisdiv).width(width);
		var imgheight = width * 0.56;
		$(thisdiv).height(width);
		
		var mediatype = inputdict['type'];
		var buttonwidth = '100%';
		
		if(mediatype != 'youtube'){
		
		var backgroundimg = inputdict['featured_imagepath'];
		var buttontitle = inputdict['title'];
		var datetext = inputdict['formatted_date'];
		var categorytext = inputdict['category'];
		//var buttonheight = 550;
		var prehref = '';
		if(mediatype != 'podcast'){
			prehref = '/post?p=';
		}else{
			prehref = '/brand-forward?p=';
		}
		var thehref = prehref.concat(inputdict['id']);
		
		//alert(thehref);
		
		var thelink = document.createElement('a');
		var urltitle = inputdict['title'].replace(/\s/g, '');
		thelink.href = thehref+'&'+urltitle;
		
		var thebutton = document.createElement('div');
		thebutton.className = 'reusableCell1';
		thebutton.id = "reusablecellbutton_".concat(i);
		var backgroundimagestring = "url(".concat(backgroundimg);
		var backgroundimagestring2 = backgroundimagestring.concat(")");
		//thebutton.style.backgroundImage = backgroundimagestring2;
		thebutton.style.width = buttonwidth;
		//thebutton.style.height = buttonheight;
		thebutton.style.padding = 0;
		var buttontextnode = document.createTextNode(buttontitle);
		var datetextnode = document.createTextNode(datetext);
		var categorytextnode = document.createTextNode(categorytext);
		//thebutton.appendChild(buttontextnode); 
		
		var topdiv = document.createElement('div');
		topdiv.className = 'celltopdiv';
		topdiv.id = 'celltopdiv_'.concat(theindex);
		topdiv.style.backgroundImage = backgroundimagestring2;
		topdiv.style.width = buttonwidth;
		//topdiv.style.height = 900;
		topdiv.style.height = imgheight;
		thebutton.appendChild(topdiv);
		
		var bottomdiv = document.createElement('div');
		bottomdiv.className = 'cellbottomdiv';
		bottomdiv.style.width = buttonwidth;
		bottomdiv.style.height = 250;
		$(bottomdiv).css({'overflow': 'hidden'});
		//bottomdiv.style.backgroundColor = 'red';
		thebutton.appendChild(bottomdiv);
		
		var categorycontainer = document.createElement('div');
		categorycontainer.className = 'categorycontainer';
		bottomdiv.appendChild(categorycontainer);
		categorycontainer.appendChild(categorytextnode);
		
		var titlecontainer = document.createElement('div');
		titlecontainer.className = 'titlecontainer';
		$(titlecontainer).css({'font-size': '2em'});
		bottomdiv.appendChild(titlecontainer);
		titlecontainer.appendChild(buttontextnode);
		
		var datecontainer = document.createElement('div');
		datecontainer.className = 'datecontainer';
		bottomdiv.appendChild(datecontainer);
		datecontainer.appendChild(datetextnode);
		
		
		//bottomdiv.appendChild(buttontextnode);
		
		
		thelink.appendChild(thebutton);
		thisdiv.appendChild(thelink);
		
		}else{
			//for youtube videos
			var thiscontainer = document.createElement('div');
			$(thiscontainer).css({'position': 'relative', 'display': 'inline-block', 'width': buttonwidth, 'height': imgheight });
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
			//var n = youtubehref.lastIndexOf('?v=');
			//var result = youtubehref.substring(n + 3);
			//youtubehref = "https://www.youtube.com/embed/"+result+"?controls=1";
			
			var thevideo = '<iframe width='+buttonwidth+' height='+imgheight+' src='+youtubehref+'></iframe>';
			
			var theframe = document.createElement('div');
			theframe.className = 'youtubediv';
			$(theframe).css({'position': 'relative', 'display': 'inline-block', 'width': buttonwidth, 'height': imgheight, 'margin': '0', 'padding': '0'});
			
			theframe.innerHTML = thevideo;
			thiscontainer.appendChild(theframe);
			
			
			
			
		}
		
		thisdiv.style.display = "inline-block";
		thisdiv.style.position = "relative";
		
		
		return thebutton;
		
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
		        
		        			var lastindex = inputarray.length-1;
		        			var lastcelldict = inputarray[lastindex];
		        			var lastid = lastcelldict['id']; 
		            
		            //alert(inputarray.length);
		            inputarray = load_contents(lastid,inputarray,actionpath);
		            //alert(inputarray.length);
	        			}
	        			 
	        		}
			}; 
}	

function load_contents(lastid,inputarray,actionpath){
	
	//var newinputarray = inputarray;
	var newinputarray = new Array();
	for(i=0;i<inputarray.length;i++){
		newinputarray.push(inputarray[i]);
	}
	
	//alert(lastid);
	
    if(loading == false){
	loading = true;  
        $.post( actionpath, {'beforethisid': lastid}, function(data){
            
        	
        
        }).fail(function(xhr, ajaxOptions, thrownError) { 
            alert(thrownError); 
            loading = false;
            scrolledtobottom = false;
            return null;
        }).done(function( data ) {
        	
        	loading = false;
        	scrolledtobottom = false;
        	
    		var your_data = JSON.parse(data);
            
            if( your_data.length == 0 ){
            	
            	return null;
            }
            
            for(var i=0; i<your_data.length;i++){
            	
            	newinputarray.push(your_data[i]);
            	
            }
        	
        	
        	
            //alert(inputarray.length);
            //alert(newinputarray.length);
        if(newinputarray.length>20){
        	
        	if(!arraysEqual(inputarray, newinputarray)){
        	
        	var difference = newinputarray.length - inputarray.length;
        	
        	
        		inputarray = newinputarray;
	        	var cellarray = new Array();
				//alert();
				for(i=inputarray.length-difference;i<inputarray.length;i++){
					var celldiv = document.createElement('div');
					celldiv.id = 'celldiv_'.concat(i);
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
				}
				
				
		}
	}
            
            return newinputarray
  	});
    }
}

function fixweirdlynarrowrowsonsomepages(){
//alert($('.mobilemaincell'));
	$('.mobilemaincell').css({'width': '1000px', 'background-color': 'red'});
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

</script>