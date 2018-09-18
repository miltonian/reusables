<?php

namespace Reusables;


if( isset($viewdict['value']) ){
	$images = $viewdict['value'];
}else{
	$images = $viewdict;
}
$i=0;
foreach ($images as $im) {
	if( isset($viewdict['value']) ){
		$image = RFormat::formatCellWithDefaultData( $identifier , $i );
	}else{
		$image = Data::getValue( $images, $i );
	}
	$images[$i] = $image;
	$i++;
}


foreach ($images as $im) {
	if( isset( $viewoptions['pre_slug'] ) ) {
		$preslug = Data::getValue( $viewoptions, 'pre_slug' );
	}
	$linkpath = Data::getValue( $viewoptions, 'pre_slug' ) . Data::getValue( $im, 'slug' );
}

$fullarray = Data::getFullArray( $viewdict );
if( isset( $viewdict[$identifier]['value'] ) ) {
	$fullviewdict = Data::getFullArray( $viewdict )[$identifier]['value'];
}else{
	$fullviewdict = $viewdict;
}

$optiontype = Data::getValue( $viewoptions, 'type' );

?>


<div class="viewtype_section gallery_preview main <?php echo $identifier ?>">

	<div class="gallery_preview title_container">
		<div class="gallery_preview line"></div>
		<label class="gallery_preview title"><?php echo Data::getValue( $viewoptions, 'title' ) ?></label>
	</div>

	<a class="gallery_preview clicktoedit image one index_0" href="<?php echo Data::getValue( $viewoptions, 'pre_slug' ) ?><?php echo Data::getValue( $images[0], 'slug' ) ?>" style="background-image: url(<?php echo Data::getValue($images[0], 'imagepath') ?>)">
	</a>
	<a class="gallery_preview clicktoedit image two index_1" href="<?php echo Data::getValue( $viewoptions, 'pre_slug' ) ?><?php echo Data::getValue( $images[1], 'slug' ) ?>" style="background-image: url(<?php echo Data::getValue($images[1], 'imagepath') ?>)">
	</a>
	<a class="gallery_preview clicktoedit image three index_2" href="<?php echo Data::getValue( $viewoptions, 'pre_slug' ) ?><?php echo Data::getValue( $images[2], 'slug' ) ?>" style="background-image: url(<?php echo Data::getValue($images[2], 'imagepath') ?>)">
	</a>

	<a class="gallery_preview clicktoedit image four index_3" href="<?php echo Data::getValue( $viewoptions, 'pre_slug' ) ?><?php echo Data::getValue( $images[3], 'slug' ) ?>" style="background-image: url(<?php echo Data::getValue($images[3], 'imagepath') ?>)">
	</a>
	<a class="gallery_preview clicktoedit image five index_4" href="<?php echo Data::getValue( $viewoptions, 'pre_slug' ) ?><?php echo Data::getValue( $images[4], 'slug' ) ?>" style="background-image: url(<?php echo Data::getValue($images[4], 'imagepath') ?>)">
	</a>
	<a class="gallery_preview clicktoedit image six index_5" href="<?php echo Data::getValue( $viewoptions, 'pre_slug' ) ?><?php echo Data::getValue( $images[5], 'slug' ) ?>" style="background-image: url(<?php echo Data::getValue($images[5], 'imagepath') ?>)">
	</a>

	<a class="gallery_preview clicktoedit image seven index_6" href="<?php echo Data::getValue( $viewoptions, 'pre_slug' ) ?><?php echo Data::getValue( $images[6], 'slug' ) ?>" style="background-image: url(<?php echo Data::getValue($images[6], 'imagepath') ?>)">
	</a>
	<a class="gallery_preview clicktoedit image eight index_7" href="<?php echo Data::getValue( $viewoptions, 'pre_slug' ) ?><?php echo Data::getValue( $images[7], 'slug' ) ?>" style="background-image: url(<?php echo Data::getValue($images[7], 'imagepath') ?>)">
	</a>
	<a class="gallery_preview clicktoedit image nine index_8" href="<?php echo Data::getValue( $viewoptions, 'pre_slug' ) ?><?php echo Data::getValue( $images[8], 'slug' ) ?>" style="background-image: url(<?php echo Data::getValue($images[8], 'imagepath') ?>)">
	</a>
</div>

<script>

		$('.gallery_preview.clicktoedit').click(function(e){
			<?php
				Editing::setUpEditingForSection( $viewdict, $viewoptions, $identifier );
			?>
		})


</script>