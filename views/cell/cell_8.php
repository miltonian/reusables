<?php
	// image left 
	// text right
	
	

?>

<style>
.cell8 { display: inline-block; position: relative; margin: 0; padding: 20px; width: calc(100% - 40px); }
	.cell8 .picture { display: inline-block; position: relative; margin: 0; padding: 0; border: 0; border-radius: 5px; background-size: cover; background-position: center; background-repeat: no-repeat; float: left; width: 35%; height: 0; padding-bottom: 27%; cursor: pointer; }
	.cell8 .words { display: inline-block; position: relative; margin: 0; padding: 0px 20px; width: calc( 65% - 40px); text-align: left; }
		.cell8 .words #title { margin: 0; padding: 0; }
			.cell8 .words #title:hover { cursor: pointer; text-decoration: underline; }
</style>

<div class="cell8 <?php if($celldict['isfeatured']){ echo "featured"; } ?> <?php if($celldict['mediatype']=="youtube" || $celldict['mediatype']=="podcast"){ echo $celldict['mediatype']; } ?>" id="<?php echo $celldict['post_id'] ?>">
		<div class="picture" style="<?php if($celldict['featured_imagepath']){ echo 'background-image: url('.$celldict['featured_imagepath'].');'; } ?>">
			
		</div>
		<div class="words">
			<div class="text-container">
				<h2 id="title" style=""><?php if(isset($celldict['title'])){ echo $celldict['title']; } ?></h2>
				<br>
				<label id="desc"><?php echo implode(' ', array_slice( explode(' ', strip_tags($celldict['html_text'])), 0, 10) ); ?>...</label>
			</div>
		</div>
</div>

<script>
</script>