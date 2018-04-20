<?php

namespace Reusables;
	
	$required = array(
		"placeholder"=>"",
		"field_value"=>"",
		"field_index"=>"",
		"field_table"=>"",
		"field_colname"=>"",
		// "field_rowid"=>""
		"field_conditions"=>[]
	);



$labeltext = Data::getValue( $viewdict, "labeltext" );
$placeholder = Data::getValue( $viewdict, "placeholder" );
$field_value = Data::getValue( $viewdict, "field_value" );
$size = Data::getValue( $viewdict, "size" );
$is_hidden = Data::getValue( $viewdict, "is_hidden" );

$is_smart = Data::getValue( $viewoptions, "is_smart" );
if( $is_smart == "" ) {
	$is_smart = true;
} else {
	$is_smart = false;
}

if( $labeltext == "" && $placeholder=="" && $field_value=="" && $size == "" && $is_hidden == "" ) {

	$is_hidden = Data::getValue( $viewoptions, "is_hidden" );
	$size = Data::getValue( $viewoptions, "size" );
	$labeltext = Data::getValue( $viewoptions, "labeltext" );
	$placeholder = Data::getValue( $viewoptions, "placeholder" );
	$field_value = Data::getValue( $viewoptions, "field_value" );
}

if( $placeholder == "" ) {
	$placeholder = ucfirst(str_replace("_", " ", $identifier));
}
if( $labeltext == "" ) {
	$labeltext = ucfirst(str_replace("_", " ", $identifier));
}

if( !isset($viewdict['field_conditions'] ) ){
	$viewdict['field_conditions'] = [];
}else if( $viewdict['field_conditions'] == "" ){
	$viewdict['field_conditions'] = [];
}


if( $size == "" ) {
	$size = "large";
}
$sizeclass = "size_" . $size;

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

// exit( json_encode( $identifier ) );


?>

<style>
</style>

<div class="viewtype_input <?php echo $identifier ?> textarea <?php echo $sizeclass ?>">
	<label style="margin-bottom: -5px; /* font-weight: 700; font-size: 11px; */"><?php echo $labeltext ?></label>
	<textarea class="field_value" name="<?php echo $field_name ?>"><?php echo $field_value ?></textarea>
	
	<?php if( $is_smart ) { ?>
		<input type="hidden" class="field_type" name="fieldarray[<?php echo Data::getValue( $viewdict,'field_index') ?>][field_type]" value="text" style="visibility: hidden; z-index: -1;">
		<input type="hidden" class="tablename" value="<?php echo Data::getValue( $viewdict,'field_table') ?>" name="fieldarray[<?php echo Data::getValue( $viewdict,'field_index') ?>][tablename]">
		<input type="hidden" class="col_name" value="<?php echo Data::getValue( $viewdict,'field_colname') ?>" name="fieldarray[<?php echo Data::getValue( $viewdict,'field_index') ?>][col_name]">
		<?php $i=0; ?>
		<?php foreach ($viewdict['field_conditions'] as $c) { ?>
			<input type="hidden" class="conditionkey_<?php echo $i ?>" value="<?php echo $c['key'] ?>" name="fieldarray[<?php echo Data::getValue( $viewdict,'field_index') ?>][field_conditions][<?php echo $i ?>][key]">
			<input type="hidden" class="conditionvalue_<?php echo $i ?>" value="<?php echo $c['value'] ?>" name="fieldarray[<?php echo Data::getValue( $viewdict,'field_index') ?>][field_conditions][<?php echo $i ?>][value]">
			<?php $i++; ?>
		<?php } ?>
	<?php } ?>
</div>

<script>
</script>