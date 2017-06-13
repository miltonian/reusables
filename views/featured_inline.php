<?php 

$urltitleone = str_replace(' ', '', $featuredposts[0]['title']);
$urltitletwo = str_replace(' ', '', $featuredposts[1]['title']);
$urltitlethree = str_replace(' ', '', $featuredposts[2]['title']);

?>


<style>

.featuredinline1 {
	position: relative;
	display: inline-block;
	margin: 0;
	padding: 0;
	width: 100%;
	cursor: pointer;
}

.featuredinline1 .post {
	position: relative;
	display: inline-block;
	margin: 0;
	padding: 0;
	/*height: 100%;*/
	float: left;
	background-position: center;
	background-repeat: no-repeat;
	background-size: cover;
	outline: 2px solid white;
}
	.featuredinline1 .post.one { background-image: url(<?php echo $featuredposts[0]['featured_imagepath'] ?>); }
	.featuredinline1 .post.two { background-image: url(<?php echo $featuredposts[1]['featured_imagepath'] ?>); }
	.featuredinline1 .post.three { background-image: url(<?php echo $featuredposts[2]['featured_imagepath'] ?>); }

.featuredinline1 .gradient {
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

.featuredinline1 .title {
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
.featuredinline1 .title:hover { text-decoration: underline; }

@media (min-width: 0px) {.replace(/\W/g, '')
	.featuredinline1 {height: auto;}
	.featuredinline1 .post {width: 100%; padding-bottom: 70%;}
	.featuredinline1 .title {font-size: 2em;}
}
@media (min-width: 768px) {
	.featuredinline1 {/*height: 275px;*/}
	.featuredinline1 .post {width: 33.333%; padding-bottom: 30%;}
	.featuredinline1 .title {font-size: 1.4em;}
}
@media (min-width: 992px) {
	.featuredinline1 {/*height: 275px;*/}
	.featuredinline1 .post {width: 33.333%; padding-bottom: 30%;}
	.featuredinline1 .title {font-size: 1.6em;}
}
</style>

<div class="featuredinline1">
	<a href="<?php echo $baseurlminimal ?>post/<?php echo $featuredposts[0]['id'] ?>/<?php echo preg_replace('/\PL/u', '', $featuredposts[0]['title'] ); ?>"><div class="post one">
		<div class="gradient"></div>
		<label class="title"><?php echo $featuredposts[0]['title'] ?></label>
	</div></a>
	<a href="<?php echo $baseurlminimal ?>post/<?php echo $featuredposts[1]['id'] ?>/<?php echo preg_replace('/\PL/u', '', $featuredposts[1]['title'] );  ?>"><div class="post two">
		<div class="gradient"></div>
		<label class="title"><?php echo $featuredposts[1]['title'] ?></label>
	</div></a>
	<a href="<?php echo $baseurlminimal ?>post/<?php echo $featuredposts[2]['id'] ?>/<?php echo preg_replace('/\PL/u', '', $featuredposts[2]['title'] ); ?>"><div class="post three">
		<div class="gradient"></div>
		<label class="title"><?php echo $featuredposts[2]['title'] ?></label>
	</div></a>
</div>

<script>
	
	class FeaturedInlineClass {
		
		
		
	}
	
</script>