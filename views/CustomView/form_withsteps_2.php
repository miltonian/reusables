<?php

namespace Reusables;

if(!isset($GLOBALS['isadmin'])){ $GLOBALS['isadmin']=false; }


	
?>


<style>
</style>

<div class="<?php echo $identifier ?> form_withsteps">
		<div class='container' style='text-align: left; margin-top: 10px; margin-bottom: 30px; text-align: center;'>
		<input type="hidden" name="goto" value="userprofile">
			<?php 

			if($formstep==1){
				echo \Reusables\Structure::make( 
					"structure_1",
					[
						"maincolumn" => array(
							\Reusables\Input::make(
								"file_image",
								[
									"labeltext"=>"Profile Picture",
									"background-image"=>"",
									"field_value"=>"",
									"field_index"=>0,
									"field_table"=>$default_tablename,
									"field_colname"=>"custom_value",
									"field_conditions"=>\Reusables\Data::getConditions( $customviewdict['profile-pic'] )
								],
								"profilepic_input"
							)
						),
						"sidecolumn_right" => array(
							\Reusables\Structure::make( 
								"fieldwrapper", 
								[
									"size" => "large",
									"maincolumn" => array(
										\Reusables\Input::make( 
											"textfield", 
											[
												"placeholder"=>"Your Name",
												"labeltext"=>"Your Name",
												"field_value"=>"",
												"field_index"=>1,
												"field_table"=>$default_tablename,
												"field_colname"=>"custom_value",
												"field_conditions"=>\Reusables\Data::getConditions( $customviewdict['my-name'] )
											], 
											"myname_input"
										),
										\Reusables\Input::make( 
											"textfield",
											[
												"placeholder"=>"What You Do",
												"labeltext"=>"What You Do",
												"field_value"=>"",
												"field_index"=>2,
												"field_table"=>$default_tablename,
												"field_colname"=>"custom_value",
												"field_conditions"=>\Reusables\Data::getConditions( $customviewdict['i-do'] )
											], 
											"ido_input"
										),
										\Reusables\Input::make( 
											"textfield",
											[
												"placeholder"=>"Your Email",
												"labeltext"=>"Your Email",
												"field_value"=>"",
												"field_index"=>3,
												"field_table"=>$default_tablename,
												"field_colname"=>"custom_value",
												"field_conditions"=>\Reusables\Data::getConditions( $customviewdict['contactemail'] )
											], 
											"contactemail_input"
										),
										\Reusables\Input::make( 
											"textfield",
											[
												"placeholder"=>"Your Phone Number",
												"labeltext"=>"Your Phone Number",
												"field_value"=>"",
												"field_index"=>4,
												"field_table"=>$default_tablename,
												"field_colname"=>"custom_value",
												"field_conditions"=>\Reusables\Data::getConditions( $customviewdict['contactphone'] )
											], 
											"contactphone_input"
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
				echo \Reusables\Structure::make( 
					"structure_2",
					[
						"maincolumn" => array(
							\Reusables\Structure::make( 
								"fieldwrapper", 
								[
									"size" => "large",
									"maincolumn" => array(
										\Reusables\Input::make( 
											"wysi",
											[
												"labeltext"=>"Tell Us About Yourself",
												"placeholder"=>"",
												"field_value"=>"",
												"field_index"=>5,
												"field_table"=>$default_tablename,
												"field_colname"=>"custom_value",
												"field_conditions"=>\Reusables\Data::getConditions( $customviewdict['editor1'] )
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
				echo \Reusables\Structure::make( 
					"structure_2",
					[
						"maincolumn" => array(
							\Reusables\Structure::make( 
								"fieldwrapper", 
								[
									"size" => "small",
									"maincolumn" => array(
										\Reusables\Input::make( 
											"textfield",
											[
												"placeholder"=>"Skill Name #1",
												"labeltext"=>"Skill Name #1",
												"field_value"=>"",
												"field_index"=>6,
												"field_table"=>$default_tablename,
												"field_colname"=>"custom_value",
												"field_conditions"=>\Reusables\Data::getConditions( $customviewdict['skillname0'] )
											], 
											"skillname0_input"
										)
									),
								],
								"fieldwrapper"
							),
							\Reusables\Structure::make( 
								"fieldwrapper", 
								[
									"size" => "medium",
									"maincolumn" => array(
										\Reusables\Input::make( 
											"textfield",
											[
												"placeholder"=>"Skill Value #1",
												"labeltext"=>"Skill Value #1",
												"field_value"=>"",
												"field_index"=>7,
												"field_table"=>$default_tablename,
												"field_colname"=>"custom_value",
												"field_conditions"=>\Reusables\Data::getConditions( $customviewdict['skillvalue0'] )
											], 
											"skillvalue0_input"
										)
									),
								],
								"fieldwrapper"
							),
							\Reusables\Structure::make( 
								"fieldwrapper", 
								[
									"size" => "small",
									"maincolumn" => array(
										\Reusables\Input::make( 
											"textfield",
											[
												"placeholder"=>"Skill Name #1",
												"labeltext"=>"Skill Name #1",
												"field_value"=>"",
												"field_index"=>8,
												"field_table"=>$default_tablename,
												"field_colname"=>"custom_value",
												"field_conditions"=>\Reusables\Data::getConditions( $customviewdict['skillvalue1'] )
											], 
											"skillname1_input"
										)
									),
								],
								"fieldwrapper"
							),
							\Reusables\Structure::make( 
								"fieldwrapper", 
								[
									"size" => "medium",
									"maincolumn" => array(
										\Reusables\Input::make( 
											"textfield",
											[
												"placeholder"=>"Skill Value #1",
												"labeltext"=>"Skill Value #1",
												"field_value"=>"",
												"field_index"=>9,
												"field_table"=>$default_tablename,
												"field_colname"=>"custom_value",
												"field_conditions"=>\Reusables\Data::getConditions( $customviewdict['skillvalue1'] )
											], 
											"skillvalue1_input"
										)
									),
								],
								"fieldwrapper"
							),
							\Reusables\Structure::make( 
								"fieldwrapper", 
								[
									"size" => "small",
									"maincolumn" => array(
										\Reusables\Input::make( 
											"textfield",
											[
												"placeholder"=>"Skill Name #2",
												"labeltext"=>"Skill Name #2",
												"field_value"=>"",
												"field_index"=>10,
												"field_table"=>$default_tablename,
												"field_colname"=>"custom_value",
												"field_conditions"=>\Reusables\Data::getConditions( $customviewdict['skillvalue2'] )
											], 
											"skillname2_input"
										)
									),
								],
								"fieldwrapper"
							),
							\Reusables\Structure::make( 
								"fieldwrapper", 
								[
									"size" => "medium",
									"maincolumn" => array(
										\Reusables\Input::make( 
											"textfield",
											[
												"placeholder"=>"Skill Value #3",
												"labeltext"=>"Skill Value #3",
												"field_value"=>"",
												"field_index"=>11,
												"field_table"=>$default_tablename,
												"field_colname"=>"custom_value",
												"field_conditions"=>\Reusables\Data::getConditions( $customviewdict['skillvalue2'] )
											], 
											"skillvalue2_input"
										)
									),
								],
								"fieldwrapper"
							)
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

	var customviewdict = <?php echo json_encode($customviewdict) ?>;
	var dataarray = <?php echo json_encode( \Reusables\Data::getFullArray( $customviewdict ) ) ?>;
	var identifier = "<?php echo $identifier ?>";
	var step = <?php echo $formstep ?>;

	class <?php echo $identifier ?>Classes {
		populateview(index=null){
			Reusable.updateFileImage( dataarray, "<?php echo $identifier ?>", "<?php echo $data_id ?>", "profile-pic", "profilepic_input", "custom_value", null );
			Reusable.updateTextField( dataarray, "<?php echo $identifier ?>", "<?php echo $data_id ?>", "my-name", "myname_input", "custom_value", null );
			Reusable.updateTextField( dataarray, "<?php echo $identifier ?>", "<?php echo $data_id ?>", "i-do", "ido_input", "custom_value", null );
			Reusable.updateTextField( dataarray, "<?php echo $identifier ?>", "<?php echo $data_id ?>", "contactemail", "contactemail_input", "custom_value", null );
			Reusable.updateTextField( dataarray, "<?php echo $identifier ?>", "<?php echo $data_id ?>", "contactphone", "contactphone_input", "custom_value", null );

			// wysi needs an fieldindex too
			Reusable.updateWysi( dataarray, "<?php echo $identifier ?>", "<?php echo $data_id ?>", "editor1", "editor1_input", "custom_value", null, 5 );



			Reusable.updateTextField( dataarray, "<?php echo $identifier ?>", "<?php echo $data_id ?>", "skillname0", "skillname0_input", "custom_value", null );
			Reusable.updateTextField( dataarray, "<?php echo $identifier ?>", "<?php echo $data_id ?>", "skillvalue0", "skillvalue0_input", "custom_value", null );

			Reusable.updateTextField( dataarray, "<?php echo $identifier ?>", "<?php echo $data_id ?>", "skillname1", "skillname1_input", "custom_value", null );
			Reusable.updateTextField( dataarray, "<?php echo $identifier ?>", "<?php echo $data_id ?>", "skillvalue1", "skillvalue1_input", "custom_value", null );

			Reusable.updateTextField( dataarray, "<?php echo $identifier ?>", "<?php echo $data_id ?>", "skillname2", "skillname2_input", "custom_value", null );
			Reusable.updateTextField( dataarray, "<?php echo $identifier ?>", "<?php echo $data_id ?>", "skillvalue2", "skillvalue2_input", "custom_value", null );
		}
	}

	if(<?php echo $identifier ?> !== undefined || <?php echo $identifier ?> !== null) {
		let <?php echo $identifier ?> = new <?php echo $identifier ?>Classes();
		<?php echo $identifier ?>.populateview();
	}


</script>
	
