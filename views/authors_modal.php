<?php
	/* $authorsarray */

?>


<style>

.newauthordiv {
	
	position: relative; 
	display: inline-block;
	margin: 0;
	padding: 0;
	background-color: white;
	width: 500px;
	height: 90px;
	margin-top: 20px;
	
}

.newauthorimglabel {
	
	position: relative; 
	display: inline-block;
	margin: 0;
	padding: 0;
	background-color: rgba(230,230,240,1);
	border: 0;
	width: 60px;
	height: 60px;
	border-radius: 50%;
	float: left;
	cursor: pointer;
	margin-top: 15px;
		
}

.newauthorimglabel:hover {
	
	opacity: 0.7;
	
}

.newnameinput {
	
	position: relative; 
	display: inline-block;
	margin: 0;
	padding: 0;
	height: 1em;
	margin-top: 17px;
	float: left;
	margin-left: 20px;
	color: #333333;
	height: 60px;
	width: 400px;
	border: 0;
	
	color: #333333;
	font-size: 1.3em;
	font-weight: 300;
	
}

#addauthorbutton:hover {
	
	opacity: 0.7;
	
}
.deleteauthorbutton {
	
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
.newauthorbutton {
	
	position: absolute;
	display: inline-block;
	margin: 0;
	padding: 0;
	float: right;
	right: 20px;
	top: 25px;
	background-color: white;
	border: 0;
	color: blue;
	font-size: 0.7em;
	font-weight: 300;
	padding: 5px;
	cursor: pointer;
	
}

.newauthorbutton:hover {
	
	opacity: 0.7;
	
}
.authorimg-cell { 
	
	display: inline-block; 
	position: relative; 
	border: 0;
	border-radius: 50%;
	background-color: gray;
	margin: 0;
	padding: 0;
	width: 60px;
	height: 60px;
	top: 50%; 
	margin-top: -30px;
	float: left;
	
}

.authorname-cell {
	
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
		
}

.bottomdivider {
	
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

.authorcellbutton, .cellbutton {
	
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

.authorcellbutton:hover {
	
	background-color: rgba(230,230,240,1);
	
}
</style>

<div class='backgroundoverlay authorsbackground' style='z-index: 5;'>
	<div class='authorpopview' style='display: none; position: absolute; background-color: white; border: 0;  border-radius: 10px; width: 600px; height: 400px; top: 50%; margin-top: -200px; left: 50%; margin-left: -300px; overflow-y: scroll; overflow-x: hidden;'>
		<button class='closebutton'></button>
		<button class=newauthorbutton>Add New</button>
		<p class='reusablepoptitle'>Select Author</p>
		
		<div class=newauthordiv style='display: none;'>
			<!--<form method='POST' action='/entrenash/editing/add_author.php' enctype='multipart/form-data'>-->
				<input type=file id=newauthorimgfile name='authorimg' style='position: absolute; opacity: 0;  z-index: -1;'>
				<label class=newauthorimglabel id=newauthorimglabel for=newauthorimgfile style='overflow: hidden;'>
					<p  id='newauthorimgp' style='font-size: 0.6em; position: relative; display: inline-block; height: 1.0em; top: 40%; margin-top: -0.5em'>upload<br>image</p>
					<img id='newauthorimgimg' style='display: none; position: absolute; margin: 0;  padding: 0; top: 0; left: 0;'>
				</label>
				<input type="hidden" name="fromurl" value=<?php echo $thisurl ?>>
				<input type="text" name="authorname" id='authorname-cell' class='newnameinput' placeholder='Enter the authors name' />
				<input type="submit" id="addauthorbutton" value="Add" style='position: absolute; display: inline-block; margin: 0; padding: 0; background-color: green; color: white; top: 0; right: 8; border: 0; height: 60px; border-radius: 5px; font-weight: 300; font-size: 1em; width: 60px; top: 50%; margin-top: -30px; cursor: pointer;' />
			<!--</form>-->
		</div>
		
		<div style='display: inline-block; position: relative; margin: 0; padding: 0; width: 90%; height: 300px; margin-top: 20px;'>
			<div id='authors_reusableTableDiv' style='overflow: scroll;'>
				
			</div>
		</div>
		
	</div>
</div>



<script>

var authorsarray = <?php echo json_encode($authorsarray) ?>;

var addingnewauthor = false;
$('.newauthorbutton').click( function() {
	if(addingnewauthor==false){
		addingnewauthor = true;
		$('.newauthordiv').css('display', 'inline-block');
		$('.newauthorbutton').text('Cancel');
	}else{
		addingnewauthor = false;
		$('.newauthordiv').css('display', 'none');
		$('.newauthorbutton').text('Add New');
	}
});

$('#newauthorimgfile').change( function() {
	$('#newauthorimgp').css('display', 'none');
		readURL(this);
});
populateauthors(authorsarray);
$('#addauthorbutton').click(function(){
	addauthoraction($('#newauthorimgfile').val(),$('#authorname-cell').val());
});
	
function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
				
			var extension = input.files[0].name.split('.').pop().toLowerCase();
				
		reader.onload = function (e) {
    				$('#newauthorimgimg').attr('src', e.target.result);
    				$('#newauthorimgimg').css('width', 'auto');
    				$('#newauthorimgimg').css('height', '100%');
    				$('#newauthorimgimg').css('display', 'inline-block');
    			}

			reader.readAsDataURL(input.files[0]);
		}
}
function populateauthors(authorsarray){
	var authorscellarray = new Array();
	
	for(i=0;i<authorsarray.length;i++){
		
		var celldiv = document.createElement('div');
		celldiv.id = 'authors_celldiv_'.concat(i);
		var celltype = 1;
		
		var theindex = i;
		var authorsdict = authorsarray[i];
		
		Javascript:setupAuthorsTableCell(celltype,authorsdict,theindex,celldiv);
		
		authorscellarray.push(celldiv);
	}
	
	Javascript:addAuthorsTable(authorscellarray,1 );
}
		
function addAuthorsTable(cellarray, cellsinrow ) {
	var myTableDiv = document.getElementById("authors_reusableTableDiv")
	var table = document.createElement('TABLE')
	var tableBody = document.createElement('TBODY')
	
	table.id = 'authors_reusableTable';
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
    		thiscell.className = 'authors_reusablecelldiv';
    		        		
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

function setupAuthorsTableCell(celltype, inputdict, theindex, thisdiv) {
	
	if(celltype == 1){
		var buttonwidth = 500;
		var buttonheight = 90;
		
		thisdiv.style.display = "inline-block";
		thisdiv.style.position = "relative";
		thisdiv.style.width = buttonwidth;
		thisdiv.style.height = buttonheight;
		thisdiv.className = 'celldivv';
		//thisdiv.appendChild(thelink);
		
		var cellbutton = document.createElement('div');
		cellbutton.className = 'authorcellbutton';
		cellbutton.id = theindex;
		
		thisdiv.appendChild(cellbutton);
		
		var authorimg = document.createElement('img');
		authorimg.className = 'authorimg-cell';
		authorimg.src = inputdict['imagepath'];
		thisdiv.appendChild(authorimg);
		
		var authorname = document.createElement('p');
		authorname.className = 'authorname-cell';
		var authornametext = document.createTextNode(inputdict['name']);
		authorname.appendChild(authornametext);
		thisdiv.appendChild(authorname);
		
		var deletebutton = document.createElement('a');
		deletebutton.className = 'deleteauthorbutton';
		deletebutton.id = 'deleteauthorbutton';
		deletebutton.href = '/reusables/functions/deleteauthor_1.php?id='+inputdict['id']+'&fromurl='+'<?php echo $thisurl ?>';
		var deletetext = document.createTextNode("Delete");
		deletebutton.appendChild(deletetext);
		cellbutton.appendChild(deletebutton);
		
		var bottomdivider = document.createElement('hr');
		bottomdivider.className = 'bottomdivider';
		cellbutton.appendChild(bottomdivider);
		
		
		return thisdiv;
		
	}else if(celltype == 2){
		//image on left; title to the right of img; desc under title; time on far right; entirety is a link.
		
	}
	
}

function addauthoraction(authorimg,authorname){

	var loading = false;
	//var newinputarray = inputarray;
	var newinputarray = new Array();
	var inputarray = <?php echo json_encode($authorsarray) ?>;
	var docroot = '<?php echo $docroot ?>';
	for(i=0;i<inputarray.length;i++){
		newinputarray.push(inputarray[i]);
	}
	if(loading == false){
		loading = true;  
		// $.post( '/editing/add_author.php', {'authorimg': authorimg, 'authorname': authorname}, function(data){
		$.post( '/reusables/functions/addauthor_1.php', {'authorimg': authorimg, 'authorname': authorname}, function(data){
	        }).fail(function(xhr, ajaxOptions, thrownError) { 
	            alert(thrownError); 
	            loading = false;
	            scrolledtobottom = false;
	            return null;
	        }).done(function( data ) {
	        	//alert(3);
	        	loading = false;
	        	
	    		var your_data = JSON.parse(data);
	            if( your_data.length == 0 ){
	            	
	            	return null;
	            }
	            
	            for(var i=0; i<your_data.length;i++){
	            	
	            	newinputarray.push(your_data[i]);
	            	
	            }
	        	var difference = newinputarray.length - inputarray.length;
	        	
	        	
	        		inputarray = newinputarray;
		        	var cellarray = new Array();
					var authorscellarray = new Array();
				
					var celldiv = document.createElement('div');
					celldiv.id = 'authors_celldiv_'.concat(inputarray.length-1);
					var celltype = 1;
						
					var theindex = inputarray.length-1;
					var authorsdict = inputarray[theindex];
					alert('Success. New Author is at the bottom of the list.');
					Javascript:setupAuthorsTableCell(celltype,authorsdict,theindex,celldiv);
						
					cellarray.push(celldiv);
					
					Javascript:addAuthorsTable(cellarray,1 );
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

function attachauthortobutton(){
	$('.authorcellbutton').click( function() {
		var inputdict = <?php echo json_encode($authorsarray) ?>[this.id];
		
		var name = inputdict['name'];
		var imagepath = inputdict['imagepath'];
		var authorid = inputdict['id'];
						
		$('.authorname').text(inputdict['name']);
		
		$('#authorbutton').css('display', 'none');
		$('.authorimg-label').css('display', 'inline-block');
		$('.authorname').css('display', 'inline-block');
		
		$('.authorimg-label').attr('src', imagepath);
		$('#authorid').val(authorid);

		$(this).off("click");
		
		closethings();
	});
}
	
</script>