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
	Views::setParams( 
		[ "imagepath", "title", "html_text" ], 
		[],
		$identifier
	);

	if( isset( $viewdict['value'] ) ){ 
		$data_id = Data::getDefaultDataID( $viewdict );
		$viewdict = Data::formatForDefaultData( $data_id ); 
	}
	$viewdict = Data::convertKeys( $viewdict );
	

?>

<style>
</style>

<div class="viewtype_section imagetext_inline <?php echo $identifier ?> main clicktoedit">
	<div class="imagetext_inline featuredimage" style="background-image: url('<?php echo Data::getValue( $viewdict, 'imagepath' ) ?>');"></div>
	<div class="imagetext_inline thecontent">
		<h2 class="imagetext_inline" id="title"><?php echo Data::getValue( $viewdict, 'title' ) ?></h2>
		<p class="imagetext_inline" id="desc"><?php echo Data::getValue( $viewdict, 'html_text' ) ?></p>
	</div>
</div>

<script>
	$('.imagetext_inline.clicktoedit').click(function(e){
		<?php
			ReusableClasses::setUpEditingForSection( $viewdict, $viewoptions, $identifier );
		?>
	})
</script>