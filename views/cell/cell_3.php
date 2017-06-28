<?php 
	if(!isset($cell3mediatype)){ $cell3mediatype=""; }
	if( !isset($isfeatured) ){ $isfeatured=false; }

	if(!isset($isadmin)){ $isadmin=false; }
if(!isset($celldict['post_id'])){ $celldict['post_id'] = $celldict['id']; }
	// celldict
	/*
		[
			"id"=>"",
			"title"=>"",
			"featured_imagepath"=>"",
			"html_text"=>"",
			"isfeatured"=>"",
			"mediatype"=>""
		]
	*/

?>
<style>
</style>

<div class="<?php echo $identifier ?> <?php if($celldict['isfeatured']){ echo "featured"; } ?> <?php if($celldict['mediatype']=="youtube" || $celldict['mediatype']=="podcast"){ echo $celldict['mediatype']; } ?>" id="<?php echo $celldict['post_id'] ?>">
	<div class="container">
		<div style="display:inline-block; width: 100%;">
			<div>
				<a href="<?php if($isadmin){ echo '#'; }else{ echo '/post/'.$celldict['post_id'] . '/' . preg_replace('/\PL/u', '-', preg_replace("/[^ \w]+/", "", $celldict['title']) ); } ?>">
					<div class="picture" style="<?php if($celldict['imagepath']){ echo 'background-image: url('.$celldict['imagepath'].');'; } ?>"></div>
				</a>
				<div class="words">
					<div class="text-container">
						<a href="<?php if($isadmin){ echo '#'; }else{ echo '/post/'.$celldict['post_id'] . '/' . preg_replace('/\PL/u', '', preg_replace("/[^ \w]+/", "", $celldict['title']) ); } ?>">
							<h1 class="title" style="font-size: 1.2em; position: relative; display: inline-block; margin: 0; padding: 0;"><?php if(isset($celldict['title'])){echo $celldict['title'];} ?></h1>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	var editingon = false;
	
	if(typeof Cell3Class == 'undefined'){
		class Cell3 {

		setupactions(){
			// var editingon=false;
			$('.<?php echo $identifier ?>').off('click');
			$('.<?php echo $identifier ?>').click(function(){
				
				// if(typeof window.selectedfeatured == 'undefined'){var window.selectedfeatured=null;}
				if($(this).hasClass('featured')){
					window.selectedfeatured = $(this).parent().attr('class');
				}else{
					window.selectedfeatured=null;
				}

				var gotothis;
				var whichfeatured;
				var posturl = '/post/';
				// window.selectedfeatured = this.id;
				var thedict;
				
				if(editingon==true){
					if(window.selectedfeatured==null || window.selectedfeatured==""){
						window.location.href = "/editing/post?p="+this.id;
					}else{
						$('.articlesbackground').css('display', 'inline-block');
						$('.articlespopview').css('display', 'inline-block');
					}
					//updateifvideo(type, path, div);
				}else{
					// var mediatype = thedict['type'];
					// var prehref = '';
					// var preprehref = '';
					// preprehref = '/';
					// //alert(mediatype);
					// if(mediatype != 'podcast'){
					// 	prehref = preprehref+'post?p=';
					// 	var thehref = prehref.concat(thedict['id']);
					// 	var urltitle = thedict['title'].replace(/\s/g, '');
					// 	window.location.href = thehref+'&'+urltitle;
					// }else{
					// 	preprehref = '/brand-forward';
					// 	prehref = preprehref+'?p=';
					// 	var thehref = prehref.concat(thedict['id']);
					// 	var urltitle = thedict['title'].replace(/\s/g, '');
					// 	window.location.href = thehref+'&'+urltitle;
					// }
					// window.location.href = "http://theanywherecard.com/unlimitedautomart_dev/post?p="+this.id;
					
					window.location.href = "/post/"+this.id+"/"+$(this).find('.title').text().replace(/\W/g, '-');
				}
				//}
			});
		}

	}
		var Cell3Class = new Cell3();
	}
	
	Cell3Class.setupactions();
</script>