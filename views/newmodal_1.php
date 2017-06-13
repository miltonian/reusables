<style>
</style>

<div class='backgroundoverlay newmodalbackground' style='z-index: 5;'>
	<div class='newmodalpopview' style='display: none; position: absolute; background-color: white; border: 0; border-radius: 10px; width: 600px; height: 400px; top: 50%; margin-top: -200px; left: 50%; margin-left: -300px; overflow-x: hidden;'>
				<button class='closebutton'></button>
				<p class='reusablepoptitle'>New Youtube Video</p>
				<form id='youtubeform' action='/editing/new_youtube.php' method='POST' enctype='multipart/form-data'>
					Select Page: 
					<select name='page_name' style='margin-top: 50px;'>
						<option value=''>-- Page --</option>
						<option value='brand_forward'>Brand Forward</option>
						<option value='healthwellness'>Health & Wellness</option>
						<option value='createorchestrate'>Create & Orchestrate</option>
					</select>
					<input type=hidden name=fromurl value=<?php echo $thisurl ?> >
					<input type=text name='youtubeurl' class='reusabletf srctf' placeholder='Youtube URL'>
					<input type=hidden name=postid id='postid'>
					<input type=submit class='reusablebuttons' style='background-color: blue; margin-top: 10px;'>
				</form>
			</div>
</div>

<script>
	$(document).ready(function(){
		
	});
</script>