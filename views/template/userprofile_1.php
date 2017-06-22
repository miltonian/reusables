<?php
	if(!isset($GLOBALS['isadmin'])){ $GLOBALS['isadmin']=false; }
	if(!isset($templatedict['editor1'])){ $templatedict['editor1']=""; }
	if(!isset($templatedict['my-name'])){ $templatedict['my-name']=""; }
	if(!isset($templatedict['i-do'])){ $templatedict['i-do']=""; }

	if(!isset($templatedict['custompageid'])){ $templatedict['custompageid']="0"; }

	$width="auto"; $height="auto";
	if($templatedict['profile-pic']==""){ $width="250px"; $height="300px"; }
?>

<style>
.userprofile1 {
	display: inline-block;
	position: relative;
	margin: 0;
	padding: 0;
	width: 100%;
	color: #333333;
}
.userprofile1 h1, .userprofile1 h2 {width: 100%; }
.userprofile1 #my-name {
	display: inline-block; 
	position: relative; 
	margin: 0;
	padding: 0;
	font-size: 3em;
	text-transform: uppercase;
}
.userprofile1 #i-do {
	display: inline-block; 
	position: relative; 
	margin: 0;
	padding: 0;
	font-size: 2em;
	font-weight: 400;
	text-transform: uppercase;
	margin-bottom: 30px;
}
.userprofile1 #profile-pic { max-width: 100%; max-height: 100%; }
.userprofile1 #desc {
	display: inline-block;
	position: relative;
	/*float: left;*/
	margin: 0;
	padding: 30px;
}
.userprofile1 .socialbuttons-container { display: inline-block; position: relative; margin: 0; padding: 0;  }
.userprofile1 .htmltext-container {display: inline-block;padding-left: 20px;padding-right: 20px;}

@media (min-width: 0px) {
	.userprofile1 .profilepic-container { float: none; max-width: 100%; max-height: auto; text-align: center;}
	.userprofile1 #desc {float: none; max-width: auto; text-align: center; padding-top: 30px;}
	.userprofile1 h1, .userprofile1 h2 { text-align: center; }
	.userprofile1 .htmltext-container {max-width: calc(100% - 40px);}
}
@media (min-width: 768px) {
	.userprofile1 .profilepic-container { float: left; max-width: 35%; /*max-height: 360px;*/ }
	.userprofile1 #desc { float: left; text-align: left; float: left; max-width: calc(65% - 60px); padding-top: 0;}
	.userprofile1 h1, .userprofile1 h2 { text-align: left; }
	.userprofile1 .htmltext-container {max-width: calc(65% - 40px);}
}
</style>

<div class="userprofile1">
	<?php if(!$GLOBALS['isadmin'] || ($GLOBALS['isadmin'] && $GLOBALS['userid'] != $templatedict['userprofile_userid'])){ ?>
	<h1 id="my-name"><?php echo $templatedict['my-name'] ?></h1>
	<h2 id="i-do"><?php echo $templatedict['i-do'] ?></h2>
	<div style="display: inline-block;">
		<div class="profilepic-container">
			<img id="profile-pic" src="<?php echo $templatedict['profile-pic'] ?>" width="auto" height="auto">
			<div style="width: 100%; margin-top: 20px; text-align: center;">
				<?php 
					// include $docroot . '/reusables/views/socialpagesbtns_1.php'; 
					Button::make( 'socialpagesbtns_1', [] );
				?>
			</div>
		</div>
		<div class="htmltext-container"><?php echo $templatedict['editor1'] ?></div>
	</div>
	<?php }else{ ?>
		
			<input type="hidden" id="custompage_id" name="custompage_id" value="<?php echo $templatedict['custompageid'] ?>">
			<input type="text" id="my-name" name="name_my-name" placeholder="My Name Is..." value="<?php echo $templatedict['my-name'] ?>" >
			<input type="text" id="i-do" name="name_i-do" placeholder="Short intro" value="<?php echo $templatedict['i-do'] ?>" >
			<div style="display: inline-block;">
				<div class="profilepic-container">
					<label id="profilepic-label" for="profilepic-input" style="display: inline-block; position: relative; margin: 0; padding: 0; cursor: pointer;"><img id="profile-pic" src="<?php echo $templatedict['profile-pic'] ?>" width="<?php echo $width ?>" height="<?php echo $height ?>"></label>
					<input type="file" name="name_profile-pic" id="profilepic-input" style="display: inline-block; visibility: hidden; z-index: -1;">
					<div style="width: 100%; margin-top: 20px; text-align: center;">
						<?php 
							// include $docroot . '/reusables/views/socialpagesbtns_1.php'; 
							Button::make( 'socialpagesbtns_1', [] );
						?>
					</div>
				</div>
				<div style="display: inline-block; position: relative; margin: 0 20px; padding: 0; width: calc(65% - 40px);">
					<textarea name='name_editor1' id='editor1' rows='10' cols='80'>
						<?php echo $templatedict['editor1'] ?>
					</textarea>
					<script>
						// Replace the <textarea id='editor1'> with a CKEditor
						// instance, using default configuration.
						CKEDITOR.replace( 'editor1' );
						CKEDITOR.config.height = '300' ;
					</script>
				</div>
			</div>

	<?php } ?>
</div>

<script>
	$('#profilepic-input').change(function(){
		ReusableGlobalFunctionsClass.readthisURL(this, $('#profilepic-label img'), null, null);
		// alert($('#featuredpostimg').val());
	});
</script>