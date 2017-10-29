<?php

namespace Reusables;

	Views::setParams( 
		[ "title", "html_text", "featured_imagepath" ], 
		[],
		$identifier
	);

?>

<style>
	.<?php echo $identifier ?>_structure.main { padding: 60px; padding-left: 150px; padding-right: 150px; width: calc(100% - 300px); }
		.<?php echo $identifier ?>_structure .main_withside.maincolumn { width: 65%; }
		.<?php echo $identifier ?>_structure .main_withside.sidecolumn_right { width: calc(35% - 20px); }
		
</style>

<div class="viewtype_postinternal imagetext_inline main <?php echo $identifier ?>">
	<?php 
		echo Structure::make("main_withside", [
			"maincolumn"=>array(
				"<h2 class='imagetext_inline' id='title'>" . Data::getValue( $viewdict, 'title' ) . "</h2>",
				"<div class='imagetext_inline' id='desc'>" . Data::getValue( $viewdict, 'html_text' ) . "</div>"
			),
			"sidecolumn_right"=>array(
				"<div class='imagetext_inline featured_image_container'>
					<img class='imagetext_inline featured_image' src='" . Data::getValue( $viewdict, 'featured_imagepath' ) . "'>
				</div>"
			)
		], $identifier . "_structure")
	?>
</div>


<script>
	
</script>