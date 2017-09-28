<?php

namespace Reusables;

	// image left 
	// text right
	
	extract( Cell::prepareCell( $identifier ) );

?>

<style>
</style>

<div class="cell_8 main <?php echo $identifier ?> <?php if($isfeatured){ echo "featured"; } ?> <?php if($mediatype=="youtube" || $mediatype=="podcast"){ echo Data::getValue( $viewdict, 'mediatype' ); } ?>" id="<?php echo Data::getValue( $viewdict, 'index' ) ?>">
		<a href="<?php echo $linkpath; ?>">
			<div class="cell_8 picture" style="background-color: #333333; <?php if( Data::getValue( $viewdict, 'featured_imagepath' ) ){ echo 'background-image: url('.Data::getValue( $viewdict, 'featured_imagepath' ).');'; } ?>">
				<?php if( $mediatype ){ ?>
					<video width="100%" height="auto" autoplay loop>
					  <source src="<?php echo Data::getValue( $viewdict, 'featured_imagepath' ) ?>" type="video/mp4">
					  <source src="<?php echo Data::getValue( $viewdict, 'featured_imagepath' ) ?>" type="video/ogg">
					Your browser does not support the video tag.
					</video>
				<?php } ?>
			</div>
		</a>
		<div class="cell_8 words">
			<div class="cell_8 text-container">
				<a href="<?php echo $linkpath; ?>">
					<h2 class="cell_8" id="title" style=""><?php if(isset($viewdict['title'])){ echo Data::getValue( $viewdict, 'title' ); } ?></h2>
				</a>
				<br>
				<label class="cell_8" id="desc"><?php echo implode(' ', array_slice( explode(' ', strip_tags(Data::getValue( $viewdict, 'html_text' ))), 0, 10) ); ?>...</label>
			</div>
		</div>
</div>

<script>

	var thismodalclass = "";
	<?php if( $viewdict['type'] == "modal" ){ ?>
		thismodalclass = new <?php echo $viewdict['modal']['modalclass'] ?>Classes();
	<?php }?>



	var viewdict = <?php echo json_encode($viewdict) ?>;

	$('.<?php echo $identifier ?>').off().click(function(e){
		// e.preventDefault();
		Reusable.addAction( viewdict, [thismodalclass], 0 );
	});

</script>