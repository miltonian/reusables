<?php

namespace Reusables;

$viewdict = Data::convertKeys( $viewdict );
	
	if( isset( $viewdict['value'] ) ){ 
		$data_id = Data::getDefaultDataID( $viewdict );
		$viewdict = Data::formatForDefaultData( $data_id ); 
	}
?>

<style>
</style>

<div class="<?php echo $identifier ?> header_2 main" style="background-color: <?php echo Data::getValue( $viewdict, 'backgroundcolor' ) ?>; background-image: url('<?php echo Data::getValue( $viewdict, 'featured_imagepath' ) ?>');">
	<div class="header_2 overlay"></div>
	<a href="<?php echo Data::getValue( $viewdict, 'logolink' ) ?>">
		<img src="<?php echo Data::getValue( $viewdict, 'logo_imagepath' ) ?>" class="header_2" id="logo">
	</a>
</div>

<script>
</script>