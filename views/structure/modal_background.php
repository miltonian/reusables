<?php
	$required = array(
		"maincolumn"=>""
	);

	ReusableClasses::checkRequired( "modal_background", $structuredict, $required );
?>

<style>

</style>

<div class="<?php echo $identifier ?> modal_background main">
	<div class="modal_background overlay"></div>
	<div class="modal_background maincolumn">
		<?php 
			foreach ($structuredict['maincolumn'] as $view) {
				echo $view;
			}
		?>
	</div>
</div>

<script>
</script>