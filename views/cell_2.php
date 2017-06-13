<?php 
	if(!isset($cell2mediatype)){ $cell2mediatype=""; }
	if( !isset($isfeatured) ){ $isfeatured=false; }
?>

<style>

</style>

<div class="cell2 <?php if($isfeatured){ echo "featured"; } ?> <?php if($cell2mediatype=="youtube" || $cell2mediatype=="podcast"){ echo $cell2mediatype; } ?>" id="<?php echo $cell2id ?>">
	<div class="container">
		<div style="display: inline-block; width: 100%;">
			<div>
				<div class="picture" style="<?php if($cell2image){ echo 'background-image: url('.$cell2image.');'; } ?>"></div>
				<div class="words">
					<div class="text-container">
						<!-- <label class="grey-label">Today</label> -->
						<br>
						<label class="title" style=""><?php if(isset($cell2title)){echo $cell2title;} ?></label>
						<br>
						<label class="grey-label"><?php echo $cell2desc ?>...</label>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

	var editingon = false;
	
	if(typeof Cell2Class == 'undefined'){
		class Cell2 {

		setupactions(){
			var editingon=false;
			$('.cell2').off('click');
			$('.cell2').click(function(){

				// if(typeof window.selectedfeatured == 'undefined'){var window.selectedfeatured=null;}
				if($(this).hasClass('featured')){
					window.selectedfeatured = $(this).parent().attr('class');
				}else{
					window.selectedfeatured=null;
				}

				var gotothis;
				var whichfeatured;
				var posturl = '<?php echo $baseurlminimal ?>post/';
				// window.selectedfeatured = this.id;
				var thedict;
				
				if(editingon==true){
					// $('.articlesbackground').css('display', 'inline-block');
					// $('.articlespopview').css('display', 'inline-block');
					//updateifvideo(type, path, div);
					if(window.selectedfeatured==null || window.selectedfeatured==""){
						window.location.href = "<?php echo $baseurlminimal ?>editing/post?p="+this.id;
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
					window.location.href = "<?php echo $baseurlminimal ?>post/"+this.id+"/"+$(this).find('.title').text().replace(/[^ \w]+/, '').replace(/\W/g, '-');
				}
			});
		}

	}
		var Cell2Class = new Cell2();
	}
	
	Cell2Class.setupactions();


</script>