<?php
	$required = array(
		"sidecolumn_left"=>"",  
		"maincolumn"=>"",
		"sidecolumn_right"=>""
	);

	ReusableClasses::checkRequired( "three_columns", $structuredict, $required );

?>

<style>
</style>

<div class="<?php echo $identifier ?>">
	<div class="sidecolumn_left">
		<?php 
			foreach ($structuredict['sidecolumn_left'] as $view) {
				echo $view;
			}
		?>
	</div>
	<div class="maincolumn">
		<?php 
			foreach ($structuredict['maincolumn'] as $view) {
				echo $view;
			}
		?>
	</div>
	<div class="sidecolumn_right">
		<?php 
			foreach ($structuredict['sidecolumn_right'] as $view) {
				echo $view;
			}
		?>
	</div>
</div>

<script>
</script>