<?php

namespace Reusables;

if(!isset($isadmin)){ $isadmin=false; }

$navbuttons = Data::getValue( $viewdict, 'pages' );
if($navbuttons == "") {
	$navbuttons = [];
}
// exit( json_encode( $navbuttons ) );

$required = array(
	"pages"=>array("slug", "name|imagepath|emoji"), 
	"logo|brandname"=>"",  
);

if (!isset($viewdict['logolink'])) { $viewdict['logolink'] = ""; }

// ReusableClasses::checkRequired( "navbar", $viewdict, $required );

Views::setParams( 
	["logolink", "logo", "brandname", "pages"=>["slug", "imagepath", "emoji", "name"]], 
	["type", "modal", "attached", "link"],
	$identifier
);

$dropdown_fullwidth = Data::getValue( $viewoptions, "dropdown_fullwidth" );
if( $dropdown_fullwidth == "" ) {
	$dropdown_fullwidth = false;
}

?>

<style>

</style>

<div class="viewtype_nav slim <?php echo $identifier ?> all">
<div class='slim main <?php echo $identifier ?> mobilenav'>
	<a class="slim" id="brandlink" href='/<?php echo Data::getValue( $viewdict, 'logolink' ) ?>'>
		<?php if(isset($viewdict['logo'])){ ?>
			<img class='slim topbarlogo' src='<?php echo Data::getValue( $viewdict, 'logo' ) ?>' width="auto" height="auto">
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
		$dropdownindex = 0;
		$i=0;
		foreach ($navbuttons as $b) {
			if( !isset($b['position'] ) ){ $b['position'] = "left"; }
			$classname = Data::getValue( $b, 'classname' );
			if( $classname == "" ) {
				$classname = $identifier . "_page_" . $i;
			}

			$button = "<div class='slim page clicktoedit " . $classname . " wrapper dropdownindex_" . $dropdownindex . " ";
			if(isset($b['buttons'])){
				$button .= "has_dropdown desktopnavdropdown";
			}
			$button .= " ' style='float: " . $b['position'] . ";'> ";
			$button .= "<a href='" . $b['slug'] . "' class='slim topbar-button'>"; 
			if( isset( $b['imagepath'] ) ){ 
				$button .= "<img src='" . $b['imagepath'] . "'>"; 
			}if( isset( $b['emoji'] ) ){ 
				$button .= $b['emoji']; 
			}if( isset( $b['title'] ) ){ 
				$button .= "<label>" . $b['title'] . "</label>"; 
			} 
			$button .= "</a>";
			if( $dropdown_fullwidth && isset($b['buttons']) ) {
				$button .= "</div>";
			}
			if(isset($b['buttons'])){
				$button .= "<div class='slim dropdown-content dropdownindex_" . $dropdownindex . " ";
				if( $dropdown_fullwidth ) {
					$button .= " fullwidth ";
				}
				$button .= "'>";
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
			if( !$dropdown_fullwidth || !isset($b['buttons']) ) {
				$button .= "</div>";
			}
			// $button .= "</div>";
			if($b['position'] == "left"){
				array_push($leftbuttons, $button);
			}else if($b['position'] == "right"){
				array_push($rightbuttons, $button);
			}
			$dropdownindex++;
			$i++;
		}

		foreach ($leftbuttons as $b) {
			echo $b;
		}
		$rightbuttons = array_reverse( $rightbuttons );
		foreach ($rightbuttons as $b) {
			echo $b;
		}
	?>

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
		var dropdownindex = Reusable.getIndexFromClass("dropdownindex_", this)
		$('.slim.dropdown-content.dropdownindex_' + dropdownindex).css({'display': 'block'});
	});
	$('.slim.desktopnav .slim.has_dropdown').mouseleave(function(e){
		var dropdownindex = Reusable.getIndexFromClass("dropdownindex_", this)
		if( $('.slim.dropdown-content.dropdownindex_' + dropdownindex).hasClass('fullwidth') == false ) {
			$('.slim.dropdown-content.dropdownindex_' + dropdownindex).css({'display': 'none'});
		}else{
			$('.slim.dropdown-content.dropdownindex_' + dropdownindex).off().mouseleave(function(e){
				$('.slim.dropdown-content.dropdownindex_' + dropdownindex).css({'display': 'none'});
			});
		}
		
	});

	$(document).ready(function(){
		window.onscroll = function(ev) {
			$('.slim.mobilenav .slim.dropdown-content').css('display','none');
			$('.slim.mobilenav .slim.dropdown').css('background-color', 'transparent');
		};
	});

	$('.<?php echo $identifier ?> .slim.clicktoedit').click(function(e){
			<?php
				// ReusableClasses::setUpEditingForSection( $viewdict, $viewoptions, $identifier );
				// $fullviewdict = Data::getFullArray( $viewdict );
				// ReusableClasses::addEditingToCell( $identifier, $fullviewdict, "modal" );
			?>
		})
		
</script>
	