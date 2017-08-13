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

	$data_id = Data::getDefaultDataID( $celldict );
	$fullcelldict = Data::getFullArray( $celldict );
	if(!isset($celldict)){ $cell2mediatype=""; }
	if( !isset($celldict['type'])){ $celldict['type'] = ""; }
	if( !isset($celldict['isfeatured']) ){ $celldict['isfeatured']=false; }
	// if( !isset($mediatype) ){ $mediatype="post"; }
	if( !isset($isadmin) ){ $isadmin=false; }
	// if(!isset($celldict['id'])){ $celldict['id'] = $celldict['id']; }

	$linkpath = "";
	$linkpath .= Data::getValue( $celldict, 'pre_slug' );
	$linkpath .= Data::getValue( $celldict, 'slug' );

	$mediatype = Data::getValue( $celldict, 'mediatype' );

	// echo Data::getValue( $celldict, 'id' )
	$cellindex = Data::getValue( $celldict, 'index' );
	// echo json_encode($cellindex);
	// exit(json_encode($cellindex));

?>

<style>
</style>



<div id="<?php echo $cellindex ?>" class="cell_fundraiser_2 main <?php echo $identifier ?> <?php if($celldict['isfeatured']){ echo "featured"; } ?> <?php if($mediatype=="youtube" || $mediatype=="podcast"){ echo $mediatype; } ?> index_<?php echo $cellindex ?>" >
	<div class="cell_fundraiser_2 container">
		<div style="display: inline-block; width: 100%;">
			<div>
				<a href="<?php echo $linkpath ?>">
					<div class="cell_fundraiser_2 picture" style="<?php echo 'background-image: url('.Data::getValue( $celldict, 'featured_imagepath' ).');'; ?>; <?php if( $mediatype == "video" ){ echo 'padding-bottom: 0;';  } ?>)">
						<?php if($mediatype == "video"){ ?>
							<video width="100%" height="auto" autoplay loop>
							  <source src="<?php echo Data::getValue( $celldict, 'featured_imagepath' ) ?>" type="video/mp4">
							  <source src="<?php echo Data::getValue( $celldict, 'featured_imagepath' ) ?>" type="video/ogg">
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
							<label class="cell_fundraiser_2 title" style=""><?php echo Data::getValue( $celldict, 'title' ); ?></label>
						</a>
						<br>
						<label class="cell_fundraiser_2 grey-label"><?php echo implode(' ', array_slice( explode(' ', strip_tags(Data::getValue( $celldict, 'html_text' ))), 0, 10) ); ?>...</label>
						<?php Data::addData( $celldict, $identifier . "_bargraph" ); ?>
						<?php echo Section::make( "bargraph_1", $identifier . "_bargraph") ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

	var thismodalclass = "";
	<?php if( $celldict['type'] == "modal" ){ ?>
		thismodalclass = new <?php echo $celldict['modal']['modalclass'] ?>Classes();
		var dataarray = <?php echo json_encode( $fullcelldict ) ?>;
	<?php }?>



	var celldict = <?php echo json_encode($celldict) ?>;

	$('.<?php echo $identifier ?>').off().click(function(e){
		// e.preventDefault();
		Reusable.addAction( celldict, [thismodalclass], 0, dataarray, this );
	});
	
</script>