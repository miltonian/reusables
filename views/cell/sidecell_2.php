<?php

namespace Reusables;

	// image left 
	// text right
	
	if(!isset($isadmin)){ $isadmin=false; }
	// if(!isset($celldict['post_id'])){ $celldict['post_id'] = $celldict['id']; }

	$linkpath = "";
	$linkpath .= Data::getValue( $celldict, 'pre_slug' );
	$linkpath .= Data::getValue( $celldict, 'slug' );

	$mediatype = Data::getValue( $celldict, 'mediatype' );

?>

<style>
</style>

<div class="sidecell_2 main <?php echo $identifier ?> <?php if($mediatype=="youtube" || $mediatype=="podcast"){ echo Data::getValue( $celldict, 'mediatype' ); } ?>" id="<?php echo Data::getValue( $celldict, 'id' ) ?>">
	<a href="<?php echo $linkpath; ?>">
		<div class="sidecell_2 picture" style="background-color: #333333; <?php if( Data::getValue( $celldict, 'featured_imagepath' ) ){ echo 'background-image: url('.Data::getValue( $celldict, 'featured_imagepath' ).');'; } ?>">
			<?php if($celldict['mediatype']){ ?>
					<video width="100%" height="auto" autoplay loop>
					  <source src="<?php echo Data::getValue( $celldict, 'featured_imagepath' ) ?>" type="video/mp4">
					  <source src="<?php echo Data::getValue( $celldict, 'featured_imagepath' ) ?>" type="video/ogg">
					Your browser does not support the video tag.
					</video>
				<?php } ?>
		</div>
		<div class="sidecell_2 words">
			<div class="sidecell_2 text-container">
				<a href="<?php echo $linkpath; ?>">
					<h2 class="sidecell_2" id="title" style=""><?php if(isset($celldict['title'])){ echo Data::getValue( $celldict, 'title' ); } ?></h2>
				</a>
				<br>
				<label class="sidecell_2" id="desc"><?php echo implode(' ', array_slice( explode(' ', strip_tags(Data::getValue( $celldict, 'html_text' ))), 0, 10) ); ?>...</label>
			</div>
		</div>
	</a>
</div>

<script>
</script>