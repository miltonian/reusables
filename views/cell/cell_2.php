<?php 

	namespace Reusables;

	extract( Cell::prepareCell( $identifier ) );

?>

<style>
</style>



<div class="cell_2 main <?php echo $identifier ?> index_<?php echo $cellindex ?> <?php if($mediatype=="youtube" || $mediatype=="podcast"){ echo $mediatype; } ?> index_<?php echo $cellindex ?>" >
	<div class="cell_2 container">
		<div style="display: inline-block; width: 100%;">
			<div>
				<a href="<?php echo $linkpath ?>">
					<div class="cell_2 picture" style="<?php echo 'background-image: url('.Data::getValue( $viewdict, 'featured_imagepath' ).');'; ?>; <?php if( $mediatype == "video" ){ echo 'padding-bottom: 0;';  } ?>)">
						<?php if($mediatype == "video"){ ?>
							<video width="100%" height="auto" autoplay loop>
							  <source src="<?php echo Data::getValue( $viewdict, 'featured_imagepath' ) ?>" type="video/mp4">
							  <source src="<?php echo Data::getValue( $viewdict, 'featured_imagepath' ) ?>" type="video/ogg">
							Your browser does not support the video tag.
							</video>
						<?php } ?>
					</div>
				</a>
				<div class="cell_2 words">
					<div class="cell_2 text-container">
						<!-- <label class="grey-label">Today</label> -->
						<br>
						<a href="<?php echo $linkpath ?>">
							<label class="cell_2 title" style=""><?php echo Data::getValue( $viewdict, 'title' ); ?></label>
						</a>
						<br>
						<label class="cell_2 grey-label"><?php echo $description ?></label>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

	var thismodalclass = "";
	<?php if( $celltype == "modal" ){ ?>
		thismodalclass = new <?php echo $viewoptions['modal']['modalclass'] ?>Classes();
		var dataarray = <?php echo json_encode( $fullviewdict ) ?>;
	<?php }?>



	var viewdict = <?php echo json_encode($viewdict) ?>;

	$('.<?php echo $identifier ?>').off().click(function(e){
		// e.preventDefault();
		// alert( JSON.stringify(thismodalclass ) );
		Reusable.addAction( viewdict, [thismodalclass], 0, dataarray, this );
	});
	
</script>