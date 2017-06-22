<?php 
$device = $GLOBALS['device'];
?>

<style>

</style>


<div style='position: relative; display: inline-block; width: 100%; height: 100px; background-color: #333333; text-align: center; padding-top: 50px;'>
	<p id="businessname" style='position: relative; display: inline-block; float: left; padding-left: 30px; color: white; font-size: 0.7em;  margin-top: 20px;'></p>
	<div style='position: relative; display: inline-block; float: right; height: 40px; margin-right: 50px;'>
		<a id="fblink" target="_blank"><button style='background: transparent; background-size: cover;  background-position: center; background-repeat: no-repeat; -webkit-appearance: none; background-image: url(http://entrenash.co/media/images/facebook-4-xxl.png); border: 0; cursor: pointer; width: 40px; height: 40px;'></button></a>
		<a id="twitterlink" target="_blank"><button style='background: transparent; background-size: cover; background-position: center; background-repeat: no-repeat; -webkit-appearance: none; background-image: url(http://entrenash.co/media/images/twitter_circle_gray-256.png); border: 0; cursor: pointer; width: 40px; height: 40px;'></button></a>
		<a id="instalink" target="_blank"><button style='background: transparent; background-size: cover;  background-position: center; background-repeat: no-repeat; -webkit-appearance: none; background-image: url(http://entrenash.co/media/images/instagram-xxl-2.png); border: 0; cursor: pointer; width: 40px; height: 40px;'></button></a>
	</div>
</div>

<script>
class Footer1 {
	populatesection(name,fblink,twitterlink,instalink){
		$('#businessname').text(name);
		$('#fblink').attr('href',fblink);
		$('#twitterlink').attr('href',twitterlink);
		$('#instalink').attr('href',instalink);
	}
}
</script>