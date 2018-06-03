<?php

namespace Reusables;

	if(!isset($categoriesmodalarray)){ $categoriesmodalarray=array(); }

extract( Views::setUp( $identifier ) );
$navbuttons = [];
if( isset( $viewvalues[0]['pages'] ) ) {
	$navbuttons = $viewvalues[0]['pages'];
} else {
	if( sizeof($viewvalues) > 0 ) {
		if( $viewvalues[0] > 0 ) {

			foreach ($viewvalues[0] as $key => $value) {
				if( $key == "linkpath" ) {
					continue;
				}
				$dict = ["title"=>$key, "slug"=>$value];
				array_push( $navbuttons, $dict );
			}
		}
	}
}

?>

<style>
</style>

<div class="viewtype_menu <?php echo $identifier ?> menuview_1">
	<div class="container">
		<div class="header">
			<label>menu</label>
			<button class="close">&#x2715;</button>
		</div>
		<ul>
		<?php foreach ($navbuttons as $p) { ?>
			<?php if( isset( $p[ 'buttons' ] )){ ?>
				<a href="#" class="drop-down"><li><label><?php echo $p['title'] ?></label></li></a>
				<ul class="tags-drop">
					<?php foreach ($p['buttons'] as $c) { ?>
						<a href="<?php echo $c['slug'] ?>"><li><label><?php echo $c['title'] ?></label></li></a>
					<?php } ?>
				</ul>
			<?php }else{ ?>
				<a href="<?php echo $p['slug']; ?>"><li><label><?php echo $p['title'] ?></label></li></a>
			<?php } ?>
		<?php } ?>
		</ul>
	</div>
</div>

<script>
	$('.menuview_1 .container .header .close').click(function(){
		closemenu();
	});
	$('.menuview_1 .container').click(function(){
		event.stopPropagation();
	});
	$('.menuview_1').click(function(){
		closemenu();
	});
	var showingtags=false;
	$('.menuview_1 .container a.drop-down').click(function(e){
		e.preventDefault();
		if(!showingtags){
			showingtags=true;
			$('.menuview_1 .container .tags-drop').css({'display':'inline-block', 'opacity':'1', 'overflow-y':'hidden'});
			$('.menuview_1 .container .tags-drop a').css({'display':'inline-block', 'opacity':'0', 'top':'-300'});
			$('.menuview_1 .container .tags-drop a').animate({'opacity':'1', 'top':'0'}, 500, function(){
				$('.menuview1 .container .tags-drop').css({'overflow-y': 'scroll'});
			});
		}else{
			showingtags=false;
			$('.menuview_1 .container .tags-drop').css({'display':'inline-block', 'opacity':'1', 'overflow-y':'hidden'});
			$('.menuview_1 .container .tags-drop a').css({'display':'inline-block', 'opacity':'1', 'top':'0'});
			$('.menuview_1 .container .tags-drop a').animate({'opacity':'0', 'top':'-300'}, 500, function(){
				$('.menuview_1 .container .tags-drop').css({'display': 'none'});
			});
		}
		
	});

	function closemenu(){
		$('.menuview_1 .container').animate({'left': '-260px'}, 300, function(){
			// $('.menuview1').animate({'opacity': '0'});
		});
		$('.menuview_1').animate({'opacity': '0'}, 300, function(){
			$('.menuview_1').css({'display': 'none'});
		});
	}
</script>