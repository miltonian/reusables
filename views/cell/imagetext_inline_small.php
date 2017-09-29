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


<div class="imagetext_inline_small main <?php echo $identifier ?> index_<?php echo $cellindex ?> <?php if($mediatype=="youtube" || $mediatype=="podcast"){ echo $mediatype; } ?> index_<?php echo $cellindex ?>">
	<div class="imagetext_inline_small leftdiv">
		<a href="<?php echo $linkpath ?>"><div class="imagetext_inline_small image" style="background-image: url('<?php echo Data::getValue( $viewdict, 'featured_imagepath' ) ?>');"></div></a>
	</div>
	<div class="imagetext_inline_small rightdiv">
		<a href="<?php echo $linkpath ?>"><label class="imagetext_inline_small title"><?php echo Data::getValue( $viewdict, 'title') ?></label></a>
	</div>
</div>


<script>
	
</script>