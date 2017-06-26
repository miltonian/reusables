<?php
	/*
		$postdict = [
				"featured_imagepath"=>"",
				"html_text"=>""
			]
	*/
?>

<style>
	.postinternal3 { display: inline-block; position: relative; margin: 0; padding: 0; width: 100%; }
		.postinternal3 #featuredimage { display: inline-block; position: relative; margin: 0; padding: 0; background-size: cover; background-position: center; background-repeat: no-repeat; width: 100%; height: 0; padding-bottom: 50%; }
		.postinternal3 .text-container { display: inline-block; position: relative; margin: 50px 0px; padding: 0; text-align: left; }
</style>

<div class="postinternal3">
	<div id="featuredimage" style="background-image: url('<?php echo $postdict['featured_imagepath'] ?>');" ></div>
	<?php
		if($postdict['sharingdict']){
			ReusableClasses::sharing( "sharingbtns_1", $postdict['sharingdict'] );
		}
	?>
	<div class="text-container">
		<?php echo $postdict['html_text'] ?>
	</div>
</div>

<script>
</script>