<?php

namespace Reusables;

$leftdict = $viewdict['leftdict'];
$rightdict = $viewdict['rightdict'];

// exit( json_encode( ( 100.0 / sizeof( $leftdict['morelinks'] ) ) ) );

$left_morelinks = Data::getValue( $leftdict, 'morelinks' );
if( $left_morelinks == "" ) {
	$left_morelinks = [];
}
$right_morelinks = Data::getValue( $rightdict, 'morelinks' );
if( $right_morelinks == "" ) {
	$right_morelinks = [];
}

?>

<style>
			.divinline_1.left .divinline_1.inner { width: <?php echo ( 100.0 / sizeof( $leftdict['morelinks'] ) ) ?>%; }
			.divinline_1.right .divinline_1.inner { width: <?php echo ( 100.0 / sizeof( $rightdict['morelinks'] ) ) ?>%; }
</style>

<div class="divinline_1 main <?php echo $identifier ?>">
	<div class="divinline_1 wrapper">
		<a href="<?php echo Data::getValue( $leftdict, 'link' ) ?>" >
			<div class="divinline_1 left cells <?php echo Data::getValue( $leftdict, 'more' ) ?>" style="background-color: <?php echo Data::getValue( $leftdict, 'backgroundcolor' ) ?>; background-image: url('<?php echo Data::getValue( $leftdict, 'imagepath' ) ?>');">
				<?php foreach ($left_morelinks as $l) { ?>
					<div class="divinline_1 inner" style="background-image: url('<?php echo Data::getValue( $l, 'imagepath' ) ?>'); background-color: <?php echo Data::getValue( $l, 'backgroundcolor' ) ?>;"></div>
				<?php } ?>
			</div>
		</a>

		<a href="<?php echo Data::getValue( $rightdict, 'link' ) ?>" >
			<div class="divinline_1 right cells <?php echo Data::getValue( $rightdict, 'more' ) ?>" style="background-color: <?php echo Data::getValue( $rightdict, 'backgroundcolor' ) ?>; background-image: url('<?php echo Data::getValue( $rightdict, 'imagepath' ) ?>');">
				<?php foreach ($right_morelinks as $l) { ?>
					<div class="divinline_1 inner" style="background-image: url('<?php echo Data::getValue( $l, 'imagepath' ) ?>'); background-color: <?php echo Data::getValue( $l, 'backgroundcolor' ) ?>;"></div>
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