<?php

if(!isset($GLOBALS['isadmin'])){ $GLOBALS['isadmin']=false; }
// if(!isset($sectiondict[0]['formdesc'])){ $sectiondict[0]['formdesc']=""; }

$optionsarray = array( "Brand Engagement", "Core Partner", "Concert Promotion", "Business Promotion" );

$data_id = Data::getDefaultDataID( $sectiondict );

$formstep = $sectiondict['step'];
$default_tablename = Data::getDefaultTableNameWithID( $data_id );

if( isset($sectiondict['index'] ) ){
	$sectiondict = Data::convertDataForArray( $sectiondict['data_id'], $sectiondict['index'] );
}

// exit( json_encode( Data::getConditions( $sectiondict['profile-pic'] ) ) );
// exit(json_encode($sectiondict));

// exit( json_encode( Data::getFullArray( $sectiondict ) ) );
	
?>


<style>
</style>

<div class="<?php echo $identifier ?> form_withsteps">
		<div class='container' style='text-align: left; margin-top: 10px; margin-bottom: 30px; text-align: center;'>
		<input type="hidden" name="goto" value="userprofile">
			<?php 

			if($formstep==1){
				echo Structure::make( 
					"structure_1",
					[
						"maincolumn" => array(
							Input::make(
								"file_image",
								[
									"background-image"=>"",
									"field_value"=>"",
									"field_index"=>0,
									"field_table"=>$default_tablename,
									"field_colname"=>"custom_value",
									"field_conditions"=>Data::getConditions( $sectiondict['profile-pic'] )
								],
								"profilepic_input"
							)
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
												"field_value"=>"",
												"field_index"=>1,
												"field_table"=>$default_tablename,
												"field_colname"=>"custom_value",
												"field_conditions"=>Data::getConditions( $sectiondict['my-name'] )
											], 
											"myname_input"
										),
										Input::make( 
											"textfield",
											[
												"placeholder"=>"Your Funding Goal",
												"field_value"=>"",
												"field_index"=>2,
												"field_table"=>$default_tablename,
												"field_colname"=>"custom_value",
												"field_conditions"=>Data::getConditions( $sectiondict['i-do'] )
											], 
											"ido_input"
										)
									)
								],
								"fieldwrapper"
							)
						)
					],
					"stepone-structure"
				);
			}else if($formstep==2){
				echo Structure::make( 
					"structure_2",
					[
						"maincolumn" => array(
							Structure::make( 
								"fieldwrapper", 
								[
									"size" => "large",
									"maincolumn" => array(
										Input::make( 
											"wysi",
											[
												"placeholder"=>"",
												"field_value"=>"",
												"field_index"=>3,
												"field_table"=>$default_tablename,
												"field_colname"=>"custom_value",
												"field_conditions"=>Data::getConditions( $sectiondict['editor1'] )
											], 
											"editor1_input"
										)
									)
								],
								"fieldwrapper"
							)
						)
					],
					"steptwo-structure"
				);
			}else if($formstep==3){
				echo Structure::make(
					"structure_2",
					[
						"maincolumn" => array(
							""
						)
					],
					"stepthree-structure"
				);
			}

			?>
		<!-- <input type='submit' class='custombutton' value='Next'> -->
		<button class="main_with_hidden next custombutton">Next</button>
		<button class="main_with_hidden save custombutton" style="display: none;">Save</button>
		</div>
</div>
<script>

	var sectiondict = <?php echo json_encode($sectiondict) ?>;
	var dataarray = <?php echo json_encode( Data::getFullArray( $sectiondict ) ) ?>;
	var identifier = "<?php echo $identifier ?>";
	var step = <?php echo $formstep ?>;

	class <?php echo $identifier ?>Classes {
		populateview(index=null){
			Reusable.updateFileImage( dataarray, "<?php echo $identifier ?>", "<?php echo $data_id ?>", "profile-pic", "profilepic_input", "custom_value", null );
			Reusable.updateTextField( dataarray, "<?php echo $identifier ?>", "<?php echo $data_id ?>", "my-name", "myname_input", "custom_value", null );
			Reusable.updateTextField( dataarray, "<?php echo $identifier ?>", "<?php echo $data_id ?>", "i-do", "ido_input", "custom_value", null );

			// wysi needs an fieldindex too
			Reusable.updateWysi( dataarray, "<?php echo $identifier ?>", "<?php echo $data_id ?>", "editor1", "editor1_input", "custom_value", null, 3 );
		}
	}

	if(<?php echo $identifier ?> !== undefined || <?php echo $identifier ?> !== null) {
		let <?php echo $identifier ?> = new <?php echo $identifier ?>Classes();
		<?php echo $identifier ?>.populateview();
	}


</script>
	
