<?php
	/*
		$sectiondict = [
			"left_imagepath"=>"",
			"right_imagepath"=>""
		]
	*/

?>

<style>
</style>

<div class="<?php echo $identifier ?> section_8">
	<div class="wrapper">
		<div class="left" style="background-image: url('<?php echo Data::getValue($sectiondict['left_imagepath']) ?>');"></div>
		<div class="right" style="background-image: url('<?php echo Data::getValue($sectiondict['right_imagepath']) ?>');"></div>
	</div>
</div>

<script>
</script>