<?php

namespace Reusables;

	//$sliderarray
	// exit(json_encode($sliderarray[1]));
if(!isset($isediting)){$isediting=false;}
if(!isset($sliderdict['sliderarray'])){$sliderdict['sliderarray'] = array(); }

$sliderarray = $sliderdict['sliderarray'];

$imagepickerarray = $sliderarray;

// exit(json_encode($sliderarray[0]));
// exit(json_encode($sliderarray[0]['imagepath']));

// if(substr($sliderarray[1]['imagepath'], 0,1) == "/"){exit("hello");}

// exit(substr($sliderarray[1]['imagepath'], 0,1));
// exit(json_encode($sliderarray));

// exit(json_encode(Shortcuts::changeURLForTesting($sliderarray[1]['imagepath'])));

?>

<style>


</style>

<?php 
	/*include $docroot.'/reusables/views/imagepicker_1.php';*/ 
	echo Modal::make( "imagepicker_1", [], $identifier . "-imagepicker" );
?>

<div class="slider_2 <?php echo $identifier ?> <?php if($isediting){ echo 'editing'; } ?>">
	<div class="backgroundimage" style="background-image: url('<?php echo Shortcuts::changeURLForTesting($sliderarray[0]['imagepath']) ?>');"></div>
	<div class="image left" id="one" style="background-image: url('<?php echo Shortcuts::changeURLForTesting($sliderarray[sizeof($sliderarray)-1]['imagepath']) ?>');"></div>
	<div class="image mid" id="two" style="background-image: url('<?php echo Shortcuts::changeURLForTesting($sliderarray[0]['imagepath']) ?>');"></div>
	<div class="image right" id="three"  style="background-image: url('<?php echo Shortcuts::changeURLForTesting($sliderarray[1]['imagepath']) ?>');"></div>

	<button class="buttons left"></button>
	<button class="buttons right"></button>
</div>

<script>

var slider2array = <?php echo json_encode($sliderarray) ?>;
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
		if(currentindex<0){currentindex=slider2array.length-1;}
		var previndex = currentindex-1;
		if(previndex<0){ previndex=slider2array.length-1; }
		
		var backgroundimage = slider2array[previndex]['imagepath']
		if(backgroundimage.substr(0,1)=="/"){
			backgroundimage = backgroundimage.replace("/", '/');
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
				backgroundimage = backgroundimage.replace( '/', 0, testroot[changeindex] );
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
		// currentindex++;
		// if(currentindex>slider2array.length-1){currentindex=0;}
		// var nextindex = currentindex+1;
		// if(nextindex>slider2array.length-1){nextindex=0;}
		// // alert(nextindex)

		// var backgroundimage = slider2array[nextindex]['imagepath']
		
		// if(backgroundimage.substr(0,1)=="/"){
		// 	backgroundimage = backgroundimage.replace("/", '/');
		// }else if(backgroundimage.substr(0,testroots[0].length)==testroots[0] || backgroundimage.substr(0,testroots[1].length)==testroots[1]){

		// 	var change = true;
		// 	var changeindex = 0;
		// 	if(backgroundimage.substr(0, testroot[1].length) == testroot[1]){ changeindex = 1; }
		// 	for(var i=0; i<testurls.length;i++){
		// 		if(backgroundimage.substr(0, testurls[i].length) == testurls[i]){
		// 			change = false;
		// 		}
		// 	}
		// 	if(change){
		// 		backgroundimage = backgroundimage.replace( '/', 0, testroot[changeindex] );
		// 	}
		// }
		// $('.image.right').css('background-image', 'url("'+backgroundimage+'")');
	}
}

let imagepicker1class = new ImagePicker1();


class slider2Class {
	attachobjtopicker(obj){
		// imagepicker1class.attachToObj(obj);
	}

	attachPicker(){
		// imagepicker1class.attachgallery( $('.slider2')[0] );
	}
}

let slider2 = new slider2Class();
if(isediting){
	slider2.attachPicker();
}

// setInterval(function(){
	// $('.image.right').css({'z-index': '1'});
	// $('.image.left, .image.mid').css({'z-index': '0'});
	// $('.image.right').stop().animate({'left': '0'}, 300, function(){
	// 	$('.image.left').css({'left': '100%'});
	// 	$('.image.mid').css({'left': '-100%'});
		// moveright($('#one'));
		// moveright($('#two'));
		// moveright($('#three'));
	// });
	
	
// }, 5000);




</script>