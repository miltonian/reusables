<?php
	$required = array(
		"title"=>"",
		"first"=>"",  
		"second"=>"",
		"third"=>""
	);

	ReusableClasses::checkRequired( "three_columns", $structuredict, $required );
	// exit(json_encode($identifier));
?>

<style>
</style>

<div class="<?php echo $identifier ?> modalinner_1">
	<div class="header">
		<button id="close">&#10006;</button>
		<?php echo Header::make( "header_5", ["title"=>$structuredict['title']], "campaignedit-header" ); ?>
		
	</div>
	<div class="body">
		<div class="column">
			<?php 
				foreach ($structuredict['first'] as $view) {
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