<?php

namespace Reusables;



$is_smart = Data::getValue( $viewoptions, "is_smart" );

if( $is_smart == "" ) {
	$is_smart = true;
} else if( $is_smart == "0" ) {
	$is_smart = false;
}

if( !isset($viewdict['field_conditions'] ) ){
	$viewdict['field_conditions'] = [];
}else if( $viewdict['field_conditions'] == "" ){
	$viewdict['field_conditions'] = [];
}else if( sizeof($viewdict['field_conditions']) == 1 ) {
	if( sizeof($viewdict['field_conditions'][0]) == 0 ) {
		$viewdict['field_conditions'] = [];
	}
}

$size = Data::getValue( $viewdict, "size" );

if( $size == "" ) {
	$size = "large";
}
$sizeclass = "size_" . $size;

$help_modal = Data::getValue( $viewoptions, "help_modal" );
if( $help_modal != "" ) {
	$help_modal = $help_modal["modalclass"];
}

$labeltext = Data::getValue( $viewdict, "labeltext" );
if( $labeltext == "" ) {
	$labeltext = Data::getValue( $viewoptions, "labeltext" );
}

$is_multiple = Data::getValue( $viewdict, "multiple" );
if( $is_multiple == "" ) {
	$is_multiple = Data::getValue( $viewoptions, "multiple" );
}
if( in_array($is_multiple, ["1", 1, "true", true, "yes"]) ) {
	$is_multiple = true;
}
// exit(json_encode($identifier));

// $field_name = "fieldarray[" . Data::getValue( $viewdict, 'field_index') . "][field_value]";
$field_name = "fieldimage[" . Data::getValue( $viewdict, 'field_index') . "][field_value]";
if( !$is_smart ) {
	if( Data::getValue( $viewdict, 'field_name' ) != "" || Data::getValue( $viewoptions, 'field_name' ) ) {
		$field_name = Data::getValue( $viewdict, 'field_name' );
		if( $field_name == "" ) {
			$field_name = Data::getValue( $viewoptions, 'field_name' );
			if( $field_name == "" ) {
				$field_name = $identifier;
			}
		}
	}
}
$field_name_multiple = "fieldimage_multiple[" . Data::getValue( $viewdict, 'field_index') . "][field_value]";

$js_var = str_replace(".", "_", $identifier);


?>

<style>
</style>

<div class="viewtype_input <?php echo $identifier ?> file_image <?php echo $sizeclass ?>">
	<?php
		Data::add( ["title" => $labeltext], $identifier . "_label" );
		Options::add( $help_modal, "help_modal", $identifier . "_label" );
		echo Header::make( "basic_label", $identifier . "_label" );
	?>
	<div id="<?php echo $identifier ?>_file_image_image_container">
		<?php if($is_multiple) { ?>
			<label class="<?php echo $identifier ?>_add_button file_image_add_image_button file_image_look" for='<?php echo $identifier ?>_input_to_add' id='<?php echo $identifier ?>_imglabel'><span class="file_image_plus_sign">&#43;</span></label>
		<?php } ?>
		<label class="file_image file_image_look" id='imglabel' for='<?php echo $identifier ?>_field_value' style="background-image: url('<?php echo Data::getValue( $viewdict,'background-image') ?>');"></label>
	</div>
	<div id="<?php echo $identifier ?>_file_image_image_inputs_container" class="file_image_image_inputs_container">
		<input type="file" class="field_value <?php echo $js_var ?>_file_image_input" id="<?php echo $identifier ?>_field_value" value="<?php echo Data::getValue( $viewdict,'field_value') ?>" name="<?php echo $field_name ?>" style="visibility: hidden; z-index: -1;">
		<!-- <input type="file" class="field_value" id="<?php echo $identifier ?>_add_input" name="placeholder_field" style="visibility: hidden; z-index: -1;"> -->
		<input type="file" class="field_value <?php echo $js_var ?>_file_image_input" id="<?php echo $identifier ?>_input_to_add" name="<?php echo $field_name_multiple ?>[0]" style="visibility: hidden; z-index: -1;">
	</div>
	<input type="hidden" class="field_type" name="fieldimage[<?php echo Data::getValue( $viewdict,'field_index') ?>][field_type]" value="image_<?php echo Data::getValue( $viewdict,'field_index') ?>" style="visibility: hidden; z-index: -1;">
	<input type="hidden" class="tablename" value="<?php echo Data::getValue( $viewdict,'field_table') ?>" name="fieldimage[<?php echo Data::getValue( $viewdict,'field_index') ?>][tablename]">
	<input type="hidden" class="col_name" value="<?php echo Data::getValue( $viewdict,'field_colname') ?>" name="fieldimage[<?php echo Data::getValue( $viewdict,'field_index') ?>][col_name]">
	<?php $i=0; ?>
	<?php foreach ($viewdict['field_conditions'] as $c) { ?>
		<input type="hidden" class="conditionkey_<?php echo $i ?>" value="<?php echo $c['key'] ?>" name="fieldimage[<?php echo Data::getValue( $viewdict,'field_index') ?>][field_conditions][<?php echo $i ?>][key]">
		<input type="hidden" class="conditionvalue_<?php echo $i ?>" value="<?php echo $c['value'] ?>" name="fieldimage[<?php echo Data::getValue( $viewdict,'field_index') ?>][field_conditions][<?php echo $i ?>][value]">
		<?php $i++; ?>
	<?php } ?>
