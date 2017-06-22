<?php 
	if(!isset($maincategoriesmodalarray)){ $maincategoriesmodalarray = array(); }
	array_push($maincategoriesmodalarray, ["id"=>"0", "time_created"=>"", "name"=>"Other"]);
	if(!isset($categoriesmodalarray)){ $categoriesmodalarray = array(); }
		if(!isset($categoriesnomain
			)){ $categoriesnomain = array(); }
	// exit(json_encode($categoriesmodalarray));
?>

<style>

.categoriesmodal1 {

}
.categoriesmodal1 .categoriespopview {
	display: none; position: absolute; background-color: white; border: 0;  border-radius: 10px; width: 600px; height: 400px; top: 50%; margin-top: -200px; left: 50%; margin-left: -300px; overflow-y: scroll; overflow-x: hidden;
}
.categoriesmodal1 .title {
	display: inline-block;
	position: relative;
	text-align: center;
	width: 80%;
	margin: 0;
	padding: 0;
	margin-top: 25px;
	color: #333333;
	font-size: 1.3em;
	font-weight: 400;
}
.categoriesmodal1 .table-container {
	display: inline-block; position: relative; margin: 0; padding: 0; width: 90%; height: 300px; margin-top: 20px; overflow: hidden;
}
.categoriesmodal1 .table {
	display: inline-block;
	position: absolute;
	margin: 0;
	padding: 0;
	width: 100%;
	max-height: 100%;
	overflow-x: hidden;
	overflow-y: scroll;
	top: 0px;
}
.categoriesmodal1 .table.main {
	left: 0; 
}
.categoriesmodal1 .table.sub {
	left: 100%;
	width: 75%;
}
.categoriesmodal1 .table .cell {
	display: inline-block;
	position: relative;
	margin: 0;
	padding: 0;
	width: 100%;
	height: 50px;
	border-bottom: 1px solid #efefef;
	cursor: pointer;
}
	.categoriesmodal1 .table .cell:hover { background-color: rgba(0,0,5,0.1); }
	.categoriesmodal1 .table .cell.selected { background-color: rgba(0,0,5,0.1); }

.categoriesmodal1 .table .cell .name {
	position: relative; 
	display: inline-block;
	margin: 0;
	margin-left: 50px;
	padding: 0;
	top: 50%;
	transform: translateY(-50%);
	font-size: 1em;
	color: #333333;
	float: left;
}
	.categoriesmodal1 .table.sub .cell .name {margin-left: 15px;}
</style>

<div class='categoriesmodal1 categoriesbackground backgroundoverlay' style='z-index: 5;'>
<div class='categoriespopview'>
	<button class='closebutton'></button>
	<!-- <button class=newcategorybutton>Add New</button> -->
	<p class='title'>Select Categories</p>
				
	<!-- <div class=newcategorydiv style='display: none;'>
		<form method='POST' action='/reusables/functions/addcategory_1.php' enctype='multipart/form-data' style='position: relative; display: inline-block;'>
			
			<input type=text name=categoryname class=newnameinput placeholder='Enter the category name' />
			<input type='hidden' name="from_url" value='asdf' />
			<input type=submit id=addcategorybutton value='Add' style='position:  absolute;  display: inline-block; margin: 0; padding: 0; 
			background-color: green; color: white; right: 8px; border: 0; height: 60px; border-radius: 5px;  font-weight: 300; font-size: 1em; width: 60px; cursor: pointer; z-index: 1; top: 18px;' />
		</form>
	</div> -->

	<div class="table-container">
		<div class='table main'>
		<?php for($i=0;$i<sizeof($maincategoriesmodalarray);$i++){ ?>
			<div class="cell" id="<?php echo $maincategoriesmodalarray[$i]['id'] ?>">
				<label class="name"><?php echo $maincategoriesmodalarray[$i]['name'] ?></label>
			</div>
		<?php } ?>
		</div>
		<div class="table sub">
			<?php for($i=0;$i<sizeof($categoriesmodalarray);$i++){ ?>
				<div class="selectable cell maincategoryid_<?php if(isset($categoriesmodalarray[$i]['maincategoryid'])){ echo $categoriesmodalarray[$i]['maincategoryid']; }else{ echo '0'; } ?>" id="<?php echo $categoriesmodalarray[$i]['id'] ?>">
					<label class="name"><?php echo $categoriesmodalarray[$i]['name'] ?></label>
				</div>
				
			<?php } ?>
		</div>
	</div>
				
