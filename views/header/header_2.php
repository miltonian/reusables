<?php

?>

<style>
	.header2 { display: inline-block; position: relative; margin: 0; padding: 0; width: 100%; height: 200px; background-size: cover; background-position: center; background-repeat: no-repeat; }
		.header2 #logo { display: inline-block; position: relative; margin: 0; padding: 0; width: auto; height: auto; top: 50%; transform: translateY(-50%); }
		.header2 .overlay { display: inline-block; position: absolute; margin: 0; padding: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.3); }

	@media (min-width: 0px) {
		.header2 { height: 100px; }
			.header2 #logo { margin-left: 25px; max-height: 80px; max-width: 80px; top: 50%; transform: translateY(-50%); }
	}
	@media (min-width: 768px) {
		.header2 { height: 200px; }
			.header2 #logo { margin-left: 25px; max-height: 150px; max-width: 150px; }
	}
</style>

<div class="header2" style="background-image: url('<?php echo $headerdict['featured_imagepath'] ?>');">
	<div class="overlay"></div>
	<a href="/">
		<img src="<?php echo $headerdict['logo_imagepath'] ?>" id="logo">
	</a>
</div>

<script>
</script>