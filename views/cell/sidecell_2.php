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
	if(!isset($viewdict)){ $cell7mediatype=""; }
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

	$description = implode(' ', array_slice( explode(' ', strip_tags(Data::getValue( $viewdict, 'html_text' ))), 0, 10) ) . "...";
	if( $description == "..." ){
		$description = "";
	}

	$celldate = Data::getValue( $viewdict, 'date' );

?>

<style>
</style>

<div class="sidecell_2 main <?php echo $identifier ?> index_<?php echo $cellindex ?> <?php if($mediatype=="youtube" || $mediatype=="podcast"){ echo $mediatype; } ?> index_<?php echo $cellindex ?>">
	<a href="<?php echo $linkpath ?>">
		<div class="sidecell_2 picture" style="background-color: #333333; <?php if( Data::getValue( $viewdict, 'featured_imagepath' ) ){ echo 'background-image: url('.Data::getValue( $viewdict, 'featured_imagepath' ).');'; } ?>">
			<?php if($mediatype){ ?>
					<video width="100%" height="auto" autoplay loop>
					  <source src="<?php echo Data::getValue( $viewdict, 'featured_imagepath' ) ?>" type="video/mp4">
					  <source src="<?php echo Data::getValue( $viewdict, 'featured_imagepath' ) ?>" type="video/ogg">
					Your browser does not support the video tag.
					</video>
				<?php } ?>
		</div>
		<div class="sidecell_2 words">
			<div class="sidecell_2 text-container">
				<a href="<?php echo $linkpath; ?>">
					<h2 class="sidecell_2" id="title" style=""><?php if(isset($viewdict['title'])){ echo Data::getValue( $viewdict, 'title' ); } ?></h2>
				</a>
				<br>
				<label class="sidecell_2" id="desc"><?php echo implode(' ', array_slice( explode(' ', strip_tags(Data::getValue( $viewdict, 'html_text' ))), 0, 10) ); ?>...</label>
			</div>
		</div>
	</a>
</div>

<script>
</script>