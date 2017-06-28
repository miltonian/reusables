<?php

if(!isset($isadmin)){ $isadmin=false; }
$navbuttons = array();
if(isset($navdict['buttons'])){ $navbuttons = $navdict['buttons']; }

$required = array(
	"buttons"=>array("link", "name|imagepath|emoji"), 
	"logo|brandname"=>"",  
);

ReusableClasses::checkRequired( "navbar", $navdict, $required );

?>

<style>
	.<?php echo $identifier ?> { position: fixed; margin: 0; height: 60px; width: calc(100% - 50px); padding: 0; z-index: 1; box-shadow: 0px 0px 15px rgba(0,0,0,0.2); padding-right: 50px;}
		.<?php echo $identifier ?>.mobilenav { margin: 0; height: 200px; width: 100%; padding: 0; background-color: white; z-index: 3; left: 0; height: 200px; height: 100px; text-align: left; }
		.<?php echo $identifier ?>.desktopnav { left: 0; text-align: left;  }
		.<?php echo $identifier ?> .topbarlogo { display: inline-block; position: relative; width: auto; border-style: solid; border-width: 0px; margin-left: 2em; top: 50%; margin-top: -20px; }
		.<?php echo $identifier ?>.desktopnav .topbarlogo { height: 40px; }
		.<?php echo $identifier ?>.mobilenav .topbarlogo { width: auto; height: auto; max-width: 60%; margin: 0; max-height: 100%; top: 50%;  transform: translateY(-50%); }
		.<?php echo $identifier ?> .dropdown { position: relative; display: inline-block; }
		
		.<?php echo $identifier ?> .dropdown-content { display: none; position: absolute; background-color: #f9f9f9; width: 30%; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); padding: 12px 16px; z-index: 1; float: right;  right: 0; font-size: 2em; }
		
		.<?php echo $identifier ?> .dropdown-content a { color: #333333; padding: 30px 20px; text-decoration: none; display: block; font-size: 0.7em; border-bottom: 1px solid #e0e0e0; }
		.<?php echo $identifier ?>:hover{ background-color: rgba(124,199,192, 0.6); }

	.<?php echo $identifier ?> .menubtn { width: auto; margin-right: 30px; height: 50%; top: 50%; transform: translateY(-50%); float: right; cursor: pointer; }

	.<?php echo $identifier ?> .logo-div h3, .<?php echo $identifier ?> .logo-div {
		text-decoration: none;
		color: #333333;
		text-transform: uppercase;
		margin-left: 20px;
		float: left;
	}
	.<?php echo $identifier ?> .topbar-button { display: inline-block; position: relative; margin: 0 5px; padding: 0; background: transparent; float: right; text-decoration: none; color: #333333; top: 50%; transform: translateY(-50%); }

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
	
	
<div class='<?php echo $identifier ?> mobilenav' style='background-color: white'>
	<a href='/'>
		<!-- <img class='topbarlogo' src='<?php echo $productdict['logo'] ?>'> -->
		<?php if(isset($navdict['logo'])){ ?>
			<img class='topbarlogo' src=<?php echo $navdict['logo'] ?> width="auto" height="auto">
		<?php }else{ ?>
			<h3><?php echo $navdict['brandname'] ?></h3>
		<?php } ?>
	</a>
	<img class='dropdown menubtn' src='https://cdn4.iconfinder.com/data/icons/wirecons-free-vector-icons/32/menu-alt-512.png' style='width: auto; margin-right: 30px;'>
	<div class='dropdown-content'>
		<?php foreach ($navbuttons as $b) { ?>
			<a href='/<?php echo $b['link'] ?>'><?php if(isset($b['imagepath'])){ "<img src='".$b['imagepath']."'>"; }else if(isset($b['emoji'])){ echo $b['emoji']; }else{ echo $b['name']; } ?></a>
		<?php } ?>
	</div>
</div>

<div class='<?php echo $identifier ?> desktopnav navbar-shadow' style='background-color: white; <?php if($isadmin){ echo "margin-top: 60px"; } ?>'>
	<a href='/' class='logo-div'>
		<!-- <img class='topbarlogo' src='<?php echo $productdict['logo'] ?>'> -->
		<?php if(isset($navdict['logo'])){ ?>
			<img class='topbarlogo' src=<?php echo $navdict['logo'] ?> width="auto" height="auto">
		<?php }else{ ?>
			<h3><?php echo $navdict['brandname'] ?></h3>
		<?php } ?>
	</a>
	<?php foreach ($navbuttons as $b) { ?>

		<a href='/<?php echo $b['link'] ?>' class='topbar-button'><?php if(isset($b['imagepath'])){ echo "<img src='".$b['imagepath']."'>"; }else if(isset($b['emoji'])){ echo $b['emoji']; }else{ echo $b['name']; } ?></a>
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
	