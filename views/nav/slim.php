<?php

namespace Reusables;

if(!isset($isadmin)){ $isadmin=false; }
$navbuttons = array();
if(isset($viewdict['pages'])){ $navbuttons = $viewdict['pages']; }

// exit( json_encode( $navbuttons ) );

$required = array(
	"pages"=>array("slug", "name|imagepath|emoji"), 
	"logo|brandname"=>"",  
);

if (!isset($viewdict['logolink'])) { $viewdict['logolink'] = ""; }

// ReusableClasses::checkRequired( "navbar", $viewdict, $required );

?>

<style>

</style>

<div class="slim <?php echo $identifier ?> all">
<div class='slim main <?php echo $identifier ?> mobilenav'>
	<a class="slim" id="brandlink" href='/<?php echo  Data::getValue( $viewdict, 'logolink' ) ?>'>
		<?php if(isset($viewdict['logo'])){ ?>
			<img class='slim topbarlogo' src='<?php echo  Data::getValue( $viewdict, 'logo' ) ?>' width="auto" height="auto">
		<?php }else{ ?>
			<h3 class="slim" id="brandname"><?php echo Data::getValue( $viewdict, 'brandname' ) ?></h3>
		<?php } ?>
	</a>
	<?php if( sizeof( $viewdict['pages'] ) > 0 ){ ?>
		<img class='slim dropdown menubtn' src='https://cdn4.iconfinder.com/data/icons/wirecons-free-vector-icons/32/menu-alt-512.png' style='width: auto; margin-right: 30px;'>
	<?php } ?>
	<div class='slim dropdown-content'>
		<?php foreach ($navbuttons as $b) { ?>
			<a href='<?php echo $b['slug'] ?>'><?php if(isset($b['imagepath'])){ "<img src='".$b['imagepath']."'>"; }else if(isset($b['emoji'])){ echo $b['emoji']; }else{ echo $b['name']; } ?></a>
		<?php } ?>
	</div>
</div>

<div class='slim main <?php echo $identifier ?> desktopnav navbar-shadow' style='<?php if($isadmin){ echo "margin-top: 60px"; } ?>'>
	<a href='/<?php echo $viewdict['logolink'] ?>' class='slim logo-div'>
		<?php if(isset($viewdict['logo'])){ ?>
			<img class='slim topbarlogo' src='<?php echo  Data::getValue( $viewdict, 'logo' ) ?>' width="auto" height="auto">
		<?php } ?>
			<h3><?php echo  Data::getValue( $viewdict, 'brandname' ) ?></h3>

	</a>
	<?php
		
		$leftbuttons = array();
		$rightbuttons = array();
		$button = "";
		foreach ($navbuttons as $b) {
			// exit( json_encode( $b ) );
			$button = "<div class='slim page " . $b['classname'] . " wrapper ";
			if(isset($b['buttons'])){
				$button .= "has_dropdown";
			}
			$button .= " '> ";
			$button .= "<a href='" . $b['slug'] . "' class='slim topbar-button'>"; 
			if( isset( $b['imagepath'] ) ){ 
				$button .= "<img src='" . $b['imagepath'] . "'>"; 
			}if( isset( $b['emoji'] ) ){ 
				$button .= $b['emoji']; 
			}if( isset( $b['name'] ) ){ 
				$button .= "<label>" . $b['name'] . "</label>"; 
			} 
			$button .= "</a>";
			if(isset($b['buttons'])){
				$button .= "<div class='slim dropdown-content'>";
					foreach ($b['buttons'] as $s) {
						$button .= "<a class='slim' id='link' href='" . $s['slug'] . "'>";
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
			"main_withside",
			[
				"maincolumn"=>$leftbuttons,
				"sidecolumn_right"=>$rightbuttons
			],
			"slim_structure"
		);
	?>
	<!-- <?php foreach ($navbuttons as $b) { ?>

		<a href='/<?php echo $b['slug'] ?>' class='topbar-button'><?php if(isset($b['imagepath'])){ echo "<img src='".$b['imagepath']."'>"; }else if(isset($b['emoji'])){ echo $b['emoji']; }else{ echo $b['name']; } ?></a>
	<?php } ?> -->
</div>


<div class="slim spacing"></div>

</div>



<script>
	$('.slim.mobilenav .slim.dropdown').click(function(){
		$('.slim.dropdown-content').css('display', 'block');
	});

	$('.slim.desktopnav .slim.has_dropdown').click(function(e){
		// e.preventDefault();
	})
	$('.slim.desktopnav .slim.has_dropdown').mouseenter(function(e){
		$(this).find('.slim.dropdown-content').css({'display': 'block'});
	});
	$('.slim.desktopnav .slim.has_dropdown').mouseleave(function(e){
		$(this).find('.slim.dropdown-content').css({'display': 'none'});
	});

	$(document).ready(function(){
		window.onscroll = function(ev) {
			$('.slim.mobilenav .slim.dropdown-content').css('display','none');
			$('.slim.mobilenav .slim.dropdown').css('background-color', 'transparent');
		};
	});
		
</script>
	