<?php

namespace Reusables;

	/*
		$sectiondict = [
			"featured_imagepath"=>"",
			"logo_imagepath"=>"",
			"title"=>"",
			"adposition"=>0,
			"desc"=>""
		]
	*/
	if( isset( $sectiondict['value'] ) ){ 
		$data_id = Data::getDefaultDataID( $sectiondict );
		$sectiondict = Data::formatForDefaultData( $data_id ); 
	}
?>

<style>
</style>

<div class="featuredsection_7 <?php echo $identifier ?>">
	<div class="featuredimage" style="background-image: url('<?php echo Data::getValue( $sectiondict, 'headshot_image' ) ?>');"></div>
	<div class="content">
		<h2 id="title"><?php echo Data::getValue( $sectiondict, 'title' ) ?></h2>
		<p id="desc"><?php echo Data::getValue( $sectiondict, 'desc' ) ?></p>
	</div>
</div>

<script>
</script>