<?php

namespace Reusables;

$twittericon_white = "https://theanywherecard.com/social_images/twitter_social_button.png";
$facebookicon_white = "https://theanywherecard.com/social_images/facebook-256.png";
$linkedin_white = "https://theanywherecard.com/social_images/linkedin-image.png";


	Views::setParams( 
		[ "facebook", "twitter", "instagram" ], 
		[],
		$identifier
	);

?>

<style>
</style>





<div class="viewtype_sharing <?php echo $identifier ?> socialpage_circles">
	<a href="<?php echo Data::getValue( $viewdict, 'facebook' ) ?>" target="_blank"><button class="social-icon facebook"></button></a>
	<a href="<?php echo Data::getValue( $viewdict, 'twitter' ) ?>" target="_blank"><button class="social-icon twitter"></button></a>
	<a href="<?php echo Data::getValue( $viewdict, 'instagram' ) ?>" target="_blank"><button class="social-icon instagram"></button></a>
</div>



<script>

</script>
