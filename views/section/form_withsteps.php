<?php

if(!isset($GLOBALS['isadmin'])){ $GLOBALS['isadmin']=false; }
if(!isset($sectiondict['formdesc'])){ $sectiondict['formdesc']=""; }

$optionsarray = array( "Brand Engagement", "Core Partner", "Concert Promotion", "Business Promotion" );


if( !isset($sectiondict['formimg']) ){ $sectiondict['formimg'] = 'reusables/uploads/icons/adgoeshere970250.png'; }

?>


<style>


.<?php echo $identifier ?> { display: inline-block; position: relative; margin: 0; padding: 0; }
.<?php echo $identifier ?> .field-wrapper { display: inline-block; position: relative; margin: 20px; padding: 0; width: calc(50% - 40px); float: left; text-align: left; margin-bottom: 5px; }
	.<?php echo $identifier ?> .field-wrapper label { margin-bottom: 5px; }
	.<?php echo $identifier ?> .field-wrapper input { display: inline-block; position: relative; margin: 0px; padding: 10px; width: 100%; border: 0; border: 1px solid #e0e0e0; border-radius: 5px; background-color: white; float: left; height: 50px; font-weight: 300; font-size: 1.1em; background-color: rgba(255,255,255,0.2); border: 0; background-color: rgba(255, 255, 255, 0.6); border: 1px solid rgba(255, 255, 255, 0.2); font-weight: 500; color: white; }
		.<?php echo $identifier ?> .field-wrapper input::placeholder { color: white; font-weight: 300; }
		.<?php echo $identifier ?> input:focus { outline: none; }
			.<?php echo $identifier ?> .stepone-structure .maincolumn { width: calc(30% - 20px); float: left; }
			.<?php echo $identifier ?> .stepone-structure .sidecolumn_right { width: calc(70% - 20px); float: left; }
	.<?php echo $identifier ?> #imglabel { display: inline-block; position: relative; margin: 0; padding: 0; width: 100%; padding-bottom: 100%; border: 0; border-radius: 5px; overflow: hidden; background-size: cover; background-position: center; background-repeat: no-repeat; cursor: pointer; }
	.<?php echo $identifier ?> .fieldwrapper { margin: 0 20px; }
	.<?php echo $identifier ?> .campaignedit-firstinstruction { padding: 0 40px; }
	.<?php echo $identifier ?> .custombutton { display: inline-block; position: relative; margin: 0; padding: 20px; -webkit-appearance: none; border: 0; border-radius: 5px; background-color: green; color: white; width: calc(100% - 20px); font-size: 15px; font-weight: 500; cursor: pointer; }

</style>

<div class="<?php echo $identifier ?>">
	<form class='theform' method='post' action='#' enctype="multipart/form-data">
		<div class='container' style='text-align: left; margin-top: 10px; margin-bottom: 30px; text-align: center;'>
			<?php 
			echo Structure::make( 
				"structure_1",
				[
					"maincolumn" => array(
						"
							<label id='imglabel' for='formimg' style='background-image: url(".$sectiondict['formimg'].");'></label>
							<input type='file' id='formimg' style='visibility: hidden; z-index: -1; '>
						"
					),
					"sidecolumn_right" => array(
						Structure::make( 
							"fieldwrapper", 
							[
								"size" => "large",
								"maincolumn" => array(
									Input::make( 
										"textfield", 
										[
											"placeholder"=>"Campaign Name",
											"fieldvalue"=>"New bus/coach for away games",
											"fieldname"=>"campaign_name"
										], 
										"campaign_name"
									),
									Input::make( 
										"textfield",
										[
											"placeholder"=>"Your Funding Goal",
											"fieldvalue"=>"40000",
											"fieldname"=>"funding_goal"
										], 
										"funding_goal"
									)
								)
							],
							"fieldwrapper"
						)
					)
				],
				"stepone-structure"
			);

			?>
		<input type='submit' class='custombutton' value='Next'>
		</div>
	</form>
</div>
<script>
	$('#formimg').change(function(){
		ReusableGlobalFunctionsClass.readthisURL(this, $('#imglabel'), null, null);

	});
</script>
	
