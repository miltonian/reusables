<?php 

	namespace Reusables;

	Views::setParams( 
		[ "category", "data_id", "fullviewdict", "linkpath", "mediatype", "cellindex", "description", "celldate", "celltype", "imagepath", "title", "slug" ],
		[],
		$identifier
	);

	$viewdict = Data::convertKeysInTable( $identifier, $viewdict );
	


	extract( Cell::prepareCell( $identifier ) );

	// exit( json_encode( Data::getValue( $viewdict, 'title' ) ) );

?>

<style>
</style>



<div class="viewtype_cell imagetext_full main <?php echo $identifier ?> index_<?php echo $cellindex ?> <?php if($mediatype=="youtube" || $mediatype=="podcast"){ echo $mediatype; } ?> index_<?php echo $cellindex ?>" >
	<div class="imagetext_full container">
		<div style="display: inline-block; width: 100%;">
			<div>
				<a href="<?php echo $linkpath ?>">
					<div class="imagetext_full picture" style="<?php echo 'background-image: url('.Data::getValue( $viewdict, 'imagepath' ).');'; ?>; <?php if( $mediatype == "video" ){ echo 'padding-bottom: 0;';  } ?>)">
						<?php if($mediatype == "video"){ ?>
							<video width="100%" height="auto" autoplay loop>
							  <source src="<?php echo Data::getValue( $viewdict, 'imagepath' ) ?>" type="video/mp4">
							  <source src="<?php echo Data::getValue( $viewdict, 'imagepath' ) ?>" type="video/ogg">
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
						<label class="imagetext_full grey-label"><?php echo Data::getValue( $html_text ) ?></label>
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