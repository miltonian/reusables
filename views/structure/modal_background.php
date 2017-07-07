<?php
	$required = array(
		"maincolumn"=>""
	);

	ReusableClasses::checkRequired( "modal_background", $structuredict, $required );
?>

<style>

</style>

<div class="<?php echo $identifier ?> modal_background">
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