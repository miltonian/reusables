<?php

namespace Reusables;

	Views::setParams( 
		[ "imagepath", "title", "subtitle", "slug" ], 
		[],
		$identifier
	);

	$viewdict = Data::convertKeys( $viewdict );

	if( isset( $viewdict['value'] ) ){ 
		$data_id = $identifier;
	}
	if( isset($viewdict['editing']) ){ $isediting=1; }else{ $isediting=0; }
	

	$linkpath = Data::getValue( $viewoptions, 'pre_slug' ) . Data::getValue( $viewdict, 'slug' );
	if( $linkpath == "" ) {
		$linkpath = "#";
	}
	$optiontype = Data::getValue( $viewoptions, 'type' );
	$fullarray = Data::getFullArray( $viewdict );
	
	if( isset( $viewdict[$identifier]['value'] ) ) {
		$fullviewdict = Data::getFullArray( $viewdict )[$identifier]['value'];
	}else{
		$fullviewdict = $viewdict;
	}
	

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