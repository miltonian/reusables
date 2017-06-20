<?php
	// image left 
	// text right
	
	if(!isset($isadmin)){ $isadmin=false; }

?>

<style>
.cell8 { display: inline-block; position: relative; margin: 0; padding: 20px 5px; width: calc(100% - 10px); }
	.cell8 .picture { display: inline-block; position: relative; margin: 0; padding: 0; border: 0; border-radius: 5px; background-size: cover; background-position: center; background-repeat: no-repeat; float: left; height: 0; cursor: pointer; }
	.cell8 .words { display: inline-block; position: relative; margin: 0; padding: 0px 20px; }
		.cell8 .words a {text-decoration: none;}
		.cell8 .words #title { margin: 0; padding: 0; text-decoration: none; color: #333333; }
			.cell8 .words #title:hover { cursor: pointer; text-decoration: underline; }

@media (min-width: 0px) {
		.cell8 .picture { width: 90%; padding-bottom: 80%; float: none; }
		.cell8 .words { width: calc( 90% - 40px); text-align: center; float: none; }
}
@media (min-width: 768px) {
		.cell8 .picture { width: 35%; padding-bottom: 27%; float: left; }
		.cell8 .words { width: calc( 65% - 40px); text-align: left; float: left; }
}
</style>

<div class="cell8 <?php if($celldict['isfeatured']){ echo "featured"; } ?> <?php if($celldict['mediatype']=="youtube" || $celldict['mediatype']=="podcast"){ echo $celldict['mediatype']; } ?>" id="<?php echo $celldict['post_id'] ?>">
		<a href="<?php if($isadmin){ echo '#'; }else{ echo '/post/'.$celldict['post_id'] . '/' . preg_replace('/\PL/u', '-', preg_replace("/[^ \w]+/", "", $celldict['title']) ); } ?>">
			<div class="picture" style="<?php if($celldict['featured_imagepath']){ echo 'background-image: url('.$celldict['featured_imagepath'].');'; } ?>"></div>
		</a>
		<div class="words">
			<div class="text-container">
				<a href="<?php if($isadmin){ echo '#'; }else{ echo '/post/'.$celldict['post_id'] . '/' . preg_replace('/\PL/u', '', preg_replace("/[^ \w]+/", "", $celldict['title']) ); } ?>">
					<h2 id="title" style=""><?php if(isset($celldict['title'])){ echo $celldict['title']; } ?></h2>
				</a>
				<br>
				<label id="desc"><?php echo implode(' ', array_slice( explode(' ', strip_tags($celldict['html_text'])), 0, 10) ); ?>...</label>
			</div>
		</div>
</div>

<script>
</script>