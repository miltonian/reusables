<?php

?>

<style>
.menuview1 {
	position: fixed;
	display: none;
	margin: 0;
	padding: 0;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	background-color: rgba(0,0,0,0.5);
	z-index: 99;
	opacity: 0;
}
.menuview1 .container {
	position: relative; 
	display: inline-block;
	margin: 0;
	padding: 0;
	left: -260px;
	top: 0;
	width: 260px;
	height: 100%;
	background-color: white;
	float: left;
}
.menuview1 .container .header {
	width: 100%;
	position: relative; 
	display: inline-block;
	margin: 0;
	padding: 0;
	background-color: rgba(245,245,250,0.9);
	height: 65px;
}
.menuview1 .container .header label {
	position: relative;
	display: inline-block;
	margin: 0;
	padding: 0;
	float: left;
	width: 100px;
	font-size: 0.9em;
	font-weight: 500;
	text-transform: uppercase;
	top: 50%;
	transform: translateY(-50%);
	color: #555555;
}
.menuview1 .container .header .close {
	position: relative;
	display: inline-block;
	margin: 0;
	padding: 10px;
	background: transparent;
	border: 0;
	-webkit-appearance: none;
	float: right;
	font-size: 1.5em;
	color: #555555;
	top: 50%;
	transform: translateY(-50%);
	cursor: pointer;
}
.menuview1 .container ul {
	position: relative;
	display: inline-block;
	margin: 0;
	padding: 0;
	width: 100%;
}
.menuview1 .container ul li {
	position: relative;
	display: inline-block;
	margin: 0;
	padding: 0px 25px;
	height: 55px;
	border-bottom: 1px solid #efefef;
	float: left;
	width: calc(100% - 50px);
	cursor: pointer;
}
	.menuview1 .container ul li:hover { background-color: rgba(200,200,205,0.1); }
.menuview1 .container ul li label {
	position: relative;
	display: inline-block;
	margin: 0;
	padding: 0;
	float: left;
	top: 50%;
	transform: translateY(-50%);
	font-weight: 200;
	text-decoration: none;
	color: #333333;
	width: 100%;
	text-align: left;
	cursor: pointer;
}
.menuview1 .container .tags-drop {
	background-color: #efefef;
	max-height: 300px;
	overflow-y: scroll;
}
	.menuview1 .container .tags-drop a {width: 85%; float: right; display: none; position: relative;}
</style>

<div class="menuview1">
	<div class="container">
		<div class="header">
			<label>menu</label>
			<button class="close">&#x2715;</button>
		</div>
		<ul>
			<a href="<?php echo $baseurlminimal ?>"><li><label>HOME</label></li></a>
			<a href="<?php echo $baseurlminimal ?>about"><li><label>CONTACT US / ABOUT</label></li></a>
			<!-- <a href=""><li><label>TEAM</label></li></a> -->
			<!-- <a href="<?php echo $baseurlminimal ?>partnerwithus"><li><label>PARTNER WITH US</label></li></a> -->
			<a href="<?php echo $baseurlminimal ?>partnerwithus"><li><label>PARTNER WITH US</label></li></a>
			<a href="<?php echo $baseurlminimal ?>contribute"><li><label>CONTRIBUTE</label></li></a>
			<a class="tags drop-down" href=""><li><label>TAGS</label></li></a>
			<ul class="tags-drop">
				<?php for($i=0;$i<sizeof($categoriesmodalarray);$i++){ ?>
					<a href="<?php echo $baseurlminimal ?>category/c/<?php echo $categoriesmodalarray[$i]['id'] ?>/<?php echo preg_replace('/\PL/u', '', $categoriesmodalarray[$i]['name']) ?>"><li><label><?php echo $categoriesmodalarray[$i]['name'] ?></label></li></a>
				<?php } ?>
			</ul>
		</ul>
	</div>
</div>

<script>
	$('.menuview1 .container .header .close').click(function(){
		closemenu();
	});
	$('.menuview1 .container').click(function(){
		// alert();
		event.stopPropagation();
	});
	$('.menuview1').click(function(){
		closemenu();
	});
	var showingtags=false;
	$('.menuview1 .container a.drop-down').click(function(e){
		e.preventDefault();
		if(!showingtags){
			showingtags=true;
			$('.menuview1 .container .tags-drop').css({'display':'inline-block', 'opacity':'1', 'overflow-y':'hidden'});
			$('.menuview1 .container .tags-drop a').css({'display':'inline-block', 'opacity':'0', 'top':'-300'});
			$('.menuview1 .container .tags-drop a').animate({'opacity':'1', 'top':'0'}, 500, function(){
				$('.menuview1 .container .tags-drop').css({'overflow-y': 'scroll'});
			});
		}else{
			showingtags=false;
			$('.menuview1 .container .tags-drop').css({'display':'inline-block', 'opacity':'1', 'overflow-y':'hidden'});
			$('.menuview1 .container .tags-drop a').css({'display':'inline-block', 'opacity':'1', 'top':'0'});
			$('.menuview1 .container .tags-drop a').animate({'opacity':'0', 'top':'-300'}, 500, function(){
				$('.menuview1 .container .tags-drop').css({'display': 'none'});
			});
		}
		
	});

	function closemenu(){
		$('.menuview1 .container').animate({'left': '-260px'}, 300, function(){
			// $('.menuview1').animate({'opacity': '0'});
		});
		$('.menuview1').animate({'opacity': '0'}, 300, function(){
			$('.menuview1').css({'display': 'none'});
		});
	}
</script>