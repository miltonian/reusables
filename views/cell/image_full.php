<?php 

	namespace Reusables;

	Views::setParams( 
		[ "category", "data_id", "fullviewdict", "linkpath", "mediatype", "cellindex", "description", "celldate", "celltype", "featured_imagepath", "title", "slug" ],
		[],
		$identifier
	);

	$viewdict = Data::convertKeysInTable( $identifier, $viewdict );
	


	extract( Cell::prepareCell( $identifier ) );
	
?>

<div class="viewtype_cell image_full main <?php echo $identifier ?> <?php if($viewdict['isfeatured']){ echo "featured"; } ?> <?php if($mediatype=="youtube" || $mediatype=="podcast"){ echo $mediatype; } ?> index_<?php echo $cellindex ?>" id="<?php echo Data::getValue( $viewdict, 'id' ) ?>">

	<div class="image_full container">
		<div style="display: inline-block; width: 100%;">
			<div>
				<a href="<?php echo $linkpath ?>">
					<div class="image_full picture" style="<?php echo 'background-image: url('.Data::getValue( $viewdict, 'featured_imagepath' ).');'; ?>">
						<label class="image_full title"><?php echo Data::getValue( $viewdict, 'title' ) ?></label>
					</div>
				</a>
			</div>
		</div>
	</div>
</div>

<script>

	<?php
		ReusableClasses::addEditingToCell( $identifier, $fullviewdict, $celltype );
	?>;
	
</script>