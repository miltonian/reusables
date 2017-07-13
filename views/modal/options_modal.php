<?php
namespace Reusables;

	if(!isset($optionsmodalarray)){$optionsmodalarray = ["article"=>true, "podcast"=>true, "youtube"=>true]; }
?>

<style>

.addnewoptionsdiv {
	
	position: relative; 
	display: inline-block; 
	margin: 0;
	padding: 0;
	background-color: white;
	border: 0; 
	border-radius: 8px;
	width: 500px;
	top: 50%; 
	margin-top: -100px;
	padding-bottom: 20px;
	
}

.viewtitle {
	
	position: relative;
	display: inline-block; 
	color: #333333;
	margin: 0; 
	padding: 0; 
	margin-top: 10px;
	font-size: 0.9em;
	font-weight: 400;
	margin-top: 20px;
	margin-bottom: 20px;
	
}

.optionbuttons {
	
	position: relative;
	display: inline-block;
	border: 0;
	margin: 0; 
	padding: 0;
	float: left;
	width: 200px;
	height: 70px;
	border-style: solid;
	border-color: #b4b4b4;
	border-width: 1px;
	border-radius: 8px;
	-webkit-appearance: none;
	background-color: white;
	font-size: 1.3em;
	font-weight: 700;
	color: #333333;
	cursor: pointer;
	
}

.optionbuttons:hover {
	
	background-color: rgba(230,230,240,1);
	
}

</style>



<div class='addnewoptionsbackground backgroundoverlay' style='z-index: 5; display: none;'>
	<div class='addnewoptionsdiv'>
		<button class='closebutton'></button>
		<p class='viewtitle' style='font-size: 1.2em; margin-top: 20px; margin-bottom: 20px;'>Select type</p>
		<div style='position: relative; display: inline-block; text-align: center; margin: 0; padding: 0; margin-top: 10px; '>
			<?php if($optionsmodalarray['article']){ ?><a href='/editing/post'><button class='optionbuttons' id='articlebutton' style='margin-right: 10px; margin-top: 10px;'>Article</button></a><?php } ?>
			<?php if($optionsmodalarray['podcast']){ ?><button class='optionbuttons' id='podcastbutton' style='margin-left: 10px;'>Podcast</button><br><?php } ?>
			<?php if($optionsmodalarray['youtube']){ ?><button class='optionbuttons' id='youtubebutton' style='margin-top: 10px;'>Youtube</button><?php } ?>
		</div>
	</div>
</div>



<script>
	$(document).ready(function(){
		
	});
</script>