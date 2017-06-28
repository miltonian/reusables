<?php

?>

<style>
	.<?php echo $identifier ?> { display: inline-block; position: relative; margin: 0; padding: 0; width: 100%; height: 200px; background-size: cover; background-position: center; background-repeat: no-repeat; text-align: left;}
		.<?php echo $identifier ?> #logo { display: inline-block; position: relative; margin: 0; padding: 0; width: auto; height: auto; top: 50%; transform: translateY(-50%); }
		.<?php echo $identifier ?> .overlay { display: inline-block; position: absolute; margin: 0; padding: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.3); }

	@media (min-width: 0px) {
		.<?php echo $identifier ?> { height: 100px; }
			.<?php echo $identifier ?> #logo { margin-left: 25px; max-height: 80px; max-width: 80px; top: 50%; transform: translateY(-50%); }
	}
	@media (min-width: 768px) {
		.<?php echo $identifier ?> { height: 200px; }
			.<?php echo $identifier ?> #logo { margin-left: 25px; max-height: 150px; max-width: 150px; }
	}
</style>

<div class="<?php echo $identifier ?>" style="background-image: url('<?php echo $headerdict['featured_imagepath'] ?>');">
	<div class="overlay"></div>
	<a href="/">
		<img src="<?php echo $headerdict['logo_imagepath'] ?>" id="logo">
	</a>
</div>

<script>
</script>