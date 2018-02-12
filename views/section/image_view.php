<?php

namespace Reusables;

	Views::setParams( 
		[ "imagepath", "slug" ], 
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


<div class="viewtype_section image_view clicktoedit main <?php echo $identifier ?>">
	<img class="image_view image" src="<?php echo Data::getValue($viewdict, 'imagepath') ?>">
</div>

<script>

		$('.<?php echo $identifier ?>.image_view.clicktoedit').click(function(e){
			<?php
				ReusableClasses::setUpEditingForSection( $viewdict, $viewoptions, $identifier );
			?>
		})


</script>