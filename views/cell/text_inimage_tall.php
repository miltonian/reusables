<?php 

	namespace Reusables;

	$viewdict = Data::convertKeysInTable( $identifier, $viewdict );
	
	
	extract( Cell::prepareCell( $identifier ) );


?>

<style>
</style>



<div class="viewtype_cell text_inimage_tall main <?php echo $identifier ?> index_<?php echo $cellindex ?> <?php if($mediatype=="youtube" || $mediatype=="podcast"){ echo $mediatype; } ?> index_<?php echo $cellindex ?>" >
	<div class="text_inimage_tall container">
		<div style="display: inline-block; width: 100%;">
			<div>
				<a href="<?php echo $linkpath ?>" >
					<div class="text_inimage_tall picture" style="<?php echo 'background-image: url('.Data::getValue( $viewdict, 'imagepath', $table_identifier ).');'; ?>; <?php if( $mediatype == "video" ){ echo 'padding-bottom: 0;';  } ?>)">
						<?php if($mediatype == "video"){ ?>
							<video width="100%" height="auto" autoplay loop>
							  <source src="<?php echo Data::getValue( $viewdict, 'imagepath', $table_identifier ) ?>" type="video/mp4">
							  <source src="<?php echo Data::getValue( $viewdict, 'imagepath', $table_identifier ) ?>" type="video/ogg">
							Your browser does not support the video tag.
							</video>
						<?php } ?>
						<div class="text_inimage_tall words">
							<div class="text_inimage_tall gradient"></div>
							<div class="text_inimage_tall text-container">
								<!-- <label class="grey-label">Today</label> -->
								<label class="text_inimage_tall category"><?php echo Data::getValue( $viewdict, 'category', $table_identifier ) ?></label>
								<br>
								<!-- <a href="<?php echo $linkpath ?>"> -->
									<label class="text_inimage_tall title" style=""><?php echo Data::getValue( $viewdict, 'title', $table_identifier ); ?></label>

								<!-- </a> -->
								<br>
								<label class="text_inimage_tall grey-label"><?php echo Data::getValue( $html_text ) ?></label>
							</div>
						</div>
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