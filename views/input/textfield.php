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

	// ReusableClasses::checkRequired( "textfield", $viewdict, $required );
/*
<input type="hidden" class="row_id" value="<?php echo $viewdict['field_rowid'] ?>" name="fieldarray[<?php echo $viewdict['field_index'] ?>][row_id]">
*/
// exit( json_encode( $viewdict ) );
if( !isset($viewdict['field_conditions'] ) ){
	$viewdict['field_conditions'] = [];
}else if( $viewdict['field_conditions'] == "" ){
	$viewdict['field_conditions'] = [];
}else if( sizeof($viewdict['field_conditions']) == 1 ) {
	if( sizeof($viewdict['field_conditions'][0]) == 0 ) {
		$viewdict['field_conditions'] = [];
	}
}

$is_currency = Data::getValue( $viewdict, "is_currency" );
$is_hidden = Data::getValue( $viewdict, "is_hidden" );
$size = Data::getValue( $viewdict, "size" );
$labeltext = Data::getValue( $viewdict, "labeltext" );
$placeholder = Data::getValue( $viewdict, "placeholder" );
$field_value = Data::getValue( $viewdict, "field_value" );

if( $is_currency == "" && $is_hidden == "" && $size == "" && $labeltext == "" && $placeholder=="" && $field_value == "" ) {

	$is_currency = Data::getValue( $viewoptions, "is_currency" );
	$is_hidden = Data::getValue( $viewoptions, "is_hidden" );
	$size = Data::getValue( $viewoptions, "size" );
	$labeltext = Data::getValue( $viewoptions, "labeltext" );
	$placeholder = Data::getValue( $viewoptions, "placeholder" );
	$field_value = Data::getValue( $viewoptions, "field_value" );
}

if( $size == "" ) {
	$size = "large";
}
$sizeclass = "size_" . $size;


// exit( json_encode( [$viewdict['field_colname'], $viewdict['field_conditions']] ) );
$field_table = Data::getValue( $viewdict, 'field_table' );
if( $field_table != "new_apps_client_information" ) {
	// exit( json_encode( $field_table ) );
}

?>

<style>
	.<?php echo $identifier ?> .input_groupaddon { font-size: 14px; font-weight: 400; line-height: 1; color: #555; text-align: center; background-color: #eee; border: 1px solid #ccc; border-radius: 4px; width: 1%; width: 30px; white-space: nowrap; vertical-align: middle; display: table-cell; float: left; border-top-right-radius: 0; padding: 15.5px 0; border-bottom-right-radius: 0; }
	.<?php echo $identifier ?> .field_value.input_withaddon { border-top-left-radius: 0; border-bottom-left-radius: 0; width: calc( 100% - 32px); }
</style>

<div class="viewtype_input <?php echo $identifier ?> textfield <?php echo $sizeclass ?>">
	<?php if( !$is_hidden ){ ?>
		<label style="margin-bottom: -5px; /* font-weight: 700; font-size: 11px; */"><?php echo $labeltext ?></label>
	<?php } ?>
	<?php if( $is_currency != "" ){ ?>
		<span class="input_groupaddon">$</span>
		<input type="text" class="field_value input_withaddon" placeholder="<?php echo $placeholder ?>" value="<?php echo $field_value ?>" name="fieldarray[<?php echo Data::getValue( $viewdict, 'field_index') ?>][field_value]">
	<?php } else if( $is_hidden ){ ?>
		<input type="hidden" class="field_value" placeholder="<?php echo $placeholder ?>" value="<?php echo $field_value ?>" name="fieldarray[<?php echo Data::getValue( $viewdict, 'field_index') ?>][field_value]">
	<?php } else{ ?>
		<input type="text" class="field_value" placeholder="<?php echo $placeholder ?>" value="<?php echo $field_value ?>" name="fieldarray[<?php echo Data::getValue( $viewdict, 'field_index') ?>][field_value]">
	<?php } ?>

	<input type="hidden" class="field_type" name="fieldarray[<?php echo Data::getValue( $viewdict, 'field_index') ?>][field_type]" value="text" style="visibility: hidden; z-index: -1;">
	<input type="hidden" class="tablename" value="<?php echo Data::getValue( $viewdict, 'field_table') ?>" name="fieldarray[<?php echo Data::getValue( $viewdict, 'field_index') ?>][tablename]">
	<input type="hidden" class="col_name" value="<?php echo Data::getValue( $viewdict, 'field_colname') ?>" name="fieldarray[<?php echo Data::getValue( $viewdict, 'field_index') ?>][col_name]">
	<?php $i=0; ?>
	<?php if( sizeof( $viewdict['field_conditions'] ) > 0 ){
		foreach ($viewdict['field_conditions'] as $c) { ?>
			<input type="hidden" class="conditionkey_<?php echo $i ?>" value="<?php echo $c['key'] ?>" name="fieldarray[<?php echo Data::getValue( $viewdict, 'field_index') ?>][field_conditions][<?php echo $i ?>][key]">
			<input type="hidden" class="conditionvalue_<?php echo $i ?>" value="<?php echo $c['value'] ?>" name="fieldarray[<?php echo Data::getValue( $viewdict, 'field_index') ?>][field_conditions][<?php echo $i ?>][value]">
			<?php $i++; ?>
		<?php } ?>
	<?php } ?>
</div>

<script>
</script>