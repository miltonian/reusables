<?php

namespace Reusables;

	// image left 
	// text right
	
	if(!isset($isadmin)){ $isadmin=false; }
	if( !isset($viewdict['type'])){ $viewdict['type'] = ""; }
	// if(!isset($viewdict['post_id'])){ $viewdict['post_id'] = $viewdict['id']; }

	$linkpath = "";
	$linkpath .= Data::getValue( $viewoptions, 'pre_slug' );
	$linkpath .= Data::getValue( $viewdict, 'slug' );

	$mediatype = Data::getValue( $viewdict, 'mediatype' );

	if( isset($viewdict['isfeatured']) ){ $isfeatured = $viewdict['isfeatured']; }else { $isfeatured = false; }

	// exit( json_encode( $viewdict['needed'] ) );
	// exit( json_encode( Data::getValue( $viewdict, 'needed' ) ) );

	Views::setParams( 
		[ "category", "data_id", "fullviewdict", "linkpath", "mediatype", "index", "html_text", "celldate", "celltype", "slug" ], 
		[],
		$identifier
	);

?>

<style>

</style>

<div class="viewtype_cell imagetext_inline_funding main <?php echo $identifier ?> <?php if($isfeatured){ echo "featured"; } ?> <?php if($mediatype=="youtube" || $mediatype=="podcast"){ echo Data::getValue( $viewdict, 'mediatype' ); } ?>" id="<?php echo Data::getValue( $viewdict, 'index' ) ?>">
		<a class="imagetext_inline_funding picture_container" href="<?php echo $linkpath; ?>">
			<div class="imagetext_inline_funding picture" style="background-color: #333333; <?php if( Data::getValue( $viewdict, 'featured_imagepath' ) ){ echo 'background-image: url('.Data::getValue( $viewdict, 'featured_imagepath' ).');'; } ?>">
				<?php if( $mediatype ){ ?>
					<video width="100%" height="auto" autoplay loop>
					  <source src="<?php echo Data::getValue( $viewdict, 'featured_imagepath' ) ?>" type="video/mp4">
					  <source src="<?php echo Data::getValue( $viewdict, 'featured_imagepath' ) ?>" type="video/ogg">
					Your browser does not support the video tag.
					</video>
				<?php } ?>
			</div>
		</a>
		<div class="imagetext_inline_funding words">
			<div class="imagetext_inline_funding text-container">
				<a class="imagetext_inline_funding" id="titlelink" href="<?php echo $linkpath; ?>">
					<h2 class="imagetext_inline_funding" id="title" style=""><?php echo implode(' ', array_slice( explode(' ', strip_tags(Data::getValue( $viewdict, 'title' ))), 0, 20) ); ?></h2>
				</a>
				<label class="imagetext_inline_funding" id="desc"><?php echo implode(' ', array_slice( explode(' ', strip_tags(Data::getValue( $viewdict, 'html_text' ))), 0, 20) ); ?>... <a href="<?php echo $linkpath ?>">Learn More</a></label>
				<?php Data::add( $viewdict, $identifier . "_bargraph" ); ?>
				<?php echo Section::make( "fundbar", $identifier . "_bargraph") ?>
			</div>
		</div>
</div>

<script>

	<?php
		Editing::addEditingToCell( $identifier, $fullviewdict, $celltype );
	?>;
	
</script>