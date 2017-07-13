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
// exit( json_encode( getFullArray( $sectiondict ) ) );

// 	function getFullArray( $viewdict )
// 	{
// 		$allkeys = array_keys($viewdict);
// 		$dataidarray = array();
// 		// exit(json_encode($viewdict));
// 		foreach ($allkeys as $k) {
// 			$dataid = $viewdict[$k]['data_id'];
// 			if ($dataid != null) {
// 				if( !isset( $dataidarray[ $dataid ] ) ){ 
// 					$dataidarray[ $dataid ] = Data::retrieveDataWithID( $dataid ); 
// 				}
// 			}
// 		}
// 		return $dataidarray;
// 	}

?>


<style>
</style>

<div class="<?php echo $identifier ?> form_editnetwork">
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
									"field_table"=>"",
									"field_colname"=>"",
									"field_conditions"=>Data::getConditions( $sectiondict['logo_imagepath'] )
								],
								"networklogo_input"
							)
						)
					],
					"form_networklogo_structure"
				);

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
											"textfield", 
											[
												"placeholder"=>"Organization Name",
												"field_value"=>"",
												"field_index"=>1,
												"field_table"=>"",
												"field_colname"=>"",
												"field_conditions"=>Data::getConditions( $sectiondict['network_name'] )
											], 
											"networkname_input"
										)
									)
								],
								"fieldwrapper"
							),
							Structure::make( 
								"fieldwrapper", 
								[
									"size" => "large",
									"maincolumn" => array(
										Input::make( 
											"textfield", 
											[
												"placeholder"=>"Address",
												"field_value"=>"",
												"field_index"=>2,
												"field_table"=>"",
												"field_colname"=>"",
												"field_conditions"=>Data::getConditions( $sectiondict['address'] )
											], 
											"address_input"
										)
									)
								],
								"fieldwrapper"
							),
							Structure::make( 
								"fieldwrapper", 
								[
									"size" => "small",
									"maincolumn" => array(
										Input::make( 
											"textfield",
											[
												"placeholder"=>"City",
												"field_value"=>"",
												"field_index"=>3,
												"field_table"=>"",
												"field_colname"=>"",
												"field_conditions"=>Data::getConditions( $sectiondict['city'] )
											], 
											"city_input"
										),
										Input::make( 
											"textfield",
											[
												"placeholder"=>"Zip Code",
												"field_value"=>"",
												"field_index"=>4,
												"field_table"=>"",
												"field_colname"=>"",
												"field_conditions"=>Data::getConditions( $sectiondict['zip'] )
											], 
											"zip_input"
										)
									)
								],
								"fieldwrapper"
							),
							Structure::make( 
								"fieldwrapper", 
								[
									"size" => "large",
									"maincolumn" => array(
										Input::make( 
											"textfield", 
											[
												"placeholder"=>"slug",
												"field_value"=>"",
												"field_index"=>5,
												"field_table"=>"",
												"field_colname"=>"",
												"field_conditions"=>Data::getConditions( $sectiondict['slug'] )
											], 
											"slug_input"
										)
									)
								],
								"fieldwrapper"
							)
						)
					],
					"form_networkedit_structure"
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
	// alert(JSON.stringify(dataarray));
	var identifier = "<?php echo $identifier ?>";
	class <?php echo $identifier ?>Classes {
		populateview(index=null){
			var thisdict = [];
			if(index == null){ thisdict = sectiondict; }else { thisdict = sectiondict[index]; }

			Reusable.updateFileImage( dataarray, "<?php echo $identifier ?>", "network_info", "logo_imagepath", "networklogo_input", "maininfo_value", index );

			Reusable.updateTextField( dataarray, "<?php echo $identifier ?>", "network", "name", "networkname_input", "name", index );
			Reusable.updateTextField( dataarray, "<?php echo $identifier ?>", "network_info", "address", "address_input", "maininfo_value", index );
			Reusable.updateTextField( dataarray, "<?php echo $identifier ?>", "network_info", "city", "city_input", "maininfo_value", index );
			Reusable.updateTextField( dataarray, "<?php echo $identifier ?>", "network_info", "zip", "zip_input", "maininfo_value", index );
			Reusable.updateTextField( dataarray, "<?php echo $identifier ?>", "network_info", "slug", "slug_input", "maininfo_value", index );
		}
	}
	let <?php echo $identifier ?> = new <?php echo $identifier ?>Classes();
	<?php echo $identifier ?>.populateview();
</script>
	
