<?php

namespace Reusables;

$data_id = Data::getDefaultDataID( $sectiondict );

$default_tablename = Data::getDefaultTableNameWithID( $data_id );

if( isset($sectiondict['index'] ) ){
	$sectiondict = Data::convertDataForArray( $sectiondict['data_id'], $sectiondict['index'] );
}

// exit( json_encode( Data::getConditions( $sectiondict['money'] ) ) );
// exit(json_encode($sectiondict));

// exit( json_encode( Data::getFullArray( $sectiondict ) ) );
	
?>


<style>
</style>

<div class="<?php echo $identifier ?> form_simple_1 main">
		<div class='container' style='text-align: left; margin-top: 10px; margin-bottom: 30px; text-align: center;'>
		<input type="hidden" name="goto" value="userprofile">
			<?php 

				echo Structure::make( 
					"structure_2",
					[
						"maincolumn" => array(
							Input::make( 
								"textfield", 
								[
									"placeholder"=>"Money",
									"labeltext"=>"Money",
									"field_value"=>"",
									"field_index"=>1,
									"field_table"=>$default_tablename,
									"field_colname"=>"custom_value",
									"field_conditions"=>Data::getConditions( $sectiondict['money'] )
								], 
								"money_input"
							)
						)
					],
					"main_structure"
				);
			

			?>
		<button class="modalinner_1 save custombutton">Save</button>
		</div>
</div>
<script>

	var sectiondict = <?php echo json_encode($sectiondict) ?>;
	var dataarray = <?php echo json_encode( Data::getFullArray( $sectiondict ) ) ?>;
	var identifier = "<?php echo $identifier ?>";

	class <?php echo $identifier ?>Classes {
		populateview(index=null){
// alert(JSON.stringify(dataarray));
			Reusable.updateTextField( dataarray, "<?php echo $identifier ?>", "<?php echo $data_id ?>", "money", "money_input", "custom_value", null );

		}
	}

	if(<?php echo $identifier ?> !== undefined || <?php echo $identifier ?> !== null) {
		let <?php echo $identifier ?> = new <?php echo $identifier ?>Classes();
		<?php echo $identifier ?>.populateview();
	}


</script>
	
