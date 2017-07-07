<?php

if(!isset($GLOBALS['isadmin'])){ $GLOBALS['isadmin']=false; }
// if(!isset($sectiondict[0]['formdesc'])){ $sectiondict[0]['formdesc']=""; }

$optionsarray = array( "Brand Engagement", "Core Partner", "Concert Promotion", "Business Promotion" );

// if( !isset($sectiondict[0]['featured_imagepath']) ){ $sectiondict[0]['featured_imagepath'] = 'reusables/uploads/icons/adgoeshere970250.png'; }
if( isset($sectiondict['index'] ) ){
	$sectiondict = Data::convertDataForArray( $sectiondict['data_id'], $sectiondict['index'] );
}
// exit(json_encode( json_encode( Data::getFullArray( $sectiondict ) ) ));
// exit(json_encode( Data::getConditions( $sectiondict['featured_imagepath'] ) ));
?>


<style>
</style>

<div class="<?php echo $identifier ?> form_withsteps">
	<form class='theform' method='post' action='/edit_view.php' enctype="multipart/form-data">
		<div class='container' style='text-align: left; margin-top: 10px; margin-bottom: 30px; text-align: center;'>
		<input type="hidden" name="goto" value="admin/campaigns">
			<?php 
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
								"field_table"=>"posts",
								"field_colname"=>"featured_imagepath",
								"field_conditions"=>Data::getConditions( $sectiondict['featured_imagepath'] )
							],
							"campaign_featuredimage"
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
											"field_table"=>"posts",
											"field_colname"=>"title",
											"field_conditions"=>Data::getConditions( $sectiondict['title'] )
										], 
										"campaign_name"
									),
									Input::make( 
										"textfield",
										[
											"placeholder"=>"Your Funding Goal",
											"field_value"=>"",
											"field_index"=>2,
											"field_table"=>"posts",
											"field_colname"=>"needed",
											"field_conditions"=>Data::getConditions( $sectiondict['needed'] )
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
	var sectiondict = <?php echo json_encode($sectiondict) ?>;
	var dataarray = <?php echo json_encode( Data::getFullArray( $sectiondict ) ) ?>;
	var identifier = "<?php echo $identifier ?>";
	class <?php echo $identifier ?>Classes {
		populateview(index=null){
			//this needs to include thisdictvalue instead of whatever its pulling

			Reusable.updateFileImage( dataarray, "<?php echo $identifier ?>", "postarray", "featured_imagepath", "campaign_featuredimage", "featured_imagepath", index );
			Reusable.updateTextField( dataarray, "<?php echo $identifier ?>", "postarray", "title", "campaign_name", "title", index );
			Reusable.updateTextField( dataarray, "<?php echo $identifier ?>", "postarray", "needed", "funding_goal", "needed", index );
		}
	}
	let <?php echo $identifier ?> = new <?php echo $identifier ?>Classes();
	<?php echo $identifier ?>.populateview();
</script>
	
