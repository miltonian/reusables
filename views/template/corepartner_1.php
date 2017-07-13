<?php

namespace Reusables;


require_once($docroot.'/reusables/reusable.php');
require_once($docroot.'/classes/classes.php');
require_once($docroot.'/classes/adminclasses.php');

$ReusableClass = new ReusableClass();
$MainClasses = new MainClasses();

$adsetdict = $MainClasses->getadset();
$topad = $adsetdict['topad']['imagepath'];
//exit(json_encode($topad));
$sidead1 = $adsetdict['sidead1']['imagepath'];
//exit(json_encode($sidead1));
$sidead2 = $adsetdict['sidead2']['imagepath'];
// $bottomad = $adsetdict['bottomad']['imagepath'];

$topad = 'https://theanywherecard.com/entrenash/media/images/tempads/1_2.png';
$topad = 'https://theanywherecard.com/entrenash/media/images/tempads/JimPlasko_top_728x90_block.jpg';
$bottomad = 'https://theanywherecard.com/entrenash/media/images/tempads/2_2.png';
$bottomad = 'https://theanywherecard.com/entrenash/media/images/tempads/JimPlasko_bottom_728x90_block.jpg';



$optionsarray = array( "Brand Engagement", "Core Partner", "Concert Promotion", "Business Promotion" );

// $corepartnerdict = $MainClasses->getCorePartner( "1" )[1];
// $corepartnerpagedesc = $corepartnerdict['page_desc'];
// $topimg = $corepartnerdict['imagepath'];

$corepartnerpagedesc = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";

$exampleimg1 = 'https://theanywherecard.com/entrenash/media/images/exampleimg.jpeg';

$examplebigad = 'https://theanywherecard.com/entrenash/post/media/images/bigad.png';
$examplepostimg = 'https://theanywherecard.com/entrenash/post/media/images/examplepostimg.png';

$afterthisid = "0";
$limit = 7;
$sideposts = $MainClasses->getPostsAfterWithLimit( $afterthisid, $limit )[1];

$metatitle = "EntreNash - Jim Plasko";
// include $docroot.'/structure/header.php';

$fullarray = $MainClasses->getArticlesNoPodcasts()[1];
$featuredposts = $MainClasses->randomizearrayof20($fullarray, 4);

?>


<style>

.corepartnerform {
	
	position: relative;
	display: inline-block;
	background-color: red;
	margin: 0;
	padding: 0;
	width: 90%; 
	min-height: 100px;
	border-radius: 6px;
	border-style: solid; 
	border-width: 1px; 
	border-color: #d0d0d3;
	background-color: rgba(245,245,250,1);
	text-align: center;
	margin-bottom: 50px;
	
}

.formtitle {
	
	display: inline-block;
	position: relative; 
	color: #333333;
	margin: 0;
	padding: 0;
	margin-top: 20px;
	margin-bottom: 20px;
	margin-left: 30px;
	float: left;
	font-weight: 600;
	
}

.formheaders {
	
	position: relative;
	display: inline-block;
	margin: 0;
	padding: 0;
	font-size: 0.8em;
	font-weight: 500;
	color: #333333;
	float: left;
	margin-left: 30px;
	margin-top: 30px;
	
}

.container {position: relative; display: inline-block; width: 100%;}
.indent {margin-left: 40px;}

.customtf {
	
	display: inline-block; 
	position: relative; 
	background-color: white;
	margin: 0;
	padding: 0;
	border-radius: 6px;
	border-style: solid;
	border-width: 1px;
	border-color: #d0d0d3;
	font-weight: 300;
	padding-left: 40px;
	height: 60px;
	min-width: 200px;
	color: #333333;
	font-size: 1.2em;
	
}

.forminput {

	float: left;
	margin-left: 90px;
	margin-top: 8px;
	
}

