<?php

namespace Reusables;

if(!isset($GLOBALS['isadmin'])){ $GLOBALS['isadmin']=false; }
if(!isset($viewdict['formdesc'])){ $viewdict['formdesc']=""; }

$optionsarray = array( "Brand Engagement", "Core Partner", "Concert Promotion", "Business Promotion" );


// $viewdict['formdesc'] = $corepartnerdict['page_desc'];
// $viewdict['formimg'] = $corepartnerdict['imagepath'];
if( !isset($viewdict['formimg']) ){ $viewdict['formimg'] = 'reusables/uploads/icons/adgoeshere970250.png'; }

// $viewdict['formdesc'] = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";

// $exampleimg1 = 'https://theanywherecard.com/entrenash/media/images/exampleimg.jpeg';

$examplebigad = 'https://theanywherecard.com/entrenash/post/media/images/bigad.png';
$examplepostimg = 'https://theanywherecard.com/entrenash/post/media/images/examplepostimg.png';

?>


<style>

.register_basic {
	 position: relative; display: inline-block; background: transparent; margin: 0; padding: 0; width: 60%;  min-height: 100px; border-radius: 6px; border: 0; /*background-color: rgba(245,245,250,1);*/ background-color: rgba(0,0,0,0.5); text-align: center; margin-bottom: 50px; }

.formtitle { display: inline-block; position: relative;  color: #333333; margin: 0; padding: 0; margin-top: 20px; margin-bottom: 20px; margin-left: 30px; float: left; font-weight: 600; }

.formheaders { position: relative; display: inline-block; margin: 0; padding: 0; font-size: 0.8em; font-weight: 500; color: #333333; float: left; margin-left: 30px; margin-top: 30px; }

.container {position: relative; display: inline-block; width: 100%;}
.indent {margin-left: 40px;}

.customtf { display: inline-block;  position: relative;  margin: 0; padding: 0; border-radius: 6px; border-style: solid; border-width: 1px; border-color: #d0d0d3; font-weight: 300; padding-left: 40px; height: 60px; min-width: 200px; color: #333333; font-size: 1.2em; background-color: rgba(255,255,255,0.2); }

.forminput { float: left; margin-left: 90px; margin-top: 8px; }

.custombutton { display: inline-block; position: relative; border: 0; -webkit-appearance: none; border-radius: 6px; border-style: solid; border-width: 1px; border-color: rgba(0,0,0,0.1); margin: 0; padding: 0; color: white; height: 60px; min-width: 100px; font-size: 1em; font-weight: 500; }

/*below is featured content*/

.seconddiv { position: relative;  display: inline-block;  text-align: center;  margin: 0;  padding: 0;  width: 100%;  margin-top: -20px; }
.featureddivs:hover { opacity: 0.7; }

.gradientdiv { position: relative;  display: inline-block;  margin: 0; padding: 0;  width: 100%;   height: 45%;  top: 55%;  background: -webkit-linear-gradient(top,rgba(0,0,0,0),rgba(0,0,0,1));  background: -o-linear-gradient(bottom,rgba(0,0,0,0),rgba(0,0,0,1));  background: -moz-linear-gradient(bottom,rgba(0,0,0,0),rgba(0,0,0,1));   background: linear-gradient(to bottom, rgba(0,0,0,0), rgba(0,0,0,1));  }

.featuredtitles { position: relative;  display: inline-block;  color: white; padding: 0;  margin: 0; font-weight: 700; }

.featureddates { position: relative;  display: inline-block;  color: white; padding: 0;  margin: 0; font-size: 0.7em; font-weight: 400; height: 1.0em; top: 50%;  margin-top: -0.5em; }

.featureddivss { position: relative;  display: inline-block;  margin: 0;  padding: 0;   float: left;  height: 270px;  width: 350px;  float: left;  overflow: hidden;  background-position: center;  background-size: 100% auto;  border: none;  border-style: solid;  border-color: white;  border-width: 1px;  box-sizing: border-box;  cursor: pointer; transition: 0.6s; transform-style: preserve-3d; background: transparent; }

.featuredcontentcontainer { position: relative; display: inline-block; width: 90%; height: 100%; }

.featuredcontent { position: absolute;  display: block;  padding: 0;  margin: 0; width: 68%; left: 20px; height: 80px; text-align: left; bottom: 0; }

.featuredtitlescontainer { position: relative;  display: inline-block; width: 100%;  height: 60%; padding: 0; margin: 0; }

.featureddatescontainer { position: relative;  display: inline-block; width: 100%;  height: 40%; padding: 0; margin: 0; }
.options-text { margin-left: 10px;  font-size: 0.8em;  font-weight: 300;  margin-right: 5px; }
/*done featured content*/



.register_basic .field-wrapper {display: inline-block; position: relative; margin: 20px; padding: 0; width: calc(50% - 40px); float: left; text-align: left; margin-bottom: 5px;}
			.register_basic .field-wrapper label {margin-bottom: 5px;}
			.register_basic .field-wrapper input { display: inline-block; position: relative; margin: 0px; padding: 10px; width: 100%; border: 0; border: 1px solid #e0e0e0; border-radius: 5px; background-color: white; float: left; height: 50px; font-weight: 300; font-size: 1.1em; background-color: rgba(255,255,255,0.2); border: 0; background-color: rgba(255, 255, 255, 0.6); border: 1px solid rgba(255, 255, 255, 0.2); font-weight: 500; color: white;}
				.register_basic .field-wrapper input::placeholder { color: white; font-weight: 300; }
				.register_basic input:focus {outline: none;}



</style>

		<!-- <div class='reusablepopbackground'>
			<div class='reusablepopview'>
				<button class=reusablepopclosebutton></button>
				<p class='reusablepoptitle'>title</p>
				<p class='reusablepopdesc'>desc</p>
			</div>
		</div> -->
		
		<div class=firstdiv style='font-family: Muli, sans-serif; position: relative; display: inline-block; margin: 0; margin-top: 0px; padding: 0; width: 100%; max-width: 1200px;  text-align: center; top: 50%; transform: translateY(-50%);'>
			
			<div class=firstmaincontent style='position: relative; display: inline-block; max-width: 1200px; width: 100%; text-align: center;'>
				
				<form class='register_basic' method='post' action='registeruser.php'>
					<div class='container' style='text-align: left; margin-top: 10px; margin-bottom: 30px; text-align: center;'>
					<h2 style="width: calc(100% - 0px); padding: 0px 0px; text-align: center; color: white; font-weight: 400;">Register</h2>
						<div class="field-wrapper">
							<!-- <label>First name:</label><br> -->
							<input type="text" name="first_name" placeholder="First Name" id="first_name">
						</div>

						<div class="field-wrapper">
							<!-- <label>Last name:</label><br> -->
							<input type="text" name="last_name" placeholder="Last Name" id="last_name">
						</div>

						<div class="field-wrapper" style="width: calc(100% - 40px);">
							<!-- <label>Email:</label><br> -->
							<input type="text" name="email" placeholder="Email" id="email">
						</div>
					<input type='submit' class='custombutton' style='background-color: #ff5719; width: 170px; margin-top: 10px; margin-bottom: 10px; cursor: pointer;'>
					</div>
				</form>
				
				
			</div>
			
		</div>

<script>
	$('#formimg').change(function(){
		ReusableGlobalFunctionsClass.readthisURL(this, $('#formlabel'), null, null);
		// alert($('#featuredpostimg').val());
	});
</script>
	
	