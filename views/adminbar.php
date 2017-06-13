<?php

if(!isset($isadmin)){ $isadmin=false; }

?>
<style>
	.backgroundoverlay { position: fixed; display: none; width: 100%; height: 100%; margin: 0; padding: 0; background-color: rgba( 0, 0, 0, 0.7); z-index: 4; text-align: center; left: 0; }
	.closebutton { display: inline-block; position: absolute; border: 0; border-style: solid; border-width: 0.5px; border-color: #b4b4b4; border-radius: 50%; -webkit-appearance: none; width: 20px; height: 20px; background-color: white; cursor: pointer; background-image: url('http://www.alexanderhamiltondev.com/images/xmark-gray@2x.png'); background-size: 50% 50%; background-position: center; background-repeat: no-repeat; margin: 0;  padding: 0; left: 10px; top: 10px; }
</style>

<div class='reusabletopbar desktopadminbar' style='background-color: #F0EBF5; z-index: 3; display: none; left: 0;<?php if($isadmin){ echo "display: inline-block;"; } ?> height: 60px; width: 100%; top: 0;'>
	<label id=adminemail style='position: relative; display: inline-block; float: left; color: #333; height: 1em; top: 50%; margin-top: -0.5em; margin-left: 40px; font-weight: 300;'></label>
	<label class='edit-status' style='position: relative; display: inline-block; float: left; color: #333; height: 1em; top: 50%; margin-top: -0.5em; margin-left: 5px; font-weight: 600;'> - Normal Mode</label>
	<button id='editbutton' class='reusabletopbarbuttons' style='color: #333;'>Edit: On/<strong>Off</strong></button>
	<button class='reusabletopbarbuttons onwhenediting' id='editingaddnew' style='color: #333333; display: none;'>New Post</button>
	<button class='reusabletopbarbuttons onwhenediting' id='editauthorsbutton' style='color: #333333; display: none;'>Edit Authors</button>
	<button class='reusabletopbarbuttons onwhenediting' id='editcategoriesbutton' style='color: #333333; display: none;'>Edit Categories</button>
	<button class='reusabletopbarbuttons onwhenediting' id='editarticlesbutton' style='color: #333333; display: none;'>All Articles</button>
</div>
	
		<script>
			
			var thisurl = <?php echo json_encode($thisurl) ?>;
			
			window.selectedfeatured = '';

			<?php if($isadmin){ ?>
				$('#adminemail').text('<?php echo $email ?>');
				$('#editbutton').off("click");
				$('#editbutton').click(function(){
					<?php 
						$gotoedit = false;
						if($_SERVER['HTTP_HOST'] == "theanywherecard.com"){
							$poststring = "/experiencenash_dev/post";
							if(substr($_SERVER['REQUEST_URI'], 0, strlen($poststring)) == $poststring){
								$gotoedit = true;
							}
						}else{
							$poststring = "/post";
							if(substr($_SERVER['REQUEST_URI'], 0, strlen($poststring)) == $poststring){
								$gotoedit = true;
							}
						}
						if($gotoedit){
							$gotostring = $_SERVER['REQUEST_URI'];
							$gotostring = str_replace("post", "editing/post", $gotostring);
							// exit(json_encode($gotostring));
							?> window.location.href = '<?php echo $gotostring ?>'; <?php
						}
						
					?>
					edittoggle();
				});
			<?php } ?>
			
			var editingon = false;
			function showadminbar(device,email){
				if(device == 'mobile'){
					$('.mobileadminbar').css({'display': 'block'});
				}else{
					$('.desktopadminbar').css({'display': 'inline-block'});
					$('.desktopnav').css({'margin-top': '60px'});
				}
				$('#adminemail').text(email);
				$('#editbutton').off("click");
				$('#editbutton').click(function(){ edittoggle(); });
			}
			var d = new Date();
			var currentepoch = Math.round(d.getTime() / 1000);
				
				$('#editingaddnew').click( function() { closethings(); $('.darkoverlay, .addnewoptionsbackground, .addnewoptionsdiv').css('display', 'inline-block'); });
				$('#editauthorsbutton, authors.editing').click( function() { closethings(); $('.authorsbackground, .authorpopview').css('display', 'inline-block'); });
				$('#editcategoriesbutton, .categories.editing').click( function() { closethings(); $('.categoriesbackground, .categoriespopview').css('display', 'inline-block'); });
				$('#editarticlesbutton, .articles.editing').click( function() {
					// selectedfeatured = '';
					closethings();
					$('.articlesbackground, .articlespopview').css('display', 'inline-block');
				});
				$('#podcastbutton').click(function(){
					closethings();
					$('.podcastbackground, .newpodcastpopview').css('display', 'inline-block');
					$('.reusablepoptitle').text('New Podcast');
					$('#podcastform').attr({'action': '/editing/brand-forward/new_podcast.php'});
				});
				$('#youtubebutton').click(function(){
					closethings();
					$('.newmodalbackground, .newmodalpopview').css('display', 'inline-block');
					$('.reusablepoptitle').text('New Youtube Video');
					$('#youtubeform').attr({'action': '/editing/new_youtube.php'});
				});
				$('.closebutton').click( function(e) { e.preventDefault(); closethings(); });
			function edittoggle(){
				if(editingon==true){
					editingon=false;
					$('.edit-status').text('- Normal Mode');
					$('#editbutton').html('Edit: On/<strong>Off</strong>');
					$('.desktopadminbar').css({'background-color': '#F0EBF5'});
					$('.onwhenediting').css({'display': 'none'});
				}else{
					editingon=true;
					$('.edit-status').text('- Editing Mode'); 
					$('#editbutton').html('Edit: <strong>On</strong>/Off');
					$('.desktopadminbar').css({'background-color': '#F5F5D8'});
					$('.onwhenediting').css({'display': 'inline-block'});
				}
			}
			function closethings() {
					selectedfeatured = '';
					$('.nametf').val('');
					$('.srctf').val('');
					$('#postid').val('');
					$('#podcastimglabel').css('background-image', 'url()');
					$('.addimagep').text('Edit Image');

					$('.backgroundoverlay input').val('');
					
					$('.darkoverlay').css('display', 'none');
					$('.imageorvideodiv').css('display', 'none');
					$('.authorpopview').css('display', 'none');
					$('.reusablepopview').css('display', 'none');
					$('.categoriespopview').css('display', 'none');
					$('.articlespopview').css('display', 'none');
					$('.schedulepostview1').css('display', 'none');

					$('.backgroundoverlay').css('display', 'none');
			}
			function editpodcast(dict){
				var text = dict['title'];
				var src = dict['imagepath'];
				var img = dict['featured_imagepath'];
				var postid = dict['id'];
				
				$('.nametf').val(text);
				$('.srctf').val(src);
				$('#postid').val(postid);
				if(img != '' && img != null){
					$('#podcastimglabel').css('background-image', 'url('+img+')');
					$('.addimagep').css('color', 'white');
					$('.addimagep').text('Edit Image');
				}
				$('.reusablepoptitle').text('Edit Podcast');
				$('.podcastbackground').css('display', 'inline-block');
				$('.newpodcastpopview').css('display', 'inline-block');
				$('#podcastform').attr({'action': '/editing/brand-forward/edit_podcast.php'});
			}
			function articleclicked(obj,articlearray){
			//alert();
				var oldtext = obj.id;
				var theindex = oldtext.replace('reusablecellbutton_','');
				var articledict = articlearray[theindex];
				var mediatype = articledict['type'];
				var prehref = '';
				var preprehref = '';
				if(editingon==true){
					preprehref = '/editing/';
				}else{
					preprehref = '/';
				}
				if(mediatype != 'podcast'){
					prehref = preprehref+'post?p=';
					var thehref = prehref.concat(articledict['id']);
					var urltitle = articledict['title'].replace(/\s/g, '');
					window.location.href = thehref+'&'+ urltitle;
				}else{
					if(editingon==true){
						editpodcast(articledict);
					}else{
						preprehref = '/brand-forward';
						prehref = preprehref+'?p=';
						var thehref = prehref.concat(articledict['id']);
						var urltitle = articledict['title'].replace(/\s/g, '');
						window.location.href = thehref+'&'+urltitle;
					}
				}
				
			}
			
		</script>