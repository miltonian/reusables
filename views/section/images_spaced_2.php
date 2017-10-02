<?php

namespace Reusables;

	/*
		$viewdict = [
			"left_imagepath"=>"",
			"right_imagepath"=>""
		]
	*/

		// exit( json_encode( Data::getValue($viewdict['left_imagepath']) ) );

?>

<style>
</style>

<div class="viewtype_section <?php echo $identifier ?> section_8 main">
	<div class="section_8 wrapper">
		<div class="section_8 left" style="background-image: url('<?php echo Data::getValue($viewdict, 'left_imagepath') ?>');"></div>
		<div class="section_8 right" style="background-image: url('<?php echo Data::getValue($viewdict, 'right_imagepath') ?>');"></div>
	</div>
</div>

<script>
</script>