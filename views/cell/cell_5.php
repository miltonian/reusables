<?php 
	if(!isset($cell5mediatype)){ $cell5mediatype=""; }
	if( !isset($isfeatured) ){ $isfeatured=false; }
?>
<style>

.cell5 {
	display: inline-block;
	position: relative;
	margin: 0;
	padding: 0;

}

.cell5 .container{
	position: relative;
	display: inline-block;
	margin: 0;
	padding: 0;
	/*width: 100%;*/
	margin: 0px 5px;
	text-align: center;
	/*top: 50%;
	transform: translateY(-50%);*/
	float: left;
	background-color: white;
	padding-bottom: 10px;
}

.cell5 label { cursor: pointer; }
	.cell5 label:hover {text-decoration: underline;}

.cell5 .picture{
	position: relative;
	display: block;
	margin: 0;
	padding: 0;
	width: 700px;
	height: 425px;
	background-image: url("https://c.tadst.com/gfx/750w/sunrise-sunset-sun-calculator.jpg?1"); /* the root is entrenash */
	background-size: cover;
	background-position: center;
	cursor: pointer;
}

.cell5 .words{
	position: relative;
	display: block;
	margin: 0;
	padding: 0;
	width: 700px;
	height: 70px;
	background-color: white;
}

.cell5 .text-container{
	position: relative;
	display: inline-block;
	top: 50%;
	transform: translateY(-50%);
	padding-left: 10px; 
	padding-right: 10px;
}

.cell5 .grey-label{
	font-style: italic;
	color: grey;
	font-size: 0.8em;
	font-weight: 300;
	top: 0;
}

</style>

<div class="cell5 <?php if($celldict['isfeatured']){ echo "featured"; } ?> <?php if($celldict['mediatype']=="youtube" || $celldict['mediatype']=="podcast"){ echo $celldict['mediatype']; } ?>" id="<?php echo $celldict['id'] ?>">
	<div class="container">
		<div style="display:inline-block;">
			<div>
				<a href="<?php if($isadmin){ echo '#'; }else{ echo '/post/'.$celldict['post_id'] . '/' . preg_replace('/\PL/u', '-', preg_replace("/[^ \w]+/", "", $celldict['title']) ); } ?>">
					<div class="picture" style="<?php if($celldict['imagepath']){ echo 'background-image: url('.$celldict['imagepath'].');'; } ?>"></div>
				</a>
				<div class="words">
					<div class="text-container">
						<a href="<?php if($isadmin){ echo '#'; }else{ echo '/post/'.$celldict['post_id'] . '/' . preg_replace('/\PL/u', '', preg_replace("/[^ \w]+/", "", $celldict['title']) ); } ?>">
							<label class="title" style="font-size: 1.2em; position: relative; display: inline-block; margin: 0; padding: 0;<?php if($celldict['title']==""){ ?>opacity: 0;<?php } ?>"><?php echo $celldict['title'] ?></label>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	var editingon = false;

	
	if(typeof Cell5Class == 'undefined'){
		class Cell5 {

		setupactions(){
			var editingon=false;
			$('.cell5').off('click');
			$('.cell5').click(function(){

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
		var Cell5Class = new Cell5();
	}
	
	Cell5Class.setupactions();
</script>