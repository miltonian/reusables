<?php

namespace Reusables;

	// image left 
	// text right
	
	if(!isset($isadmin)){ $isadmin=false; }
	if( !isset($viewdict['type'])){ $viewdict['type'] = ""; }
	// if(!isset($viewdict['post_id'])){ $viewdict['post_id'] = $viewdict['id']; }

	$linkpath = "";
	$linkpath .= Data::getValue( $viewdict, 'pre_slug' );
	$linkpath .= Data::getValue( $viewdict, 'slug' );

	$mediatype = Data::getValue( $viewdict, 'mediatype' );

	if( isset($viewdict['isfeatured']) ){ $isfeatured = $viewdict['isfeatured']; }else { $isfeatured = false; }

	// exit( json_encode( $viewdict['needed'] ) );
	// exit( json_encode( Data::getValue( $viewdict, 'needed' ) ) );

	// exit( json_encode( $viewdict['html_text'] ) );

?>

<style>

</style>

<div class="cell_fundraiser_1 main <?php echo $identifier ?> <?php if($isfeatured){ echo "featured"; } ?> <?php if($mediatype=="youtube" || $mediatype=="podcast"){ echo Data::getValue( $viewdict, 'mediatype' ); } ?>" id="<?php echo Data::getValue( $viewdict, 'index' ) ?>">
		<a class="cell_fundraiser_1 picture_container" href="<?php echo $linkpath; ?>">
			<div class="cell_fundraiser_1 picture" style="background-color: #333333; <?php if( Data::getValue( $viewdict, 'featured_imagepath' ) ){ echo 'background-image: url('.Data::getValue( $viewdict, 'featured_imagepath' ).');'; } ?>">
				<?php if( $mediatype ){ ?>
					<video width="100%" height="auto" autoplay loop>
					  <source src="<?php echo Data::getValue( $viewdict, 'featured_imagepath' ) ?>" type="video/mp4">
					  <source src="<?php echo Data::getValue( $viewdict, 'featured_imagepath' ) ?>" type="video/ogg">
					Your browser does not support the video tag.
					</video>
				<?php } ?>
			</div>
		</a>
		<div class="cell_fundraiser_1 words">
			<div class="cell_fundraiser_1 text-container">
				<a class="cell_fundraiser_1" id="titlelink" href="<?php echo $linkpath; ?>">
					<h2 class="cell_fundraiser_1" id="title" style=""><?php echo implode(' ', array_slice( explode(' ', strip_tags(Data::getValue( $viewdict, 'title' ))), 0, 20) ); ?></h2>
				</a>
				<label class="cell_fundraiser_1" id="desc"><?php echo implode(' ', array_slice( explode(' ', strip_tags(Data::getValue( $viewdict, 'html_text' ))), 0, 20) ); ?>... <a href="<?php echo $linkpath ?>">Learn More</a></label>
				<?php Data::addData( $viewdict, $identifier . "_bargraph" ); ?>
				<?php echo Section::make( "bargraph_1", $identifier . "_bargraph") ?>
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