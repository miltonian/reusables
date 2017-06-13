<?php

$twittericon_white = "https://theanywherecard.com/social_images/twitter_social_button.png";
$facebookicon_white = "https://theanywherecard.com/social_images/facebook-256.png";
$linkedin_white = "https://theanywherecard.com/social_images/linkedin-image.png";

?>

<style>
.socialpagesbtns1 {
	position: relative;
	display: inline-block;
	margin: 0;
	padding: 0;
	/*margin-left: 20px;*/
	/*float: left;*/
	/*top: 50%;
	margin-top: -20px;*/
}
.socialpagesbtns1 .social-icon {
	position: relative;
	display: inline-block;
	margin: 0px 5px;
	padding: 0;
	height: 40px;
	width: 40px;
	border-radius: 50%;
	border: 1px solid #cecece;
	background-color: white;
	float: left;
	cursor: pointer;
	-webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */
    filter: grayscale(100%);
    background-size: 60%; background-position: center; background-repeat: no-repeat;
}
.socialpagesbtns1 .social-icon:hover { -webkit-filter: grayscale(0%); filter: grayscale(0%); }

.socialpagesbtns1 a {display: inline-block;}
.socialpagesbtns1 .social-icon.facebook {background-image: url('<?php echo $baseurlminimal ?>reusables/uploads/icons/facebook-icon.png');}
.socialpagesbtns1 .social-icon.twitter {background-image: url('<?php echo $baseurlminimal ?>reusables/uploads/icons/twitter-icon.png');}
.socialpagesbtns1 .social-icon.instagram {background-image: url('<?php echo $baseurlminimal ?>reusables/uploads/icons/insta-icon.png');}
	.socialpagesbtns1 .social-icon.facebook:hover {border: 2px solid #3b5998}
	.socialpagesbtns1 .social-icon.twitter:hover {border: 2px solid #4099FF}
	.socialpagesbtns1 .social-icon.instagram:hover {border: 2px solid #8a3ab9}
</style>





<div class="socialpagesbtns1">
	<a href="<?php echo $facebookpagelink ?>" target="_blank"><button class="social-icon facebook"></button></a>
	<a href="<?php echo $twitterpagelink ?>" target="_blank"><button class="social-icon twitter"></button></a>
	<a href="<?php echo $instagrampagelink ?>" target="_blank"><button class="social-icon instagram"></button></a>
</div>



<script>

</script>
