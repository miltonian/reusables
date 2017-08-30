<?php

namespace Reusables;

$headerdict = Data::convertKeys( $headerdict );
	
	if( isset( $headerdict['value'] ) ){ 
		$data_id = Data::getDefaultDataID( $headerdict );
		$headerdict = Data::formatForDefaultData( $data_id ); 
	}
?>

<style>
</style>

<div class="<?php echo $identifier ?> header_2 main" style="background-color: <?php echo Data::getValue( $headerdict, 'backgroundcolor' ) ?>; background-image: url('<?php echo Data::getValue( $headerdict, 'featured_imagepath' ) ?>');">
	<div class="header_2 overlay"></div>
	<a href="<?php echo Data::getValue( $headerdict, 'logolink' ) ?>">
		<img src="<?php echo Data::getValue( $headerdict, 'logo_imagepath' ) ?>" class="header_2" id="logo">
	</a>
</div>

<script>
</script>