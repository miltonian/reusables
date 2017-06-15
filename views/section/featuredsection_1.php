<?php 

$device = $GLOBALS['device'];


// $featuredonepostid = $featuredpost1['id'];
// $featuredtwopostid = $featuredpost2['id'];
// $featuredthreepostid = $featuredpost3['id'];
// $featuredfourpostid = $featuredpost4['id'];

// $featuredimg1 = $featuredpost1['featured_imagepath'];
// $featuredimg2 = str_replace('https://theanywherecard.com/entrenash/media/uploads/',  'https://theanywherecard.com/entrenash/media/uploads/thumbs2/', $featuredpost2['featured_imagepath']);

// $featuredimg3 = str_replace('https://theanywherecard.com/entrenash/media/uploads/',  'https://theanywherecard.com/entrenash/media/uploads/thumbs2/', $featuredpost3['featured_imagepath']);;
// $featuredimg4 = $featuredpost4['featured_imagepath'];

// $featuredtypeone = $featuredpost1['type'];
// $featuredtypetwo = $featuredpost2['type'];
// $featuredtypethree = $featuredpost3['type'];

// $featuredepoch1 = $featuredpost1['date_made'];
// $featuredepoch2 = $featuredpost2['date_made'];
// $featuredepoch3 = $featuredpost3['date_made'];
// $featuredepoch4 = $featuredpost4['date_made'];

// if($featuredepoch1){$dt = new DateTime("@$featuredepoch1"); $featureddate1 = $dt->format('m/d/y');}

// if($featuredepoch2){$dt = new DateTime("@$featuredepoch2"); $featureddate2 = $dt->format('m/d/y');}

// if($featuredepoch3){$dt = new DateTime("@$featuredepoch3"); $featureddate3 = $dt->format('m/d/y');}

// if($featuredepoch4){$dt = new DateTime("@$featuredepoch4"); $featureddate4 = $dt->format('m/d/y');}

//echo '<script>console.log('.json_encode($featureddate2).')</script>';



/*

<div class='featureddivs' id='featureddiv_one' style='background-size: cover; background-image: url("<?php echo $featuredpost1['imagepath'] ?>");'>
	<div class='gradientdiv'></div>
	<div class=featuredcontent style='height: 150px; width: 85%;' >
		<div class=featuredtitlescontainer>
			<p class='featuredtitles' style='font-size: 2.4em;'><?php echo $featuredpost1['title'] ?></p>
		</div>
		<div class=featureddatescontainer>
			<p class='featureddates' style=''><?php echo $featureddate1 ?></p>
		</div>
	</div>
</div>
<?php if($device=='mobile'){ ?>
	<div id=featureddiv_two' style='position: relative; display: inline-block; width: 50%; height: 250px; padding: 0; margin: 0; background-size: cover;'>
<?php }else{ ?>
	<div id=featureddiv_two' style='position: relative; display: inline-block; width: 50%; height: 200px; padding: 0; margin: 0; background-size: cover;'>
<?php } ?>
	<div class='featureddivs' id='featuredtwodiv_one' style='width: 50%; margin: 0; padding: 0; float: left; height: 100%; background-size: cover; background-image: url("<?php echo $featuredimg2 ?>");'>
		<div class='gradientdiv'></div>
		<?php if($device=='mobile'){ ?>
			<div class=featuredcontent style='height: 120px;'>
		<?php }else{ ?>
			<div class=featuredcontent style='height: 80px;'>
		<?php } ?>
			<div class=featuredtitlescontainer style='height: 100%;'>
				<p class='featuredtitles' style='font-size: 1.2em;  height: 100%;'><?php echo $featuredpost2['title'] ?></p>
			</div>
		</div>
	</div>
	<div class='featureddivs' id=featuredtwodiv_two style='width: 50%; margin: 0; padding: 0; background-size: cover; height: 100%; background-image: url("<?php echo $featuredimg3 ?>");'>
		<div class='gradientdiv'></div>
		
		<?php if($device=='mobile'){ ?>
			<div class=featuredcontent style='height: 120px;'>
		<?php }else{ ?>
			<div class=featuredcontent style='height: 80px;'>
		<?php } ?>
			<div class=featuredtitlescontainer style='height: 100%;'>
				<p class='featuredtitles' style='font-size: 1.2em;  height: 100%;'><?php echo $featuredpost3['title'] ?></p>
			</div>
		</div>
	</div>
</div>
<div class='featureddivs' id='featureddiv_three' style='position: relative; display: inline-block; background-size: cover; width: 50%; margin: 0; padding: 0; float: left; height: 250px; background-image: url("<?php echo $featuredpost4['imagepath'] ?>");'>
	<div class='gradientdiv'></div>
	<div class=featuredcontent>
		<div class=featuredtitlescontainer>
			<p class='featuredtitles' style=''><?php echo $featuredpost4['title'] ?></p>
		</div>
		
		<div class=featureddatescontainer>
			<p class='featureddates' style=''><?php echo $featureddate4 ?></p>
		</div>
	</div>
</div>

*/

