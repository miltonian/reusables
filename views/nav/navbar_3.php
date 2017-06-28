<?php

if(!isset($navtype)){ $navtype=1; }

if(!isset($isadmin)){ $isadmin=false; }

if(!isset($navbar2categoryfeatured)){ $navbar2categoryfeatured=false; }

if(isset($isadmin)){ if($isadmin){ $navbar2categoryfeatured = true; } }

if(!isset($tagline)){$tagline="";}

if( !isset($brandlogo) ){ $brandlogo=false; }

if( !isset($brandname) ){ $brandname = "Brand Name"; }

?>

<style>
.<?php echo $identifier ?> .container {
	position: relative; 
	display: inline-block;
	margin: 0;
	padding: 0;
	width: 100%;
	
}
.<?php echo $identifier ?> .main-content {
	position: relative; 
	display: inline-block;
	margin: 0;
	padding: 0;
	width: 100%;
	height: 60px;
	background-color: white;
	border-bottom: 1px solid #cecece;
}

.<?php echo $identifier ?> .logo-div {
	position: absolute;
	display: block;
	margin: 0;
	padding: 0;
	width: 275px;
	/* height: 70px; */
	top: 50%;
	transform: translateY(-50%);
	/*left: 50%;*/
	/*margin-left: -100px;*/
}
/*.<?php echo $identifier ?> .logo-div img {max-width: 90%; max-height: 90%;}*/
.<?php echo $identifier ?> .subnav {
	position: relative; 
	display: inline-block;
	margin: 0;
	padding: 0;
	width: 100%;
	height: 40px;
	background-color: white;
	border-bottom: 1px solid #cecece;
	text-align: center;
}
.<?php echo $identifier ?> .categories-wrapper {
	position: relative;
	margin: 0;
	padding: 0;
	top: 50%;
	transform: translateY(-50%);
	text-transform: uppercase;
}
.<?php echo $identifier ?> .category-btn {
	position: relative; 
	display: inline-block;
	margin: 0px 30px;
	padding: 5px;
	background: transparent;
	float: left;
	text-decoration: none;
	color: #555555;
	font-size: 0.9em;
	font-weight: 500;
}
.<?php echo $identifier ?> .subscribe-btn {
	position: relative;
	display: inline-block;
	margin: 0;
	padding: 5px;
	color: #333333;
	font-weight: 600;
	font-size: 0.9em;
	-webkit-appearance: none;
	background: transparent;
	border: 0;
	cursor: pointer;
}
.<?php echo $identifier ?> .tagline {
	position: absolute;
	margin: 0;
	padding: 0;
	left: 50%;
	color: #555555;
	text-decoration: none;
	bottom: 13px;
	font-weight: 400;
	font-size: 0.6em;
	transform: translateX(-50%);
}

.<?php echo $identifier ?> .logo-div h3 {
	text-decoration: none;
	color: #333333;
	text-transform: uppercase;
}

@media (min-width: 0px) {
	.<?php echo $identifier ?> .categories-wrapper {display: none;}
	.<?php echo $identifier ?> .logo-div {left: 30px; text-align: left; padding-right: 20px;}
	.<?php echo $identifier ?> .logo-div img {max-width: 70%; max-height: 70%;}
	.<?php echo $identifier ?> .search-container {display: none;}
	.<?php echo $identifier ?> .tagline {display: none;}
}
@media (min-width: 768px) {
	.<?php echo $identifier ?> .categories-wrapper {display: inline-block;}
	/*.<?php echo $identifier ?> .logo-div {left: 50%; transform: translate(-50%, -50%); right: auto; text-align: center; padding-right: 0;}*/
	.<?php echo $identifier ?> .logo-div img {max-width: 90%; max-height: 90%;}
	.<?php echo $identifier ?> .search-container {display: inline-block;}
	.<?php echo $identifier ?> .tagline {display: inline-block;}
}
</style>


<div class="<?php echo $identifier ?>" style="<?php if($isadmin){ echo "margin-top: 60px"; } ?>">
	<div class="container">
		<div class="main-content">
			<a href="/">
				<div class="logo-div">
					<?php if($brandlogo){ ?>
						<img src=<?php echo $logoimgthumb ?> width="auto" height="auto">
					<?php }else{ ?>
						<h3><?php echo $navdict['brandname'] ?></h3>
					<?php } ?>
					
				</div>
			</a>
			<div class="search-container" style="position: absolute; right: 30px; top: 50%; transform: translateY(-50%);">
				<?php
					Button::make( "searchbar_1", [], "search-btn" );
				?>
			</div>
		</div>
	</div>
</div>

<script>

</script>