.custombutton {
	
	display: inline-block;
	position: relative;
	border: 0;
	-webkit-appearance: none;
	border-radius: 6px;
	border-style: solid;
	border-width: 1px;
	border-color: rgba(0,0,0,0.1);
	margin: 0;
	padding: 0;
	color: white;
	height: 60px;
	min-width: 100px;
	font-size: 1em;
	font-weight: 500;
	
}

/*below is featured content*/

.seconddiv {
	
	position: relative; 
	display: inline-block; 
	text-align: center; 
	margin: 0; 
	padding: 0; 
	width: 100%; 
	margin-top: -20px;
	
}
.featureddivs:hover {
	
	opacity: 0.7;
	
}

.gradientdiv {

	position: relative; 
	display: inline-block; 
	margin: 0; padding: 0; 
	width: 100%;  
	height: 45%; 
	top: 55%; 
	background: -webkit-linear-gradient(top,rgba(0,0,0,0),rgba(0,0,0,1)); 
	background: -o-linear-gradient(bottom,rgba(0,0,0,0),rgba(0,0,0,1)); 
	background: -moz-linear-gradient(bottom,rgba(0,0,0,0),rgba(0,0,0,1));  
	background: linear-gradient(to bottom, rgba(0,0,0,0), rgba(0,0,0,1)); 
	
}

.featuredtitles {
	
	position: relative; 
	display: inline-block; 
	color: white;
	padding: 0; 
	margin: 0;
	font-weight: 700;
	
}

.featureddates {
	
	position: relative; 
	display: inline-block; 
	color: white;
	padding: 0; 
	margin: 0;
	font-size: 0.7em;
	font-weight: 400;
	height: 1.0em;
	top: 50%; 
	margin-top: -0.5em;
	
}

.featureddivss {
	
	position: relative; 
	display: inline-block; 
	margin: 0; 
	padding: 0;  
	float: left; 
	height: 270px; 
	width: 350px; 
	float: left; 
	overflow: hidden; 
	background-position: center; 
	background-size: 100% auto; 
	border: none; 
	border-style: solid; 
	border-color: white; 
	border-width: 1px; 
	box-sizing: border-box; 
	cursor: pointer;
	transition: 0.6s;
	transform-style: preserve-3d;
	background: transparent;
	
}

.featuredcontentcontainer {
	
	position: relative;
	display: inline-block;
	width: 90%;
	height: 100%;
	
}

.featuredcontent {
	
	position: absolute; 
	display: block; 
	padding: 0; 
	margin: 0;
	width: 68%;
	left: 20px;
	height: 80px;
	text-align: left;
	bottom: 0;
		
}

.featuredtitlescontainer {
	
	position: relative; 
	display: inline-block;
	width: 100%; 
	height: 60%;
	padding: 0;
	margin: 0;
	
}

.featureddatescontainer {
	
	position: relative; 
	display: inline-block;
	width: 100%; 
	height: 40%;
	padding: 0;
	margin: 0;
}
.options-text {
	
	margin-left: 10px; 
	font-size: 0.8em; 
	font-weight: 300; 
	margin-right: 5px;
}
/*done featured content*/

