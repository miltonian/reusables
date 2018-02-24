<?php
	namespace Reusables;

	$buttonsarray = $viewdict['buttons'];
	$keyarray = array_keys($buttonsarray);
	$width = strval( 100.0 / floatval( sizeof( $buttonsarray ) ) ) . "%";


	Views::setParams( 
		[ "buttons"=>["link", "img", "text"] ], 
		[],
		$identifier
	);

?>

<style>
	.sharing_mobile_bottom.button { width: <?php echo $width ?>; }
</style>

<div class="viewtype_sharing <?php echo $identifier ?> sharing_mobile_bottom main">
	<?php $i=0; foreach( $buttonsarray as $b ){ ?>
		<?php $thekey=$keyarray[$i]; ?>
		<a href="<?php echo Data::getValue( $b, 'link') ?>" class="sharing_mobile_bottom button <?php echo $thekey ?>">
			<?php if( isset( $b['img'] ) ){ ?>
				<img src="<?php echo Data::getValue( $b, 'img' ) ?>" />
			<?php }else{ ?>
				<img />
			<?php } ?>
			<label class="sharing_mobile_bottom" id="text">
				<?php echo Data::getValue( $b, 'text' ) ?>
			</label>
		</a>
	<?php $i++; } ?>
</div>