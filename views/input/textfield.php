<?php
	
	$required = array(
		"placeholder"=>"",
		"field_value"=>"",
		"field_index"=>"",
		"field_table"=>"",
		"field_colname"=>"",
		"field_rowid"=>""
	);

	ReusableClasses::checkRequired( "textfield", $inputdict, $required );

?>

<style>
	.<?php echo $identifier ?> { display: inline-block; position: relative; margin: 0; padding: 0; float: left; width: 100%; }
		.<?php echo $identifier ?> label { display: inline-block; position: relative; margin: 0; padding: 10px 0; width: calc(100% - 0px); font-size: 13px; font-weight: 500; }
		.<?php echo $identifier ?> input { display: inline-block; position: relative; margin: 0; padding: 10px; width: calc(100% - 20px); font-size: 14px; font-weight: 400; color: #333333; background-color: white; border: 1px solid #e0e0e0; border-radius: 5px; }
</style>

<div class="<?php echo $identifier ?>">
	<label>Test input label</label>
	<input type="text" class="field_value" placeholder="<?php echo $inputdict['placeholder'] ?>" value="<?php echo $inputdict['field_value'] ?>" name="fieldarray[<?php echo $inputdict['field_index'] ?>][field_value]">
	<input type="hidden" class="tablename" value="<?php echo $inputdict['field_table'] ?>" name="fieldarray[<?php echo $inputdict['field_index'] ?>][tablename]">
	<input type="hidden" class="col_name" value="<?php echo $inputdict['field_colname'] ?>" name="fieldarray[<?php echo $inputdict['field_index'] ?>][col_name]">
	<input type="hidden" class="row_id" value="<?php echo $inputdict['field_rowid'] ?>" name="fieldarray[<?php echo $inputdict['field_index'] ?>][row_id]">
</div>

<script>
</script>