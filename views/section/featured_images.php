<?php

namespace Reusables;

//exit("hello");
//$MainClasses = new MainClasses();

$featuredpost1 = $MainClasses->getFeaturedPosts( "1" )[1];

$featuredpost2 = $MainClasses->getFeaturedPosts( "2" )[1];
$featuredpost3 = $MainClasses->getFeaturedPosts( "3" )[1];
$featuredpost4 = $MainClasses->getFeaturedPosts( "4" )[1];
//exit(json_encode(array($featuredpost3)));
$featuredtitle1 = $featuredpost1['title'];
$featuredtitle2 = $featuredpost2['title'];
$featuredtitle3 = $featuredpost3['title'];
$featuredtitle4 = $featuredpost4['title'];

$featuredoneid = $featuredpost1['post_id'];
$featuredtwoid = $featuredpost2['post_id'];
$featuredthreeid = $featuredpost3['post_id'];
$featuredfourid = $featuredpost4['post_id'];

$featuredtypeone = $featuredpost1['type'];
$featuredtypetwo = $featuredpost2['type'];
$featuredtypethree = $featuredpost3['type'];
//backgroundimg = backgroundimg.replace("https://theanywherecard.com/entrenash/media/uploads/", "https://theanywherecard.com/entrenash/media/uploads/thumbs/");
$featuredimage1 = $featuredpost1['featured_imagepath'];
$featuredimage2 = $featuredpost2['featured_imagepath'];
$featuredimage3 = $featuredpost3['featured_imagepath'];
$featuredimage4 = $featuredpost4['featured_imagepath'];

$featuredimage1 = str_replace('https://theanywherecard.com/entrenash/media/uploads/',  'https://theanywherecard.com/entrenash/media/uploads/thumbs2/', $featuredimage1);
$featuredimage2 = str_replace('https://theanywherecard.com/entrenash/media/uploads/',  'https://theanywherecard.com/entrenash/media/uploads/thumbs2/', $featuredimage2);
$featuredimage3 = str_replace('https://theanywherecard.com/entrenash/media/uploads/',  'https://theanywherecard.com/entrenash/media/uploads/thumbs2/', $featuredimage3);
$featuredimage4 = str_replace('https://theanywherecard.com/entrenash/media/uploads/',  'https://theanywherecard.com/entrenash/media/uploads/thumbs2/', $featuredimage4);

$featuredepoch1 = $featuredpost1['date_made'];
$featuredepoch2 = $featuredpost2['date_made'];
$featuredepoch3 = $featuredpost3['date_made'];
$featuredepoch4 = $featuredpost4['date_made'];

$dt = new DateTime("@$featuredepoch1");
$featureddate1 = $dt->format('m/d/y');

$dt = new DateTime("@$featuredepoch2");
$featureddate2 = $dt->format('m/d/y');

$dt = new DateTime("@$featuredepoch3");
$featureddate3 = $dt->format('m/d/y');

$dt = new DateTime("@$featuredepoch4");
$featureddate4 = $dt->format('m/d/y');

?>


<style>
.featureddivs:hover { opacity: 0.7; }
#featureddiv_one {
	
	position: relative; 
	display: inline-block; 
	margin: 0; 
	padding: 0;  
	float: left; 
	height: 450px; 
	width: 50%; 
	float: left; 
	overflow: hidden; 
	background-position: center; 
	background-size: 100% auto; 
	border: none; 
	border-style: solid; 
	border-color: white; 
	border-width: 1px; 
	box-sizing: border-box; 
	cursor: pointer;
	
}

#featureddiv_two {
	
	position: relative; 
	display: inline-block; 
	margin: 0; 
	padding: 0; 
	float: left; 
	height: 200px; 
	width: 50%; 
	
}

#featuredtwodiv_one {
	
	position: relative; 
	display: inline-block; 
	margin: 0; 
	padding: 0; 
	float: left; 
	height: 200px; 
	width: 50%; 
	float: left; 
	overflow: hidden; 
	background-position: center; 
	background-size: 100% auto; 
	border: none; 
	border-style: solid; 
	border-color: white; 
	border-width: 1px; 
	box-sizing: border-box; 
	cursor: pointer;
	
}

#featuredtwodiv_two {
	
	position: relative; 
	display: inline-block; 
	margin: 0; 
	padding: 0; 
	float: left; 
	height: 200px; 
	width: 50%; 
	float: left; 
	overflow: hidden; 
	background-position: center; 
	background-size: 100% auto; 
	border: none; 
	border-style: solid; 
	border-color: white; 
	border-width: 1px;  
	box-sizing: border-box; 
	cursor: pointer;
	
}

#featureddiv_three {
	
	position: relative; 
	display: inline-block; 
	margin: 0; 
	padding: 0; 
	float: left; 
	height: 250px; 
	width: 50%; 
	float: left; 
	overflow: hidden; 
	background-position: center; 
	background-size: 100% auto; 
	border: none; 
	border-style: solid; 
	border-color: white; 
	border-width: 1px; 
	box-sizing: border-box; 
	cursor: pointer;
	
}

.featuredcontentcontainer {
	
	position: relative;
	display: inline-block;
	width: 90%;
	height: 100%;
	
}

.featuredcontent {
	
	position: absolute; 
	display: block; 
	padding: 0; 
	margin: 0;
	width: 68%;
	left: 20px;
	height: 110px;
	text-align: left;
	bottom: 0;
	
}

.featuredtitlescontainer {
	
	position: relative; 
	display: inline-block;
	width: 100%; 
	height: 60%;
	padding: 0;
	margin: 0;
	
}

