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

.article_cellbutton:hover {
	
	background-color: rgba(230,230,240,1);
	
}

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

#articlename {
	
	cursor: pointer;
	
}

#articlename:hover {
	
	background-color: rgba(240,240,250,1);
	
}

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
.reusabletopbarbuttons{
	color: #333333;
}
</style>

<?php
	$thisurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$thisurlsecure = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	
	$MainClasses = new MainClasses();
	$allarticlesarray = $MainClasses->getArticles()[1];
	$publishedarray = $MainClasses->getPublished()[1];
	$unpublishedarray = $MainClasses->getUnPublished()[1];
	
	for($i=0;$i<sizeof($publishedarray);$i++){
		$datemade = $publishedarray[$i]['date_made'];
		$dt = new DateTime("@$datemade");
		$publishedarray[$i]['formatted_date'] = $dt->format('m/d/y');
	}
	
	for($i=0;$i<sizeof($unpublishedarray);$i++){
		$datemade = $unpublishedarray[$i]['date_made'];
		$dt = new DateTime("@$datemade");
		$unpublishedarray[$i]['formatted_date'] = $dt->format('m/d/y');
	}
	
?>

<div class='reusablepopbackground articlesbackground' style='z-index: 5;'>
	<div class='articlespopview' style='display: none; position: absolute; background-color: white; border: 0;  border-radius: 10px; width: 600px; height: 400px; top: 50%; margin-top: -200px; left: 50%; margin-left: -300px;'>
		<button class=reusablepopclosebutton></button>
		<p class='reusablepoptitle' style='margin-bottom: 0px; padding: 0;'>Select Article</p>
		<div style='width: 100%; text-align: center; height: 40px; margin: 0; padding: 0; margin-top: 10px;'>
			<div style='display: inline-block; position: relative; margin: 0; padding: 0;'>
				<button id='unpublished-btn' class='reusabletopbarbuttons'>Unpublished</button>
				<button id='published-btn' class='reusabletopbarbuttons'>Published</button>
			</div>
		</div>
		
		<div style='display: inline-block; position: relative; margin: 0; padding: 0; width: 90%; height: 300px; margin-top: -10px; overflow-y: scroll; overflow-x: hidden;'>
			<div id='article_reusableTableDiv' style='margin: 0; padding: 0;'>
						
			</div>
		</div>
					
	</div>
</div>

<script>

var allarticlesarray = <?php echo json_encode($allarticlesarray) ?>;
var publishedarray = <?php echo json_encode($publishedarray) ?>;
var unpublishedarray = <?php echo json_encode($unpublishedarray) ?>;

var currentarray;

var thisurl = <?php echo json_encode($thisurl) ?>;

$(document).ready(function(){

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
	$('.article_cellbutton').click( function() {
				
				var articledict = allarticlesarray[this.id];
				var theid = articledict['id'];
				
				if(selectedfeatured != ''){
					var featuredid = '0';
					if(selectedfeatured == 'featureddiv_one'){
						featuredid = '1'
					}else if(selectedfeatured == 'featuredtwodiv_one'){
						featuredid = '2'
					}else if(selectedfeatured == 'featuredtwodiv_two'){
						featuredid = '3'
					}else if(selectedfeatured == 'featureddiv_three'){
						featuredid = '4'
					}
					alert();
					if(featuredid != '0'){
						window.location.href = '/editing/change_featured.php?id='+theid+'&featuredid='+featuredid+'&fromurl='+thisurl;
					}
					
				}else{
					window.location.href = '/editing/post?id='+theid;
				}
			});
			
			//populatearticles(allarticlesarray);
			$('#published-btn').click();
});

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
			
			Javascript:addArticlesTable(articlescellarray,2 );
			
			dynamicsetup();
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
		articleimg.style.backgroundImage = 'url('+backgroundurl+')';
		thisdiv.appendChild(articleimg);
		
		var articlename = document.createElement('p');
		articlename.className = 'articlename';
		var articlenametext = document.createTextNode(inputdict['title']);
		articlename.appendChild(articlenametext);
		thisdiv.appendChild(articlename);
		
		var urltitle = inputdict['title'].replace(/\s/g, '');
		
		//urltitle = urltitle.replace(' ', '_');
		
		var subtitlename = document.createElement('p');
		subtitlename.className = 'articlesubtitle';
		var subtitletext = document.createTextNode('http://entrenash.co/post?p='+inputdict['id']+'&'+urltitle);
		subtitlename.appendChild(subtitletext);
		thisdiv.appendChild(subtitlename);
		
		var articledate = document.createElement('p');
		articledate.className = 'articledate';
		$(articledate).text(inputdict['formatted_date']);
		thisdiv.appendChild(articledate);
		
		var deletebutton = document.createElement('a');
		deletebutton.className = 'deletepostbutton';
		deletebutton.id = 'deletepostbutton';
		deletebutton.href = '/editing/delete_post.php?id='+inputdict['id']+'&fromurl='+thisurl;
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

function articleclickedd(obj){
	var currentdict = currentarray[obj.id];
	var theid = currentdict['id'];
	
					if(selectedfeatured != null && selectedfeatured != ''){
					
						
						if(selectedfeatured != ''){
							var featuredid = '0';
							
							if(selectedfeatured == 'featureddiv_one'){
								featuredid = '1'
							}else if(selectedfeatured == 'featuredtwodiv_one'){
								featuredid = '2'
							}else if(selectedfeatured == 'featuredtwodiv_two'){
								featuredid = '3'
							}else if(selectedfeatured == 'featureddiv_three'){
								featuredid = '4'
							}
							
							if(featuredid != '0'){
							
								window.location.href = '/editing/change_featured.php?id='+theid+'&featuredid='+featuredid+'&fromurl='+thisurl;
							}
							
						}else{
							//alert('something went wrong2');
						}
					}else{
						window.location.href = '/editing/post?p='+theid;
					}
	
}

</script>