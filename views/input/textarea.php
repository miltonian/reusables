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

	ReusableClasses::checkRequired( "textarea", $inputdict, $required );
/*
<input type="hidden" class="row_id" value="<?php echo $inputdict['field_rowid'] ?>" name="fieldarray[<?php echo $inputdict['field_index'] ?>][row_id]">
*/
?>

<style>
</style>

<div class="<?php echo $identifier ?> textarea">
	<label style="margin-bottom: -5px; font-weight: 700; font-size: 11px"><?php echo Data::getValue( $inputdict, "labeltext") ?></label>
	<textarea class="field_value" name="fieldarray[<?php echo $inputdict['field_index'] ?>][field_value]"><?php echo $inputdict['field_value'] ?></textarea>
	<input type="hidden" class="field_type" name="fieldarray[<?php echo $inputdict['field_index'] ?>][field_type]" value="text" style="visibility: hidden; z-index: -1;">
	<input type="hidden" class="tablename" value="<?php echo $inputdict['field_table'] ?>" name="fieldarray[<?php echo $inputdict['field_index'] ?>][tablename]">
	<input type="hidden" class="col_name" value="<?php echo $inputdict['field_colname'] ?>" name="fieldarray[<?php echo $inputdict['field_index'] ?>][col_name]">
	<?php $i=0; ?>
	<?php foreach ($inputdict['field_conditions'] as $c) { ?>
		<input type="hidden" class="conditionkey_<?php echo $i ?>" value="<?php echo $c['key'] ?>" name="fieldarray[<?php echo $inputdict['field_index'] ?>][field_conditions][<?php echo $i ?>][key]">
		<input type="hidden" class="conditionvalue_<?php echo $i ?>" value="<?php echo $c['value'] ?>" name="fieldarray[<?php echo $inputdict['field_index'] ?>][field_conditions][<?php echo $i ?>][value]">
		<?php $i++; ?>
	<?php } ?>
</div>

<script>
</script>