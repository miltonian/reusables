<?php

namespace Reusables;

	/*
	$structuredict = [ 
				"maincolumn" => array(["viewtype"=>"","filename"=>"", "data"=>""]),
				"sidecolumn_right" => array(["viewtype"=>"","filename"=>"", "data"=>""])
			]
	*/
?>

<style>

</style>

<div class="viewtype_structure <?php echo $identifier ?> main_withside main">
	<div class="main_withside maincolumn">
		<?php 
			if( isset( $structuredict['maincolumn'] ) ) {
				foreach ($structuredict['maincolumn'] as $view) {
					echo $view;
				}
			}
		?>
	</div>
	<div class="main_withside sidecolumn_right">
		<?php 
			if( isset( $structuredict['sidecolumn_right'] ) ) {
				foreach ($structuredict['sidecolumn_right'] as $view) {
					echo $view;
				}
			}
		?>
	</div>
</div>

<script>
</script>