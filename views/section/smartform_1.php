<?php

namespace Reusables;

// exit( json_encode( $sectiondict ) );
$input_keys = $sectiondict['input_keys'];
extract( CustomView::makeFormVars( $sectiondict, "sectiondict" ) );

if( !isset( $typearray ) ){ $typearray = null; }

$inputs = array();
$i=0;
foreach ($input_keys as $k) {
	$type=null;
	if( $typearray ){ $type = $typearray[$i]; }
	array_push( 
		$inputs, 
		Input::fill( $sectiondict, $k, $i, $type, null, null )
	);
	$i++;
}
	// exit( json_encode( $inputs ) );
?>


<style>
</style>

<div class="<?php echo $identifier ?> smartform_1 main">
	<div class='container' style='text-align: left; margin-top: 10px; margin-bottom: 30px; text-align: center;'>
		<input type="hidden" name="goto" value="userprofile">
			<?php 

				echo Structure::make( 
					"structure_2",
					[
						"maincolumn" => $inputs
						
					],
					"main_structure"
				);
			
			?>
		<button class="modalinner_1 save custombutton">Save</button>
	</div>
</div>

<script>

	var sectiondict = <?php echo json_encode($sectiondict) ?>;
	var input_keys = <?php echo json_encode($input_keys) ?>;
	var typearray = [];
	<?php foreach ($input_keys as $k) { ?>
		typearray.push( '<?php echo Input::getInputType( $k ) ?>' );
	<?php } ?>

	var dataarray = <?php echo json_encode( Data::getFullArray( $sectiondict ) ) ?>;
	var formatteddata = <?php echo json_encode( Data::retrieveDataWithID( $data_id ) ) ?>;
	var identifier = "<?php echo $identifier ?>";

	class <?php echo $identifier ?>Classes {
		populateview(index=null){

			for (var i = 0; i < input_keys.length; i++) {
				var key = input_keys[i];
				var colname = formatteddata['db_info']['colnames'][key];
				var type = typearray[i];
				if(type=="textarea"){
					Reusable.updateTextArea( dataarray, "<?php echo $identifier ?>", "<?php echo $data_id ?>", key, key+"_input", colname, index );
				}else if(type=="wysi"){
					Reusable.updateWysi( dataarray, "<?php echo $identifier ?>", "<?php echo $data_id ?>", key, key+"_input", colname, index, i );
				}else if(type=="file_image"){
					Reusable.updateFileImage( dataarray, "<?php echo $identifier ?>", "<?php echo $data_id ?>", key, key+"_input", colname, index );
				}else if(type=="textfield"){
					Reusable.updateTextField( dataarray, "<?php echo $identifier ?>", "<?php echo $data_id ?>", key, key+"_input", colname, index );
				}
			}

		}
	}

	if( <?php echo $identifier ?> !== undefined || <?php echo $identifier ?> !== null ) {
		let <?php echo $identifier ?> = new <?php echo $identifier ?>Classes();
		// <?php echo $identifier ?>.populateview();
	}


</script>
	
