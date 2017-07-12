<?php 

	/*
		[
			"id"=>"",
			"title"=>"",
			"featured_imagepath"=>"",
			"html_text"=>"",
			"isfeatured"=>""
		]
	*/

	if(!isset($cell2)){ $cell2mediatype=""; }
	if( !isset($celldict['isfeatured']) ){ $celldict['isfeatured']=false; }
	if( !isset($celldict['mediatype']) ){ $celldict['mediatype']="post"; }
	if( !isset($isadmin) ){ $isadmin=false; }
	// if(!isset($celldict['id'])){ $celldict['id'] = $celldict['id']; }

	// exit( json_encode( $celldict['featured_imagepath'] ) );

?>

<style>
</style>



<div class="cell_2 main <?php echo $identifier ?> <?php if($celldict['isfeatured']){ echo "featured"; } ?> <?php if($celldict['mediatype']=="youtube" || $celldict['mediatype']=="podcast"){ echo $celldict['mediatype']; } ?>" id="<?php echo Data::getValue( $celldict, 'id' ) ?>">
	<div class="cell_2 container">
		<div style="display: inline-block; width: 100%;">
			<div>
				<a href="<?php if($isadmin){ echo '#'; }else{ echo '/post/'.Data::getValue( $celldict, 'id' ) . '/' . preg_replace('/\PL/u', '-', preg_replace("/[^ \w]+/", "", Data::getValue( $celldict, 'title' )) ); } ?>">
					<div class="cell_2 picture" style="<?php echo 'background-image: url('.Data::getValue( $celldict, 'featured_imagepath' ).');'; ?>"></div>
				</a>
				<div class="cell_2 words">
					<div class="cell_2 text-container">
						<!-- <label class="grey-label">Today</label> -->
						<br>
						<a href="<?php if($isadmin){ echo '#'; }else{ echo '/post/'. Data::getValue( $celldict, 'id' ) . '/' . preg_replace('/\PL/u', '', preg_replace("/[^ \w]+/", "", Data::getValue( $celldict, 'title' )) ); } ?>">
							<label class="cell_2 title" style=""><?php echo Data::getValue( $celldict, 'title' ); ?></label>
						</a>
						<br>
						<label class="cell_2 grey-label"><?php echo implode(' ', array_slice( explode(' ', strip_tags(Data::getValue( $celldict, 'html_text' ))), 0, 10) ); ?>...</label>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

	var editingon = false;
	
	if(typeof <?php echo $identifier ?> == 'undefined'){
		class <?php echo $identifier ?>Classes {

		setupactions(){
			var editingon=false;
			$('.<?php echo $identifier ?>').off('click');
			$('.<?php echo $identifier ?>').click(function(){

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
					// $('.articlesbackground').css('display', 'inline-block');
					// $('.articlespopview').css('display', 'inline-block');
					//updateifvideo(type, path, div);
					if(window.selectedfeatured==null || window.selectedfeatured==""){
						window.location.href = "/editing/post?p="+this.id;
					}else{
						$('.articlesbackground').css('display', 'inline-block');
						$('.articlespopview').css('display', 'inline-block');
					}
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
					// window.location.href = "http://theanywherecard.com/experiencenash_dev/post?p="+this.id;
					window.location.href = "/post/"+this.id+"/"+$(this).find('.title').text().replace(/[^ \w]+/, '').replace(/\W/g, '-');
				}
			});
		}

	}
		var <?php echo $identifier ?> = new <?php echo $identifier ?>Classes();
	}
	
	<?php echo $identifier ?>.setupactions();


</script>