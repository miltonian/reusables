<?php

if(!isset($isadmin)){ $isadmin=false; }
$navbuttons = array();
if(isset($navdict['pages'])){ $navbuttons = $navdict['pages']; }

$required = array(
	"pages"=>array("link", "name|imagepath|emoji"), 
	"logo|brandname"=>"",  
);

ReusableClasses::checkRequired( "navbar", $navdict, $required );

?>

<style>

</style>
	
	
<div class='navbar <?php echo $identifier ?> mobilenav' style='background-color: white'>
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

<div class='navbar <?php echo $identifier ?> desktopnav navbar-shadow' style='background-color: white; <?php if($isadmin){ echo "margin-top: 60px"; } ?>'>
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
	