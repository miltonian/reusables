<?php

namespace Reusables;

	// image left 
	// text right
	
	extract( Cell::prepareCell( $identifier ) );

?>

<style>
</style>

<div class="viewtype_cell imagetext_inline main <?php echo $identifier ?> <?php if($isfeatured){ echo "featured"; } ?> <?php if($mediatype=="youtube" || $mediatype=="podcast"){ echo Data::getValue( $viewdict, 'mediatype' ); } ?>" id="<?php echo Data::getValue( $viewdict, 'index' ) ?>">
		<a href="<?php echo $linkpath; ?>">
			<div class="imagetext_inline picture" style="background-color: #333333; <?php if( Data::getValue( $viewdict, 'featured_imagepath' ) ){ echo 'background-image: url('.Data::getValue( $viewdict, 'featured_imagepath' ).');'; } ?>">
				<?php if( $mediatype ){ ?>
					<video width="100%" height="auto" autoplay loop>
					  <source src="<?php echo Data::getValue( $viewdict, 'featured_imagepath' ) ?>" type="video/mp4">
					  <source src="<?php echo Data::getValue( $viewdict, 'featured_imagepath' ) ?>" type="video/ogg">
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
				<label class="imagetext_inline" id="desc"><?php echo implode(' ', array_slice( explode(' ', strip_tags(Data::getValue( $viewdict, 'html_text' ))), 0, 10) ); ?>...</label>
			</div>
		</div>
</div>

<script>

	var thismodalclass = "";
	var celltype = <?php echo json_encode( $celltype) ?>;

	<?php if( $celltype == "modal" ){ ?>
		thismodalclass = new <?php echo $viewoptions['modal']['modalclass'] ?>Classes();
		var dataarray = <?php echo json_encode( $fullviewdict ) ?>;
	<?php }?>

	var viewdict = <?php echo json_encode($viewdict) ?>;
	var viewoptions = <?php echo json_encode( $viewoptions ) ?>;

	<?php 
		ReusableClasses::getEditingFunctionsJS( $viewoptions ) 
	?>;

	$('.<?php echo $identifier ?>').off().click(function(e){
		e.preventDefault();

		if( typeof dataarray === 'undefined' ) {
			dataarray = []
		}
		Reusable.addAction( viewdict, [thismodalclass], 0, dataarray, this, e, viewoptions );
	});

</script>