?>

<style>
.featuredsection1 {
	display: inline-block;
	position: relative;
	margin: 0;
	padding: 0;
	width: 100%;
	height: 450px;
}
.featuredsection1 .leftdiv, .featuredsection1 .rightdiv {
	display: inline-block;
	position: relative;
	margin: 0;
	padding: 0;
	height: 100%;
	float: left;
	background-position: center;
	background-size: cover;
	background-repeat: no-repeat;
}
	.featuredsection1 .rightdiv{width: 50%;}
.featuredsection1 .topdiv {
	display: inline-block;
	position: relative;
	margin: 0;
	padding: 0;
	width: 100%;
	height: 44%;
	background-position: center;
	background-size: cover;
	background-repeat: no-repeat;
}
.featuredsection1 .bottomdiv {
	display: inline-block;
	position: relative;
	margin: 0;
	padding: 0;
	width: 100%;
	height: 56%;
	background-position: center;
	background-size: cover;
	background-repeat: no-repeat;
}
.featuredsection1 .post {
	outline: 2px solid white;
}

@media (min-width: 0px) {
	.featuredsection1 .leftdiv {width: 100%;}
	.featuredsection1 .rightdiv {display: none;}
}
@media (min-width: 768px) {
	.featuredsection1 .leftdiv {width: 50%;}
	.featuredsection1 .rightdiv {display: inline-block;}
}
</style>

<div class="featuredsection1">
	<div class="leftdiv post">
		<?php $isfeatured=true; $showdate=false;  $fontsize='2em'; $cell7image=$featuredpost1['featured_imagepath']; $cell7title=$featuredpost1['title']; $cell7id=$featuredpost1['id']; $cell7date=$featuredpost1['formatted_date']; $cell7mediatype=$featuredpost1['type']; include $docroot.'/reusables/views/cell_7.php' ?>
	</div>
	<div class="rightdiv">
		<div class="topdiv">
			<div class="leftdiv post" >
				<?php $isfeatured=true; $hasdate=false;  $fontsize='1.0em'; $fontsizemobile='1.0em'; $cell7image=$featuredpost2['featured_imagepath']; $cell7title=$featuredpost2['title']; $cell7id=$featuredpost2['id']; $cell7date=$featuredpost2['formatted_date']; $cell7mediatype=$featuredpost2['type']; include $docroot.'/reusables/views/cell_7.php' ?>
			</div>
			<div class="rightdiv post">
				<?php $isfeatured=true; $hasdate=false;  $fontsize='1.0em'; $fontsizemobile='1.0em'; $cell7image=$featuredpost3['featured_imagepath']; $cell7title=$featuredpost3['title']; $cell7id=$featuredpost3['id']; $cell7date=$featuredpost3['formatted_date']; $cell7mediatype=$featuredpost3['type']; include $docroot.'/reusables/views/cell_7.php' ?>
			</div>
		</div>
		<div class="bottomdiv post">
			<?php $isfeatured=true; $showdate=false; $fontsize='1.3em'; $fontsizemobile='1.3em'; $cell7image=$featuredpost4['featured_imagepath']; $cell7title=$featuredpost4['title']; $cell7id=$featuredpost4['id']; $cell7date=$featuredpost4['formatted_date']; $cell7mediatype=$featuredpost4['type']; include $docroot.'/reusables/views/cell_7.php' ?>
		</div>
	</div>
</div>



<script>

class FeaturedSection1 {

