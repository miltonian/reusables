<?php 
	if(!isset($cell3mediatype)){ $cell3mediatype=""; }
	if( !isset($isfeatured) ){ $isfeatured=false; }
?>
<style>

.cell3 {
	display: inline-block;
	position: relative;
	margin: 0;
	padding: 0;
	width: 100%;
}

.cell3 .container{
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
	width: 100%;
}

.cell3 h1 { cursor: pointer; }
	.cell3 h1:hover {text-decoration: underline;}

.cell3 .picture{
	position: relative;
	display: block;
	margin: 0;
	padding: 0;
	width: 450px;
	width: 100%;
	height: 300px;
	height: 335px;
	background-image: url("https://c.tadst.com/gfx/750w/sunrise-sunset-sun-calculator.jpg?1"); /* the root is entrenash */
	background-size: cover;
	background-position: center;
	cursor: pointer;
}

.cell3 .words{
	position: relative;
	display: block;
	margin: 0;
	padding: 0;
	width: 450px;
	width: 100%;
	height: 70px;
	background-color: white;
}

.cell3 .text-container{
	position: relative;
	display: inline-block;
	top: 50%;
	transform: translateY(-50%);
	padding-left: 10px; 
	padding-right: 10px;
	max-width: calc(100% - 20px);
}

.cell3 .grey-label{
	font-style: italic;
	color: grey;
	font-size: 0.8em;
	font-weight: 300;
	top: 0;
}
.cell3 a { text-decoration: none; color: #333333;} 

</style>

<div class="cell3 <?php if($isfeatured){ echo "featured"; } ?> <?php if($cell3mediatype=="youtube" || $cell3mediatype=="podcast"){ echo $cell3mediatype; } ?>" id="<?php echo $cell3id ?>">
	<div class="container">
		<div style="display:inline-block; width: 100%;">
			<div>
				<a href="<?php if($isadmin){ echo '#'; }else{ echo $baseurlminimal.'post/'.$cell3id . '/' . preg_replace('/\PL/u', '-', preg_replace("/[^ \w]+/", "", $cell3title) ); } ?>"><div class="picture" style="<?php if($cell3image){ echo 'background-image: url('.$cell3image.');'; } ?>"></div></a>
				<div class="words">
					<div class="text-container">
						<a href="<?php if($isadmin){ echo '#'; }else{ echo $baseurlminimal.'post/'.$cell3id . '/' . preg_replace('/\PL/u', '', preg_replace("/[^ \w]+/", "", $cell3title) ); } ?>"><h1 class="title" style="font-size: 1.2em; position: relative; display: inline-block; margin: 0; padding: 0;"><?php if(isset($cell3title)){echo $cell3title;} ?></h1></a>
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
			$('.cell3').off('click');
			$('.cell3').click(function(){
				
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
					if(window.selectedfeatured==null || window.selectedfeatured==""){
						window.location.href = "<?php echo $baseurlminimal ?>editing/post?p="+this.id;
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
					
					window.location.href = "<?php echo $baseurlminimal ?>post/"+this.id+"/"+$(this).find('.title').text().replace(/\W/g, '-');
				}
				//}
			});
		}

	}
		var Cell3Class = new Cell3();
	}
	
	Cell3Class.setupactions();
</script>