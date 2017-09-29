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

<div class="<?php echo $identifier ?> main_withside main">
	<div class="main_withside maincolumn">
		<?php 
			foreach ($structuredict['maincolumn'] as $view) {
				// $ReusableClasses->$view['viewtype']( $view['filename'], $view['data'] );
				echo $view;
			}
		?>
	</div>
	<div class="main_withside sidecolumn_right">
		<?php 
			foreach ($structuredict['sidecolumn_right'] as $view) {
				// $ReusableClasses->$view['viewtype']( $view['filename'], $view['data'] );
				echo $view;
			}
		?>
	</div>
</div>

<script>
</script>