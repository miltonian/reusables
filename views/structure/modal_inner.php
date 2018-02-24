<?php

namespace Reusables;

	$required = array(
		"title"=>"",
		"first"=>"",  
		"second"=>"",
		"third"=>""
	);

	// ReusableClasses::checkRequired( "three_columns", $structuredict, $required );
	// exit(json_encode($identifier));
?>

<style>
</style>

<div class="viewtype_structure <?php echo $identifier ?> modal_inner main">
	<div class="modal_inner header">
		<button class="modal_inner" id="close">&#10006;</button>
		<?php 
			Data::addData( ["title"=>$structuredict['title']], $identifier . "_modalinner_header" );
			echo Header::make( "basic", $identifier . "_modalinner_header" ); 
		?>
		
	</div>
	<div class="modal_inner body">
		<div class="modal_inner column">
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