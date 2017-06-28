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
			.<?php echo $identifier ?> .wrapper .left { display: inline-block; position: relative; margin: 0 80px; padding: 0; width: 300px; height: 250px; background-size: contain; background-repeat: no-repeat; background-position: center; float: left; top: 50%; transform: translateY(-50%); background-color: white; border: 1px solid #e0e0e0; }
			.<?php echo $identifier ?> .wrapper .right { display: inline-block; position: relative; margin: 0 80px; padding: 0; width: 300px; height: 250px; background-size: contain; background-repeat: no-repeat; background-position: center; float: left; top: 50%; transform: translateY(-50%); background-color: white; border: 1px solid #e0e0e0; }

		@media (min-width: 0px) {

		}
		@media (min-width: 768px) {

		}
		@media (min-width: 992px) {

		}
</style>

<div class="<?php echo $identifier ?>">
	<div class="wrapper">
		<div class="left" style="background-image: url('<?php echo $sectiondict['left_imagepath'] ?>');"></div>
		<div class="right" style="background-image: url('<?php echo $sectiondict['right_imagepath'] ?>');"></div>
	</div>
</div>

<script>
</script>