</div>
</div>

<script>


var categoriesmodalarray = [];
var maincategories = '<?php echo json_encode($maincategoriesmodalarray) ?>';
var categories = '<?php echo json_encode($categoriesmodalarray) ?>';


var thisurl = "";

$(document).ready(function(){

	$('.categoriesmodal1 .table.main .cell').click(function(){
		$( '.categoriesmodal1 .table.main .cell' ).removeClass( "selected" );
		$(this).toggleClass(' selected');
		if( $(this).hasClass('selected') ){
			$('.categoriesmodal1 .table.sub .cell').css({'display': 'none'});
			// alert(this.id)
			$('.categoriesmodal1 .table.sub .cell.maincategoryid_'+this.id).css({'display': 'inline-block'});
			$('.categoriesmodal1 .table.main').animate({'width':'20%'});
				$('.categoriesmodal1 .table.main').css({'border-right': '1px solid #efefef'});
			$('.categoriesmodal1 .table.main .cell label').animate({'margin-left':'15px'});

			$('.categoriesmodal1 .table.sub').animate({'left':'25%'});
		}else{
			$('.categoriesmodal1 .table.main').animate({'width':'100%'});
				$('.categoriesmodal1 .table.main').css({'border-right': '0px solid #efefef'});
			$('.categoriesmodal1 .table.main .cell label').animate({'margin-left':'50px'});

			$('.categoriesmodal1 .table.sub').animate({'left':'100%'});
		}
		
	});
	var addingnewcategory = false;
			
			$('.newcategorybutton').click( function() {
				
				if(addingnewcategory == false){
				
					addingnewcategory = true;
					
					$('.newcategorydiv').css('display', 'inline-block');
					$('.newcategorybutton').text('Cancel');
					
				}else{
					
					addingnewcategory = false;
					
					$('.newcategorydiv').css('display', 'none');
					$('.newcategorybutton').text('Add New');
					
					
				}
				
			});

			$('.categoriesmodal1 .selectable.cell').click( function() {
				// var categoriesdict = allarticlesarray[this.id];
				var categoriesmodalarray = <?php echo json_encode($categoriesmodalarray) ?>;
				var categoriesdict = [];
				for(var i=0;i<categoriesmodalarray.length;i++){
					if(categoriesmodalarray[i]['id'] == this.id ){ 
						categoriesdict = categoriesmodalarray[i];
						i=categoriesmodalarray.length;
					}
				} 
				
				var theid = categoriesdict['id'];
				// alert(JSON.stringify(theid));
				var theclasses = selectedfeatured.split(" ");
				var featuredsectionid="-1";
				for(var i=0;i<theclasses.length;i++){
					if( theclasses[i].startsWith("featuredsectionid_") ){ var classes2 = theclasses[i].split("_"); featuredsectionid=classes2[1]; }
				}

				var sortorder="-1";
				for(var i=0;i<theclasses.length;i++){
					if( theclasses[i].startsWith("sortorder_") ){ var classes2 = theclasses[i].split("_"); sortorder=classes2[1]; }
				}

				// alert(this.id);
				if( featuredsectionid!="" && featuredsectionid!="-1" && sortorder!="" && sortorder!="-1" ){
					var thevalue = this.id;
					var type = "category";
					window.location.href = '/reusables/functions/changefeaturedcontent_1.php?thevalue='+thevalue+'&featuredsectionid='+featuredsectionid+'&sortorder='+sortorder+'&type='+type+'&fromurl=/';
				}

				if(selectedfeatured != ''){
					var featuredid = '0';
					for(var i=0;i<10;i++){
						if(selectedfeatured == selectedfeatured+' '+i){
							// alert('found it! '+ selectedfeatured);
							featuredid = i;
						}
					}
					
					if(featuredid != '0'){
						// window.location.href = '/reusables/functions/changefeatured_1.php?id='+theid+'&featuredid='+featuredid+'&fromurl='+thisurl;
					}
					
				}else{
					// window.location.href = '/editing/post?id='+theid;
				}
			});
	//populatecategories(categoriesmodalarray);
});