.corepartnerform .field-wrapper {display: inline-block; position: relative; margin: 20px; padding: 0; width: calc(50% - 40px); float: left; text-align: left; margin-bottom: 5px;}
			.corepartnerform .field-wrapper label {margin-bottom: 5px;}
			.corepartnerform .field-wrapper input { display: inline-block; position: relative; margin: 0px; padding: 10px; width: 100%; border: 0; border: 1px solid #e0e0e0; border-radius: 5px; background-color: white; float: left; height: 50px; font-weight: 300; font-size: 1.1em; }
				.corepartnerform input:focus {outline: none;}



</style>

		<div class='reusablepopbackground'>
			<div class='reusablepopview'>
				<button class=reusablepopclosebutton></button>
				<p class='reusablepoptitle'>title</p>
				<p class='reusablepopdesc'>desc</p>
			</div>
		</div>
		
		<div class=firstdiv style='font-family: Muli, sans-serif; position: relative; display: inline-block; margin: 0; margin-top: 60px; padding: 0; width: 100%; max-width: 1200px;  text-align: center;'>
			
			<div class=firstmaincontent style='position: relative; display: inline-block; max-width: 1200px; width: 100%; text-align: center;'>
				
				<?php if( $isadmin==false ){ ?>
				<div class=bigad style='position: relative; display: inline-block; width: 100%; text-align: center; display: none;'>
					<img src=<?php if(isset($topimg)){echo $topimg; } ?> style='position: relative; display: inline-block; width: 90%;'>
				</div>
				
				<div class='container' style='width: 80%; font-weight: 400; color: #333333; margin-top: 20px; margin-bottom: 50px; display: none;'>
					<div class='htmltextdiv' style='display: inline-block; position: relative; margin: 0; padding: 0; margin-top: 30px;'>
						<?php if(isset($corepartnerpagedesc)){ echo $corepartnerpagedesc; } ?>
					</div>
				</div>
				<?php }else { ?>
				
				<form id='corepartnerdesc' action='editcorepartner.php' method='POST' enctype='multipart/form-data'>
				
				<div style=''>
						<input type=hidden id='old_imagepath' name='old_imagepath' value=<?php echo $topimg ?>>
						<input type='hidden' id='imagechanged' name='imagechanged' value='0'>
						<input type=file id='$topimg' name='$topimg' style='opacity: 0; position: absolute; z-index: -1;'>
						<div class=bigad style='position: relative; display: inline-block; width: 100%; height: 300px; text-align: center;'>
							<label for='$topimg' id='$topimglabel' style='position: relative;  display: inline-block; margin: 0; padding: 0; width: 100%; height: auto; margin-top: 20px; -webkit-appearance: none; border: 0; background: transparent; cursor: pointer; background-image: url(<?php echo $topimg ?>); position: relative; display: inline-block; height: 250px; width: 970px; top: 50%;  margin-top: -125px; background-repeat: no-repeat; background-size: cover; background-position: center;'></label>
						</div>
					</div>
				
				<div class='container' style='width: 80%; font-weight: 400; color: #333333; margin-top: 20px; margin-bottom: 50px;'>
					<div class='htmltextdiv' style='display: inline-block; position: relative; margin: 0; padding: 0; margin-top: 30px;'>
					
						<textarea name='editor1' id='editor1'  rows='10' cols='80'><?php echo $corepartnerpagedesc ?></textarea>
						<input type='hidden' value='1' name='corepartner'>
						
						<script>
                					// Replace the <textarea id='editor1'> with a CKEditor
                					// instance, using default configuration.
                					CKEDITOR.replace( 'editor1' );
                					CKEDITOR.config.width = 950;
            					</script>
						
							<input type='submit' class='custombutton' name='submitbutton' style='background-color: blue; float: right; margin-right: 50px; margin-top: 20px; height: 45px; cursor: pointer; margin-bottom: 50px;' value='Save'>
					</div>
				</div>
				</form>
				<?php } ?>
				
				
				
				<form class='corepartnerform' method='post' action='partner_submit.php'>
					
					<div class='container' style='text-align: left; margin-top: 10px; margin-bottom: 30px; text-align: center;'>
					<!-- <div style='display: inline-block; position: relative; text-align: left;'> -->
					
						<div class="field-wrapper">
							<label>First name:</label><br>
							<input type="text" name="first_name" placeholder="First Name" id="first_name">
						</div>

						<div class="field-wrapper">
							<label>Last name:</label><br>
							<input type="text" name="last_name" placeholder="Last Name" id="last_name">
						</div>

						<div class="field-wrapper" style="width: calc(100% - 40px);">
							<label>Email:</label><br>
							<input type="text" name="email" placeholder="Email" id="email">
						</div>
<div style="display: inline-block; position: relative; margin: 30px 0px; padding: 0; width: 100%;">
					<?php for($i=0;$i<sizeof($optionsarray);$i++){ ?>

						<div style="display: inline-block; position: relative; margin: 0; padding: 0; width: 50%; float: left; text-align: center; font-size: 1.7em; "><input class='options' type='checkbox' name="check_list[]" value="<?php echo $optionsarray[$i] ?>" style="display: inline-block;" ><span class='options-text'><?php echo $optionsarray[$i] ?></span></div>

						<?php if($i % 2 == 0){ ?>
							
						<?php }else { ?>

						<?php } ?>

						<?php if(sizeof($optionsarray)>$i+1){ ?>
							<?php $i++; ?>
							<div style="display: inline-block; position: relative; margin: 0; padding: 0; width: 50%; float: left; text-align: center; font-size: 1.7em; "><input class='options' type='checkbox' name="check_list[]" value="<?php echo $optionsarray[$i] ?>" ><span class='options-text'><?php echo $optionsarray[$i] ?></span></div>
						<?php } ?>

						<?php if($i % 2 == 0){ ?>
								
						<?php }else { ?>

						<?php } ?>

						
						
						</div>
					<?php } ?>

						<!--<input type='checkbox' class='options' /> Option <input type='checkbox' class='options' /> Option <input type='checkbox' class='options' /> Option<br>
						<input type='checkbox' class='options' /> Option <input type='checkbox' class='options' /> Option <input type='checkbox' class='options' /> Option<br>-->
					<!-- </div> -->
					</div>
					<input type='hidden' id='options' name='options' value=''>
					<input type='submit' class='custombutton' style='background-color: #ff5719; width: 170px;  margin-bottom: 150px; cursor: pointer;'>
					</div>
				</form>
				
				
			</div>
			
		</div>
		
		<?php include $docroot.'/reusables/views/featured_inline.php'; ?>
		
		
		
		<?php include $docroot.'/structure/footer.php'; ?>
	
	<script>
		var isadmin = <?php echo json_encode($isadmin) ?>;
		//$(document).ready(function(){
		
			// if(isadmin==true){
			// 	showadminbar(<?php echo json_encode($device) ?>, <?php echo json_encode($email) ?>);
			// 	$('.seconddiv').css({'margin-top': '150px'});
			// 	$('#editbutton').click(function(){
			// 	window.location.href = '/editing/post?p='+postid;
			// 	});
			// }
			// shownav(<?php echo json_encode($device) ?>, <?php echo json_encode($logoimgthumb) ?>);
			
			// var device = <?php echo json_encode($device) ?>;
			// if(device=='mobile'){
			// 	var thedict = [];
			// 	populatemaintable(<?php echo json_encode($featuredposts) ?>, null);
			// 	fixweirdlynarrowrowsonsomepages();
			// }
			
		//});
		$('#$topimg').change(function(){
			if (this.files && this.files[0]) {
				var reader = new FileReader();
        			reader.onload = function (e) {
            				$('#$topimglabel').css('background-image', 'url('+e.target.result+')');
            				$('#imagechanged').val('1');
            			}

        			reader.readAsDataURL(this.files[0]);
    			}	
		});
		$('.options').click(function(){
			if(this.checked){
				if($('#options').val() == ''){
					$('#options').val($(this).parent().find('span').text());
				}else{
					$('#options').val($('#options').val()+','+$(this).parent().find('span').text());
				}
				
			}else{
				var thetext = $('#options').val();
				var removethis = $(this).parent().find('span').text();
				var commabefore = $('#options').val().includes(','+removethis);
				var normal = $('#options').val().includes(removethis);
				var commaafter = $('#options').val().includes(removethis+',');
				
				if(commabefore){
					thetext = thetext.replace(','+removethis,'');
				}else if(commaafter){
					thetext = thetext.replace(removethis+',','');
				}else{
					thetext = thetext.replace(removethis,'');
				}
				
				$('#options').val(thetext);
				
			}
			//alert($('#options').val());
		});
	</script>
	