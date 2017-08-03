<?php

namespace Reusables;

?>

<style>
	.<?php echo $identifier ?>_structure.main { padding: 60px; padding-left: 150px; padding-right: 150px; width: calc(100% - 300px); }
		.<?php echo $identifier ?>_structure .structure_1.maincolumn { width: 65%; }
		.<?php echo $identifier ?>_structure .structure_1.sidecolumn_right { width: calc(35% - 20px); }
		
</style>

<div class="postinternal_4 main <?php echo $identifier ?>">
	<?php 
		echo Structure::make("structure_1", [
			"maincolumn"=>array(
				"<h2 class='postinternal_4' id='title'>" . Data::getValue( $postdict, 'title' ) . "</h2>",
				"<div class='postinternal_4' id='desc'>" . Data::getValue( $postdict, 'html_text' ) . "</div>"
			),
			"sidecolumn_right"=>array(
				"<div class='postinternal_4 featured_image_container'>
					<img class='postinternal_4 featured_image' src='" . Data::getValue( $postdict, 'featured_imagepath' ) . "'>
				</div>"
			)
		], $identifier . "_structure")
	?>
</div>


<script>
	
</script>