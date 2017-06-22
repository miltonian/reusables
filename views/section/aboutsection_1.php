<?php

$exampledesc = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";

$exampleemail = "example@email.com";

?>

<style>
.about1 {
	display: inline-block;
	position: relative;
	margin: 0;
	padding: 0;
	width: 100%;
	text-align: center;
}
.about1 .container {
	display: inline-block;
	position: relative;
	margin: 0;
	padding: 0;
	max-width: 1200px;
}
.about1 .person {
	display: inline-block;
	position: relative; 
	margin: 0;
	padding: 0;
	margin: 0px 10px;
}
.about1 .person img {
	display: inline-block;
	position: relative;
	margin: 0;
	padding: 0;
	width: 100%;
	/*padding-bottom: 100%;*/
}

.about1 .person .name {
	display: inline-block;
	position: relative;
	margin: 0;
	padding: 10px;
	width: calc(100% - 20px);
	color: #333333;
	text-align: center;
	padding-bottom: 0;
}
.about1 .person .title {
	display: inline-block;
	position: relative;
	margin: 0;
	padding: 10px;
	width: calc(100% - 20px);
	color: #333333;
	text-align: center;
}
.about1 .person .email {
	display: inline-block;
	position: relative;
	margin: 0;
	padding: 0px;
	width: calc(100% - 20px);
	color: #555555;
	text-align: center;
	font-weight: 300;
	font-size: 0.9em;
}
.about1 .person .desc {
	display: inline-block;
	position: relative;
	margin: 0;
	padding: 10px;
	width: calc(100% - 20px);
	color: #555555;
	text-align: center;
	font-weight: 300;
}

@media (min-width: 0px) {
	.about1 .person {width: calc(100% - 20px); float: none; margin-bottom: 50px;}
}
@media (min-width: 768px) {
	.about1 .person { width: calc(60% - 20px); float: none;}
}
@media (min-width: 992px) {
	.about1 .person { width: calc(33% - 20px); float: left;}
}
</style>

<div class="about1">
	<div class="container">
		<?php for ($i=0; $i < sizeof($teamarray); $i++) { ?>
			<div class="person <?php echo $i ?>">
				<img src="<?php echo $teamarray[$i]['imagepath'] ?>" />
				<h3 class="name"><?php echo $teamarray[$i]['name'] ?></h3>
				<h5 class="title"><?php echo $teamarray[$i]['title'] ?></h5>
				<p class="email"><?php echo $teamarray[$i]['email'] ?></p>
				<p class="desc"><?php echo $teamarray[$i]['desc'] ?></p>
			</div>
		<?php } ?>
	</div>
</div>


<script>
</script>