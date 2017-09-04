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

<a href="<?php echo $linkpath ?>">
<div class="cell_7 main <?php echo $identifier ?> index_<?php echo $cellindex ?> <?php if($mediatype=="youtube" || $mediatype=="podcast"){ echo $mediatype; } ?> index_<?php echo $cellindex ?>" style="background-image: url(<?php echo $celldict['featured_imagepath'] ?>)">
		<div class="cell_7 gradient"></div>
		<label class="cell_7 title mobile"><?php echo Data::getValue( $celldict, 'title' ) ?></label>
		<label class="cell_7 title desktop"><?php echo Data::getValue( $celldict, 'title' ) ?></label>
		<?php if($celldate!=""){ ?>
			<label class="cell_7 date"><?php echo $celldate ?></label>
		<?php } ?>
	</div>
</a>

<script>

	var thismodalclass = "";
	<?php if( $celldict['type'] == "modal" ){ ?>
		thismodalclass = new <?php echo $celldict['modal']['modalclass'] ?>Classes();
		var dataarray = <?php echo json_encode( $fullcelldict ) ?>;
	<?php }?>



	var celldict = <?php echo json_encode($celldict) ?>;

	$('.<?php echo $identifier ?>').off().click(function(e){
		// e.preventDefault();
		// alert( JSON.stringify(thismodalclass ) );
		Reusable.addAction( celldict, [thismodalclass], 0, dataarray, this );
	});
	
</script>