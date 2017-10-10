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
	$linkpath .= Data::getValue( $viewoptions, 'pre_slug' );
	$linkpath .= Data::getValue( $viewdict, 'slug' );

	$mediatype = Data::getValue( $viewdict, 'mediatype' );

	// echo Data::getValue( $viewdict, 'id' )
	$cellindex = Data::getValue( $viewdict, 'index' );
	// echo json_encode($cellindex);
	// exit(json_encode($cellindex));

?>

<style>
</style>



<div id="<?php echo $cellindex ?>" class="viewtype_cell imagetext_full_funding main <?php echo $identifier ?> <?php if($viewdict['isfeatured']){ echo "featured"; } ?> <?php if($mediatype=="youtube" || $mediatype=="podcast"){ echo $mediatype; } ?> index_<?php echo $cellindex ?>" >
	<div class="imagetext_full_funding container">
		<div style="display: inline-block; width: 100%;">
			<div>
				<a href="<?php echo $linkpath ?>">
					<div class="imagetext_full_funding picture" style="<?php echo 'background-image: url('.Data::getValue( $viewdict, 'featured_imagepath' ).');'; ?>; <?php if( $mediatype == "video" ){ echo 'padding-bottom: 0;';  } ?>)">
						<?php if($mediatype == "video"){ ?>
							<video width="100%" height="auto" autoplay loop>
							  <source src="<?php echo Data::getValue( $viewdict, 'featured_imagepath' ) ?>" type="video/mp4">
							  <source src="<?php echo Data::getValue( $viewdict, 'featured_imagepath' ) ?>" type="video/ogg">
							Your browser does not support the video tag.
							</video>
						<?php } ?>
					</div>
				</a>
				<div class="imagetext_full_funding words">
					<div class="imagetext_full_funding text-container">
						<!-- <label class="grey-label">Today</label> -->
						<br>
						<a href="<?php echo $linkpath ?>">
							<label class="imagetext_full_funding title" style=""><?php echo Data::getValue( $viewdict, 'title' ); ?></label>
						</a>
						<br>
						<label class="imagetext_full_funding grey-label"><?php echo implode(' ', array_slice( explode(' ', strip_tags(Data::getValue( $viewdict, 'html_text' ))), 0, 10) ); ?>...</label>
						<?php Data::addData( $viewdict, $identifier . "_bargraph" ); ?>
						<?php echo Section::make( "fundbar", $identifier . "_bargraph") ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

	<?php
		ReusableClasses::addEditingToCell( $identifier, $fullviewdict, $celltype );
	?>;
	
</script>