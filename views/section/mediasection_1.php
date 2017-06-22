<?php

?>

<style>
.mediasection1 {
	display: inline-block;
	position: relative; 
	margin: 0;
	padding: 0;
	width: 100%; 
	/*height: 100%;*/
}
.mediasection1 .container {
	display: inline-block;
	position: relative;
	margin: 0;
	padding: 0;
}
.mediasection1 .post {
	display: inline-block;
	position: relative;
	margin: 0 10%;
	padding: 0;
	width: 25%;
	padding-bottom: 25%;
	background-size: cover;
	background-position: center;
	background-repeat: no-repeat;
	cursor: pointer;
	/*background-color: red;*/
}
.mediasection1 .post:hover {opacity: 0.6}
</style>

<div class="mediasection1">
	<!-- <div class="container"> -->
		<?php for ($i=0; $i < sizeof($mediaarray); $i++) { ?>
			<div class="post <?php echo $i ?>" style="background-image: url('<?php echo $mediaarray[$i]['imagepath'] ?>')">

			</div>
			<!-- <label>Coming Summer 2017</label> -->
		<?php } ?>
	<!-- </div> -->
</div>

<script>
	
</script>