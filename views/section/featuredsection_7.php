<?php
	/*
		$sectiondict = [
			"featured_imagepath"=>"",
			"logo_imagepath"=>"",
			"title"=>"",
			"adposition"=>0,
			"desc"=>""
		]
	*/
?>

<style>
	.section_7 { display: inline-block; position: relative; margin: 0; padding: 20px 0px; width: 100%; background-color: white; border-bottom: 1px solid #e3e3e3; }
		.section_7 .featuredimage { display: inline-block; position: relative; margin: 0; padding: 0; background-size: cover; background-position: center; background-repeat: no-repeat; border: 0; border-radius: 5px; }
		.section_7 .content { display: inline-block; position: relative; padding: 0px 20px; }
			.section_7 .content #title { margin: 0; }

		@media (min-width: 0px) {
			.section_7 { text-align: center; }
				.section_7 .featuredimage { width: 90%; height: 0; padding-bottom: 80%; float: none; margin-left: 0px; margin-bottom: 20px; }
				.section_7 .content { float: none; }
		}
		@media (min-width: 768px) {
			.section_7 { text-align: left; }
				.section_7 .featuredimage { width: 120px; height: 120px; float: left; margin-left: 50px; margin-bottom: 0px; padding-bottom: 0%; }
				.section_7 .content { float: left; width: calc( 100% - 120px - 50px - 50px - 40px ); }
		}
		@media (min-width: 992px) {

		}
</style>

<div class="section_7">
	<div class="featuredimage" style="background-image: url('<?php echo $sectiondict['featured_imagepath'] ?>');"></div>
	<div class="content">
		<h2 id="title"><?php echo $sectiondict['title'] ?></h2>
		<p id="desc"><?php echo $sectiondict['desc'] ?></p>
	</div>
</div>

<script>
</script>