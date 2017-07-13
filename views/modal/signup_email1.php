<?php

namespace Reusables;

?>


<div id="subscribe-popup" style="display: none; height: 100%; width: 100%; position: fixed; margin: 0; padding: 0; z-index: 9999; background-color: rgba(0,0,0,0.8); top: 0; left: 0; text-align: center;">
	<div style="position: relative; display: inline-block; width: 800px; margin-top: 100px; border-radius: 10px;  overflow: hidden; background-color: white;">
	
<!-- Begin MailChimp Signup Form -->
<link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
<style type="text/css">
	#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
	/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
	   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
</style>
<div id="mc_embed_signup">
<form action="//entrenash.us15.list-manage.com/subscribe/post?u=58fb07234758e314e4ccb2c2f&amp;id=1d5a3a498c" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
<a href='#' class='close' style='position: absolute; right: 35px; top: 25px; text-decoration: none; color: #333333;  font-size: 1.4em;'>&#10006;</a>
    <div id="mc_embed_signup_scroll">
	<h2>Subscribe to our mailing list</h2>
<div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
<div class="mc-field-group">
	<label for="mce-EMAIL">Email Address  <span class="asterisk">*</span>
</label>
	<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
</div>
<div class="mc-field-group">
	<label for="mce-FNAME">First Name </label>
	<input type="text" value="" name="FNAME" class="" id="mce-FNAME">
</div>
<div class="mc-field-group">
	<label for="mce-AGERANGE">Your Age Range </label>
	<select name="AGERANGE" class="" id="mce-AGERANGE">
	<option value=""></option>
	<option value="Generation Z (1-21)">Generation Z (1-21)</option>
<option value="Millennials (22-40)">Millennials (22-40)</option>
<option value="Generation X (41-52)">Generation X (41-52)</option>
<option value="Baby Boomers (53-71)">Baby Boomers (53-71)</option>
<option value="Silent Generation (71+)">Silent Generation (71+)</option>

	</select>
</div>
	<div id="mce-responses" class="clear">
		<div class="response" id="mce-error-response" style="display:none"></div>
		<div class="response" id="mce-success-response" style="display:none"></div>
	</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_58fb07234758e314e4ccb2c2f_1d5a3a498c" tabindex="-1" value=""></div>
    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button" style="background-color: #ff5719;"></div>
    </div>
</form>
</div>
<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='AGERANGE';ftypes[2]='dropdown';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
<!--End mc_embed_signup-->

</div>
 </div>
 
 <script>
 
	$('#subscribe-button').click(function(){
	
 		$('#subscribe-popup').css({'display': 'inline-block', 'opacity': '1'});
 	});
 	$('.close').click(function(){
 		$('#subscribe-popup').css({'display': 'none'});
 	});
 </script>