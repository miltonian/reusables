<?php

if(!isset($isadmin)){ $isadmin=false; }
$navbuttons = array();
if(isset($navdict['buttons'])){ $navbuttons = $navdict['buttons']; }

?>

<style>
	.navbar1 { position: fixed; margin: 0; height: 60px; width: 100%; padding: 0; z-index: 1; box-shadow: 0px 0px 15px rgba(0,0,0,0.2); }
		.navbar1.mobilenav { margin: 0; height: 200px; width: 100%; padding: 0; background-color: white; z-index: 3; left: 0; height: 200px; height: 100px; text-align: left; }
		.navbar1.desktopnav { left: 0; text-align: left;  }
		.navbar1 .topbarlogo { display: inline-block; position: relative; width: auto; border-style: solid; border-width: 0px; margin-left: 2em; top: 50%; margin-top: -20px; }
		.navbar1.desktopnav .topbarlogo { height: 40px; }
		.navbar1.mobilenav .topbarlogo { width: auto; height: auto; max-width: 60%; margin: 0; max-height: 100%; top: 50%;  transform: translateY(-50%); }
		.navbar1 .dropdown { position: relative; display: inline-block; }
		
		.navbar1 .dropdown-content { display: none; position: absolute; background-color: #f9f9f9; width: 30%; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); padding: 12px 16px; z-index: 1; float: right;  right: 0; font-size: 2em; }
		
		.navbar1 .dropdown-content a { color: #333333; padding: 30px 20px; text-decoration: none; display: block; font-size: 0.7em; border-bottom: 1px solid #e0e0e0; }
		.navbar1:hover{ background-color: rgba(124,199,192, 0.6); }

	.navbar1 .menubtn { width: auto; margin-right: 30px; height: 50%; top: 50%; transform: translateY(-50%); float: right; cursor: pointer; }

@media (min-width: 0px) {
	.mobilenav {display: block;}
	.desktopnav {display: none;}
}
@media (min-width: 768px) {
	.mobilenav {display: none;}
	.desktopnav {display: inline-block;}
}
@media (min-width: 992px) {

}
</style>
	
	
<div class='navbar1 mobilenav' style='background-color: white'>
	<a href='/'><img class='topbarlogo' src='<?php echo $productdict['logo'] ?>'></a>
	<img  class='dropdown menubtn' src='https://cdn4.iconfinder.com/data/icons/wirecons-free-vector-icons/32/menu-alt-512.png' style='width: auto; margin-right: 30px;'>
	<div class='dropdown-content'>
		<?php foreach ($navbuttons as $b) { ?>
			<a href='/<?php echo $b['link'] ?>'><?php echo $b['name'] ?></a>
		<?php } ?>
	</div>
</div>

<div class='navbar1 desktopnav navbar-shadow' style='background-color: white; <?php if($isadmin){ echo "margin-top: 60px"; } ?>'>
	<a href='/'><img class='topbarlogo' src='<?php echo $productdict['logo'] ?>'></a>
	<?php foreach ($navbuttons as $b) { ?>
		<a href='/<?php echo $b['link'] ?>' class='topbar-button'><?php echo $b['name'] ?></a>
	<?php } ?>
</div>



<script>
	$('.dropdown').click(function(){
		$('.dropdown-content').css('display', 'block');
	});

	$(document).ready(function(){
		window.onscroll = function(ev) {
			$('.dropdown-content').css('display','none');
			$('.dropdown').css('background-color', 'white');
		};
	});
		
</script>
	