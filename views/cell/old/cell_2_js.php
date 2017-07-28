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