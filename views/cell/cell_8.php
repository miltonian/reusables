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

<div class="cell_8 main <?php echo $identifier ?> <?php if($celldict['isfeatured']){ echo "featured"; } ?> <?php if($mediatype=="youtube" || $mediatype=="podcast"){ echo Data::getValue( $celldict, 'mediatype' ); } ?>" id="<?php echo Data::getValue( $celldict, 'id' ) ?>">
		<a href="<?php echo $linkpath; ?>">
			<div class="cell_8 picture" style="<?php if( Data::getValue( $celldict, 'featured_imagepath' ) ){ echo 'background-image: url('.Data::getValue( $celldict, 'featured_imagepath' ).');'; } ?>"></div>
		</a>
		<div class="cell_8 words">
			<div class="cell_8 text-container">
				<a href="<?php echo $linkpath; ?>">
					<h2 class="cell_8" id="title" style=""><?php if(isset($celldict['title'])){ echo Data::getValue( $celldict, 'title' ); } ?></h2>
				</a>
				<br>
				<label class="cell_8" id="desc"><?php echo implode(' ', array_slice( explode(' ', strip_tags(Data::getValue( $celldict, 'html_text' ))), 0, 10) ); ?>...</label>
			</div>
		</div>
</div>

<script>
</script>