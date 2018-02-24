<?php

namespace Reusables;

	$required = array(
		"sidecolumn_left"=>"",  
		"maincolumn"=>"",
		"sidecolumn_right"=>""
	);

	ReusableClasses::checkRequired( "three_columns", $structuredict, $required );

?>

<style>
</style>

<div class="viewtype_structure <?php echo $identifier ?> three_columns main">
	<div class="three_columns sidecolumn_left">
		<?php 
			foreach ($structuredict['sidecolumn_left'] as $view) {
				echo $view;
			}
		?>
	</div>
	<div class="three_columns maincolumn">
		<?php 
			foreach ($structuredict['maincolumn'] as $view) {
				echo $view;
			}
		?>
	</div>
	<div class="three_columns sidecolumn_right">
		<?php 
			foreach ($structuredict['sidecolumn_right'] as $view) {
				echo $view;
			}
		?>
	</div>
</div>

<script>
</script>