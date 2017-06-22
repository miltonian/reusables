<style>
</style>

<div class='reusablepopbackground podcastbackground backgroundoverlay' style='z-index: 5;'>
	<div class='newpodcastpopview' style='display: none; position: absolute; background-color: white; border: 0; border-radius: 10px; width: 600px; height: 400px; top: 50%; margin-top: -200px; left: 50%; margin-left: -300px; overflow-x: hidden;'>
				<button class=reusablepopclosebutton></button>
				<p class='reusablepoptitle'>New Podcast</p>
				<form id='podcastform' action='/entrenash/editing/brand-forward/new_podcast.php' method='POST' enctype='multipart/form-data'>
					<div style='width: 100%; text-align: center;'>
						<label id='podcastimglabel' for=podcastimginput style='position: relative; display: inline-block;  background-color: #F0F0FA;  border-color: #b6b6b6; border-style: solid; border-width: 1px; border-radius: 2px; cursor: pointer; width: 155px; height: 100px; margin-top: 20px; background-size: cover; background-position: center; background-repeat: no-repeat;'>
							<p class='addimagep' style='position: relative; display: inline-block; margin: 0; padding: 0; width: 100%; text-align: center; color: #333333; font-size: 0.8em; font-weight: 400; height: 1.0em; top: 50%; margin-top: -0.5em;'>Add Image<br><span style='font-size: 0.7em; font-weight: 300;'>(1400 x 900)</span></p>
						</label>
					</div>
					<input type=hidden name=fromurl value=<?php echo $thisurl ?> >
					<input type=file name=featuredpostimg id='podcastimginput' style='display: none;'>
					<input type=text name=title class='reusabletf nametf' placeholder='Podcast Name'>
					<input type=text name=src class='reusabletf srctf' placeholder='Media Source'>
					<input type=hidden name=postid id='postid'>
					<input type=submit class='reusablebuttons' style='background-color: blue; margin-top: 10px;'>
				</form>
			</div>
</div>

<script>
	$(document).ready(function(){
		$('#podcastimginput').change(function(){
			var input = this;
			if (input.files && input.files[0]) {
        			var reader = new FileReader();
        				
        			reader.onload = function (e) {
            				$('#podcastimglabel').css('background-image', 'url('+e.target.result+')');
            				$('.addimagep').css('display', 'none');
            			}

        			reader.readAsDataURL(input.files[0]);
    			}
		});
	});
</script>