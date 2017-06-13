<?php

?>

<style>

.container-sidecolumn {
	position: relative; 
	display: inline-block; 
	width: 350px; 
	float: left;
}

.side_cellleftdiv {
	
	position: relative;
	display: inline-block;
	width: 55%;
	height: 100%;
	padding: 0;
	overflow: hidden;
	margin: 0;
	
}

.side_titlecontainer {
	
	position: relative;
	display: inline-block;
	margin: 0;
	padding: 0;
	float: left;
	font-size: 0.6em;
	font-weight: 600;
	overflow: hidden;
	height: 95px;
	
}

.side_datecontainer {
	
	position: absolute;
	display: block;
	margin: 0;
	padding: 0;
	float: left;
	font-size: 0.35em;
	font-weight: 400;
	bottom: 0;
	
}

.side_cellrightdiv {
	
	position: relative;
	display: inline-block;
	width: 45%;
	height: 100%;
	padding: 0;
	overflow: hidden;
	background-size: cover;
	background-position: center 0;
	background-repeat: no-repeat;
	overflow: hidden;
	border: 0;
	border-radius: 6px;
	
}

.side_celldiv {
	
	position: relative;
	display: inline-block; 
	padding: 0;
	
}

#thelink {
	
	position: relative;
	display: inline-block; 
	width: 100%;
	padding: 0;
	
}

.side_reusableCell1 {
	
	display: inline-block;
	position: relative;
	background-size: 100% 100%;
	background-position: center;
	background-color: white;
	-webkit-appearance: none;
	border: 0;
	margin: 0;
	padding: 0;
	/*margin-left: 20px;
	margin-right: 20px;*/
	cursor: pointer;
	font-size: 1.7em;
	color: #333333;
	float: left;
	padding: 20px;
	
	width: 100%;
	height: 80px;
	
	
}

#side_TableDiv {
	
	position: relative;
	display: inline-block;
	width: 100%;
	padding: 0;
	/*min-height: 100px;
	min-width: 100px;*/
	
}

#side_reusableTable {
	
	position: relative;
	display: inline-block;
	width: 100%;
	/*height: 100%;*/
	padding: 0;
	margin: 0;
	
}

.side_reusablecelldiv {
	
	position: relative;
	display: inline-block;
	padding: 0;
	width: 100%;
	
}

.addiv {
	
	display: inline-block; 
	position: relative;
	width: 100%;
	/*height: 160px;*/
	padding: 0;
	margin: 0;
	background-position: center;
	background-size: 100% 100%;
	background-repeat: no-repeat;
	
}

.sidead-tall {height: 600px}
.sidead-short {height: 240px}
</style>

<div class='container-sidecolumn'>
	<div id='side_TableDiv'>
	</div>
</div>









