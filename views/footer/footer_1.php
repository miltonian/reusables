<?php 

?>

<style>
.<?php echo $identifier ?> { position: relative; display: inline-block; width: 100%; height: 100px; background-color: #333333; text-align: center; }
	.<?php echo $identifier ?> .inner { display: inline-block; position: relative; margin: 0; padding: 0; width: 100%; top: 50%; transform: translateY(-50%); }
	.<?php echo $identifier ?> #businessname { position: relative; display: inline-block; float: left; padding-left: 30px; color: white; font-size: 0.7em;  margin-top: 20px; }
	.<?php echo $identifier ?> .social-container { position: relative; display: inline-block; float: right; height: 40px; margin-right: 50px; }
	.<?php echo $identifier ?> a button { background: transparent; background-size: cover;  background-position: center; background-repeat: no-repeat; -webkit-appearance: none; border: 0; cursor: pointer; width: 40px; height: 40px; }
</style>


<div class="<?php echo $identifier ?>">
	<div class="inner">
		<p id="businessname"><?php echo $footerdict['name'] ?></p>
		<div class="social-container">
			<a id="fblink" target="_blank" href="<?php echo $footerdict['fblink'] ?>">
				<button style='background-image: url(http://entrenash.co/media/images/facebook-4-xxl.png);'></button>
			</a>
			<a id="twitterlink" target="_blank" href="<?php echo $footerdict['twitterlink'] ?>">
				<button style='background-image: url(http://entrenash.co/media/images/twitter_circle_gray-256.png);'></button>
			</a>
			<a id="instalink" target="_blank" href="<?php echo $footerdict['instalink'] ?>">
				<button style='background-image: url(http://entrenash.co/media/images/instagram-xxl-2.png);'></button>
			</a>
		</div>
	</div>
</div>

<script>
</script>