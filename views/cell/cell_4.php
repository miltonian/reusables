<?php 
	if(!isset($cell4mediatype)){ $cell4mediatype=""; }
	if( !isset($isfeatured) ){ $isfeatured=false; }

	if(!isset($isadmin)){ $isadmin=false; }
	if(!isset($celldict['post_id'])){ $celldict['post_id'] = $celldict['id']; }
?>
<style>

.cell4 {
	display: inline-block;
	position: relative;
	margin: 0;
	padding: 0;
	width: 100%;

}

.cell4 .container{
	position: relative;
	display: inline-block;
	margin: 0;
	padding: 0;
	/*width: 100%;*/
	/*margin: 0px 5px;*/
	text-align: center;
	/*top: 50%;
	transform: translateY(-50%);*/
	float: left;
	background-color: white;
	padding-bottom: 10px;
	width: 100%;
}

.cell4 label { cursor: pointer; }
	.cell4 label:hover {text-decoration: underline;}
	
.cell4 .picture{
	position: relative;
	display: block;
	margin: 0;
	padding: 0;
	width: 220px;
	height: 160px;
	background-image: url("https://c.tadst.com/gfx/750w/sunrise-sunset-sun-calculator.jpg?1"); /* the root is entrenash */
	background-size: cover;
	background-position: center;
	cursor: pointer;
	width: 100%;
}

.cell4 .words{
	position: relative;
	display: block;
	margin: 0;
	padding: 0;
	width: 220px;
	height: 17px;
	margin-top: 10px;
	overflow: hidden;
	background-color: white;
	width: 100%;
}

.cell4 .text-container{
	position: relative;
	display: inline-block;
	padding-left: 10px; 
	padding-right: 10px;
}

.cell4 .grey-label{
	font-style: italic;
	color: grey;
	font-size: 0.8em;
	font-weight: 300;
	top: 0;
}

</style>

<div class="cell4 <?php if($celldict['isfeatured']){ echo "featured"; } ?> <?php if($celldict['mediatype']=="youtube" || $celldict['mediatype']=="podcast"){ echo $celldict['mediatype']; } ?>" id="<?php echo $celldict['id'] ?>">
	<div class="container">
		<div style="display:inline-block; width: 100%">
			<div>
				<a href="<?php if($isadmin){ echo '#'; }else{ echo '/post/'.$celldict['post_id'] . '/' . preg_replace('/\PL/u', '-', preg_replace("/[^ \w]+/", "", $celldict['title']) ); } ?>">
					<div class="picture" style="<?php if($celldict['imagepath']){ echo 'background-image: url('.$celldict['imagepath'].');'; } ?>"></div>
				</a>
				<div class="words">
					<div class="text-container">
						<a href="<?php if($isadmin){ echo '#'; }else{ echo '/post/'.$celldict['post_id'] . '/' . preg_replace('/\PL/u', '', preg_replace("/[^ \w]+/", "", $celldict['title']) ); } ?>">
							<label class="title" style="font-size: 0.9em; position: relative; display: inline-block; margin: 0; padding: 0;"><?php if(isset($celldict['title'])){echo $celldict['title'];} ?></label>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	var editingon = false;

	
	if(typeof Cell4Class == 'undefined'){
		class Cell4 {

		setupactions(){
			var editingon=false;
			$('.cell4').off('click');
			$('.cell4').click(function(){

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
					window.location.href = "/post/"+this.id+"/"+$(this).find('.title').text().replace(/\W/g, '-');
				}
			});
		}

	}
		var Cell4Class = new Cell4();
	}
	
	Cell4Class.setupactions();
</script>