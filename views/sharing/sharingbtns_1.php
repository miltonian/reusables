<?php

?>

<style>
.sharingbtns1 { position: relative; margin: 0; padding: 0; width: 100%; }
.sharingbtns1 .sharingbuttons {position: relative; height: 40px; border: 0; border-radius: 3px; margin-top: 10px; margin-bottom: 5px; font-size: 1.1em; font-weight: 400; border-bottom: 3px solid rgba(0,0,0,0.3); display: inline-block;}
	.sharingbtns1 .sharingbuttons p {position: relative; display: inline-block; padding: margin: 0; margin-left: 10px; text-decoration: none; color: white; padding-right: 15px; height: 1em; top: 46%; margin-top: -0.5em; float: left; font-size: 0.9em;  font-weight: 500; text-shadow: 1px 1px 0px rgba(0,0,0,0.3);}
	.sharingbtns1 .sharingbuttons img {position: relative; display: inline-block; height: 20px; width: auto; padding: 0; margin: 0; padding-left: 10px; top: 50%; margin-top: -10px; float: left;}
	.sharingbtns1 .sharingbuttons#fb {background-color: #3b5998;}
	.sharingbtns1 .sharingbuttons#twitter {background-color: #55ACEE; margin-left: 20px;}

@media (min-width: 0px) {
	.sharingbtns1 { display: none; }
}
@media (min-width: 768px) {
	.sharingbtns1 { display: inline-block; }
}
</style>

<div class="sharingbtns1">
	<div style="position: relative; display: inline-block; width: 90%; text-align: left; margin-top: 10px;">
		<a href="#" class="sharingbuttons" id="fb"><img src="/uploads/icons/facebook-256-2.png"><p>Share on Facebook</p></a>
		<a href="#" class="sharingbuttons" id="twitter"><img src="/uploads/icons/twitter-512.gif" /><p>Share on Twitter</p></a>
	</div>
</div>

<script>

	$('.sharingbtns1 .sharingbuttons').click(function(e){
		e.preventDefault();

		var sharelink;
		if( this.id=="fb" ){
			sharelink = '<?php echo $sharingdict['facebook'] ?>';
		}else{
			sharelink = '<?php echo $sharingdict['twitter'] ?>';
		}
		var left = ($(window).width()/2)-(900/2);
		var top = ($(window).height()/2)-(600/2);
		window.open (sharelink, "popup", "width=900, height=600, top="+top+", left="+left);
	});

</script>