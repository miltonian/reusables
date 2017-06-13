<?php
	//$galleryarray
	// exit(json_encode($galleryarray[1]));
if(!isset($isediting)){$isediting=false;}
if(!isset($galleryarray)){$galleryarray = array(); }

$imagepickerarray = $galleryarray;

// if(substr($galleryarray[1]['imagepath'], 0,1) == "/"){exit("hello");}

// exit(substr($galleryarray[1]['imagepath'], 0,1));
// exit(json_encode($galleryarray));

// exit(json_encode($shortcuts->changeURLForTesting($galleryarray[1]['imagepath'])));

?>

<style>
.gallery1 {
	display: inline-block;
	position: relative;
	margin: 0;
	padding: 0;
	width: 100%;
	height: 100%;
	overflow: hidden;
	background-color: black;
	/*background-color: white;*/
	width: calc(100% - 40px);
	/* margin-right: 30px; */
	padding: 0 20px;
	margin: 0;
	overflow: hidden;
}
.gallery1 .backgroundimage {
	position: absolute;
	display: inline-block;
	margin: 0;
	padding: 0;
	top: -10%;
	left: -10%;
	width: 120%;
	height: 120%;
	background-position: center;
	background-size: cover;
	filter:blur(15px);
}
.gallery1 .image {
	display: inline-block;
	position: absolute;
	margin: 0;
	padding: 0;
	height: 100%;
	width: 100%;
	background-position: center;
	background-size: contain;
	background-repeat: no-repeat;
}
.gallery1 .image.left {left: -100%;}
.gallery1 .image.mid {left: 0;}
.gallery1 .image.right {left: 100%;}

.gallery1 .buttons {
	display: inline-block;
	position: absolute;
	margin: 0;
	padding: 0;
	height: 100%;
	width: 20%;
	top: 0;
	z-index: 1;
	-webkit-appearance: none;
	border: 0;
	cursor: pointer;
	background: transparent;
	background-position: center;
	background-size: 30% auto;
	background-repeat: no-repeat;
	opacity: 0.8;
}
.gallery1 .buttons:hover {background-color: rgba(0,0,0,0.5);}
.gallery1 .buttons.left {
	left: 0;
	float: left;
	background-image: url('<?php echo $baseurlminimal ?>reusables/uploads/icons/leftarrow-white.png');
}
.gallery1 .buttons.right {
	right: 0;
	float: right;
	background-image: url('<?php echo $baseurlminimal ?>reusables/uploads/icons/rightarrow-white.png');
}
.gallery1.editing {
	cursor: pointer;
}
</style>

<?php include $docroot.'/reusables/views/imagepicker_1.php'; ?>

<div class="gallery1 <?php if($isediting){ echo 'editing'; } ?>">
	<div class="backgroundimage" style="background-image: url('<?php echo $shortcuts->changeURLForTesting($galleryarray[0]['imagepath']) ?>');"></div>
	<div class="image left" id="one" style="background-image: url('<?php echo $shortcuts->changeURLForTesting($galleryarray[sizeof($galleryarray)-1]['imagepath']) ?>');"></div>
	<div class="image mid" id="two" style="background-image: url('<?php echo $shortcuts->changeURLForTesting($galleryarray[0]['imagepath']) ?>');"></div>
	<div class="image right" id="three"  style="background-image: url('<?php echo $shortcuts->changeURLForTesting($galleryarray[1]['imagepath']) ?>');"></div>

	<button class="buttons left"></button>
	<button class="buttons right"></button>
</div>

<script>

