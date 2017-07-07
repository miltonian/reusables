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
</style>

<div class="<?php echo $identifier ?> main_with_hidden">
	<div class="header">
		<button id="close">&#10006;</button>
		<?php echo Header::make( "header_5", ["title"=>$structuredict['title']], "campaignedit-header" ); ?>
		<?php echo Header::make( 
			"steps_1", 
			[
				"steps"=>array(
					["title"=>"Step 1", "subtitle"=>"Essentials"],
					["title"=>"Step 2", "subtitle"=>"Details"],
					["title"=>"Step 3", "subtitle"=>"Rewards"]
				)
			],
			"steps_1"
		)
		?>
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