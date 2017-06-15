

<style>

.featuredsection4{
	position: relative;
	display: inline-block;
	margin: 0;
	padding: 0;
	width: 100%;
	text-align: center;
}

.featuredsection4 .picture {
	position: relative;
	margin: 0;
	/*padding: 0;*/
	/*width: 32%;*/
	/*padding-bottom: 28%;*/
	background-size: cover;
	background-position: center;
	margin: 2px;
}
/*.picture.one{
	background-image: url("https://cnet4.cbsistatic.com/img/9C4pEHLEDdU4dAn6cLUxqq2lvP0=/770x578/2016/03/21/f930a761-b346-424d-ad8b-b22d05787ad2/apple-watch-032116-7490.jpg");
}

.picture.two{
	background-image: url("https://cnet4.cbsistatic.com/img/9C4pEHLEDdU4dAn6cLUxqq2lvP0=/770x578/2016/03/21/f930a761-b346-424d-ad8b-b22d05787ad2/apple-watch-032116-7490.jpg"); 
}

.picture.three{
	background-image: url("https://cnet4.cbsistatic.com/img/9C4pEHLEDdU4dAn6cLUxqq2lvP0=/770x578/2016/03/21/f930a761-b346-424d-ad8b-b22d05787ad2/apple-watch-032116-7490.jpg"); 
}*/

.featuredsection4 #greybox{
	position: relative;
	display: inline-block;
	margin: 0;
	padding: 0;
	width: 250px;
	height: 40px;
	background-color: grey;
	color: white;
	bottom: 0;
}

.featuredsection4 .words{
	position: relative;
	display: block;
	margin: 0;
	padding: 0;
	width: auto;
	height: 100px;
	background-color: white;
}

.featuredsection4 .text-container{
	position: relative;
	display: inline-block;
	top: 50%;
	transform: translateY(-50%);
	width: 100%;
}

.featuredsection4 .grey-label{
	font-style: italic;
	color: grey;
	font-size: 2em;
}
@media (min-width: 0px) {
	.picture.one, .picture.three {display: none;}
	.picture {width: 100%; padding: 0; padding-bottom: 68%;}
	.graylabel {margin-top: calc(68% - 38px);}
}
@media (min-width: 768px) {
	.picture {display: inline-block;}
	.picture.one, .picture.three {display: inline-block;}
	.picture {width: 32%; padding: 0; padding-bottom: 28%;}
	.graylabel {margin-top: calc(28% - 38px);}
}
</style>


<div class="featuredsection4">
	<div style="display:inline-block; width: 100%;">
		<div style="display: inline-block; width: 100%;">
			<div class="graylabel" style="position: absolute; display: inline-block; width: 100%; text-align: center; left: 0; z-index: 1;">
				<div id="greybox">
					<div class="text-container" style="font-size: 0.8em;">
						APRIL 30, 2017 | EXPERIENCENASH
					</div>
				</div>
			</div>
			<div class="picture one" style="background-image: url('<?php echo $featuredpost1['featured_imagepath'] ?>');"></div>
			<div class="picture two" style="background-image: url('<?php echo $featuredpost2['featured_imagepath'] ?>');"></div>
			<div class="picture three" style="background-image: url('<?php echo $featuredpost3['featured_imagepath'] ?>');"></div>
		</div>
		<div class="words">
			<div class="text-container">
				<br>
				<label style="font-size: 2.2em;"><?php echo $featuredtext ?></label>
				<br>
				<br>
			</div>
		</div>
	</div>
</div>

<script>
	
</script>