</div>

<script>
	var identifier = "<?php echo $identifier ?>";
		identifier = identifier.replace('.', '\\.')
	var <?php echo $js_var ?>_image_count = 0;
	$('#'+identifier+'_field_value').change(function(){
		var identifier = "<?php echo $identifier ?>";
		identifier = identifier.replace('.', '\\.')
		Reusable.readthisURL(this, $('.'+identifier+'').find('#imglabel'), null, null);
	});
	// $('.<?php echo $js_var ?>_file_image_input').change(function(){
	$('.<?php echo $js_var ?>_file_image_input').change(function(){
		var field_name_multiple = "fieldimage_multiple[<?php echo Data::getValue( $viewdict, 'field_index') ?>][field_value]";
		input_has_changed(this, '<?php echo $identifier ?>', field_name_multiple )
		// Reusable.changeMedia(this, identifier, '<?php echo $field_name_multiple ?>', <?php echo $js_var ?>_image_count, '<?php echo $js_var ?>');
	})

	function input_has_changed(view, identifier, field_name_multiple) {

		identifier_var = identifier.replace('.', '\\.')

		// var next_image_count = <?php echo $js_var ?>_image_count + 1;
		if( view.id == identifier+'_field_value' ) {
			Reusable.readthisURL(view, $('.'+identifier_var+'').find('#imglabel'), null, null);
		} else if( view.id == identifier+'_input_to_add' ) {
			Reusable.changeMedia(view, identifier, field_name_multiple, <?php echo $js_var ?>_image_count, '<?php echo $js_var ?>');
			<?php echo $js_var ?>_image_count++;
		} else {

			var this_image_count = view.id.replace('<?php echo $js_var ?>', '')
			this_image_count = this_image_count.replace('.', '_')
			Reusable.readthisURL(view, $('#'+this_image_count+'_imglabel'), null, null);
		}
	}

	$('.'+identifier+'.file_image .file_image_add_image_button#'+identifier+'_imglabel').click(function(e){

	});


	// $('#'+identifier+'_input_to_add').change(function(e){
	//
	// 	var identifier = "<?php echo $identifier ?>";
	// 	Reusable.changeMedia(this, identifier, '<?php echo $field_name_multiple ?>', <?php echo $js_var ?>_image_count, '<?php echo $js_var ?>');
	// 	<?php echo $js_var ?>_image_count++;
	// });

</script>
