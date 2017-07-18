<?php

namespace Reusables;
	
	$required = array(
		"background-image"=>"",
		"field_value"=>"",
		"field_index"=>"",
		"field_table"=>"",
		"field_colname"=>"",
		"field_conditions"=>[]
	);
	// exit(json_encode($inputdict));
	ReusableClasses::checkRequired( $identifier, $inputdict, $required );

?>

<style>
</style>

<div class="<?php echo $identifier ?> file_image">
	<label style="margin-bottom: -5px; font-weight: 700; font-size: 11px"><?php echo Data::getValue( $inputdict, "labeltext") ?></label>
	<label class="file_image" id='imglabel' for='<?php echo $identifier ?>_field_value' style="background-image: url('<?php echo $inputdict['background-image'] ?>');"></label>
	<input type="file" class="field_value" id="<?php echo $identifier ?>_field_value" value="<?php echo $inputdict['field_value'] ?>" name="fieldimage[<?php echo $inputdict['field_index'] ?>][field_value]" style="visibility: hidden; z-index: -1;">
	<input type="hidden" class="field_type" name="fieldimage[<?php echo $inputdict['field_index'] ?>][field_type]" value="image_<?php echo $inputdict['field_index'] ?>" style="visibility: hidden; z-index: -1;">
	<input type="hidden" class="tablename" value="<?php echo $inputdict['field_table'] ?>" name="fieldimage[<?php echo $inputdict['field_index'] ?>][tablename]">
	<input type="hidden" class="col_name" value="<?php echo $inputdict['field_colname'] ?>" name="fieldimage[<?php echo $inputdict['field_index'] ?>][col_name]">
	<?php $i=0; ?>
	<?php foreach ($inputdict['field_conditions'] as $c) { ?>
		<input type="hidden" class="conditionkey_<?php echo $i ?>" value="<?php echo $c['key'] ?>" name="fieldimage[<?php echo $inputdict['field_index'] ?>][field_conditions][<?php echo $i ?>][key]">
		<input type="hidden" class="conditionvalue_<?php echo $i ?>" value="<?php echo $c['value'] ?>" name="fieldimage[<?php echo $inputdict['field_index'] ?>][field_conditions][<?php echo $i ?>][value]">
		<?php $i++; ?>
	<?php } ?>
</div>

<script>
	$('#<?php echo $identifier ?>_field_value').change(function(){
		Reusable.readthisURL(this, $('.<?php echo $identifier ?>').find('#imglabel'), null, null);
	});
</script>