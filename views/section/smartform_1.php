<?php

namespace Reusables;

// exit( json_encode( $sectiondict['input_keys'] ) );
// exit( json_encode( $sectiondict ) );

if( !isset( $sectiondict['ifnone_insert'] ) ){
	$ifnone_insert = false;
}else{
	$ifnone_insert = $sectiondict['ifnone_insert'];
	unset( $sectiondict['ifnone_insert'] );
}

// its getting the index from the button order




// $sectiondict_value = Data::getValue( $sectiondict, 'value' );
// if( !Data::isAssoc( $sectiondict_value ) ){
// 	$sectiondict = $sectiondict['value'];
// }

// PROBLEM: not showing modal for array ( inputs are db_info, data_id, etc )
// exit( json_encode( $sectiondict['input_keys'] ) );

if( !isset( $sectiondict['input_keys'] ) ){ 
	if( isset( $sectiondict['value'] ) ){
		if ( !Data::isAssoc( $sectiondict['value'] ) ) {
			$input_keys = array_keys( $sectiondict['value'][0] );
		}else{
			$input_keys = array_keys( $sectiondict['value'] );
		}
	}else{
		$input_keys = array_keys( $sectiondict ); 
	}
	$input_keydicts = [];
}else{
	$input_keydicts = $sectiondict['input_keys'];
	$input_keys = array_keys($sectiondict['input_keys']);

	unset( $sectiondict['input_keys'] );
}

$input_onlykeys = [];

if( isset( $sectiondict[array_keys($sectiondict)[0]]['data_id'] ) ){
	$original_data_id = $sectiondict[array_keys($sectiondict)[0]]['data_id'];
}else{
	$original_data_id = $sectiondict['data_id'];
}
// exit( json_encode( $original_data_id ) );
// exit( json_encode( Data::getFullArray( $sectiondict ) ) );

extract( CustomView::makeFormVars( $sectiondict, "sectiondict" ) );
// exit( "hey" );

$steps = 1;

$inputs = array();
$i=0;
// exit( json_encode( $input_keys['download_script'] ) );
// exit( json_encode( $input_keys ) );
foreach ($input_keys as $ik) {
	// echo json_encode( $input_keydicts[ $ik ]['placeholder'] ) ;
	$placeholder = null; $labeltext = null; $type = null;
	if( isset( $input_keydicts[ $ik ]['step'] ) ){ $steps = $input_keydicts[ $ik ]['step']; }
	if( isset( $input_keydicts[ $ik ]['placeholder'] ) ){ $placeholder = $input_keydicts[ $ik ]['placeholder']; }else{ $placeholder = null; }
	if( isset( $input_keydicts[ $ik ]['labeltext'] ) ){ $labeltext = $input_keydicts[ $ik ]['labeltext']; }else{ $labeltext = null; }
	if( isset( $input_keydicts[ $ik ]['type'] ) ){ $type = $input_keydicts[ $ik ]['type']; }else{ $type = null; }
	// echo json_encode( $ik ) . ", " . json_encode( $input_keydicts[ $ik ]['viewtype'] ) . ". <br>";
	// if( !isset( $inputs['c' . $steps] ) ){ $inputs['c' . $steps] = array(); }
	$thekey = $ik;
	// exit( json_encode( $ik ) );
if( is_numeric( $ik ) ){ $thekey = $input_keydicts[$ik]; }
array_push( $input_onlykeys, $thekey );
// exit( json_encode( $sectiondict ) );
	array_push( 
		$inputs, 
		Input::fill( $sectiondict, $thekey, $i, $type, $placeholder, $labeltext, $identifier  )
	);
	$i++;
}


if( !isset( $sectiondict['formaction'] ) ){
	$formaction = '/edit_view.php';
}else{
	$formaction = $sectiondict['formaction'];
}
// exit( json_encode( $original_data_id ) );

?>


<style>
</style>

