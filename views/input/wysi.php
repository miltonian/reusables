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

	// ReusableClasses::checkRequired( "wysi", $inputdict, $required );
/*
<input type="hidden" class="row_id" value="<?php echo $inputdict['field_rowid'] ?>" name="fieldarray[<?php echo $inputdict['field_index'] ?>][row_id]">
*/

// exit(json_encode($inputdict));
if( !isset($inputdict['field_conditions'] ) ){
	$inputdict['field_conditions'] = [];
}
?>

<style>
.wysi img { max-width: 100%; }
</style>

<div class="<?php echo $identifier ?> wysi">
	<label style="margin-bottom: 0px; font-weight: 700; font-size: 11px"><?php echo Data::getValue( $inputdict, "labeltext") ?></label>
	<!-- <input type="text" class="field_value" placeholder="<?php /*echo $inputdict['placeholder']*/ ?>" value="<?php /*echo $inputdict['field_value']*/ ?>" name="fieldarray[<?php /*echo $inputdict['field_index']*/ ?>][field_value]"> -->
	<textarea class="field_value" name='fieldarray[<?php echo Data::getValue( $inputdict, 'field_index' ) ?>][field_value]' id='fieldarray[<?php echo Data::getValue( $inputdict, 'field_index' ) ?>][field_value]' rows='10' cols='80'>
		<?php /*echo $inputdict['field_value']*/ ?>

	</textarea>
	<script>
		CKEDITOR.replace( 'fieldarray[<?php echo Data::getValue( $inputdict, 'field_index' ) ?>][field_value]');
		CKEDITOR.config.height = '150' ;
		$('.cke_editor img').css({'max-width': '100%'})
	</script>

	<input type="hidden" class="field_type" name="fieldarray[<?php echo Data::getValue( $inputdict, 'field_index' ) ?>][field_type]" value="text" style="visibility: hidden; z-index: -1;">
	<input type="hidden" class="tablename" value="<?php echo Data::getValue( $inputdict, 'field_table' ) ?>" name="fieldarray[<?php echo Data::getValue( $inputdict, 'field_index' ) ?>][tablename]">
	<input type="hidden" class="col_name" value="<?php echo Data::getValue( $inputdict, 'field_colname' ) ?>" name="fieldarray[<?php echo Data::getValue( $inputdict, 'field_index' ) ?>][col_name]">
	<?php $i=0; ?>
	<?php foreach ($inputdict['field_conditions'] as $c) { ?>
		<input type="hidden" class="conditionkey_<?php echo $i ?>" value="<?php echo $c['key'] ?>" name="fieldarray[<?php echo $inputdict['field_index'] ?>][field_conditions][<?php echo $i ?>][key]">
		<input type="hidden" class="conditionvalue_<?php echo $i ?>" value="<?php echo $c['value'] ?>" name="fieldarray[<?php echo $inputdict['field_index'] ?>][field_conditions][<?php echo $i ?>][value]">
		<?php $i++; ?>
	<?php } ?>
</div>


<script>

</script>