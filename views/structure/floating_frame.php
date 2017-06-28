<?php
	$required = array(
		"maincolumn"=>"",
		"left"=>"",
		"top"=>""
	);

	ReusableClasses::checkRequired( "floating_frame", $structuredict, $required );
?>

<style>
.<?php echo $identifier ?> { position: fixed; display: inline-block; margin: 0; padding: 0; width: 400px; height: 225px; overflow: hidden; background-color: #333333; top: <?php echo $structuredict['left'] ?>; left: <?php echo $structuredict['top'] ?>; z-index: 50;}
	.<?php echo $identifier ?> .maincolumn { display: inline-block; position: relative; margin: 0; padding: 0; width: 100%; height: 100%; background: transparent; }
</style>

<div class="<?php echo $identifier ?>">
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