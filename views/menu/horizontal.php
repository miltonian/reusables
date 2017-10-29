<?php

namespace Reusables;

$isadmin = false;

$menubuttons = array();
if(isset($viewdict['buttons'])){ $menubuttons = $viewdict['buttons']; }

$buttontypes = [];
$i=0;
foreach ($menubuttons as $b) {
	$type = Data::getValue( $b, 'type' );
	array_push( $buttontypes, $type );

	// convert menu actions 
	if( $type == "modal" ) {
		$menubuttons[$i] = $options = ReusableClasses::convertViewActions( $menubuttons[$i] );
	}
	$i++;
}

$fullviewdict = Data::getFullArray( $viewdict );

	Views::setParams( 
		[ "buttons"=>["imagepath", "emoji", "name", "classname", "position", "slug"] ], 
		[],
		$identifier
	);

?>

<style>

</style>

<div class="viewtype_menu horizontal <?php echo $identifier ?> all">
<div class='horizontal main <?php echo $identifier ?> mobilenav'>
	<?php if( sizeof( $viewdict['buttons'] ) > 0 ){ ?>
		<img class='horizontal dropdown menubtn' src='https://cdn4.iconfinder.com/data/icons/wirecons-free-vector-icons/32/menu-alt-512.png' style='width: auto; margin-right: 30px;'>
	<?php } ?>
	<div class='horizontal dropdown-content'>
		<?php foreach ($menubuttons as $b) { ?>
			<a href='<?php echo $b['slug'] ?>'><?php if(isset($b['imagepath'])){ "<img src='".$b['imagepath']."'>"; }else if(isset($b['emoji'])){ echo $b['emoji']; }else{ echo $b['name']; } ?></a>
		<?php } ?>
	</div>
</div>

<div class='horizontal main <?php echo $identifier ?> desktopnav navbar-shadow' style='<?php if($isadmin){ echo "margin-top: 60px"; } ?>'>
	<?php
		
		$leftbuttons = array();
		$rightbuttons = array();
		$button = "";
		$i=0;
		foreach ($menubuttons as $b) {
			
			$button = "<div class='horizontal button " . $b['classname'] . " wrapper buttonindex_" . $i . " ";
			if(isset($b['buttons'])){
				$button .= "has_dropdown";
			}
			$button .= " ' style='float: " . $b['position'] . ";'> ";
			$button .= "<a href='" . $b['slug'] . "' class='horizontal topbar-button'>"; 
			if( isset( $b['imagepath'] ) ){ 
				$button .= "<img src='" . $b['imagepath'] . "'>"; 
			}if( isset( $b['emoji'] ) ){ 
				$button .= $b['emoji']; 
			}if( isset( $b['name'] ) ){ 
				$button .= "<label>" . $b['name'] . "</label>"; 
			} 
			$button .= "</a>";

			if(isset($b['buttons'])){
				$button .= "<div class='horizontal dropdown-content'>";
					foreach ($b['buttons'] as $s) {
						$button .= "<a class='horizontal' id='link' href='" . $s['slug'] . "'>";
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


<div class="horizontal spacing"></div>

</div>



<script>

	var thismodalclass = "";
	var viewdict = <?php echo json_encode($viewdict) ?>;
	var viewoptions = <?php echo json_encode( $viewoptions ) ?>;

	var buttontypes = <?php echo json_encode( $buttontypes ) ?>;
	var menubuttons = <?php echo json_encode( $menubuttons ) ?>;
	var identifier = <?php echo json_encode( $identifier ) ?>;

	<?php $i=0; ?>
	<?php foreach ($buttontypes as $bt) { ?>

		<?php if( $bt == "modal" ){ ?>
			thismodalclass = new <?php echo $menubuttons[$i]['modal']['modalclass'] ?>Classes();
			var dataarray = <?php echo json_encode( $fullviewdict ) ?>;
			<?php 
				ReusableClasses::getEditingFunctionsJS( $menubuttons[$i] ) 
			?>;

			$('.horizontal.main.<?php echo $identifier ?> .horizontal.button.<?php echo $menubuttons[$i]['classname'] ?>.wrapper.buttonindex_<?php echo $i ?>').off().click(function(e){
				e.preventDefault();

				if( typeof dataarray === 'undefined' ) {
					dataarray = []
				}
				Reusable.addAction( viewdict, [thismodalclass], 0, dataarray, this, e, <?php echo json_encode( $menubuttons[$i] ) ?> );
			});

		<?php } ?>
		<?php $i++; ?>

	<?php } ?>

	



	$('.horizontal.mobilenav .horizontal.dropdown').click(function(){
		$('.horizontal.dropdown-content').css('display', 'block');
	});

	$('.horizontal.desktopnav .horizontal.has_dropdown').click(function(e){
		// e.preventDefault();
	})
	$('.horizontal.desktopnav .horizontal.has_dropdown').mouseenter(function(e){
		$(this).find('.horizontal.dropdown-content').css({'display': 'block'});
	});
	$('.horizontal.desktopnav .horizontal.has_dropdown').mouseleave(function(e){
		$(this).find('.horizontal.dropdown-content').css({'display': 'none'});
	});

	// $(document).ready(function(){
	// 	window.onscroll = function(ev) {
	// 		$('.horizontal.mobilenav .horizontal.dropdown-content').css('display','none');
	// 		$('.horizontal.mobilenav .horizontal.dropdown').css('background-color', 'transparent');
	// 	};
	// });
		
</script>
	