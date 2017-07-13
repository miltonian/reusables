<?php

namespace Reusables;

?>


<style>
.celltopdiv {
	
	position: relative;
	display: inline-block;
	margin: 0; 
	padding: 0;
	background-position: center;
	background-size: 100% auto;
	float: left;
	margin-top: 0;
	
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

.reusableCell1 {
	
	display: inline-block;
	position: relative;
	
}
</style>


<div class='sidetable' style='position: relative; display: inline-block; float: left; margin: 0; padding: 0;  width: 350px; overflow: hidden;'>
	<div id='reusableTableDiv'>
	</div>
</div>




<script>
var inputarray = <?php echo json_encode($sidecolumnarray) ?>;
var cellsinrow = 1;

<?php if($device != "mobile"){ ?>
			
var height = $('.firstmaincontent').height();
var outerheight = $('.firstmaincontent').outerHeight();

var sidetableheight = 0;
//$('.sidetable').height(height);

var cellarray = new Array();

for(i=0;i<inputarray.length;i++){
	var celldiv = document.createElement('div');
	celldiv.id = 'celldiv_'.concat(i);
	var celltype = 1;
	var theindex = i;
	inputdict = inputarray[i];
	Javascript:setupSideCell2(celltype,inputdict,theindex,celldiv);
	cellarray.push(celldiv);
	sidetableheight = sidetableheight+300;
	if(sidetableheight+300 >= outerheight){
		i=inputarray.length;
	}
}

Javascript:addSideTable2(cellarray, cellsinrow );

for( i=0;i<inputarray.length;i++ ){

		var inputdict = inputarray[i];
		var type = inputdict['type'];
		var path = inputdict['imagepath'];
		var div = document.getElementById('celltopdiv_'.concat(i));
		// updateifvideo(type, path, div);
		
}
<?php }else{ ?>

	var width = $('#featuredpostimg').width();
	var height = $('#featuredpostimg').height();
	var scalefactor = width / height;
	width = $(window).width();
	height = width * scalefactor;
	$('#featuredpostimg').width(width);
	$('#featuredpostimg').css('height', 'auto');
	$('.featuredpostimgcontainer').css('text-align','center');

<?php } ?>

window.onscroll = function(ev) {
$('.dropdown-content').css('display','none');
$('.dropdown').css('background-color', 'white');
	if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight-100) {
    
		var lastindex = inputarray.length-1;
		var lastcelldict = inputarray[lastindex];
		var lastid = lastcelldict['id']; 

		inputarray = load_contents(lastid,inputarray);
		
	}
};

function addSideTable2(cellarray, cellsinrow ) {

	var myTableDiv = document.getElementById("reusableTableDiv")
    	var table = document.createElement('TABLE')
    	var tableBody = document.createElement('TBODY')
	
	table.id = 'reusableTable';
	table.style.borderSpacing = "20px";
	
    	table.appendChild(tableBody);
    	
    	
    	
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
  			
  			//for the 300x600 ad
        	if(a==2){
        		$(tr).css({'margin-top': '-25px', 'display': 'block'});
        	}
  	
  	
  	//}
        
        tableBody.appendChild(tr);
    }  
    myTableDiv.appendChild(table);
    
}

function setupSideCell2(celltype, inputdict, theindex, thisdiv) {

	if(celltype == 1){
		
		//just an button with text and background image
		if( theindex==2 ){
			//http://entrenash.co/media/images/EmailAd_300x600.jpg
			var talladbutton = document.createElement('img');
			talladbutton.id = 'subscribe-button';
			$(talladbutton).css({'position': 'relative', 'display': 'inline-block', 'height': '600px', 'width': '300px', 'cursor': 'pointer'});
			$(talladbutton).attr({'src': 'http://entrenash.co/media/images/EmailAd_300x600.jpg'});
			thisdiv.appendChild(talladbutton);
			$(thisdiv).css({'width': '100%', 'text-align': 'center'});
		}else if( theindex==5 ){
			var adarray = [['http://entrenash.co/media/images/Facebook_300x250.jpg','https://www.facebook.com/entrenash/'], ['http://entrenash.co/media/images/Instagram_300x250.jpg','https://www.instagram.com/entrenash/']];
			adarray.sort(function() { return 0.5 - Math.random() });
			var thisad = adarray[0][0];
			var thislink = adarray[0][1];
			var linkobj = document.createElement('a');
			$(linkobj).attr({'target': '_blank'});
			linkobj.href = thislink;
			var adobj = document.createElement('img');
			$(adobj).css({'position': 'relative', 'display': 'inline-block', 'width': '300px', 'height': '250px', 'cursor': 'pointer'});
			$(adobj).attr({'src': thisad})
			$(thisdiv).css({'width': '100%', 'text-align': 'center'});
			thisdiv.appendChild(linkobj);
			linkobj.appendChild(adobj);
			
		}else{
		var backgroundimg = inputdict['featured_imagepath'];
		console.log(backgroundimg);
		var buttontitle = inputdict['title'];
		var prehref = '/post?p=';
		var thehref = prehref.concat(inputdict['id']);
		var buttonwidth = 300;
		var buttonheight = 300;
		
		
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
		//thebutton.appendChild(buttontextnode);
		
		var topdiv = document.createElement('div');
		topdiv.className = 'celltopdiv';
		topdiv.style.backgroundImage = backgroundimagestring2;
		topdiv.style.width = buttonwidth;
		/*topdiv.style.height = 225;*/
		$(topdiv).css({'padding-bottom': '50%'});
		thebutton.appendChild(topdiv);
		$(topdiv).css({'border-radius': '6px', 'overflow': 'hidden'});
		
		var bottomdiv = document.createElement('div');
		bottomdiv.className = 'cellbottomdiv';
		bottomdiv.style.width = buttonwidth;
		//bottomdiv.style.height = 125;
		//bottomdiv.style.backgroundColor = 'red';
		thebutton.appendChild(bottomdiv);
		
		var titlecontainer = document.createElement('div');
		titlecontainer.className = 'titlecontainer';
		bottomdiv.appendChild(titlecontainer);
		titlecontainer.appendChild(buttontextnode);
		
		//bottomdiv.appendChild(buttontextnode);
		
		thelink.appendChild(thebutton);
		thisdiv.appendChild(thelink);
		
		}
		
		thisdiv.style.display = "inline-block";
		thisdiv.style.position = "relative";
		
		
		return thisdiv;
		
	}else if(celltype == 2){
		//image on left; title to the right of img; desc under title; time on far right; entirety is a link.
		
	}
	
}

</script>