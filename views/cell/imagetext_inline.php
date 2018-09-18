<?php

namespace Reusables;

	// image left 
	// text right
	
	// extract( Cell::prepareCell( $identifier ) );



	Views::setParams( 
		[ "category", "data_id", "fullviewdict", "linkpath", "mediatype", "cellindex", "html_text", "celldate", "celltype", "slug", "index", "imagepath", "title", "html_text" ],
		[],
		$identifier
	);

	$viewdict = Convert::keysInTable( $identifier, $viewdict );
	


	extract( Cell::prepareCell( $identifier ) );

?>

<style>
</style>

<div class="viewtype_cell imagetext_inline main <?php echo $identifier ?> index_<?php echo $cellindex ?> <?php if($isfeatured){ echo "featured"; } ?> <?php if($mediatype=="youtube" || $mediatype=="podcast"){ echo Data::getValue( $viewdict, 'mediatype' ); } ?>" id="<?php echo Data::getValue( $viewdict, 'index' ) ?>">
		<a href="<?php echo $linkpath; ?>">
			<div class="imagetext_inline picture" style="background-color: #333333; <?php if( Data::getValue( $viewdict, 'imagepath' ) ){ echo 'background-image: url('.Data::getValue( $viewdict, 'imagepath' ).');'; } ?>">
				<?php if( $mediatype ){ ?>
					<video width="100%" height="auto" autoplay loop>
					  <source src="<?php echo Data::getValue( $viewdict, 'imagepath' ) ?>" type="video/mp4">
					  <source src="<?php echo Data::getValue( $viewdict, 'imagepath' ) ?>" type="video/ogg">
					Your browser does not support the video tag.
					</video>
				<?php } ?>
			</div>
		</a>
		<div class="imagetext_inline words">
			<div class="imagetext_inline text-container">
				<a href="<?php echo $linkpath; ?>">
					<h2 class="imagetext_inline" id="title" style=""><?php if(isset($viewdict['title'])){ echo Data::getValue( $viewdict, 'title' ); } ?></h2>
				</a>
				<br>
				<label class="imagetext_inline" id="desc"><?php echo Data::getValue( $html_text ) ?></label>
			</div>
		</div>
</div>

<script>

	<?php
		Editing::addEditingToCell( $identifier, $fullviewdict, $celltype );
	?>;
	
</script>