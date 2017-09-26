<?php

namespace Reusables;

?>

<style>
	.<?php echo $identifier ?>_structure.main { padding: 60px; padding-left: 150px; padding-right: 150px; width: calc(100% - 300px); }
		.<?php echo $identifier ?>_structure .structure_1.maincolumn { width: 65%; }
		.<?php echo $identifier ?>_structure .structure_1.sidecolumn_right { width: calc(35% - 20px); }
		
</style>

<div class="titledesc_1 main <?php echo $identifier ?>">
	<h2 class='titledesc_1' id='title'><?php echo Data::getValue( $viewdict, 'title' ) ?></h2>
	<div class='titledesc_1' id='desc'><?php echo Data::getValue( $viewdict, 'html_text' ) ?></div>
</div>


<script>
	
</script>