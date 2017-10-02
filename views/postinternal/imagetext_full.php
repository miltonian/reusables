<?php

namespace Reusables;

	/*
		$viewdict = [
				"featured_imagepath"=>"",
				"html_text"=>""
			]
	*/
	
	$sharingdict = Data::getValue( $viewdict, 'sharingdict' );

?>

<style>
	.imagetext_full { display: inline-block; position: relative; margin: 0; padding: 0; width: 100%; }
		.imagetext_full #featuredimage { display: inline-block; position: relative; margin: 0; padding: 0; background-size: cover; background-position: center; background-repeat: no-repeat; width: 100%; height: 0; padding-bottom: 50%; }
		.imagetext_full .text-container { display: inline-block; position: relative; margin: 50px 0px; padding: 0; text-align: left; }
</style>

<div class="viewtype_postinternal imagetext_full">
	<div id="featuredimage" style="background-image: url('<?php echo Data::getValue( $viewdict, 'featured_imagepath' ); ?>');" ></div>
	<?php
		if( $sharingdict != "" ){
			Data::addData( Data::getValue( $viewdict, 'sharingdict' ), $identifier . "_social_3d" );
			echo Sharing::make( "social_3d", $identifier . "_social_3d" );
		}
	?>
	<div class="text-container">
		<?php echo Data::getValue( $viewdict, 'html_text' ) ?>
	</div>
</div>

<script>
</script>