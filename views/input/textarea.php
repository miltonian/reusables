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

	// ReusableClasses::checkRequired( "textarea", $viewdict, $required );
/*
<input type="hidden" class="row_id" value="<?php echo $viewdict,'field_rowid'] ?>" name="fieldarray[<?php echo $viewdict,'field_index'] ?>][row_id]">
*/
if( !isset($viewdict['field_conditions'] ) ){
	$viewdict['field_conditions'] = [];
}else if( $viewdict['field_conditions'] == "" ){
	$viewdict['field_conditions'] = [];
}


$size = Data::getValue( $viewdict, "size" );

if( $size == "" ) {
	$size = "large";
}
$sizeclass = "size_" . $size;

// exit( json_encode( $identifier ) );


?>

<style>
</style>

<div class="viewtype_input <?php echo $identifier ?> textarea <?php echo $sizeclass ?>">
	<label style="margin-bottom: -5px; /* font-weight: 700; font-size: 11px; */"><?php echo Data::getValue( $viewdict, "labeltext") ?></label>
	<textarea class="field_value" name="fieldarray[<?php echo Data::getValue( $viewdict,'field_index') ?>][field_value]"><?php echo Data::getValue( $viewdict, 'field_value') ?></textarea>
	<input type="hidden" class="field_type" name="fieldarray[<?php echo Data::getValue( $viewdict,'field_index') ?>][field_type]" value="text" style="visibility: hidden; z-index: -1;">
	<input type="hidden" class="tablename" value="<?php echo Data::getValue( $viewdict,'field_table') ?>" name="fieldarray[<?php echo Data::getValue( $viewdict,'field_index') ?>][tablename]">
	<input type="hidden" class="col_name" value="<?php echo Data::getValue( $viewdict,'field_colname') ?>" name="fieldarray[<?php echo Data::getValue( $viewdict,'field_index') ?>][col_name]">
	<?php $i=0; ?>
	<?php foreach ($viewdict['field_conditions'] as $c) { ?>
		<input type="hidden" class="conditionkey_<?php echo $i ?>" value="<?php echo $c['key'] ?>" name="fieldarray[<?php echo Data::getValue( $viewdict,'field_index') ?>][field_conditions][<?php echo $i ?>][key]">
		<input type="hidden" class="conditionvalue_<?php echo $i ?>" value="<?php echo $c['value'] ?>" name="fieldarray[<?php echo Data::getValue( $viewdict,'field_index') ?>][field_conditions][<?php echo $i ?>][value]">
		<?php $i++; ?>
	<?php } ?>
</div>

<script>
</script>