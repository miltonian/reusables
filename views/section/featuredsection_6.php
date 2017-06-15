<?php
	/*
		$sectiondict


	*/
?>

<style>
	.section_6 { display: inline-block; position: relative; margin: 0; padding: 0; width: 100%; }
		.section_6 .backgroundimage { display: inline-block; position: absolute; margin: 0; padding: 0; width: 100%; height: 100%; background-size: cover; background-position: center; background-repeat: no-repeat; z-index: -1;}
			.section_6 .backgroundimage .gradient {display: inline-block; position: absolute; margin: 0; padding: 0; width: 100%; height: 40%; bottom: 0; left: 0; background: -webkit-linear-gradient(top,rgba(0,0,0,0),rgba(0,0,0,0.7)); background: -o-linear-gradient(bottom,rgba(0,0,0,0),rgba(0,0,0,0.7)); background: -moz-linear-gradient(bottom,rgba(0,0,0,0),rgba(0,0,0,0.7)); background: linear-gradient(to bottom, rgba(0,0,0,0), rgba(0,0,0,0.7));}
		.section_6 .header { display: inline-block; position: absolute; margin: 0; padding: 0; width: 100%; left: 0; }
			.section_6 .header #logo { display: block; position: relative; margin: 0px 25px; padding: 0; top: 50%; transform: translateY(-50%); width: auto; height: auto; max-width: 20%; max-height: 80%; float: left; }
			.section_6 .header #title { position: relative; margin: 0; padding: 0; top: 50%; transform: translateY(-50%); float: left; color: white; font-size: 30px; font-weight: 300; }

		@media (min-width: 0px) {
			.section_6 { height: 200px; }
				.section_6 .header {top: 0; bottom: auto; height: 80px; }
					.section_6 .header #title { display: none; }
		}
		@media (min-width: 768px) {
			.section_6 { height: 350px; }
				.section_6 .header {top: auto; bottom: 0; height: 120px; }
					.section_6 .header #title { display: inline-block; }
		}
		@media (min-width: 992px) {
			.section_6 { height: 500px; }
				.section_6 .header {top: auto; bottom: 0; height: 120px; }
		}
</style>

<div class="section_6">
	<div class="backgroundimage" style="background-image: url('<?php echo $sectiondict['featured_imagepath'] ?>');">
		<div class="gradient"></div>
	</div>
	<div class="header">
		<img id="logo" src="<?php echo $sectiondict['logo_imagepath'] ?>">
		<h3 id="title"><?php echo $sectiondict['title'] ?></h3>
	</div>
</div>

<script>
</script>