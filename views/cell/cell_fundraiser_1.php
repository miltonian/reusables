<?php

namespace Reusables;

	// image left 
	// text right
	
	if(!isset($isadmin)){ $isadmin=false; }
	if( !isset($celldict['type'])){ $celldict['type'] = ""; }
	// if(!isset($celldict['post_id'])){ $celldict['post_id'] = $celldict['id']; }

	$linkpath = "";
	$linkpath .= Data::getValue( $celldict, 'pre_slug' );
	$linkpath .= Data::getValue( $celldict, 'slug' );

	$mediatype = Data::getValue( $celldict, 'mediatype' );

	if( isset($celldict['isfeatured']) ){ $isfeatured = $celldict['isfeatured']; }else { $isfeatured = false; }

	// exit( json_encode( $celldict['needed'] ) );
	// exit( json_encode( Data::getValue( $celldict, 'needed' ) ) );

?>

<style>

</style>

<div class="cell_fundraiser_1 main <?php echo $identifier ?> <?php if($isfeatured){ echo "featured"; } ?> <?php if($mediatype=="youtube" || $mediatype=="podcast"){ echo Data::getValue( $celldict, 'mediatype' ); } ?>" id="<?php echo Data::getValue( $celldict, 'index' ) ?>">
		<a class="cell_fundraiser_1 picture_container" href="<?php echo $linkpath; ?>">
			<div class="cell_fundraiser_1 picture" style="background-color: #333333; <?php if( Data::getValue( $celldict, 'featured_imagepath' ) ){ echo 'background-image: url('.Data::getValue( $celldict, 'featured_imagepath' ).');'; } ?>">
				<?php if( $mediatype ){ ?>
					<video width="100%" height="auto" autoplay loop>
					  <source src="<?php echo Data::getValue( $celldict, 'featured_imagepath' ) ?>" type="video/mp4">
					  <source src="<?php echo Data::getValue( $celldict, 'featured_imagepath' ) ?>" type="video/ogg">
					Your browser does not support the video tag.
					</video>
				<?php } ?>
			</div>
		</a>
		<div class="cell_fundraiser_1 words">
			<div class="cell_fundraiser_1 text-container">
				<a class="cell_fundraiser_1" id="titlelink" href="<?php echo $linkpath; ?>">
					<h2 class="cell_fundraiser_1" id="title" style=""><?php if(isset($celldict['title'])){ echo Data::getValue( $celldict, 'title' ); } ?></h2>
				</a>
				<br>
				<label class="cell_fundraiser_1" id="desc"><?php echo implode(' ', array_slice( explode(' ', strip_tags(Data::getValue( $celldict, 'html_text' ))), 0, 10) ); ?>... <a href="<?php echo $linkpath ?>">Learn More</a></label>
				<?php echo Section::make( "bargraph_1", $celldict, "bargraph") ?>
			</div>
		</div>
</div>

<script>

	var thismodalclass = "";
	<?php if( $celldict['type'] == "modal" ){ ?>
		thismodalclass = new <?php echo $celldict['modal']['modalclass'] ?>Classes();
	<?php }?>



	var celldict = <?php echo json_encode($celldict) ?>;

	$('.<?php echo $identifier ?>').off().click(function(e){
		// e.preventDefault();
		Reusable.addAction( celldict, [thismodalclass], 0 );
	});

</script>