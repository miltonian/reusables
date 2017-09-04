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
	if(!isset($celldict)){ $cell7mediatype=""; }
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

	$description = implode(' ', array_slice( explode(' ', strip_tags(Data::getValue( $celldict, 'html_text' ))), 0, 10) ) . "...";
	if( $description == "..." ){
		$description = "";
	}

	$celldate = Data::getValue( $celldict, 'date' );

?>

<style>
</style>


<div class="sidecell_1 main <?php echo $identifier ?> index_<?php echo $cellindex ?> <?php if($mediatype=="youtube" || $mediatype=="podcast"){ echo $mediatype; } ?> index_<?php echo $cellindex ?>">
	<div class="sidecell_1 leftdiv">
		<a href="<?php echo $linkpath ?>"><div class="sidecell_1 image" style="background-image: url('<?php echo Data::getValue( $celldict, 'featured_imagepath' ) ?>');"></div></a>
	</div>
	<div class="sidecell_1 rightdiv">
		<a href="<?php echo $linkpath ?>"><label class="sidecell_1 title"><?php echo Data::getValue( $celldict, 'title') ?></label></a>
	</div>
</div>


<script>
	
</script>