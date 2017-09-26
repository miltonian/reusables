<?php

namespace Reusables;

	if(!isset($cell6mediatype)){ $cell6mediatype=""; }
	if(!isset($showdate)){$showdate=false;}
	if( !isset($isfeatured) ){ $isfeatured=false; }
	if(!isset($viewdict['post_id'])){ $viewdict['post_id'] = $viewdict['id']; }
?>

<style>
</style>

<div class="cell_6 main <?php echo $identifier ?> <?php if($viewdict['isfeatured']){ echo "featured"; } ?> <?php if($viewdict['mediatype']=="youtube" || $viewdict['mediatype']=="podcast"){ echo $viewdict['mediatype']; } ?>" id="<?php echo $viewdict['id'] ?>">
	<div class="cell_6 container">
		<div style="display: inline-block; width: 100%">
			<div>
				<?php if($viewdict['mediatype']=="youtube"){ ?>
				<?php 
					//get youtubelink from imagepath
					$n = strpos($viewdict['imagepath'], "?v=");
					$startpoint = strrpos($viewdict['imagepath'], "?v=")+3;
					$endpoint = strrpos($viewdict['imagepath'], "&", $startpoint);
					$result = "";
					if($endpoint==false){
						$startpoint = strrpos($viewdict['imagepath'], ".be/")+4;
						$endpoint = strrpos($viewdict['imagepath'], "?list=", $startpoint);
					}
					if($endpoint!=false){
						$result = substr($viewdict['imagepath'], $startpoint, ($endpoint-$startpoint));
					}else{
						$result = substr($viewdict['imagepath'], $n);
					}
					$cell6image = "https://www.youtube.com/embed/".$result."?controls=0";
				?>
					
					<div class="cell_6 youtubediv" style="position: relative; display: inline-block; width: 100%; height: 44% margin: 0; padding: 0;">
						<iframe width="100%" height="44%" src="<?php echo $viewdict['imagepath'] ?>"></iframe>
					</div>
				<?php }else{ ?>
				<div class="cell_6 picture" style="<?php if($viewdict['imagepath']){ echo 'background-image: url('.$viewdict['imagepath'].');'; } ?>"></div>
				<div class="cell_6 words">
					<!-- <div class="text-container"> -->
						<label class="cell_6 category"><?php echo $viewdict['category'] ?></label>
						<br>
						<label class="cell_6 title"><?php if(isset($viewdict['title'])){echo $viewdict['title'];} ?></label>
						<br>
						<br>
						<?php if($viewdict['date']!=""){ ?>
							<label class="cell_6 date"><?php echo $viewdict['date'] ?></label>
						<?php } ?>
					<!-- </div> -->
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
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
				if($(this).hasClass("youtube") || $(this).hasClass("podcast")){
					posturl = '?p=';
				}
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
					// window.location.href = "/post?p="+this.id;
					// window.location.href = posturl+this.id+"/"+$(this).find('.title').text().replace(/\W/g, '');
					window.location.href = posturl+this.id+"/"+$(this).find('.title').text().replace(/\W/g, '-');
				}
			});
		}

		addcell(parent, viewdict){
			// console.log( "adding cell "+viewdict['id'] );

			var cell = document.createElement('div');
			var container = document.createElement('div');
			var misc_div = document.createElement('div');
			var picture = document.createElement('div');
			var words = document.createElement('div');
			var category = document.createElement('label');
			var title = document.createElement('label');
			var date = document.createElement('label');

			cell.className = '<?php echo $identifier ?>';
			cell.id = viewdict['id'];

			container.className = 'container';

			$(misc_div).css({'display': 'inline-block', 'width': '100%'});

			picture.className = 'picture';
			$(picture).css('background-image', 'url('+viewdict['featured_imagepath']+')');

			words.className = 'words';

			category.className = 'category';
			$(category).text(viewdict['category']);

			title.className = 'title';
			$(title).text(viewdict['title']);

			date.className = 'date';
			$(date).text(viewdict['datemade']);

			parent.appendChild(cell);
			cell.appendChild(container);
			container.appendChild(misc_div);
			misc_div.appendChild(picture);
			misc_div.appendChild(words);
			words.appendChild(category);
			words.appendChild(title);
			words.appendChild(date);

		}

	}
		var <?php echo $identifier ?> = new <?php echo $identifier ?>Classes();
	}
	
	<?php echo $identifier ?>.setupactions();


</script>