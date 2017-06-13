<?php

$twittericon_white = "https://theanywherecard.com/social_images/twitter_social_button.png";
$facebookicon_white = "https://theanywherecard.com/social_images/facebook-256.png";
$linkedin_white = "https://theanywherecard.com/social_images/linkedin-image.png";

?>

<style>
.sharingbtns2 {
	position: relative;
	display: inline-block;
	margin: 0;
	padding: 0;
	margin-left: 20px;
	float: left;
	/*top: 50%;*/
	/*margin-top: -20px;*/
}
.sharingbtns2 .social-icon {
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
.sharingbtns2 .social-icon:hover { -webkit-filter: grayscale(0%); filter: grayscale(0%); }

.sharingbtns2 .social-icon.facebook {background-image: url('<?php echo $baseurlminimal ?>reusables/uploads/icons/facebook-icon.png');}
.sharingbtns2 .social-icon.twitter {background-image: url('<?php echo $baseurlminimal ?>reusables/uploads/icons/twitter-icon.png');}
.sharingbtns2 .social-icon.instagram {background-image: url('<?php echo $baseurlminimal ?>reusables/uploads/icons/insta-icon.png');}
.sharingbtns2 .social-icon.pinterest {background-image: url('<?php echo $baseurlminimal ?>reusables/uploads/icons/pinterest-icon.png');}
	.sharingbtns2 .social-icon.facebook:hover {border: 2px solid #3b5998}
	.sharingbtns2 .social-icon.twitter:hover {border: 2px solid #4099FF}
	.sharingbtns2 .social-icon.instagram:hover {border: 2px solid #8a3ab9}
	.sharingbtns2 .social-icon.pinterest:hover {border: 2px solid #cb2027}

.sharea {position: relative; display: inline-block; margin: 0; padding: 0; width: 40px; padding: 0px 10px; height: 65px;}
	.sharea label {position: relative; display: inline-block; margin: 0; padding: 0; width: 100%; text-decoration: none; color: #555555; font-weight: 300;text-align: center; font-size: 0.8em; margin: 5px 5px; position: absolute; left: 0; bottom: 0;}
</style>





<div class="sharingbtns2">
	<a href="<?php echo $fbsharelink ?>" class="sharea facebook" target="_blank"><button class="social-icon facebook"></button><label>Share</label></a>
	<a href="<?php echo $twittersharelink ?>" class="sharea twitter" target="_blank"><button class="social-icon twitter"></button><label>Tweet</label></a>
	<a href="<?php echo $pinitlink ?>" class="sharea pinterest" target="_blank"><button class="social-icon pinterest"></button><label>Pin It</label></a>
	<!-- <a href="<?php echo $instagrampagelink ?>" target="_blank"><button class="social-icon instagram"></button></a> -->
</div>



<script>

</script>
