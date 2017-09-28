<?php

namespace Reusables;

	/*
		$viewdict = [
			"featured_imagepath"=>"",
			"logo_imagepath"=>"",
			"title"=>"",
			"adposition"=>0,
			"desc"=>""
		]
	*/

	$viewdict = Data::convertKeys( $viewdict );
	// exit( json_encode( Data::getValue( $viewdict, 'desc' ) ) );


	if( isset( $viewdict['value'] ) ){ 
		$data_id = Data::getDefaultDataID( $viewdict );
		$viewdict = Data::formatForDefaultData( $data_id ); 
	}
?>

<style>
</style>

<div class="featuredsection_7 <?php echo $identifier ?>">
	<div class="featuredimage" style="background-image: url('<?php echo Data::getValue( $viewdict, 'imagepath' ) ?>');"></div>
	<div class="content">
		<h2 id="title"><?php echo Data::getValue( $viewdict, 'title' ) ?></h2>
		<p id="desc"><?php echo Data::getValue( $viewdict, 'html_text' ) ?></p>
	</div>
</div>

<script>
</script>