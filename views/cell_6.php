<?php
	if(!isset($cell6mediatype)){ $cell6mediatype=""; }
	if(!isset($showdate)){$showdate=false;}
	if( !isset($isfeatured) ){ $isfeatured=false; }
?>

<style>



</style>

<div class="cell6 <?php if($isfeatured){ echo "featured"; } ?> <?php if($cell6mediatype=="youtube" || $cell6mediatype=="podcast"){ echo $cell6mediatype; } ?>" id="<?php echo $cell6id ?>">
	<div class="container">
		<div style="display: inline-block; width: 100%">
			<div>
				<?php if($cell6mediatype=="youtube"){ ?>
				<?php 
					//get youtubelink from imagepath
					$n = strpos($cell6image, "?v=");
					$startpoint = strrpos($cell6image, "?v=")+3;
					$endpoint = strrpos($cell6image, "&", $startpoint);
					$result = "";
					if($endpoint==false){
						$startpoint = strrpos($cell6image, ".be/")+4;
						$endpoint = strrpos($cell6image, "?list=", $startpoint);
					}
					if($endpoint!=false){
						$result = substr($cell6image, $startpoint, ($endpoint-$startpoint));
					}else{
						$result = substr($cell6image, $n);
					}
					$cell6image = "https://www.youtube.com/embed/".$result."?controls=0";
					// $cell6image = $result;
				?>
					
					<div class="youtubediv" style="position: relative; display: inline-block; width: 100%; height: 44% margin: 0; padding: 0;">
						<iframe width="100%" height="44%" src="<?php echo $cell6image ?>"></iframe>
					</div>
				<?php }else{ ?>
				<div class="picture" style="<?php if($cell6image){ echo 'background-image: url('.$cell6image.');'; } ?>"></div>
				<div class="words">
					<!-- <div class="text-container"> -->
						<label class="category"><?php echo $cell6category ?></label>
						<br>
						<label class="title"><?php if(isset($cell6title)){echo $cell6title;} ?></label>
						<br>
						<br>
						<?php if($showdate){ ?>
							<label class="date"><?php echo $cell6date ?></label>
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


	
	if(typeof Cell6Class == 'undefined'){
		class Cell6 {

		setupactions(){
			// var editingon=false;
			$('.cell6').off('click');
			$('.cell6').click(function(){

				// if(typeof window.selectedfeatured == 'undefined'){var window.selectedfeatured=null;}
				if($(this).hasClass('featured')){
					window.selectedfeatured = $(this).parent().attr('class');
				}else{
					window.selectedfeatured=null;
				}

				var gotothis;
				var whichfeatured;
				var posturl = '<?php echo $baseurlminimal ?>post/';
				if($(this).hasClass("youtube") || $(this).hasClass("podcast")){
					posturl = '?p=';
				}
				// window.selectedfeatured = this.id;
				var thedict;
				
				if(editingon==true){
					if(window.selectedfeatured==null || window.selectedfeatured==""){
						window.location.href = "<?php echo $baseurlminimal ?>editing/post?p="+this.id;
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

		addcell(parent, celldict){
			// console.log( "adding cell "+celldict['id'] );

			var cell = document.createElement('div');
			var container = document.createElement('div');
			var misc_div = document.createElement('div');
			var picture = document.createElement('div');
			var words = document.createElement('div');
			var category = document.createElement('label');
			var title = document.createElement('label');
			var date = document.createElement('label');

			cell.className = 'cell6';
			cell.id = celldict['id'];

			container.className = 'container';

			$(misc_div).css({'display': 'inline-block', 'width': '100%'});

			picture.className = 'picture';
			$(picture).css('background-image', 'url('+celldict['featured_imagepath']+')');

			words.className = 'words';

			category.className = 'category';
			$(category).text(celldict['category']);

			title.className = 'title';
			$(title).text(celldict['title']);

			date.className = 'date';
			$(date).text(celldict['datemade']);

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
		var Cell6Class = new Cell6();
	}
	
	Cell6Class.setupactions();


</script>