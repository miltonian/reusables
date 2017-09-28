<?php 

namespace Reusables;

	/*
		[
			"id"=>"",
			"title"=>"",
			"featured_imagepath"=>"",
			"html_text"=>"",
			"isfeatured"=>""
		]
	*/

	$data_id = Data::getDefaultDataID( $viewdict );
	$fullviewdict = Data::getFullArray( $viewdict );
	if(!isset($viewdict)){ $cell2mediatype=""; }
	if( !isset($viewdict['type'])){ $viewdict['type'] = ""; }
	if( !isset($viewdict['isfeatured']) ){ $viewdict['isfeatured']=false; }
	// if( !isset($mediatype) ){ $mediatype="post"; }
	if( !isset($isadmin) ){ $isadmin=false; }
	// if(!isset($viewdict['id'])){ $viewdict['id'] = $viewdict['id']; }

	$linkpath = "";
	$linkpath .= Data::getValue( $viewdict, 'pre_slug' );
	$linkpath .= Data::getValue( $viewdict, 'slug' );

	$mediatype = Data::getValue( $viewdict, 'mediatype' );

	// echo Data::getValue( $viewdict, 'id' )
	$cellindex = Data::getValue( $viewdict, 'index' );
	// echo json_encode($cellindex);
	// exit(json_encode($cellindex));

?>

<style>
</style>



<div id="<?php echo $cellindex ?>" class="cell_fundraiser_2 main <?php echo $identifier ?> <?php if($viewdict['isfeatured']){ echo "featured"; } ?> <?php if($mediatype=="youtube" || $mediatype=="podcast"){ echo $mediatype; } ?> index_<?php echo $cellindex ?>" >
	<div class="cell_fundraiser_2 container">
		<div style="display: inline-block; width: 100%;">
			<div>
				<a href="<?php echo $linkpath ?>">
					<div class="cell_fundraiser_2 picture" style="<?php echo 'background-image: url('.Data::getValue( $viewdict, 'featured_imagepath' ).');'; ?>; <?php if( $mediatype == "video" ){ echo 'padding-bottom: 0;';  } ?>)">
						<?php if($mediatype == "video"){ ?>
							<video width="100%" height="auto" autoplay loop>
							  <source src="<?php echo Data::getValue( $viewdict, 'featured_imagepath' ) ?>" type="video/mp4">
							  <source src="<?php echo Data::getValue( $viewdict, 'featured_imagepath' ) ?>" type="video/ogg">
							Your browser does not support the video tag.
							</video>
						<?php } ?>
					</div>
				</a>
				<div class="cell_fundraiser_2 words">
					<div class="cell_fundraiser_2 text-container">
						<!-- <label class="grey-label">Today</label> -->
						<br>
						<a href="<?php echo $linkpath ?>">
							<label class="cell_fundraiser_2 title" style=""><?php echo Data::getValue( $viewdict, 'title' ); ?></label>
						</a>
						<br>
						<label class="cell_fundraiser_2 grey-label"><?php echo implode(' ', array_slice( explode(' ', strip_tags(Data::getValue( $viewdict, 'html_text' ))), 0, 10) ); ?>...</label>
						<?php Data::addData( $viewdict, $identifier . "_bargraph" ); ?>
						<?php echo Section::make( "bargraph_1", $identifier . "_bargraph") ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

	var thismodalclass = "";
	<?php if( $viewdict['type'] == "modal" ){ ?>
		thismodalclass = new <?php echo $viewdict['modal']['modalclass'] ?>Classes();
		var dataarray = <?php echo json_encode( $fullviewdict ) ?>;
	<?php }?>



	var viewdict = <?php echo json_encode($viewdict) ?>;

	$('.<?php echo $identifier ?>').off().click(function(e){
		// e.preventDefault();
		Reusable.addAction( viewdict, [thismodalclass], 0, dataarray, this );
	});
	
</script>