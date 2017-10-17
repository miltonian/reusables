<?php

namespace Reusables;

// exit( json_encode( $viewdict ) );

// exit( json_encode( $viewdictvalue ) );
// $viewdict = Data::convertKeysInTable( $identifier, $viewdict );

// exit( json_encode( $viewdict ) );
if( isset($viewdict['value']) ){
	$images = $viewdict['value'];
}else{
	$images = $viewdict;
}
$i=0;
foreach ($images as $im) {
	if( isset($viewdict['value']) ){
		$image = Data::formatCellWithDefaultData( $identifier , $i );
	}else{
		$image = Data::getValue( $images, $i );
	}
	$images[$i] = $image;
	$i++;
}


// $images = Data::getValue( $viewdict, 'value' );
// $images = Data::convertKeys( $images, $identifier );
// exit( json_encode( $images[2] ) );
// $linkpath = Data::getValue( $viewoptions, 'pre_slug' ) . Data::getValue( $viewdict, 'slug' );
foreach ($images as $im) {
	// exit( json_encode( $viewdict ) );
	if( isset( $viewoptions['pre_slug'] ) ) {
		$preslug = Data::getValue( $viewoptions, 'pre_slug' );
	}
	$linkpath = Data::getValue( $viewoptions, 'pre_slug' ) . Data::getValue( $viewdict, 'slug' );
}

$fullarray = Data::getFullArray( $viewdict );
if( isset( $viewdict[$identifier]['value'] ) ) {
	$fullviewdict = Data::getFullArray( $viewdict )[$identifier]['value'];
}else{
	$fullviewdict = $viewdict;
}

$optiontype = Data::getValue( $viewoptions, 'type' );
// exit( json_encode( $fullviewdict ) );

?>


<div class="viewtype_section imageleft_gridright main <?php echo $identifier ?>">
	<div class="imageleft_gridright left post" style="background-image: url('<?php echo Data::getValue( $images[0], 'featured_imagepath' ) ?>'">
		<a class="imageleft_gridright link one index_0" href="<?php echo Data::getValue( $viewoptions, 'pre_slug' ) ?><?php echo Data::getValue( $images[0], 'slug' ) ?>">
			<div class="imageleft_gridright gradient">
				<h1 class="imageleft_gridright title"><?php echo Data::getValue( $images[0], 'title' ) ?></h1>
			</div>
		</a>
	</div>
	<div class="imageleft_gridright right">
		<div class="imageleft_gridright top">
			<div class="imageleft_gridright topleft post" style="background-image: url('<?php echo Data::getValue( $images[1], 'featured_imagepath' ) ?>'">
				<a class="imageleft_gridright link two index_1" href="<?php echo Data::getValue( $viewoptions, 'pre_slug' ) ?><?php echo Data::getValue( $images[1], 'slug' ) ?>">
					<div class="imageleft_gridright gradient">
						<h1 class="imageleft_gridright title"><?php echo Data::getValue( $images[1], 'title' ) ?></h1>
					</div>
				</a>
			</div>
			<div class="imageleft_gridright topright post" style="background-image: url('<?php echo Data::getValue( $images[2], 'featured_imagepath' ) ?>')">
				<a class="imageleft_gridright link three index_2" href="<?php echo Data::getValue( $viewoptions, 'pre_slug' ) ?><?php echo Data::getValue( $images[2], 'slug' ) ?>">
					<div class="imageleft_gridright gradient">
						<h1 class="imageleft_gridright title"><?php echo Data::getValue( $images[2], 'title' ) ?></h1>
					</div>
				</a>
			</div>
		</div>
		<div class="imageleft_gridright bottom post" style="background-image: url('<?php echo Data::getValue( $images[3], 'featured_imagepath' ) ?>'">
			<a class="imageleft_gridright link four index_3" href="<?php echo Data::getValue( $viewoptions, 'pre_slug' ) ?><?php echo Data::getValue( $images[3], 'slug' ) ?>">
				<div class="imageleft_gridright gradient">
					<h1 class="imageleft_gridright title"><?php echo Data::getValue( $images[3], 'title' ) ?></h1>
				</div>
			</a>
		</div>
	</div>
</div>

<script>
	
	var viewdict = <?php echo json_encode( $viewdict ) ?>;
	var viewoptions = <?php echo json_encode( $viewoptions ) ?>;

	var thismodalclass = "";
	<?php $celltype = "" ?>
	var type = <?php echo json_encode( $optiontype ) ?>;

	<?php if( $celltype == "modal" ){ ?>
		thismodalclass = new <?php echo $viewoptions['modal']['modalclass'] ?>Classes();
		var dataarray = <?php echo json_encode( $fullviewdict ) ?>;
	<?php } ?>

	var viewdict = <?php echo json_encode($viewdict) ?>;
	var viewoptions = <?php echo json_encode( $viewoptions ) ?>;

	$('.<?php echo $identifier ?> .imageleft_gridright.link').off().click(function(e){ 
		<?php $arrayindex = 1; ?>

		var optiontype = <?php echo json_encode($optiontype) ?>;
		if( optiontype == "modal" || optiontype == "dropdown" ) { 
			e.preventDefault();
			if( typeof dataarray === "undefined" ) { 
				dataarray = []
			}
			Reusable.addAction( viewdict, [thismodalclass], 0, dataarray, this, e, viewoptions );
		}

		<?php 
			ReusableClasses::getEditingFunctionsJS( $viewoptions ) ;
		?>

		if( typeof dataarray === "undefined" ) {
			dataarray = []
		}
		var viewdict = <?php echo json_encode($viewdict) ?>;
		var viewoptions = <?php echo  json_encode( $viewoptions ) ?>;
		Reusable.addAction( viewdict, [thismodalclass], 0, dataarray, this, e, viewoptions );
		
	});

</script>