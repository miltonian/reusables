<?php
	if(!isset($fontsizemobile)){$fontsizemobile='2em';}
	if(!isset($fontsize)){$fontsize='1.4em';}
	if(!isset($showdate)){$showdate=false;}
	if(!isset($cell7mediatype)){ $cell7mediatype=""; }
	if(!isset($isfeatured)){ $isfeatured=false; }

	if(!isset($isadmin)){ $isadmin=false; }

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

.cell7 {
	position: relative;
	display: inline-block;
	margin: 0;
	padding: 0;
	height: 100%;
	width: 100%;
	float: left;
	background-position: center;
	background-repeat: no-repeat;
	background-size: cover;
}
.cell7 .gradient {
	position: absolute;
	display: inline-block;
	height: 50%;
	bottom: 0;
	left: 0;
	margin: 0;
	padding: 0;
	width: 100%;
	background: -webkit-linear-gradient(top,rgba(0,0,0,0),rgba(0,0,0,1)); 
	background: -o-linear-gradient(bottom,rgba(0,0,0,0),rgba(0,0,0,1)); 
	background: -moz-linear-gradient(bottom,rgba(0,0,0,0),rgba(0,0,0,1));  
	background: linear-gradient(to bottom, rgba(0,0,0,0), rgba(0,0,0,1)); 
}

.cell7 .title {
	position: absolute;
	display: inline-block;
	margin: 0;
	padding: 10px 20px;
	height: 20%;
	bottom: 20px;
	overflow: hidden;
	width: calc(100% - 40px);
	color: white;
	font-weight: 400;
	text-align: left;
	left: 0;
	text-decoration: none;
	cursor: pointer;
	line-height: 1.5;
}
.cell7 .title:hover { text-decoration: underline; }

.cell7 .date {
	display: inline-block; 
	position: absolute; 
	margin: 0;
	padding: 10px 20px;
	bottom: 0px;
	color: white;
	font-weight: 300;
	font-size: 12px;
	left: 0;
}


@media (min-width: 0px) {
	/*.cell7 {padding-bottom: 70%;}*/
	.cell7 .title {font-size: 2em;}
	.cell7 .mobile {display: inline-block;}
	.cell7 .desktop {display: none;}
}
@media (min-width: 768px) {
	/*.cell7 {padding-bottom: 30%;}*/
	.cell7 .title {font-size: 1.4em;}
	.cell7 .mobile {display: none;}
	.cell7 .desktop {display: inline-block;}
}
@media (min-width: 992px) {
	/*.cell7 {padding-bottom: 30%;}*/
	.cell7 .title {font-size: 1.6em;}
	.cell7 .mobile {display: none;}
	.cell7 .desktop {display: inline-block;}
}

</style>

<div class="cell7 <?php if($celldict['isfeatured']){ echo "featured"; } ?> <?php if($celldict['mediatype']=="youtube" || $celldict['mediatype']=="podcast"){ echo $celldict['mediatype']; } ?>" id="<?php echo $celldict['post_id'] ?>" style="background-image: url(<?php echo $celldict['featured_imagepath'] ?>)">
		<div class="gradient"></div>
		<label class="title mobile" style="font-size: <?php echo $fontsizemobile ?>"><?php echo $celldict['title'] ?></label>
		<label class="title desktop" style="font-size: <?php echo $fontsize ?>"><?php echo $celldict['title'] ?></label>
		<?php if($celldict['date']!=""){ ?>
			<label class="date"><?php echo $celldict['date'] ?></label>
		<?php } ?>
	</div>

<script>

	var editingon = false;

	
	if(typeof Cell7Class == 'undefined'){
		class Cell7 {

		setupactions(){
			// var editingon=false;
			$('.cell7').off('click');
			$('.cell7').click(function(){

				// if(typeof window.selectedfeatured == 'undefined'){var window.selectedfeatured=null;}
				if($(this).hasClass('featured')){
					window.selectedfeatured = $(this).parent().attr('class');
				}else{
					window.selectedfeatured=null;
				}

				var gotothis;
				var whichfeatured;
				var posturl = '<?php echo $baseurlminimal ?>post/';
				if($(this).hasClass("podcast")){
					posturl = '<?php echo $baseurlminimal ?>brand-forward?p=';
				}else if($(this).hasClass("youtube")){
					posturl = '<?php echo $baseurlminimal ?>createorchestrate?p=';
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
		var Cell7Class = new Cell7();
	}
	
	Cell7Class.setupactions();


</script>