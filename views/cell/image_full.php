<?php 

	namespace Reusables;

	Views::setParams( 
		[ "category", "data_id", "fullviewdict", "linkpath", "mediatype", "cellindex", "html_text", "celldate", "celltype", "imagepath", "title", "slug" ],
		[],
		$identifier
	);

	$viewdict = Convert::keysInTable( $identifier, $viewdict );
	


	extract( Cell::prepareCell( $identifier ) );


	$isyoutube = false;
	if( substr( Data::getValue( $viewdict, 'imagepath' ), 0, 13 ) == "https://youtu" || substr( Data::getValue( $viewdict, 'imagepath' ), 0, 17 ) == "https://www.youtu" ) {
		$isyoutube = true;
		$youtube_src = Data::getValue( $viewdict, 'imagepath' );
		$youtube_frame = preg_replace(
		"/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
		"<iframe class='image_full picture' width=\"100%\" height=\"44%\" src=\"//www.youtube.com/embed/$2\" allowfullscreen></iframe>", $youtube_src);

		// exit( json_encode( $youtube_src ) );
	} 
	
?>

<div class="viewtype_cell image_full main <?php echo $identifier ?> <?php if($viewdict['isfeatured']){ echo "featured"; } ?> <?php if($mediatype=="youtube" || $mediatype=="podcast"){ echo $mediatype; } ?> index_<?php echo $cellindex ?>" id="<?php echo Data::getValue( $viewdict, 'id' ) ?>">

	<div class="image_full container">
		<div style="display: inline-block; width: 100%;">
			<div>
				<a href="<?php echo $linkpath ?>">
					<?php if( $isyoutube ) { ?>
						<?php echo $youtube_frame; ?>
					<?php } else { ?>
						<div class="image_full picture" style="<?php echo 'background-image: url('.Data::getValue( $viewdict, 'imagepath' ).');'; ?>">
							<label class="image_full title"><?php echo Data::getValue( $viewdict, 'title' ) ?></label>
						</div>
					<?php } ?>
				</a>
			</div>
		</div>
	</div>
</div>

<script>

	<?php
		Editing::addEditingToCell( $identifier, $fullviewdict, $celltype );
	?>;
	
</script>