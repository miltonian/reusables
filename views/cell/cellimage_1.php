<?php 

	namespace Reusables;

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

	if( isset( $celldict['linkpath'] ) ){
		$linkpath = Data::getValue( $celldict, 'linkpath' );
	}

	$mediatype = Data::getValue( $celldict, 'mediatype' );

	// echo Data::getValue( $celldict, 'id' )
	$cellindex = Data::getValue( $celldict, 'index' );
	// echo json_encode($cellindex);
	// exit(json_encode($cellindex));



?>

<div class="cellimage_1 main <?php echo $identifier ?> <?php if($celldict['isfeatured']){ echo "featured"; } ?> <?php if($mediatype=="youtube" || $mediatype=="podcast"){ echo $mediatype; } ?> index_<?php echo $cellindex ?>" id="<?php echo Data::getValue( $celldict, 'id' ) ?>">

	<div class="cellimage_1 container">
		<div style="display: inline-block; width: 100%;">
			<div>
				<a href="<?php echo $linkpath ?>">
					<div class="cellimage_1 picture" style="<?php echo 'background-image: url('.Data::getValue( $celldict, 'featured_imagepath' ).');'; ?>">
						<label class="cellimage_1 title"><?php echo Data::getValue( $celldict, 'title' ) ?></label>
					</div>
				</a>
			</div>
		</div>
	</div>
</div>