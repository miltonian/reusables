<?php

if(!isset($isadmin)){ $isadmin=false; }
$navbuttons = array();
if(isset($navdict['pages'])){ $navbuttons = $navdict['pages']; }

$required = array(
	"pages"=>array("slug", "name|imagepath|emoji"), 
	"logo|brandname"=>"",  
);

if (!isset($navdict['logolink'])) { $navdict['logolink'] = ""; }

ReusableClasses::checkRequired( "navbar", $navdict, $required );

?>

<style>
.navbar_4_structure { width: calc(100% - 150px - 40px); }
	.navbar_4_structure .maincolumn { width: calc( 50% - 15px - 0px ); height: 100%; padding: 0; margin: 0; padding-left: 15px; }
	.navbar_4_structure .sidecolumn_right { width: calc( 50% - 0px ); height: 100%; padding: 0; margin: 0; }
		.navbar_4_structure .sidecolumn_right div { float: right; }
		.navbar_4_structure .maincolumn a { float: left; }
</style>
	
<div class='navbar_4 <?php echo $identifier ?> mobilenav' style='background-color: white'>
	<a href='/<?php echo $navdict['logolink'] ?>'>
		<?php if(isset($navdict['logo'])){ ?>
			<img class='topbarlogo' src=<?php echo $navdict['logo'] ?> width="auto" height="auto">
		<?php }else{ ?>
			<h3><?php echo $navdict['brandname'] ?></h3>
		<?php } ?>
	</a>
	<img class='dropdown menubtn' src='https://cdn4.iconfinder.com/data/icons/wirecons-free-vector-icons/32/menu-alt-512.png' style='width: auto; margin-right: 30px;'>
	<div class='dropdown-content'>
		<?php foreach ($navbuttons as $b) { ?>
			<a href='/<?php echo $b['slug'] ?>'><?php if(isset($b['imagepath'])){ "<img src='".$b['imagepath']."'>"; }else if(isset($b['emoji'])){ echo $b['emoji']; }else{ echo $b['name']; } ?></a>
		<?php } ?>
	</div>
</div>

<div class='navbar_4 <?php echo $identifier ?> desktopnav navbar-shadow' style='background-color: white; <?php if($isadmin){ echo "margin-top: 60px"; } ?>'>
	<a href='/<?php echo $navdict['logolink'] ?>' class='logo-div'>
		<?php if(isset($navdict['logo'])){ ?>
			<img class='topbarlogo' src=<?php echo $navdict['logo'] ?> width="auto" height="auto">
		<?php }else{ ?>
			<h3><?php echo $navdict['brandname'] ?></h3>
		<?php } ?>
	</a>
	<?php
		
		$leftbuttons = array();
		$rightbuttons = array();
		$button = "";
		foreach ($navbuttons as $b) {
			$button = "<div class='" . $b['classname'] . " wrapper ";
			if(isset($b['buttons'])){
				$button .= "has_dropdown";
			}
			$button .= " '> ";
			$button .= "<a href='/" . $b['slug'] . "' class='topbar-button'>"; 
			if( isset( $b['imagepath'] ) ){ 
				$button .= "<img src='" . $b['imagepath'] . "'>"; 
			}if( isset( $b['emoji'] ) ){ 
				$button .= $b['emoji']; 
			}if( isset( $b['name'] ) ){ 
				$button .= "<label>" . $b['name'] . "</label>"; 
			} 
			$button .= "</a>";
			if(isset($b['buttons'])){
				$button .= "<div class='dropdown-content'>";
					foreach ($b['buttons'] as $s) {
						$button .= "<a href='/" . $s['slug'] . "'>";
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
	$('.mobilenav .dropdown').click(function(){
		$('.dropdown-content').css('display', 'block');
	});

	$('.navbar_4.desktopnav .has_dropdown').click(function(e){
		// e.preventDefault();
	})
	$('.navbar_4.desktopnav .has_dropdown').mouseenter(function(e){
		$(this).find('.dropdown-content').css({'display': 'block'});
	});
	$('.navbar_4.desktopnav .has_dropdown').mouseleave(function(e){
		$(this).find('.dropdown-content').css({'display': 'none'});
	});

	$(document).ready(function(){
		window.onscroll = function(ev) {
			$('.mobilenav .dropdown-content').css('display','none');
			$('.mobilenav .dropdown').css('background-color', 'white');
		};
	});
		
</script>
	