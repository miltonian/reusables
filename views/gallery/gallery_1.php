<?php

namespace Reusables;

	//$galleryarray
	// exit(json_encode($galleryarray[1]));
if(!isset($isediting)){$isediting=false;}
if(!isset($galleryarray)){$galleryarray = array(); }

$imagepickerarray = $galleryarray;

?>

<style>
</style>

<?php include $docroot.'/reusables/views/imagepicker_1.php'; ?>

<div class="viewtype_gallery gallery_1 <?php echo $identifier ?> <?php if($isediting){ echo 'editing'; } ?>">
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
$('.<?php echo $identifier ?>.editing').click(function(e){
	e.preventDefault();
	$('.imagepicker1').toggleClass('hide show');
});
$('.<?php echo $identifier ?> .buttons').click(function(e){
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
	$('.backgroundimage').css({'background-image': $('.<?php echo $identifier ?> .image.mid').css('background-image')});
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


class <?php echo $identifier ?>Classes {
	attachobjtopicker(obj){
		imagepicker1class.attachToObj(obj);
	}

	attachPicker(){
		imagepicker1class.attachgallery( $('.<?php echo $identifier ?>')[0] );
	}
}

let <?php echo $identifier ?> = new <?php echo $identifier ?>Classes();
if(isediting){
	<?php echo $identifier ?>.attachPicker();
}




</script>