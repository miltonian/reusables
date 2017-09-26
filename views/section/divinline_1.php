<?php

namespace Reusables;

$leftdict = $viewdict['leftdict'];
$rightdict = $viewdict['rightdict'];

// exit( json_encode( ( 100.0 / sizeof( $leftdict['morelinks'] ) ) ) );

?>

<style>
			.divinline_1.left .divinline_1.inner { width: <?php echo ( 100.0 / sizeof( $leftdict['morelinks'] ) ) ?>%; }
			.divinline_1.right .divinline_1.inner { width: <?php echo ( 100.0 / sizeof( $rightdict['morelinks'] ) ) ?>%; }
</style>

<div class="divinline_1 main <?php echo $identifier ?>">
	<div class="divinline_1 wrapper">
		<a href="<?php echo Data::getValue( $leftdict, 'link' ) ?>" >
			<div class="divinline_1 left cells <?php echo $leftdict['more'] ?>" style="background-color: <?php echo $leftdict['backgroundcolor'] ?>; background-image: url('<?php echo $leftdict['imagepath'] ?>');">
				<?php foreach ($leftdict['morelinks'] as $l) { ?>
					<div class="divinline_1 inner" style="background-image: url('<?php echo $l['imagepath'] ?>'); background-color: <?php echo $l['backgroundcolor'] ?>;"></div>
				<?php } ?>
			</div>
		</a>

		<a href="<?php echo Data::getValue( $rightdict, 'link' ) ?>" >
			<div class="divinline_1 right cells <?php echo $rightdict['more'] ?>" style="background-color: <?php echo $rightdict['backgroundcolor'] ?>; background-image: url('<?php echo $rightdict['imagepath'] ?>');">
				<?php foreach ($rightdict['morelinks'] as $l) { ?>
					<div class="divinline_1 inner" style="background-image: url('<?php echo $l['imagepath'] ?>'); background-color: <?php echo $l['backgroundcolor'] ?>;"></div>
				<?php } ?>
			</div>
		</a>
	</div>
</div>

<script>

$('.divinline_1.more').mouseenter(function(e){
	e.preventDefault();
	$(this).find('.inner').animate({'top': '30%'}, 300)
});
$('.divinline_1.more').mouseleave(function(e){
	e.preventDefault();
	$(this).find('.inner').animate({'top': '100%'}, 300)
});

</script>