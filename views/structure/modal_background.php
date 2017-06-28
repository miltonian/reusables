<?php
	$required = array(
		"maincolumn"=>""
	);

	ReusableClasses::checkRequired( "modal-background", $structuredict, $required );
?>

<style>

</style>

<div class="<?php echo $identifier ?>">
	<div class="overlay"></div>
	<div class="maincolumn">
		<?php 
			foreach ($structuredict['maincolumn'] as $view) {
				echo $view;
			}
		?>
	</div>
</div>

<script>
</script>