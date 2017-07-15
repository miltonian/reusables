<?php

namespace Reusables;

if(!isset($GLOBALS['isadmin'])){ $GLOBALS['isadmin']=false; }
// if(!isset($sectiondict[0]['formdesc'])){ $sectiondict[0]['formdesc']=""; }

// $optionsarray = array( "Brand Engagement", "Core Partner", "Concert Promotion", "Business Promotion" );

// if( !isset($sectiondict[0]['featured_imagepath']) ){ $sectiondict[0]['featured_imagepath'] = 'reusables/uploads/icons/adgoeshere970250.png'; }
if(isset($sectiondict['index'])){
	$sectiondict = Data::convertDataForArray( $sectiondict['data_id'], $sectiondict['index'] );
}
// exit(json_encode( json_encode( Data::getFullArray( $sectiondict ) ) ));
// exit(json_encode($sectiondict));
// exit( json_encode( $identifier ) );

?>


<style>
</style>

<div class="<?php echo $identifier ?> form_editpage">
	<form class='theform' method='post' action='/edit_view.php' enctype="multipart/form-data">
		<div class='container' style='text-align: left; margin-top: 10px; margin-bottom: 30px; text-align: center;'>
			<input type="hidden" name="goto" value="admin/settings">
			<?php 
				echo Structure::make(
					"structure_2",
					[
						"maincolumn" => array(
							Input::make(
								"file_image",
								[
									"background-image"=>"",
									"field_value"=>"",
									"field_index"=>0,
									"field_table"=>"network_info",
									"field_colname"=>"maininfo_value",
									"field_conditions"=>Data::getConditions( $sectiondict['featured_imagepath'] )
								],
								"networkimage_input"
							)
						)
					],
					"form_networkimage_structure"
				);

				echo Structure::make( 
					"structure_1",
					[
						"maincolumn" => array(
							Input::make(
								"file_image",
								[
									"background-image"=>"",
									"field_value"=>"",
									"field_index"=>1,
									"field_table"=>"network_info",
									"field_colname"=>"maininfo_value",
									"field_conditions"=>Data::getConditions( $sectiondict['headshot_image'] )
								],
								"letterimage_input"
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
												"placeholder"=>"Letter Title",
												"field_value"=>"",
												"field_index"=>2,
												"field_table"=>"network_info",
												"field_colname"=>"maininfo_value",
												"field_conditions"=>Data::getConditions( $sectiondict['welcome_title'] )
											], 
											"lettertitle_input"
										),
										Input::make( 
											"textfield",
											[
												"placeholder"=>"Letter Description",
												"field_value"=>"",
												"field_index"=>3,
												"field_table"=>"network_info",
												"field_colname"=>"maininfo_value",
												"field_conditions"=>Data::getConditions( $sectiondict['welcome_text'] )
											], 
											"letterdesc_input"
										)
									)
								],
								"fieldwrapper"
							)
						)
					],
					"form_lettersection_structure"
				);

			?>
		<input type='submit' class='custombutton' value='Next'>
		</div>
	</form>
</div>
<script>
	var sectiondict = <?php echo json_encode($sectiondict) ?>;
	var tablenames = <?php echo json_encode($tablenames) ?>;
	var dataarray = <?php echo json_encode( Data::getFullArray( $sectiondict ) ) ?>;
	var identifier = "<?php echo $identifier ?>";

	class <?php echo $identifier ?>Classes {
		populateview(index=null){
			var thisdict = [];
			if(index == null){ thisdict = sectiondict; }else { thisdict = sectiondict[index]; }

			Reusable.updateFileImage( dataarray, "<?php echo $identifier ?>", "network_info", "featured_imagepath", "networkimage_input", "maininfo_value", index );
			Reusable.updateFileImage( dataarray, "<?php echo $identifier ?>", "network_info", "headshot_image", "letterimage_input", "maininfo_value", index );
			
			Reusable.updateTextField( dataarray, "<?php echo $identifier ?>", "network_info", "welcome_title", "lettertitle_input", "maininfo_value", index );
			Reusable.updateTextField( dataarray, "<?php echo $identifier ?>", "network_info", "welcome_text", "letterdesc_input", "maininfo_value", index );
		}
	}
	let <?php echo $identifier ?> = new <?php echo $identifier ?>Classes();
	<?php echo $identifier ?>.populateview();
</script>
	
