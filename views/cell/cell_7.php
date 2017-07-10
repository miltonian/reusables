<?php
	if(!isset($fontsizemobile)){$fontsizemobile='2em';}
	if(!isset($fontsize)){$fontsize='1.4em';}
	if(!isset($showdate)){$showdate=false;}
	if(!isset($cell7mediatype)){ $cell7mediatype=""; }
	if(!isset($isfeatured)){ $isfeatured=false; }

	if(!isset($isadmin)){ $isadmin=false; }

	if(!isset($celldict['post_id'])){ $celldict['post_id'] = $celldict['id']; }

	/*
		$postdict = [
				"isfeatured"=>false,
				"mediatype"=>"",
				"post_id"=>"",
				"title"=>"",
				"featured_imagepath"=>"",
				"date"=>"",
			]
	*/

?>


<style>
</style>

<div class="cell_7 main <?php echo $identifier ?> <?php if($celldict['isfeatured']){ echo "featured"; } ?> <?php if($celldict['mediatype']=="youtube" || $celldict['mediatype']=="podcast"){ echo $celldict['mediatype']; } ?>" id="<?php echo $celldict['post_id'] ?>" style="background-image: url(<?php echo $celldict['featured_imagepath'] ?>)">
		<div class="cell_7 gradient"></div>
		<label class="cell_7 title mobile" style="font-size: <?php echo $fontsizemobile ?>"><?php echo $celldict['title'] ?></label>
		<label class="cell_7 title desktop" style="font-size: <?php echo $fontsize ?>"><?php echo $celldict['title'] ?></label>
		<?php if($celldict['date']!=""){ ?>
			<label class="cell_7 date"><?php echo $celldict['date'] ?></label>
		<?php } ?>
	</div>

<script>

	var editingon = false;

	
	if(typeof <?php echo $identifier ?> == 'undefined'){
		class <?php echo $identifier ?>Classes {

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
				if($(this).hasClass("podcast")){
					posturl = '/brand-forward?p=';
				}else if($(this).hasClass("youtube")){
					posturl = '/createorchestrate?p=';
				}
				// window.selectedfeatured = this.id;
				var thedict;
				
				if(editingon==true){
					if(!$(this).hasClass("featured")){
						window.location.href = "/editing/post?p="+this.id;
					}else{
						$('.articlesbackground').css('display', 'inline-block');
						$('.articlespopview').css('display', 'inline-block');
					}
					//updateifvideo(type, path, div);
				}else{
					// alert();
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
					// window.location.href = "http://theanywherecard.com/experiencenash_dev/post?p="+this.id;
					// window.location.href = posturl+this.id+"/"+$(this).find('.title').text().replace(/\W/g, '');
					window.location.href = posturl+this.id+"/"+$(this).find('.title').text().replace(/\W/g, '-');
				}
			});
		}

	}
		var <?php echo $identifier ?> = new <?php echo $identifier ?>Classes();
	}
	
	<?php echo $identifier ?>.setupactions();


</script>