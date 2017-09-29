<?php 

namespace Reusables;

?>

<style>
</style>


<div class="<?php echo $identifier ?> footer_slim">
	<div class="inner">
		<p id="businessname"><?php echo Data::getValue( $viewdict, 'name' ) ?></p>
		<div class="social-container">
			<a id="fblink" target="_blank" href="<?php echo Data::getValue( $viewdict, 'fblink' ) ?>">
				<button style='background-image: url(http://entrenash.co/media/images/facebook-4-xxl.png);'></button>
			</a>
			<a id="twitterlink" target="_blank" href="<?php echo Data::getValue( $viewdict, 'twitterlink' ) ?>">
				<button style='background-image: url(http://entrenash.co/media/images/twitter_circle_gray-256.png);'></button>
			</a>
			<a id="instalink" target="_blank" href="<?php echo Data::getValue( $viewdict, 'instalink' ) ?>">
				<button style='background-image: url(http://entrenash.co/media/images/instagram-xxl-2.png);'></button>
			</a>
		</div>
	</div>
</div>

<script>
</script>