var galleryarray = <?php echo json_encode($galleryarray) ?>;
var isediting = false;
<?php if($isediting){ ?>
	isediting = true;
<?php } ?>
var currentindex = 0;
$('.gallery1.editing').click(function(e){
	e.preventDefault();
	$('.imagepicker1').toggleClass('hide show');
});
$('.gallery1 .buttons').click(function(e){
	e.preventDefault();
	if( $(this).hasClass('left') ){
		// alert('left');
		// alert("WTF");
		// $('#one').attr('class', 'image mid');
		// $('#two').attr('class', 'image right');
		// $('#three').attr('class', 'image left');
		moveleft($('#one'));
		moveleft($('#two'));
		moveleft($('#three'));
	}else{
		// alert('right');
		// alert($('#one'));
		// $('#one').attr('class', 'image right');
		// $('#two').attr('class', 'image left');
		// $('#three').attr('class', 'image mid');
		moveright($('#one'));
		moveright($('#two'));
		moveright($('#three'));
	}
	$('.backgroundimage').css({'background-image': $('.gallery1 .image.mid').css('background-image')});
});
function moveleft(img){
	if(img.hasClass('mid')){
		img.attr('class', 'image right');
	}else if(img.hasClass('right')){
		img.attr('class', 'image left');
	}else{
		img.attr('class', 'image mid');
		currentindex--;
		if(currentindex<0){currentindex=galleryarray.length-1;}
		var previndex = currentindex-1;
		if(previndex<0){ previndex=galleryarray.length-1; }
		// alert('prev:'+previndex)
		
		var backgroundimage = galleryarray[previndex]['imagepath']
		if(backgroundimage.substr(0,1)=="/"){
			backgroundimage = backgroundimage.replace("/", '<?php echo $baseurlminimal ?>');
		}else if(backgroundimage.substr(0,testroots[0].length)==testroots[0] || backgroundimage.substr(0,testroots[1].length)==testroots[1]){

			var change = true;
			var changeindex = 0;
			if(backgroundimage.substr(0, testroot[1].length) == testroot[1]){ changeindex = 1; }
			for(var i=0; i<testurls.length;i++){
				if(backgroundimage.substr(0, testurls[i].length) == testurls[i]){
					change = false;
				}
			}
			if(change){
				backgroundimage = backgroundimage.replace( '<?php echo $baseurlminimal ?>', 0, testroot[changeindex] );
			}
		}
		
		$('.image.left').css('background-image', 'url("'+backgroundimage+'")');
	}
	
}
var testroots = ["https://theanywherecard.com/", "https://theanywherecard.com/"];
var testurls = ["https://theanywherecard.com/experiencenash_dev/", "http://theanywherecard.com/experiencenash_dev/"];
function moveright(img){
	if(img.hasClass('mid')){
		img.attr('class', 'image left');
	}else if(img.hasClass('right')){
		img.attr('class', 'image mid');
	}else{
		img.attr('class', 'image right');
		currentindex++;
		if(currentindex>galleryarray.length-1){currentindex=0;}
		var nextindex = currentindex+1;
		if(nextindex>galleryarray.length-1){nextindex=0;}
		// alert(nextindex)

		var backgroundimage = galleryarray[nextindex]['imagepath']
		
		if(backgroundimage.substr(0,1)=="/"){
			backgroundimage = backgroundimage.replace("/", '<?php echo $baseurlminimal ?>');
		}else if(backgroundimage.substr(0,testroots[0].length)==testroots[0] || backgroundimage.substr(0,testroots[1].length)==testroots[1]){

			var change = true;
			var changeindex = 0;
			if(backgroundimage.substr(0, testroot[1].length) == testroot[1]){ changeindex = 1; }
			for(var i=0; i<testurls.length;i++){
				if(backgroundimage.substr(0, testurls[i].length) == testurls[i]){
					change = false;
				}
			}
			if(change){
				backgroundimage = backgroundimage.replace( '<?php echo $baseurlminimal ?>', 0, testroot[changeindex] );
			}
		}
		$('.image.right').css('background-image', 'url("'+backgroundimage+'")');
	}
}

let imagepicker1class = new ImagePicker1();


class Gallery1Class {
	attachobjtopicker(obj){
		imagepicker1class.attachToObj(obj);
	}

	attachPicker(){
		imagepicker1class.attachgallery( $('.gallery1')[0] );
	}
}

let gallery1 = new Gallery1Class();
if(isediting){
	gallery1.attachPicker();
}




</script>