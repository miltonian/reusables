<?php

namespace Reusables;

$viewdict = Data::convertKeys( $viewdict );
	
	if( isset( $viewdict['value'] ) ){ 
		$data_id = Data::getDefaultDataID( $viewdict );
		$viewdict = Data::formatForDefaultData( $data_id ); 
	}


	Views::setParams( 
		[ "backgroundcolor", "featured_imagepath", "logolink", "logo_imagepath" ], 
		[],
		$identifier
	);
?>

<style>
</style>

<div class="viewtype_header <?php echo $identifier ?> brand_in_image main" style="background-color: <?php echo Data::getValue( $viewdict, 'backgroundcolor' ) ?>; background-image: url('<?php echo Data::getValue( $viewdict, 'featured_imagepath' ) ?>');">
	<div class="brand_in_image overlay"></div>
	<a href="<?php echo Data::getValue( $viewdict, 'logolink' ) ?>">
		<img src="<?php echo Data::getValue( $viewdict, 'logo_imagepath' ) ?>" class="brand_in_image" id="logo">
	</a>
</div>

<script>
</script>