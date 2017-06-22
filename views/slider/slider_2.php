<?php
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
.slider2 {
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
.slider2 .backgroundimage {
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
.slider2 .image {
	display: inline-block;
	position: absolute;
	margin: 0;
	padding: 0;
	height: 100%;
	width: 100%;
	background-position: center;
	background-size: contain;
	background-size: cover;
	background-repeat: no-repeat;
}
.slider2 .image.left {left: -100%;}
.slider2 .image.mid {left: 0;}
.slider2 .image.right {left: 100%;}

.slider2 .buttons {
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
	display: none;
}
.slider2 .buttons:hover {background-color: rgba(0,0,0,0.5);}
.slider2 .buttons.left {
	left: 0;
	float: left;
	background-image: url('/reusables/uploads/icons/leftarrow-white.png');
}
.slider2 .buttons.right {
	right: 0;
	float: right;
	background-image: url('/reusables/uploads/icons/rightarrow-white.png');
}
.slider2.editing {
	cursor: pointer;
}

.slider2 .image#two {
	left: 0;
   animation: cycle 15s ease infinite;
}

.slider2 .image#three {
	left: 0;
	transform: translateX(100%);
   animation: cycletwo 15s ease infinite;
}

.slider2 .image#one {
	left: 0;
	transform: translateX(100%);
   animation: cyclethree 15s ease infinite;
}

@keyframes cycle {
   0% { transform: translateX(0%); z-index: 0;}
   40% { transform: translateX(0%); z-index: 0;}
   41% { transform: translateX(100%); z-index: 0;}
   66% { transform: translateX(100%); z-index: -1;}
   71% { transform: translateX(100%); z-index: -1;}
   95% { transform: translateX(100%); z-index: 1;}
   100% { transform: translateX(0%); z-index: 1;}
}
@keyframes cycletwo {
   0% { transform: translateX(100%); }
   33% { transform: translateX(100%); z-index: 1;}
   38% { transform: translateX(0%); z-index: 0;}
   66% { transform: translateX(0%); z-index: 0;}
   71% { transform: translateX(0); z-index: -1;}
   100% { transform: translateX(0%); z-index: -1;}
}
@keyframes cyclethree {
   0% { transform: translateX(100%); }
   66% { transform: translateX(100%); z-index: 99;}
   71% { transform: translateX(0%); z-index: 0;}
   100% { transform: translateX(0%); z-index: 0;}
}

/*.slider2 .image.right {
	transition: 1s;
    z-index: 2;
    -webkit-animation: slide 0.5s forwards;
    -webkit-animation-delay: 2s;
    animation: slide 0.5s forwards;
    animation-delay: 2s;
}*/
/*@-webkit-keyframes slide {
    100% { left: 0; }
}
@keyframes slide {
    100% { left: 0; }
}*/
</style>

<?php 
	/*include $docroot.'/reusables/views/imagepicker_1.php';*/ 
	echo Modal::make( "imagepicker_1", [] );
?>

<div class="slider2 <?php if($isediting){ echo 'editing'; } ?>">
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
$('.slider2.editing').click(function(e){
	e.preventDefault();
	$('.imagepicker1').toggleClass('hide show');
});
$('.slider2 .buttons').click(function(e){
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
	$('.backgroundimage').css({'background-image': $('.slider2 .image.mid').css('background-image')});
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
		// alert('prev:'+previndex)
		
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