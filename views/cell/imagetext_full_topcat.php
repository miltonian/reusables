<?php 

	namespace Reusables;

	$viewdict = Convert::keysInTable( $identifier, $viewdict );
	
	extract( Cell::prepareCell( $identifier ) );

?>

<div class="viewtype_cell imagetext_full_topcat main <?php echo $identifier ?> index_<?php echo $cellindex ?> <?php if($mediatype=="youtube" || $mediatype=="podcast"){ echo $mediatype; } ?> index_<?php echo $cellindex ?>" >
	<div class="imagetext_full_topcat container">
		<div style="display: inline-block; width: 100%;">
			<div>
				<a href="<?php echo $linkpath ?>">
					<div class="imagetext_full_topcat picture" style="<?php echo 'background-image: url('.Data::getValue( $viewdict, 'imagepath', $table_identifier ).');'; ?>; <?php if( $mediatype == "video" ){ echo 'padding-bottom: 0;';  } ?>)">
						<?php if($mediatype == "video"){ ?>
							<video width="100%" height="auto" autoplay loop>
							  <source src="<?php echo Data::getValue( $viewdict, 'featured_imagepath', $table_identifier ) ?>" type="video/mp4">
							  <source src="<?php echo Data::getValue( $viewdict, 'featured_imagepath', $table_identifier ) ?>" type="video/ogg">
							Your browser does not support the video tag.
							</video>
						<?php } ?>
					</div>
				</a>
				<div class="imagetext_full_topcat words">
					<div class="imagetext_full_topcat text-container">
						<label class="imagetext_full_topcat category"><?php echo Data::getValue( $viewdict, 'category', $table_identifier ) ?></label>
						<br>
						<a href="<?php echo $linkpath ?>">
							<label class="imagetext_full_topcat title" style=""><?php echo Data::getValue( $viewdict, 'title', $table_identifier ); ?></label>

						</a>
						<br>
						<label class="imagetext_full_topcat grey-label"><?php echo Data::getValue( $html_text ) ?></label>
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