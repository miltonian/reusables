<?php
	/*
		$sectiondict = [
			"left_imagepath"=>"",
			"right_imagepath"=>""
		]
	*/

?>

<style>
	.<?php echo $identifier ?> { display: inline-block; position: relative; margin: 0; padding: 0; width: 100%; height: 55%; text-align: center; }
		.<?php echo $identifier ?> .wrapper { display: inline-block; position: relative; padding: 0; margin: 0; top: 50%; transform: translateY(-50%); height: 400px; }
			.<?php echo $identifier ?> .wrapper .left { display: inline-block; position: relative; margin: 0 80px; padding: 0; width: auto; height: auto; max-width: 1000px; max-height: 200px; float: left; top: 50%; transform: translateY(-50%); }
			.<?php echo $identifier ?> .wrapper .right { display: inline-block; position: relative; margin: 0 80px; padding: 0; width: auto; height: auto; max-width: 1000px; max-height: 200px; float: left; top: 50%; transform: translateY(-50%); }

		@media (min-width: 0px) {

		}
		@media (min-width: 768px) {

		}
		@media (min-width: 992px) {

		}
</style>

<div class="<?php echo $identifier ?>">
	<div class="wrapper">
		<img class="left" src="<?php echo $sectiondict['left_imagepath'] ?>">
		<img class="right" src="<?php echo $sectiondict['right_imagepath'] ?>">
	</div>
</div>

<script>
</script>