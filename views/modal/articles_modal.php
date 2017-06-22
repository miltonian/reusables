<?php
	/* $allarticlesarray, $publishedarray, $unpublishedarray */
	if(!isset($publishedarray)){ $publishedarray = array(); }
	if(!isset($unpublishedarray)){ $unpublishedarray = array(); }

?>

<style>

.article_cellbutton {
	
	display: block;
	position: absolute; 
	margin: 0;
	padding: 0;
	width: 100%;
	height: 100%;
	-webkit-appearance: none;
	background-color: white;
	border: 0;
	cursor: pointer;
	
}
.article_cellbutton:hover { background-color: rgba(230,230,240,1); }
.articlename {
	position: relative; 
	display: inline-block;
	margin: 0;
	padding: 0;
	height: 1em;
	top: 50%;
	margin-top: -0.6em;
	font-size: 1.2em;
	font-weight: 400;
	color: #333333;
	float: left;
	margin-left: 20px;
	width: 300px;
	height: 20px;
	overflow: hidden;
}
#articlename { cursor: pointer; }

#articlename:hover { background-color: rgba(240,240,250,1); }

.articlesubtitle {
	position: relative; 
	display: inline-block;
	margin: 0;
	padding: 0;
	height: 1em;
	font-size: 0.5em;
	font-weight: 400;
	color: #777777;
	float: left;
	margin-left: 20px;
	width: 300px;
	height: 20px;
	margin-top: 50px;
}
.articledate {
	position: absolute; 
	display: inline-block;
	margin: 0;
	padding: 0;
	height: 1em;
	font-size: 0.4em;
	font-weight: 400;
	color: #777777;
	float: right;
	width: 50px;
	height: 20px;
	margin-top: 10px;
	right: 10px;
}
.article_bottomdivider {
	position: absolute;
	display: block;
	width: 100%;
	float: left;
	bottom: 0;
	left: 0;
	height: 1px;
	background-color: #b4b4b4;
	border: 0;
}
.articleimg { 
	display: inline-block; 
	position: relative; 
	border: 0;
	background-color: gray;
	margin: 0;
	padding: 0;
	width: 60px;
	height: 60px;
	top: 50%; 
	margin-top: -30px;
	float: left;
	background-size: cover;
	background-repeat: no-repeat;
	background-position: center;
}
.deletepostbutton {
	display: inline-block; 
	position: relative; 
	border: 0;
	color: red;
	margin: 0;
	padding: 0;
	width: 80px;
	height: 1em;
	font-size: 1.1em;
	font-weight: 500;
	margin-top: 35px;
	float: right;
	cursor: pointer;
}
.reusabletopbarbuttons{ color: #333333; }
</style>

<div class='backgroundoverlay articlesbackground' style='z-index: 5;'>
	<div class='articlespopview' style='display: none; position: absolute; background-color: white; border: 0;  border-radius: 10px; width: 600px; height: 400px; top: 50%; margin-top: -200px; left: 50%; margin-left: -300px;'>
		<button class='closebutton'></button>
		<p class='reusablepoptitle' style='margin-bottom: 0px; padding: 0;'>Select Article</p>
		<div style='width: 100%; text-align: center; height: 40px; margin: 0; padding: 0; margin-top: 10px;'>
			<div style='display: inline-block; position: relative; margin: 0; padding: 0; color: #333333;'>
				<button id='unpublished-btn' class='reusabletopbarbuttons' style="color: #333333;">Unpublished</button>
				<button id='published-btn' class='reusabletopbarbuttons' style="color: #333333;">Published</button>
			</div>
		</div>
		
		<div style='display: inline-block; position: relative; margin: 0; padding: 0; width: 90%; height: 300px; margin-top: -10px; overflow-y: scroll; overflow-x: hidden;'>
			<div id='article_reusableTableDiv' style='margin: 0; padding: 0;'>
						
			</div>
		</div>
					
	</div>
</div>

<script>

var allarticlesarray = [];
var publishedarray = <?php echo json_encode($publishedarray) ?>;
var unpublishedarray = <?php echo json_encode($unpublishedarray) ?>;

var currentarray;

var thisurl = "";

	class ArticlesModal1 {
		articleclicked(obj){
			var articlesdict = currentarray[obj.id];;
			
			var theid = articlesdict['id'];
			// alert("obj class: "+$(obj).attr('class'));
			// alert("selectedfeatured: "+JSON.stringify(window.selectedfeatured));
			
			var theclasses = window.selectedfeatured.split(" ");
			var featuredsectionid="-1";
			for(var i=0;i<theclasses.length;i++){
				if( theclasses[i].startsWith("featuredsectionid_") ){ var classes2 = theclasses[i].split("_"); featuredsectionid=classes2[1]; }
			}
			var sortorder="-1";
			for(var i=0;i<theclasses.length;i++){
				if( theclasses[i].startsWith("sortorder_") ){ var classes2 = theclasses[i].split("_"); sortorder=classes2[1]; }
			}
			if( featuredsectionid!="" && featuredsectionid!="-1" && sortorder!="" && sortorder!="-1" ){
				var thevalue = theid;
				var type = "post";
				window.location.href = '/reusables/functions/changefeaturedcontent_1.php?thevalue='+thevalue+'&featuredsectionid='+featuredsectionid+'&sortorder='+sortorder+'&type='+type+'&fromurl=/';
			}
			if(window.selectedfeatured != ''){
				var featuredid = '0';
				for(var i=0;i<10;i++){
					if(window.selectedfeatured == window.selectedfeatured+' '+i){
						// alert('found it! '+ selectedfeatured);
						featuredid = i;
					}
				}
				
				if(featuredid != '0'){
					// window.location.href = '/reusables/functions/changefeatured_1.php?id='+theid+'&featuredid='+featuredid+'&fromurl='+thisurl;
				}
				
			}else{
				window.location.href = '/editing/post/'+theid+'/edit';
			}
		}
		dynamicsetup(){
			let ArticlesModal1Class = new ArticlesModal1();
			$('.article_cellbutton').click( function() {
				ArticlesModal1Class.articleclicked(this);
			});	
		}
					
	}

	$('#published-btn').click(function(){
		$('#published-btn').css({'background-color': 'rgba(0,0,0,0.1)'});
		$('#unpublished-btn').css({'background-color': 'rgba(0,0,0,0)'});
		$('#article_reusableTableDiv').empty();
		populatearticles(publishedarray);
		currentarray = publishedarray;
	});
	$('#unpublished-btn').click(function(){
		
		$('#published-btn').css({'background-color': 'rgba(0,0,0,0)'});
		$('#unpublished-btn').css({'background-color': 'rgba(0,0,0,0.1)'});
		$('#article_reusableTableDiv').empty();
		
		populatearticles(unpublishedarray);
		
		currentarray = unpublishedarray;
	});
	$('#published-btn').click();
var idk = false;
function populatearticles(allarticlesarray){
	var articlescellarray = new Array();
			
		for(i=0;i<allarticlesarray.length;i++){
			
			var celldiv = document.createElement('div');
			celldiv.id = 'article_celldiv_'.concat(i);
			var celltype = 1;
			
			var theindex = i;
			var articlesdict = allarticlesarray[i];
			
			Javascript:setupArticlesTableCell(celltype,articlesdict,theindex,celldiv);
			
			articlescellarray.push(celldiv);
			
		}
		idk=true;
		Javascript:addArticlesTable(articlescellarray,2 );
		
		let ArticlesModal1Class = new ArticlesModal1();
		ArticlesModal1Class.dynamicsetup();
}

function addArticlesTable(cellarray, cellsinrow ) {

	var myTableDiv = document.getElementById("article_reusableTableDiv")
    	var table = document.createElement('TABLE')
    	var tableBody = document.createElement('TBODY')
	
	table.id = 'article_reusableTable';
	table.style.borderSpacing = "20px";
	
    	table.appendChild(tableBody);
    	
    	
    	
    //TABLE ROWS
    
    var anumber = 1;
    
    for (a = 0; a < cellarray.length; a++) {
	var tr = document.createElement('TR');
        
        	var td = document.createElement('TD');
        	
        	
        	for(b = 0; b < cellsinrow; b++){
        		
        		if( b != 0 ){
        			a = a+1;
        		}
        		
        		var thiscell = cellarray[a];
        		thiscell.className = 'article_reusablecelldiv';
        		        		
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

function setupArticlesTableCell(celltype, inputdict, theindex, thisdiv) {
	//alert(inputdict['title']);
	
	if(celltype == 1){
	
		var buttonwidth = '500px';
		var buttonheight = 90;
		
		thisdiv.style.display = "inline-block";
		thisdiv.style.position = "relative";
		thisdiv.style.width = buttonwidth;
		thisdiv.style.height = buttonheight;
		thisdiv.style.float = 'left';
		thisdiv.className = 'article_celldivv';
		//thisdiv.appendChild(thelink);
		
		var cellbutton = document.createElement('div');
		cellbutton.className = 'article_cellbutton';
		cellbutton.id = theindex;
		
		thisdiv.appendChild(cellbutton);
		
		var articleimg = document.createElement('label');
		articleimg.className = 'articleimg';
		var backgroundurl = inputdict['featured_imagepath'];
		backgroundurl = backgroundurl.replace('/media/uploads/',  '/media/uploads/thumbs2/');
		articleimg.style.backgroundImage = 'url('+backgroundurl+')';
		thisdiv.appendChild(articleimg);
		
		var articlename = document.createElement('p');
		articlename.className = 'articlename';
		var articlenametext = document.createTextNode(inputdict['title']);
		articlename.appendChild(articlenametext);
		thisdiv.appendChild(articlename);
		//if(idk==true){alert(theindex+", 1");}
		//if(theindex==4 && idk==true){alert(inputdict['featured_imagepath'])}
		var urltitle = inputdict['title'].replace(/:/g,'');
		urltitle = urltitle.replace(/\s/g, '');
		//if(idk==true){alert(theindex+", 2");}
		//urltitle = urltitle.replace(' ', '_');
		
		var subtitlename = document.createElement('p');
		subtitlename.className = 'articlesubtitle';
		var subtitletext = document.createTextNode(window.location.protocol + "//" + window.location.host + "/"+'post/'+inputdict['id']+'/'+urltitle);
		subtitlename.appendChild(subtitletext);
		thisdiv.appendChild(subtitlename);
		
		var articledate = document.createElement('p');
		articledate.className = 'articledate';
		$(articledate).text(inputdict['formatted_date']);
		thisdiv.appendChild(articledate);
		
		var deletebutton = document.createElement('a');
		deletebutton.className = 'deletepostbutton';
		deletebutton.id = 'deletepostbutton';
		deletebutton.href = '/reusables/functions/deletepost_1.php?id='+inputdict['id']+'&fromurl='+thisurl;
		var deletetext = document.createTextNode("Delete");
		deletebutton.appendChild(deletetext);
		cellbutton.appendChild(deletebutton);
		
		var bottomdivider = document.createElement('hr');
		bottomdivider.className = 'article_bottomdivider';
		cellbutton.appendChild(bottomdivider);
		
		return thisdiv;
		
	}else if(celltype == 2){
		//image on left; title to the right of img; desc under title; time on far right; entirety is a link.
		
	}
	
}

</script>