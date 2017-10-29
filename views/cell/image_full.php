<?php 

	namespace Reusables;

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

	if( isset( $viewdict['linkpath'] ) ){
		$linkpath = Data::getValue( $viewdict, 'linkpath' );
	}

	$mediatype = Data::getValue( $viewdict, 'mediatype' );

	// echo Data::getValue( $viewdict, 'id' )
	$cellindex = Data::getValue( $viewdict, 'index' );
	// echo json_encode($cellindex);
	// exit(json_encode($cellindex));


	Views::setParams( 
		[ "category", "data_id", "fullviewdict", "linkpath", "mediatype", "cellindex", "description", "celldate", "celltype", "id", "featured_imagepath", "title", "slug" ],
		[],
		$identifier
	);
	
?>

<div class="viewtype_cell image_full main <?php echo $identifier ?> <?php if($viewdict['isfeatured']){ echo "featured"; } ?> <?php if($mediatype=="youtube" || $mediatype=="podcast"){ echo $mediatype; } ?> index_<?php echo $cellindex ?>" id="<?php echo Data::getValue( $viewdict, 'id' ) ?>">

	<div class="image_full container">
		<div style="display: inline-block; width: 100%;">
			<div>
				<a href="<?php echo $linkpath ?>">
					<div class="image_full picture" style="<?php echo 'background-image: url('.Data::getValue( $viewdict, 'featured_imagepath' ).');'; ?>">
						<label class="image_full title"><?php echo Data::getValue( $viewdict, 'title' ) ?></label>
					</div>
				</a>
			</div>
		</div>
	</div>
</div>

<script>

	<?php
		ReusableClasses::addEditingToCell( $identifier, $fullviewdict, $celltype );
	?>;
	
</script>