	populatesection(position1,position2,position3,position4){
		// var img1 = position1[0];
		// var img2 = position2[0];
		// var img3 = position3[0];
		// var img4 = position4[0];
		/*$('#featureddiv_one').css({'background-image': "url("+img1+")", "background-size": "cover"});

		$('#featuredtwodiv_one').css('background-image', "url("+img2+")");
		$('#featuredtwodiv_two').css('background-image', "url("+img3+")");
		$('#featureddiv_three').css('background-image', "url("+img4+")");

		$('#featureddiv_one .featuredtitles').text(position1[1]);
		$('#featuredtwodiv_one .featuredtitles').text(position2[1]);
		$('#featuredtwodiv_two .featuredtitles').text(position3[1]);
		$('#featureddiv_three .featuredtitles').text(position4[1]);	*/
	}
	setupactions(){
		$('.featureddivs').click(function(){
			var gotothis;
			var whichfeatured;
			var posturl = 'http://entrenash.co/post?p=';
			selectedfeatured = this.id;
			var thedict;
			
			if(editingon==true){
				$('.articlesbackground').css('display', 'inline-block');
				$('.articlespopview').css('display', 'inline-block');
				//updateifvideo(type, path, div);
			}else{
				var mediatype = thedict['type'];
				var prehref = '';
				var preprehref = '';
				preprehref = '/';
				//alert(mediatype);
				if(mediatype != 'podcast'){
					prehref = preprehref+'post?p=';
					var thehref = prehref.concat(thedict['id']);
					var urltitle = thedict['title'].replace(/\s/g, '');
					window.location.href = thehref+'&'+urltitle;
				}else{
					preprehref = '/brand-forward';
					prehref = preprehref+'?p=';
					var thehref = prehref.concat(thedict['id']);
					var urltitle = thedict['title'].replace(/\s/g, '');
					window.location.href = thehref+'&'+urltitle;
				}
			}
		});
	}
	updateiffeaturedisvideo(typeone, typetwo, typethree, pathone, pathtwo, paththree){
		if( typeone == 'video' ){
		
			var video = document.createElement('video');
			
		    	video.src = pathone;
		    	
		    	video.style.display = 'inline-block';
		    	video.style.position = 'relative';
		    	video.className = 'featuredvideoclass';
		    	
		    	video.autoplay = true;
		    	
		    	video.setAttribute('height', '450px');
			video.setAttribute('width', 'auto');
			video.style.borderRadius = '0px';
		    	
		    	video.muted = true;
		    		
		    	video.loop = true;
		    	video.autoplay = true;
		    	//video.type = 'video/mp4';
		    	
		    	var divone = document.getElementById('featureddiv_one');
		    	
		    	divone.appendChild(video);
		    	
		    	$('.gradientdiv').css('z-index', 1);
		    	$('.featuredcontent').css('z-index', 2);
		    	
		}
		
		if( typetwo == 'video' ){
		
			var video = document.createElement('video');
			
		    	video.src = pathtwo;
		    	
		    	video.style.display = 'inline-block';
		    	video.style.position = 'relative';
		    	video.className = 'featuredvideoclass';
		    	
		    	video.autoplay = true;
		    	
		    	video.setAttribute('height', '450px');
			video.setAttribute('width', 'auto');
			video.style.borderRadius = '0px';
		    	
		    	video.muted = true;
		    		
		    	video.loop = true;
		    	video.autoplay = true;
		    	//video.type = 'video/mp4';
		    	
		    	var divone = document.getElementById('featuredtwodiv_one');
		    	
		    	divone.appendChild(video);
		    	
		    	$('.gradientdiv').css('z-index', 1);
		    	$('.featuredcontent').css('z-index', 2);
		    	
		}
		
		if( typethree == 'video' ){
		
			var video = document.createElement('video');
			
		    	video.src = paththree;
		    	
		    	video.style.display = 'inline-block';
		    	video.style.position = 'relative';
		    	video.className = 'featuredvideoclass';
		    	
		    	video.autoplay = true;
		    	
		    	video.style.borderRadius = '0px';
		    	
		    	video.muted = true;
		    		
		    	video.loop = true;
		    	video.autoplay = true;
		    	//video.type = 'video/mp4';
		    	
		    	var divone = document.getElementById('featuredtwodiv_two');
		    	
		    	divone.appendChild(video);
		    	
		    	$('.gradientdiv').css('z-index', 1);
		    	$('.featuredcontent').css('z-index', 2);
		    	
		}
		
	}	
		
}

let FeaturedSection1Class = new FeaturedSection1();
//     FeaturedSection1Class.updateiffeaturedisvideo(typeone,typetwo,typethree,pathone,pathtwo,paththree);
</script>