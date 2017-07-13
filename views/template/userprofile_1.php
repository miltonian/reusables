<?php

namespace Reusables;

	if(!isset($GLOBALS['isadmin'])){ $GLOBALS['isadmin']=false; }
	if(!isset($templatedict['editor1'])){ $templatedict['editor1']=""; }
	if(!isset($templatedict['my-name'])){ $templatedict['my-name']=""; }
	if(!isset($templatedict['i-do'])){ $templatedict['i-do']=""; }

	if(!isset($templatedict['custompageid'])){ $templatedict['custompageid']="0"; }

	$width="auto"; $height="auto";
	// exit(json_encode($templatedict));
	if($templatedict['profile-pic']==""){ $width="250px"; $templatedict['profile-pic']="/reusables/uploads/icons/placeholder.png"; /*$height="300px";*/ }
	if(!isset($templatedict['preview'])){ $templatedict['preview'] = 0; }
?>

<style>
</style>

<div class="userprofile_1 <?php echo $identifier ?>">
	<?php if(((!$GLOBALS['isadmin'] && !$GLOBALS['isuser']) || ($GLOBALS['isadmin'] != $templatedict['userprofile_userid'] && $GLOBALS['userid'] != $templatedict['userprofile_userid'])) || $templatedict['preview']==1 ){ ?>
	<h1 id="my-name"><?php echo $templatedict['my-name'] ?></h1>
	<h2 id="i-do"><?php echo $templatedict['i-do'] ?></h2>
	<div style="display: inline-block;">
		<div class="profilepic-container">
			<img id="profile-pic" src="<?php echo $templatedict['profile-pic'] ?>" width="auto" height="auto">
			<div style="width: 100%; margin-top: 20px; text-align: center;">
				<?php 
					// include $docroot . '/reusables/views/socialpagesbtns_1.php'; 
					echo Sharing::make( 'socialpagesbtns_1', [], "social-btns" );
				?>
			</div>
		</div>
		<div class="htmltext-container"><?php echo $templatedict['editor1'] ?></div>
	</div>
	<?php }else{ ?>
		
			<input type="hidden" id="custompage_id" name="custompage_id" value="<?php echo $templatedict['custompageid'] ?>">
			<input type="text" id="my-name" name="name_my-name" placeholder="My Name Is..." value="<?php echo $templatedict['my-name'] ?>" style="padding: 10px; border-radius: 5px; border: 1px solid #e0e0e0; font-size: 3em; text-transform: uppercase; margin-bottom: 10px;">
			<input type="text" id="i-do" name="name_i-do" placeholder="Short intro" value="<?php echo $templatedict['i-do'] ?>" style="padding: 10px; border-radius: 5px; border: 1px solid #e0e0e0; margin-bottom: 40px;">
			<div style="display: inline-block;">
				<div class="profilepic-container">
					<label id="profilepic-label" for="profilepic-input" style="display: inline-block; position: relative; margin: 0; padding: 0; cursor: pointer; float: left;"><img id="profile-pic" src="<?php echo $templatedict['profile-pic'] ?>" width="<?php echo $width ?>" height="<?php echo $height ?>"></label>
					<input type="file" name="name_profile-pic" id="profilepic-input" style="display: inline-block; visibility: hidden; z-index: -1;">
					<div style="width: 100%; max-width: 250px; float: left; margin-top: 20px; text-align: center;">
						<?php 
							// include $docroot . '/reusables/views/socialpagesbtns_1.php'; 
							echo Sharing::make( 'socialpagesbtns_1', [], "sharing-btns" );
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