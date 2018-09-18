<?php

namespace Reusables;

if( !isset($viewdict['field_conditions'] ) ){
	$viewdict['field_conditions'] = [];
}else if( $viewdict['field_conditions'] == "" ){
	$viewdict['field_conditions'] = [];
}

$options = Data::getValue( $viewdict, 'options' );
if( $options == "" ) {
	$options = [];
}

$is_smart = Data::getValue( $viewoptions, "is_smart" );

if( $is_smart == "" ) {
	$is_smart = true;
} else if( $is_smart == "0" ) {
	$is_smart = false;
}

$hides_element_array = Data::getValue( $viewoptions, "hides_element_array" );
if($identifier == "container_standalone") {

// exit( json_encode( $hides_element_array ) );
}
$size = Data::getValue( $viewdict, "size" );

if( $size == "" ) {
	$size = "large";
}
$sizeclass = "size_" . $size;

$placeholder = Data::getValue( $viewdict, 'placeholder' );
$labeltext = Data::getValue( $viewdict, 'labeltext' );
if( $labeltext == "" ) {
	$labeltext = Data::getValue( $viewoptions, 'labeltext' );
}
if( $labeltext == "" ) {
	$labeltext = ucfirst(str_replace("_", " ", $identifier));
}

$field_name = "fieldarray[" . Data::getValue( $viewdict, 'field_index') . "][field_value]";
if( !$is_smart ) {
	$field_name = Data::getValue( $viewdict, 'field_name' );
	if( $field_name == "" ) {
		$field_name = Data::getValue( $viewoptions, 'field_name' );
		if( $field_name == "" ) {
			$field_name = $identifier;
		}
	}
}

$input_name = Data::getValue($viewdict, 'input_name');

if( sizeof($options) == 0 ) {

	$options = [];
	foreach ($viewdict as $key => $value) {
	    if( !is_numeric($key) ) { break; }
	    if( !is_array($value) ) {
	        $title = $value;
	        // $value = ltrim($value, ' ');
	        // $value = rtrim($value, ' ');
	        $value = strtolower(str_replace(' ', '-', $value));
	        $value = ["title"=>$title, "value"=>$value];
	        array_push($options, $value);
	    } else {
	        array_push($options, $value);
	    }
	}
}

$help_modal = Data::getValue( $viewoptions, "help_modal" );
if( $help_modal != "" ) {
	$help_modal = $help_modal["modalclass"];
}

?>

<style>
	.<?php echo $identifier ?> .input_groupaddon { font-size: 14px; font-weight: 400; line-height: 1; color: #555; text-align: center; background-color: #eee; border: 1px solid #ccc; border-radius: 4px; width: 1%; width: 30px; white-space: nowrap; vertical-align: middle; display: table-cell; float: left; border-top-right-radius: 0; padding: 15.5px 0; border-bottom-right-radius: 0; }
	.<?php echo $identifier ?> .field_value.input_withaddon { border-top-left-radius: 0; border-bottom-left-radius: 0; width: calc( 100% - 30px); }
</style>

<div class="viewtype_input <?php echo $identifier ?> select <?php echo $sizeclass ?>">
	<?php
		Data::add( ["title" => $labeltext], $identifier . "_label" );
		Options::add( $help_modal, "help_modal", $identifier . "_label" );
		echo Header::make( "basic_label", $identifier . "_label" );
	?>

		<select class="field_value" name="<?php echo $field_name ?>" >
			<?php foreach($options as $o ) { ?>
				<option value="<?php echo $o['value'] ?>"><?php echo $o['title'] ?></option>
			<?php } ?>
		</select>

	<?php if( $is_smart ) { ?>
		<input type="hidden" class="field_type" name="fieldarray[<?php echo Data::getValue( $viewdict, 'field_index') ?>][field_type]" value="text" style="visibility: hidden; z-index: -1;">
		<input type="hidden" class="tablename" value="<?php echo Data::getValue( $viewdict, 'field_table') ?>" name="fieldarray[<?php echo Data::getValue( $viewdict, 'field_index') ?>][tablename]">
		<input type="hidden" class="col_name" value="<?php echo Data::getValue( $viewdict, 'field_colname') ?>" name="fieldarray[<?php echo Data::getValue( $viewdict, 'field_index') ?>][col_name]">
		<input type="hidden" class="field_name" value="<?php echo $input_name ?>" name="fieldarray[<?php echo Data::getValue( $viewdict, 'field_index') ?>][field_name]">
		<?php $i=0; ?>
		<?php foreach ($viewdict['field_conditions'] as $c) { ?>
			<input type="hidden" class="conditionkey_<?php echo $i ?>" value="<?php echo $c['key'] ?>" name="fieldarray[<?php echo Data::getValue( $viewdict, 'field_index') ?>][field_conditions][<?php echo $i ?>][key]">
			<input type="hidden" class="conditionvalue_<?php echo $i ?>" value="<?php echo $c['value'] ?>" name="fieldarray[<?php echo Data::getValue( $viewdict, 'field_index') ?>][field_conditions][<?php echo $i ?>][value]">
			<?php $i++; ?>
		<?php } ?>
	<?php } ?>
</div>

<script>

	$(".<?php echo $identifier ?> select.field_value").change(function () {

		var hides_element_array = <?php echo json_encode( $hides_element_array) ?>;

		$.each(hides_element_array, function(key, value) {
	        if( $( ".<?php echo $identifier ?> select.field_value option:selected" ).text() == key ) {
	        	$(value).hide();
	        } else {
	            $(value).show();
	        }
		})
    });
</script>
