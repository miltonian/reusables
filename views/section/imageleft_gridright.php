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


<div class="viewtype_section imageleft_gridright main <?php echo $identifier ?>">
	<div class="imageleft_gridright left post" style="background-image: url('<?php echo Data::getValue( $images[0], 'imagepath' ) ?>'">
		<a class="imageleft_gridright clicktoedit link one index_0" href="<?php echo Data::getValue( $viewoptions, 'pre_slug' ) ?><?php echo Data::getValue( $images[0], 'slug' ) ?>">
			<div class="imageleft_gridright gradient">
				<h1 class="imageleft_gridright title"><?php echo Data::getValue( $images[0], 'title' ) ?></h1>
			</div>
		</a>
	</div>
	<div class="imageleft_gridright right">
		<div class="imageleft_gridright top">
			<div class="imageleft_gridright topleft post" style="background-image: url('<?php echo Data::getValue( $images[1], 'imagepath' ) ?>'">
				<a class="imageleft_gridright clicktoedit link two index_1" href="<?php echo Data::getValue( $viewoptions, 'pre_slug' ) ?><?php echo Data::getValue( $images[1], 'slug' ) ?>">
					<div class="imageleft_gridright gradient">
						<h1 class="imageleft_gridright title"><?php echo Data::getValue( $images[1], 'title' ) ?></h1>
					</div>
				</a>
			</div>
			<div class="imageleft_gridright topright post" style="background-image: url('<?php echo Data::getValue( $images[2], 'imagepath' ) ?>')">
				<a class="imageleft_gridright clicktoedit link three index_2" href="<?php echo Data::getValue( $viewoptions, 'pre_slug' ) ?><?php echo Data::getValue( $images[2], 'slug' ) ?>">
					<div class="imageleft_gridright gradient">
						<h1 class="imageleft_gridright title"><?php echo Data::getValue( $images[2], 'title' ) ?></h1>
					</div>
				</a>
			</div>
		</div>
		<div class="imageleft_gridright bottom post" style="background-image: url('<?php echo Data::getValue( $images[3], 'imagepath' ) ?>'">
			<a class="imageleft_gridright clicktoedit link four index_3" href="<?php echo Data::getValue( $viewoptions, 'pre_slug' ) ?><?php echo Data::getValue( $images[3], 'slug' ) ?>">
				<div class="imageleft_gridright gradient">
					<h1 class="imageleft_gridright title"><?php echo Data::getValue( $images[3], 'title' ) ?></h1>
				</div>
			</a>
		</div>
	</div>
</div>

<?php Editing::clickToEditSection( $viewdict, $viewoptions, $identifier, __FILE__ ) ?>