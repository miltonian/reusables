<?php

namespace Reusables;

	Views::setParams( 
		[ "leftdict"=>["more", "link", "imagepath"], "rightdict"=>["more", "link", "imagepath"] ], 
		[],
		$identifier
	);

// $leftdict = $viewdict['leftdict'];
// $rightdict = $viewdict['rightdict'];
$leftdict = Data::getValue( $viewdict, 0 );
$rightdict = Data::getValue( $viewdict, 1 );

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
	.imageinimage_inline.left .imageinimage_inline.inner { width: <?php echo ( 100.0 / sizeof( Data::getValue( $leftdict, 'morelinks' ) ) ) ?>%; }
	.imageinimage_inline.right .imageinimage_inline.inner { width: <?php echo ( 100.0 / sizeof( Data::getValue( $rightdict, 'morelinks' ) ) ) ?>%; }
</style>

<div class="viewtype_section imageinimage_inline main <?php echo $identifier ?>">
	<div class="imageinimage_inline wrapper">
		<a class="imageinimage_inline link clicktoedit index_0" href="<?php echo Data::getValue( $leftdict, 'link' ) ?>" >
			<div class="imageinimage_inline left cells <?php echo Data::getValue( $leftdict, 'more' ) ?>" style="background-color: <?php echo Data::getValue( $leftdict, 'backgroundcolor' ) ?>; background-image: url('<?php echo Data::getValue( $leftdict, 'imagepath' ) ?>');">
				<?php foreach ($left_morelinks as $l) { ?>
					<div class="imageinimage_inline inner" style="background-image: url('<?php echo Data::getValue( $l, 'imagepath' ) ?>'); background-color: <?php echo Data::getValue( $l, 'backgroundcolor' ) ?>;"></div>
				<?php } ?>
			</div>
		</a>

		<a class="imageinimage_inline link clicktoedit index_1" href="<?php echo Data::getValue( $rightdict, 'link' ) ?>" >
			<div class="imageinimage_inline right cells <?php echo Data::getValue( $rightdict, 'more' ) ?>" style="background-color: <?php echo Data::getValue( $rightdict, 'backgroundcolor' ) ?>; background-image: url('<?php echo Data::getValue( $rightdict, 'imagepath' ) ?>');">
				<?php foreach ($right_morelinks as $l) { ?>
					<div class="imageinimage_inline inner" style="background-image: url('<?php echo Data::getValue( $l, 'imagepath' ) ?>'); background-color: <?php echo Data::getValue( $l, 'backgroundcolor' ) ?>;"></div>
				<?php } ?>
			</div>
		</a>
	</div>
</div>

<script>

	$('.imageinimage_inline.more').mouseenter(function(e){
		e.preventDefault();
		$(this).find('.inner').animate({'top': '30%'}, 300)
	});
	$('.imageinimage_inline.more').mouseleave(function(e){
		e.preventDefault();
		$(this).find('.inner').animate({'top': '100%'}, 300)
	});

	$('.imageinimage_inline.clicktoedit').click(function(e){
		<?php
			ReusableClasses::setUpEditingForSection( $viewdict, $viewoptions, $identifier );
		?>
	})

</script>