.featureddatescontainer {
	
	position: relative; 
	display: inline-block;
	width: 100%; 
	height: 40%;
	padding: 0;
	margin: 0;
	
}
</style>


				<div class='featureddivs' id='featureddiv_one' style='background-image: url($featuredimage1); background-size: cover;' >
					<!--<a href='http://theanywherecard.com/entrenash/post?p=$featuredoneid' >-->
						<div class='gradientdiv'></div>
						
						<div class='featuredcontent' id='1' style='height: 150px; width: 85%;' >
							<div class='featuredtitlescontainer' id='1'>
								<p class='featuredtitles' id='1' style='font-size: 2.4em;'>$featuredtitle1</p>
							</div>
							
							<div class='featureddatescontainer' id='1'>
								<p class='featureddates' id='1' style=''>$featureddate1</p>
							</div>
						</div>
					<!--</a>-->
				</div>
				
				<?php if($device=='mobile'){ ?>
					<div id='featureddiv_two' style='position: relative; display: inline-block; width: 50%; height: 250px; padding: 0; margin: 0; background-size: cover;'>
				<?php }else{ ?>
					<div id='featureddiv_two' style='position: relative; display: inline-block; width: 50%; height: 200px; padding: 0; margin: 0; background-size: cover;'>
				<?php } ?> 
					
					
					<div class='featureddivs' id='featuredtwodiv_one' style='background-image: url(<?php echo $featuredimage2 ?>);  width: 50%; margin: 0; padding: 0; float: left; height: 100%;'>
						<!--<a href='http://theanywherecard.com/entrenash/post?p=$featuredtwoid' style='position: relative; display: inline-block; margin: 0; padding: 0; width: 100%; height: 100%;'>-->
							<div class='gradientdiv'></div>
							
							<?php if($device=='mobile'){ ?>
								<div class='featuredcontent' id='2' style='height: 120px;'>
							<?php }else{ ?>
								<div class='featuredcontent' id='2' style='height: 80px;'>
							<?php } ?>
							
								<div class='featuredtitlescontainer' id='2' style='height: 100%;'>
									<p class='featuredtitles' id='2' style='font-size: 1.2em;  height: 100%;'>$featuredtitle2</p>
								</div>
								
							</div>
							
						<!--</a>-->
					</div>
					<div class='featureddivs' id='featuredtwodiv_two' style='background-image: url($featuredimage3);  width: 50%; margin: 0; padding: 0; background-size: cover; height: 100%;'>
						<!--<a href='http://theanywherecard.com/entrenash/post?p=$featuredthreeid' style='width: 100%; height: 100%;'>-->
							<div class='gradientdiv'></div>
							
							<?php if($device=='mobile'){ ?>
								<div class='featuredcontent' id='3' style='height: 120px;'>
							<?php }else{ ?>
								<div class='featuredcontent' id='3' style='height: 80px;'>
							<?php } ?>
								<div class='featuredtitlescontainer' id='3' style='height: 100%;'>
									<p class='featuredtitles' id='3' style='font-size: 1.2em;  height: 100%;'>$featuredtitle3</p>
								</div>
								
							</div>
						<!--</a>-->
					</div>
				</div>
				<div class='featureddivs' id='featureddiv_three' style='position: relative; display: inline-block;  background-image: url($featuredimage4); background-size: cover; width: 50%; margin: 0; padding: 0; float: left; height: 250px;'>
					<!--<a href='http://theanywherecard.com/entrenash/post?p=$featuredfourid' style='width: 100%; height: 100%; '>-->
						<div class='gradientdiv'></div>
						
						<div class='featuredcontent'>
							<div class='featuredtitlescontainer'>
								<p class='featuredtitles' id='4' style=''>$featuredtitle4</p>
							</div>
							
							<div class='featureddatescontainer'>
								<p class='featureddates' id='4' style=''>$featureddate4</p>
							</div>
						</div>
					<!--</a>-->
				</div>
<script>

class FeaturedSection_One {
	populatecontent(featuredonedict,featuredtwodict,featuredthreedict,featuredfourdict){
		$('#featureddiv_one').css({'background-image': 'url('+featuredonedict['image']+')'});
		$('#featuredtwodiv_one').css({'background-image': 'url('+featuredtwodict['image']+')'});
		$('#featuredtwodiv_two').css({'background-image': 'url('+featuredthreedict['image']+')'});
		$('#featureddiv_three').css({'background-image': 'url('+featuredfourdict['image']+')'});
		
		$('#featureddiv_one').find('.featuredtitles').text(featuredonedict['title']);
		$('#featuredtwodiv_one').find('.featuredtitles').text(featuredtwodict['title']);
		$('#featuredtwodiv_two').find('.featuredtitles').text(featuredthreedict['title']);
		$('#featureddiv_three').find('.featuredtitles').text(featuredfourdict['title']);
		
		$('#featureddiv_one').find('.featureddates').text(featuredonedict['datemade']);
		$('#featuredtwodiv_one').find('.featureddates').text(featuredtwodict['datemade']);
		$('#featuredtwodiv_two').find('.featureddates').text(featuredthreedict['datemade']);
		$('#featureddiv_three').find('.featureddates').text(featuredfourdict['datemade']);
		
		$('.featureddivs').off('click');
		addaction('#featureddiv_one');
		addaction($('#featuredtwodiv_one'));
		addaction($('#featuredtwodiv_two'));
		addaction($('#featureddiv_three'));
	}
	
	addaction(obj){
		$(obj).off();
	}
}

</script>