<script>

	$(document).ready(function(){
		populatesidetable(<?php echo json_encode($sidecolumnarray) ?>, <?php echo json_encode($adsetdict) ?>);
	});

	function populatesidetable(inputarray,adsetdict){
		
		var sidecellarray = new Array();
				//alert(inputarray[13]);
		for(i=0;i<inputarray.length;i++){
			var sidecelldiv = document.createElement('div');
			
			sidecelldiv.className = 'side_celldiv';
			sidecelldiv.id = 'side_celldiv_'.concat(i);
			var celltype = 1;
			var theindex = i;
			inputdict = inputarray[i];
			
			Javascript:setupSideTableCell(inputdict,theindex,sidecelldiv);
			sidecellarray.push(sidecelldiv);
			
		}
				//alert();
		Javascript:addSideTable(sidecellarray,1,adsetdict);	
				
		for( i=0;i<inputarray.length;i++ ){
				
			var inputdict = inputarray[i];
			var type = inputdict['type'];
			var path = inputdict['imagepath'];
			var div = document.getElementById('side_cellrightdiv_'.concat(i));
						
			updateifvideo(type, path, div);
		}
	}
	
	function addSideTable(cellarray, cellsinrow, adsetdict ) 
{

	//every 3 or 4 will be an ad

	var myTableDiv = document.getElementById("side_TableDiv");
	myTableDiv.style.padding = "0";
	myTableDiv.style.margin = "0";
    	var table = document.createElement('TABLE');
    	table.style.padding = "0";
    	table.style.margin = "0";
    	var tableBody = document.createElement('TBODY');
	tableBody.style.padding = "0";
	tableBody.style.margin = "0";
	
	table.id = 'side_reusableTable';
	table.style.borderSpacing = "30px";
	
    	table.appendChild(tableBody);
    	
    	var multiplethree = 0;
    	var numberofads = 1;
    	var numberofsideads = 0;
    	
    var anumber = 1;
    //alert();
    for (a = 0; a < cellarray.length; a++) {
    
    
    		multiplethree = multiplethree+1;
        	
        	if( (multiplethree == 5 || a==2) && numberofads<4 ){
        		numberofads = numberofads+1;
        		numberofsideads = numberofsideads+1;
        		multiplethree = 0;
        		var trtwo = document.createElement('TR');
        		
        		var tdtwo = document.createElement('TD');
        		
        		var thelink = document.createElement('a');
        		var addiv = document.createElement('div');
        		if(numberofsideads==3){
        			addiv.className = 'addiv sidead-tall';
        			var sidetallimg = "";
        			if(adsetdict['sidetall']!=null){sidetallimg=adsetdict['sidetall']['imagepath'];}
        			$(addiv).css({'background-image': 'url('+sidetallimg+')'});
        		}else{
        		//alert(adsetdict);
        			if(numberofsideads==1){
        				$(addiv).css({'background-image': 'url('+adsetdict['sidead1']['imagepath']+')'});
        				thelink.href = adsetdict['sidead1']['link_path'];
        			}else{
        				//addiv.style.backgroundImage = 'url()';
        				$(addiv).css({'background-image': 'url('+adsetdict['sidead2']['imagepath']+')'});
        				thelink.href = adsetdict['sidead2']['link_path'];
        			}
        			
        			addiv.className = 'addiv sidead-short';
        		}
        		
        		//addiv.style.backgroundImage = 'url(https://theanywherecard.com/entrenash/media/images/your-ad-goes-here.jpg)';
        		thelink.appendChild(addiv);
        		tdtwo.appendChild(thelink);
        		trtwo.appendChild(tdtwo);
        		tableBody.appendChild(trtwo);
        		//alert();
        	}
    
    
    
    
    	var tr = document.createElement('TR');
        
        	var td = document.createElement('TD');
        	
        	
        	for(b = 0; b < cellsinrow; b++){
        		
        		if( b != 0 ){
        			a = a+1;
        		}
        		        		
        		var thiscell = cellarray[a];
        		thiscell.className = 'side_reusablecelldiv';
        		
        		
        		if( (a) >= (cellarray.length - 1) ){
        			
        			b = cellsinrow.length;
        			
        			
        		}
        		
        		td.appendChild(thiscell);
        		
        	}
        	
        	
        	
        	tr.appendChild(td);
        	
  		
  	        
        tableBody.appendChild(tr);
    }  
    myTableDiv.appendChild(table);
    
}

function setupSideTableCell(inputdict, theindex, thisdiv) 
{
	
	var mediatype = inputdict['type'];
	
	var backgroundimg = inputdict['featured_imagepath'];
	backgroundimg = backgroundimg.replace("https://theanywherecard.com/entrenash/media/uploads/", "https://theanywherecard.com/entrenash/media/uploads/thumbs2/");
	var buttontitle = inputdict['title'];
	var datetext = inputdict['formatted_date'];
	var buttonwidth = 250;
	var buttonheight = 200;
	var prehref = '';
		if(mediatype != 'podcast'){
			prehref = '/post?p=';
		}else{
			prehref = '/brand-forward?p=';
		}
	var thehref = prehref.concat(inputdict['id']);
	
	var thelink = document.createElement('a');
	thelink.id = 'thelink;'
	var urltitle = inputdict['title'].replace(/\s/g, '');
	thelink.href = thehref+'&'+urltitle;
	
	var thebutton = document.createElement('div');
	thebutton.className = 'side_reusableCell1';
	thebutton.id = "side_reusablecellbutton_".concat(i);
	var backgroundimagestring = "url(".concat(backgroundimg);
	var backgroundimagestring2 = backgroundimagestring.concat(")");
	thebutton.style.padding = 0;
	var buttontextnode = document.createTextNode(buttontitle);
	
	var leftdiv = document.createElement('div');
	leftdiv.className = 'side_cellleftdiv';
	thebutton.appendChild(leftdiv);
	
	var rightdiv = document.createElement('div');
	rightdiv.className = 'side_cellrightdiv';
	rightdiv.id = 'side_celltopdiv_'.concat(theindex);
	rightdiv.style.backgroundImage = backgroundimagestring2;
	thebutton.appendChild(rightdiv);
	
	
	
	var titlecontainer = document.createElement('div');
	titlecontainer.className = 'side_titlecontainer';
	leftdiv.appendChild(titlecontainer);
	
	titlecontainer.appendChild(buttontextnode);
	$(titlecontainer).css({'height': '57px'});
	
	var datetextnode = document.createTextNode(datetext);
	var datecontainer = document.createElement('div');
	datecontainer.className = 'side_datecontainer';
	leftdiv.appendChild(datecontainer);
	datecontainer.appendChild(datetextnode);
	
	thelink.appendChild(thebutton);
	
	thisdiv.style.display = "inline-block";
	thisdiv.style.position = "relative";
	thisdiv.appendChild(thelink);
	
	return thebutton;
	
}
	
</script>