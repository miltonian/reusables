<?php

namespace Reusables;
	
	$required = array(
		"actions"=>array("backgroundimage", ""), 
		"featured_imagepath"=>"",  
		"title"=>"",
		"index"=>""
	);

	ReusableClasses::checkRequired( $identifier, $viewdict, $required );
	// exit(json_encode($viewdict));

?>
<style>
</style>

<div class="productcell_2 main <?php echo $identifier ?>" id="<?php echo $viewdict['id'] ?>">
	<div class="productcell_2 container">
		<div style="display: inline-block; width: 100%">
			<div>
				<div class="productcell_2 picture" style="<?php if($viewdict['featured_imagepath']){ echo 'background-image: url('.$viewdict['featured_imagepath'].');'; } ?>"></div>
				<div class="productcell_2 words">
					<div class="productcell_2 text-container">
						<label class="productcell_2 grey-label date">Today</label>
						<br>
						<label class="productcell_2 title"><?php if(isset($viewdict['title'])){echo $viewdict['title'];} ?></label>
						<br>
						<label class="productcell_2 grey-label desc"><?php echo strip_tags($viewdict['html_text']) ?></label>
						<label class="productcell_2 grey-label price"><?php echo $viewdict['price'] ?></label>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

	var editingon = false;
	var isfeatured = '<?php echo $isfeatured ?>';
	
	if(typeof <?php echo $identifier ?> == 'undefined'){
		class <?php echo $identifier ?>Classes {

		setupactions(){
			// var editingon=false;
			$('.<?php echo $identifier ?>').off('click');
			$('.<?php echo $identifier ?>').click(function(){
// alert(isfeatured);
				if(isfeatured==true || isfeatured=="1"){
					selectedfeatured = $(this).parent().attr('class');
				}else{
					selectedfeatured=null;
				}

				var gotothis;
				var whichfeatured;
				var posturl = 'http://entrenash.co/post?p=';
				// selectedfeatured = this.id;
				var thedict;
				//alert(this.className);
				if(this.id == 'featuredsection_2 0'){
					// gotothis = posturl+featuredonepostid;
					gotothis = posturl;
				}else if(this.className == 'featuredsection_2 1'){
					// gotothis = posturl+featuredtwopostid;
					gotothis = posturl;
				}else if(this.className == 'featuredsection_2 2'){
					// gotothis = posturl+featuredthreepostid;
					gotothis = posturl;
				}else if(this.className == 'featuredsection_2 3'){
					// gotothis = posturl+featuredfourpostid;
					gotothis = posturl;
				}
				
				if(editingon==true){
					if(selectedfeatured==null || selectedfeatured==""){
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
					window.location.href = "/post?p="+this.id;
				}
			});
		}

	}
		var <?php echo $identifier ?> = new <?php echo $identifier ?>Classes();
	}
	
	<?php echo $identifier ?>.setupactions();


</script>