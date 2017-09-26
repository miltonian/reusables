<?php

namespace Reusables;

	if(!isset($categoriesmodalarray)){ $categoriesmodalarray=array(); }
	// exit( json_encode( $viewdict ) );
?>

<style>
</style>

<div class="<?php echo $identifier ?> menuview_1">
	<div class="container">
		<div class="header">
			<label>menu</label>
			<button class="close">&#x2715;</button>
		</div>
		<ul>
		<?php foreach ($viewdict['pages'] as $p) { ?>
			<?php if( isset( $p[ 'buttons' ] )){ ?>
				<a href="#" class="drop-down"><li><label><?php echo $p['name'] ?></label></li></a>
				<ul class="tags-drop">
					<?php foreach ($p['buttons'] as $c) { ?>
						<a href="<?php echo $c['slug'] ?>"><li><label><?php echo $c['name'] ?></label></li></a>
					<?php } ?>
				</ul>
			<?php }else{ ?>
				<a href="<?php echo $p['slug']; ?>"><li><label><?php echo $p['name'] ?></label></li></a>
			<?php } ?>
		<?php } ?>
			<!-- <a href="/"><li><label>HOME</label></li></a>
			<a href="/about"><li><label>CONTACT US / ABOUT</label></li></a>
			<a href="/partnerwithus"><li><label>PARTNER WITH US</label></li></a>
			<a href="/contribute"><li><label>CONTRIBUTE</label></li></a>
			<a class="tags drop-down" href=""><li><label>TAGS</label></li></a> -->
			<!-- <ul class="tags-drop">
				<?php for($i=0;$i<sizeof($categoriesmodalarray);$i++){ ?>
					<a href="/category/c/<?php echo $categoriesmodalarray[$i]['id'] ?>/<?php echo preg_replace('/\PL/u', '', $categoriesmodalarray[$i]['name']) ?>"><li><label><?php echo $categoriesmodalarray[$i]['name'] ?></label></li></a>
				<?php } ?>
			</ul> -->
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