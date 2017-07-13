<?php

namespace Reusables;

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

<div class="<?php echo $identifier ?> modalinner_1 main">
	<div class="modalinner_1 header">
		<button class="modalinner_1" id="close">&#10006;</button>
		<?php echo Header::make( "header_5", ["title"=>$structuredict['title']], "campaignedit-header" ); ?>
		
	</div>
	<div class="modalinner_1 body">
		<div class="modalinner_1 column">
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