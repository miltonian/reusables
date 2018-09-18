<?php 

namespace Reusables;

	Views::setParams( 
		[ "category", "data_id", "fullviewdict", "linkpath", "mediatype", "cellindex", "description", "celldate", "celltype", "slug", "featured_imagepath", "title", "html_text" ],
		[],
		$identifier
	);

	$viewdict = Convert::keysInTable( $identifier, $viewdict );
	


	extract( Cell::prepareCell( $identifier ) );


?>

<style>
</style>



<div id="<?php echo $cellindex ?>" class="viewtype_cell imagetext_full_funding main <?php echo $identifier ?> <?php if($viewdict['isfeatured']){ echo "featured"; } ?> <?php if($mediatype=="youtube" || $mediatype=="podcast"){ echo $mediatype; } ?> index_<?php echo $cellindex ?>" >
	<div class="imagetext_full_funding container">
		<div style="display: inline-block; width: 100%;">
			<div>
				<a href="<?php echo $linkpath ?>">
					<div class="imagetext_full_funding picture" style="<?php echo 'background-image: url('.Data::getValue( $viewdict, 'featured_imagepath' ).');'; ?>; <?php if( $mediatype == "video" ){ echo 'padding-bottom: 0;';  } ?>)">
						<?php if($mediatype == "video"){ ?>
							<video width="100%" height="auto" autoplay loop>
							  <source src="<?php echo Data::getValue( $viewdict, 'featured_imagepath' ) ?>" type="video/mp4">
							  <source src="<?php echo Data::getValue( $viewdict, 'featured_imagepath' ) ?>" type="video/ogg">
							Your browser does not support the video tag.
							</video>
						<?php } ?>
					</div>
				</a>
				<div class="imagetext_full_funding words">
					<div class="imagetext_full_funding text-container">
						<!-- <label class="grey-label">Today</label> -->
						<br>
						<a href="<?php echo $linkpath ?>">
							<label class="imagetext_full_funding title" style=""><?php echo Data::getValue( $viewdict, 'title' ); ?></label>
						</a>
						<br>
						<label class="imagetext_full_funding grey-label"><?php echo implode(' ', array_slice( explode(' ', strip_tags(Data::getValue( $viewdict, 'html_text' ))), 0, 10) ); ?>...</label>
						<?php Data::add( $viewdict, $identifier . "_bargraph" ); ?>
						<?php echo Section::make( "fundbar", $identifier . "_bargraph") ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

	<?php
		Editing::addEditingToCell( $identifier, $fullviewdict, $celltype );
	?>;
	
</script>