<form class='theform' method='post' action='<?php echo $formaction ?>' enctype='multipart/form-data'>
<?php if( $ifnone_insert ){ ?>
	<input type='hidden' name='ifnone_insert' value='1' >
<?php } ?>
<div class="<?php echo $identifier ?> smartform_1 main">
	<div class='thecontainer' style='text-align: left; margin-top: 10px; margin-bottom: 30px; text-align: center;'>
		<input type="hidden" name="goto" value="">
			<?php 

				echo Structure::make( 
					"structure_2",
					[
						"maincolumn" => $inputs
						
					],
					"main_structure smartform_1"
				);
			
			?>
		<button class="smartform_1 modalinner_1 save custombutton">Save</button>
		<?php /*if( $steps > 1 ){*/ ?>
			<!-- <button class="smartform_1 main_with_hidden next custombutton">Next</button> -->
			<!-- <button class="smartform_1 main_with_hidden save custombutton">Save</button> -->
		<?php /*}{*/ ?>
		<!-- <button class="smartform_1 main_with_hidden save custombutton">Save</button> -->
		<?php /*}*/ ?>
	</div>
</div>
</form>

<script>

	var sectiondict = <?php echo json_encode($sectiondict) ?>;
	var input_keys = <?php echo json_encode($input_onlykeys) ?>;
	var data_id = "<?php echo $data_id ?>";
	var original_data_id = "<?php echo $original_data_id ?>";
	// alert( JSON.stringify( original_data_id ) );
	var typearray = [];
	<?php foreach ($input_onlykeys as $k) { ?>
		<?php if( $k == "download_script" ){ ?>
			typearray.push( 'copybutton_1' );
		<?php }else{ ?>
			typearray.push( '<?php echo Input::getInputType( $k ) ?>' );
		<?php } ?>
	<?php } ?>

	var dataarray = <?php echo json_encode( Data::getFullArray( $sectiondict ) ) ?>;

	var formatteddata = <?php echo json_encode( Data::retrieveDataWithID( $original_data_id ) ) ?>;
	var identifier = "<?php echo $identifier ?>";

	class <?php echo $identifier ?>Classes {
		populateview(index=null){
			// alert( JSON.stringify( typearray ) )
			for (var i = 0; i < input_keys.length; i++) {
				var key = input_keys[i];

				var colname = formatteddata['db_info']['colnames'][key];
				var type = typearray[i];
				if(type=="textarea"){
					Reusable.updateTextArea( dataarray, "<?php echo $identifier ?>", "<?php echo $original_data_id ?>", key, "<?php echo $identifier ?>_"+key+"_input", colname, index );
				}else if(type=="wysi"){
					Reusable.updateWysi( dataarray, "<?php echo $identifier ?>", "<?php echo $original_data_id ?>", key, "<?php echo $identifier ?>_"+key+"_input", colname, index, i );
				}else if(type=="file_image"){
					Reusable.updateFileImage( dataarray, "<?php echo $identifier ?>", "<?php echo $original_data_id ?>", key, "<?php echo $identifier ?>_"+key+"_input", colname, index );
				}else if(type=="textfield"){
					Reusable.updateTextField( dataarray, "<?php echo $identifier ?>", "<?php echo $original_data_id ?>", key, "<?php echo $identifier ?>_"+key+"_input", colname, index );
				}else if(type=="colorpicker"){
					Reusable.updateColorPicker( dataarray, "<?php echo $identifier ?>", "<?php echo $original_data_id ?>", key, "<?php echo $identifier ?>_"+key+"_input", colname, index );
				}else if(type=="copybutton_1"){
					Reusable.updateCopyButton( dataarray, "<?php echo $identifier ?>", "<?php echo $original_data_id ?>", key, "<?php echo $identifier ?>_"+key+"_input", colname, index );
				}
			}
		}
	}

	if( <?php echo $identifier ?> !== undefined || <?php echo $identifier ?> !== null ) {
		let <?php echo $identifier ?> = new <?php echo $identifier ?>Classes();
		// <?php echo $identifier ?>.populateview();
	}


</script>
	
