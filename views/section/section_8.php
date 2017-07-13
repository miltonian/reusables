<?php

namespace Reusables;

	/*
		$sectiondict = [
			"left_imagepath"=>"",
			"right_imagepath"=>""
		]
	*/

		// exit( json_encode( Data::getValue($sectiondict['left_imagepath']) ) );

?>

<style>
</style>

<div class="<?php echo $identifier ?> section_8 main">
	<div class="section_8 wrapper">
		<div class="section_8 left" style="background-image: url('<?php echo Data::getValue($sectiondict, 'left_imagepath') ?>');"></div>
		<div class="section_8 right" style="background-image: url('<?php echo Data::getValue($sectiondict, 'right_imagepath') ?>');"></div>
	</div>
</div>

<script>
</script>