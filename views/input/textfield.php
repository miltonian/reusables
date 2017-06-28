<?php
	
	$required = array(
		"placeholder"=>"",
		"fieldvalue"=>"",
		"fieldname"=>""
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
	<input type="text" placeholder="<?php echo $inputdict['placeholder'] ?>" value="<?php echo $inputdict['fieldvalue'] ?>" name="<?php echo $inputdict['fieldname'] ?>">
</div>

<script>
</script>