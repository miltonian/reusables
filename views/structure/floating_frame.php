<?php
	$required = array(
		"maincolumn"=>"",
		"left"=>"",
		"top"=>""
	);

	ReusableClasses::checkRequired( "floating_frame", $structuredict, $required );
?>

<style>
</style>

<div class="<?php echo $identifier ?> floating_frame">
	<div class="maincolumn">
		<?php 
			foreach ($structuredict['maincolumn'] as $view) {
				echo $view;
			}
		?>
	</div>
</div>

<script>
$('.<?php echo $identifier ?> #close').click(function(){
	$('.<?php echo $identifier ?>').parent().css('display', 'none');
	$('.<?php echo $identifier ?>').parent().parent().parent().css('display', 'none');
});
</script>