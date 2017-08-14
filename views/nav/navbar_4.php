<?php

namespace Reusables;

if(!isset($isadmin)){ $isadmin=false; }
$navbuttons = array();
if(isset($navdict['pages'])){ $navbuttons = $navdict['pages']; }

$required = array(
	"pages"=>array("slug", "name|imagepath|emoji"), 
	"logo|brandname"=>"",  
);

if (!isset($navdict['logolink'])) { $navdict['logolink'] = ""; }

// ReusableClasses::checkRequired( "navbar", $navdict, $required );

?>

<style>

</style>
	
<div class='navbar_4 main <?php echo $identifier ?> mobilenav' style='background-color: white'>
	<a class="navbar_4" id="brandlink" href='/<?php echo $navdict['logolink'] ?>'>
		<?php if(isset($navdict['logo'])){ ?>
			<img class='navbar_4 topbarlogo' src=<?php echo $navdict['logo'] ?> width="auto" height="auto">
		<?php }else{ ?>
			<h3 class="navbar_4" id="brandname"><?php echo $navdict['brandname'] ?></h3>
		<?php } ?>
	</a>
	<?php if( sizeof( $navdict['pages'] ) > 0 ){ ?>
		<img class='navbar_4 dropdown menubtn' src='https://cdn4.iconfinder.com/data/icons/wirecons-free-vector-icons/32/menu-alt-512.png' style='width: auto; margin-right: 30px;'>
	<?php } ?>
	<div class='navbar_4 dropdown-content'>
		<?php foreach ($navbuttons as $b) { ?>
			<a href='/<?php echo $b['slug'] ?>'><?php if(isset($b['imagepath'])){ "<img src='".$b['imagepath']."'>"; }else if(isset($b['emoji'])){ echo $b['emoji']; }else{ echo $b['name']; } ?></a>
		<?php } ?>
	</div>
</div>

<div class='navbar_4 main <?php echo $identifier ?> desktopnav navbar-shadow' style='background-color: white; <?php if($isadmin){ echo "margin-top: 60px"; } ?>'>
	<a href='/<?php echo $navdict['logolink'] ?>' class='navbar_4 logo-div'>
		<?php if(isset($navdict['logo'])){ ?>
			<img class='navbar_4 topbarlogo' src=<?php echo $navdict['logo'] ?> width="auto" height="auto">
		<?php } ?>
			<h3><?php echo $navdict['brandname'] ?></h3>

	</a>
	<?php
		
		$leftbuttons = array();
		$rightbuttons = array();
		$button = "";
		foreach ($navbuttons as $b) {
			$button = "<div class='navbar_4 " . $b['classname'] . " wrapper ";
			if(isset($b['buttons'])){
				$button .= "has_dropdown";
			}
			$button .= " '> ";
			$button .= "<a href='/" . $b['slug'] . "' class='navbar_4 topbar-button'>"; 
			if( isset( $b['imagepath'] ) ){ 
				$button .= "<img src='" . $b['imagepath'] . "'>"; 
			}if( isset( $b['emoji'] ) ){ 
				$button .= $b['emoji']; 
			}if( isset( $b['name'] ) ){ 
				$button .= "<label>" . $b['name'] . "</label>"; 
			} 
			$button .= "</a>";
			if(isset($b['buttons'])){
				$button .= "<div class='navbar_4 dropdown-content'>";
					foreach ($b['buttons'] as $s) {
						$button .= "<a class='navbar_4' id='link' href='/" . $s['slug'] . "'>";
						if(isset($s['imagepath'])){ 
							$button .= "<img src='" . $s['imagepath'] . "'>"; 
						}else if(isset($s['emoji'])){ 
							$button .= $s['emoji']; 
						}else{ 
							$button .= $s['name']; 
						}
						$button .= "</a>";
					}
				$button .= "</div>";
			}
			$button .= "</div>";
			if($b['position'] == "left"){
				array_push($leftbuttons, $button);
			}else if($b['position'] == "right"){
				array_push($rightbuttons, $button);
			}
		}

		echo Structure::make( 
			"structure_1",
			[
				"maincolumn"=>$leftbuttons,
				"sidecolumn_right"=>$rightbuttons
			],
			"navbar_4_structure"
		);
	?>
	<!-- <?php foreach ($navbuttons as $b) { ?>

		<a href='/<?php echo $b['slug'] ?>' class='topbar-button'><?php if(isset($b['imagepath'])){ echo "<img src='".$b['imagepath']."'>"; }else if(isset($b['emoji'])){ echo $b['emoji']; }else{ echo $b['name']; } ?></a>
	<?php } ?> -->
</div>



<script>
	$('.navbar_4.mobilenav .navbar_4.dropdown').click(function(){
		$('.navbar_4.dropdown-content').css('display', 'block');
	});

	$('.navbar_4.desktopnav .navbar_4.has_dropdown').click(function(e){
		// e.preventDefault();
	})
	$('.navbar_4.desktopnav .navbar_4.has_dropdown').mouseenter(function(e){
		$(this).find('.navbar_4.dropdown-content').css({'display': 'block'});
	});
	$('.navbar_4.desktopnav .navbar_4.has_dropdown').mouseleave(function(e){
		$(this).find('.navbar_4.dropdown-content').css({'display': 'none'});
	});

	$(document).ready(function(){
		window.onscroll = function(ev) {
			$('.navbar_4.mobilenav .navbar_4.dropdown-content').css('display','none');
			$('.navbar_4.mobilenav .navbar_4.dropdown').css('background-color', 'white');
		};
	});
		
</script>
	