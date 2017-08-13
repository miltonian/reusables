<?php

namespace Reusables;

	/*
		$postdict = [
				"featured_imagepath"=>"",
				"html_text"=>""
			]
	*/
	
	$sharingdict = Data::getValue( $postdict, 'sharingdict' );

?>

<style>
	.postinternal3 { display: inline-block; position: relative; margin: 0; padding: 0; width: 100%; }
		.postinternal3 #featuredimage { display: inline-block; position: relative; margin: 0; padding: 0; background-size: cover; background-position: center; background-repeat: no-repeat; width: 100%; height: 0; padding-bottom: 50%; }
		.postinternal3 .text-container { display: inline-block; position: relative; margin: 50px 0px; padding: 0; text-align: left; }
</style>

<div class="postinternal3">
	<div id="featuredimage" style="background-image: url('<?php echo Data::getValue( $postdict, 'featured_imagepath' ); ?>');" ></div>
	<?php
		if( $sharingdict != "" ){
			Data::addData( Data::getValue( $postdict, 'sharingdict' ), $identifier . "_sharingbtns_1" );
			echo Sharing::make( "sharingbtns_1", $identifier . "_sharingbtns_1" );
		}
	?>
	<div class="text-container">
		<?php echo Data::getValue( $postdict, 'html_text' ) ?>
	</div>
</div>

<script>
</script>