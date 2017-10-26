<?php 

	namespace Reusables;

	extract( Cell::prepareCell( $identifier ) );


	// exit( json_encode( $fullviewdict ) );

?>

<style>
</style>



<div class="viewtype_cell imagetext_full main <?php echo $identifier ?> index_<?php echo $cellindex ?> <?php if($mediatype=="youtube" || $mediatype=="podcast"){ echo $mediatype; } ?> index_<?php echo $cellindex ?>" >
	<div class="imagetext_full container">
		<div style="display: inline-block; width: 100%;">
			<div>
				<a href="<?php echo $linkpath ?>">
					<div class="imagetext_full picture" style="<?php echo 'background-image: url('.Data::getValue( $viewdict, 'featured_imagepath' ).');'; ?>; <?php if( $mediatype == "video" ){ echo 'padding-bottom: 0;';  } ?>)">
						<?php if($mediatype == "video"){ ?>
							<video width="100%" height="auto" autoplay loop>
							  <source src="<?php echo Data::getValue( $viewdict, 'featured_imagepath' ) ?>" type="video/mp4">
							  <source src="<?php echo Data::getValue( $viewdict, 'featured_imagepath' ) ?>" type="video/ogg">
							Your browser does not support the video tag.
							</video>
						<?php } ?>
					</div>
				</a>
				<div class="imagetext_full words">
					<div class="imagetext_full text-container">
						<!-- <label class="grey-label">Today</label> -->
						<label class="imagetext_full category"><?php echo Data::getValue( $viewdict, 'category' ) ?></label>
						<br>
						<a href="<?php echo $linkpath ?>">
							<label class="imagetext_full title" style=""><?php echo Data::getValue( $viewdict, 'title' ); ?></label>
						</a>
						<br>
						<label class="imagetext_full grey-label"><?php echo $description ?></label>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

	<?php
		ReusableClasses::addEditingToCell( $identifier, $fullviewdict, $celltype );
	?>;
	
</script>