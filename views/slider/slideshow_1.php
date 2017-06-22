<?php
	
$dir    = '../penthouse/images';
$files1 = scandir($dir);


for($i=0;$i<2;$i++){
	array_shift($files1);
}

$prelink = "http://theanywherecard.com/entrenash/penthouse/images/";
$thumblink = "http://theanywherecard.com/entrenash/penthouse/images/thumbs/";

?>


<style>

.slide_container {
	
	display: inline-block; 
	position: relative; 
	margin: 0;
	padding: 0;
	width: 100%;
	text-align: center;
	
}

.slide_main {
	
	display: inline-block;
	position: relative; 
	margin: 0;
	padding: 0;
	width: 800px;
	height: 400px;
	
}

.slide_mainimg {
	
	display: inline-block;
	position: relative; 
	margin: 0;
	padding: 0;
	width: 100%; 
	height: 300px;
	background-color: #f5f5fa;
	
}

.slide_thumbs {
	
	position: relative; 
	display: inline-block;
	margin: 0;
	padding: 0;
	width: 100%;
	height: 100px;
	overflow-x: scroll;
    	overflow-y: hidden;
    	background-color: #F5F5FA;
	
}

.big_img {
	
	position: relative; 
	display: inline-block;
	margin: 0;
	padding: 0;
	width: 100%;
	height: 100%;
	background-size: contain;
	background-position: center;
	background-repeat: no-repeat;
	
}

.div_thumbs {
	
	position: relative;
	display: inline-block;
	margin: 5px 5px 5px 5px;
	padding: 0;
	width: 82px;
	height: 82px;
	background-size: cover;
	background-position: center;
	background-repeat: no-repeat;
	float: left;
	border-radius: 0px;
	border-style: solid;
	border-width: 3px;
	border-color: #C5C5C9;
	cursor: pointer;
	
}

.thumbs_container {
	
	position: relative;
	display: inline-block;
	margin: 0;
	padding: 0;
	width: auto;
	height: 100px;
	
}

</style>

<div class="slide_container">
	<div class="slide_main">
		<div class="slide_mainimg">
			<div class="big_img" id="1" style="background-image: url('<?php echo $prelink.$files1[0]; ?>')"></div>
		</div>
		<div class="slide_thumbs">
			<div class="thumbs_container">
			<?php for($i=0;$i<sizeof($files1);$i++){ 
				echo '<div class="div_thumbs" id="'.$i.'" style="background-image: url('.$thumblink.$files1[$i].');  cursor: pointer;"></div>';
			 } ?>
			</div>
		</div>
	</div>
</div>

<script>

	$('.div_thumbs').click(function(){
		var prelink = '<?php echo $prelink ?>';
		var imgnames = <?php echo json_encode($files1) ?>;
		var imgsrc = prelink+imgnames[this.id];
		$('.big_img').stop().animate({'opacity': '0'}, 300, function(){
			$('.big_img').css({'background-image': 'url('+imgsrc+')'});
			$('.big_img').stop().animate({'opacity': '1'}, 300);
		});
	});

</script>