function populatecategories(categoriesmodalarray){
	var categoriescellarray = new Array();
			
	for(i=0;i<categoriesmodalarray.length;i++){
				
		var celldiv = document.createElement('div');
		celldiv.id = 'category_celldiv_'.concat(i);
		var celltype = 1;
				
		var theindex = i;
		var categoriesdict = categoriesmodalarray[i];
				
		Javascript:setupCategoriesTableCell(celltype,categoriesdict,theindex,celldiv);
				
		categoriescellarray.push(celldiv);
				
	}
			
	Javascript:addCategoriesTable(categoriescellarray,2 );
}

function addCategoriesTable(cellarray, cellsinrow ) {

	

	var myTableDiv = document.getElementById("category_reusableTableDiv")
    	var table = document.createElement('TABLE')
    	var tableBody = document.createElement('TBODY')
	
	table.id = 'category_reusableTable';
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
        		thiscell.className = 'category_reusablecelldiv';
        		        		
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

function setupCategoriesTableCell(celltype, inputdict, theindex, thisdiv) {
	
	if(celltype == 1){
		var buttonwidth = '500px';
		var buttonheight = 90;
		
		thisdiv.style.display = "inline-block";
		thisdiv.style.position = "relative";
		thisdiv.style.width = buttonwidth;
		thisdiv.style.height = buttonheight;
		thisdiv.style.float = 'left';
		thisdiv.className = 'category_celldivv';
		//thisdiv.appendChild(thelink);
		
		var cellbutton = document.createElement('div');
		cellbutton.className = 'category_cellbutton';
		cellbutton.id = theindex;
		
		thisdiv.appendChild(cellbutton);
		
		var categoryname = document.createElement('p');
		categoryname.className = 'categoryname';
		var categorynametext = document.createTextNode(inputdict['name']);
		categoryname.appendChild(categorynametext);
		thisdiv.appendChild(categoryname);
		
		var deletebutton = document.createElement('a');
		deletebutton.className = 'deletecategorybutton';
		deletebutton.id = 'deletecategorybutton';
		deletebutton.href = '/reusables/functions/deletecategory_1.php?id='+inputdict['id']+'&fromurl='+thisurl;
		var deletetext = document.createTextNode("Delete");
		deletebutton.appendChild(deletetext);
		cellbutton.appendChild(deletebutton);
		
		var bottomdivider = document.createElement('hr');
		bottomdivider.className = 'category_bottomdivider';
		cellbutton.appendChild(bottomdivider);
		
		
		return thisdiv;
		
	}else if(celltype == 2){
		//image on left; title to the right of img; desc under title; time on far right; entirety is a link.
		
	}
	
}

function attachcategoriestotf(){
	$('.category_cellbutton, .categoriesmodal1 .table .selectable.cell').click( function() {
				
		// var thedict = categoriesmodalarray[this.id];
		// var thetext = thedict['name'];
		var previoustext = $('#categorytf').val();
		
		var thetext = $(this).find('.name').text();
		
		if(previoustext!=""){ thetext = previoustext+","+thetext; }
		
		$('#categorytf').val(thetext);

		$(this).off("click");
		
		closethings();
		
	});
}

</script>