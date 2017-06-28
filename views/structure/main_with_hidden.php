<?php
	$required = array(
		"title"=>"",
		"first"=>"",  
		"second"=>"",
		"third"=>""
	);

	ReusableClasses::checkRequired( "three_columns", $structuredict, $required );
?>

<style>
.<?php echo $identifier ?> { position: relative; display: inline-block; margin: 0; padding: 0; width: 100%; overflow: hidden; }
	.<?php echo $identifier ?> .header { position: relative; display: inline-block; margin: 0; padding: 10px 0; width: 100%; }
	.<?php echo $identifier ?> .body { position: relative; display: inline-block; margin: 0; padding: 10px 0; width: 100%; }
	.<?php echo $identifier ?> .column { position: relative; display: inline-block; margin: 0; padding: 0; width: 100%; left: 0; top: 0; margin-top: 0px;}
		.<?php echo $identifier ?> .column.second { left: 100%; }
		.<?php echo $identifier ?> .column.third { left: 200%; }
	.<?php echo $identifier ?> #close { display: inline-block; position: absolute; margin: 0; padding: 0; width: 40px; height: 40px; background: transparent; border-radius: 50%; border: 0px solid #efefef; font-size: 15px; top: 5px; cursor: pointer; z-index: 99; }
</style>

<div class="<?php echo $identifier ?>">
	<div class="header">
		<button id="close">&#10006;</button>
		<?php echo Header::make( "header_5", ["title"=>$structuredict['title']], "campaignedit-header" ); ?>
	</div>
	<div class="body">
		<div class="column first">
			<?php 
				foreach ($structuredict['first'] as $view) {
					echo $view;
				}
			?>
		</div>
		<div class="column second">
			<?php 
				foreach ($structuredict['second'] as $view) {
					echo $view;
				}
			?>
		</div>
		<div class="column third">
			<?php 
				foreach ($structuredict['third'] as $view) {
					echo $view;
				}
			?>
		</div>
	</div>
</div>

<script>
$('.<?php echo $identifier ?> #close').click(function(){
	$('.<?php echo $identifier ?>').parent().css('display', 'none');
	$('.<?php echo $identifier ?>').parent().parent().parent().css('display', 'none');
});
</script>