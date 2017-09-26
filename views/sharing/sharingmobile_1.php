<?php
	namespace Reusables;

	$buttonsarray = $viewdict['buttons'];
	$keyarray = array_keys($buttonsarray);
	$width = strval( 100.0 / floatval( sizeof( $buttonsarray ) ) ) . "%";
?>

<style>
	.sharingmobile_1.button { width: <?php echo $width ?>; }
</style>

<div class="<?php echo $identifier ?> sharingmobile_1 main">
	<?php $i=0; foreach( $buttonsarray as $b ){ ?>
		<?php $thekey=$keyarray[$i]; ?>
		<a href="<?php echo $b['link'] ?>" class="sharingmobile_1 button <?php echo $thekey ?>">
			<?php if( isset( $b['img'] ) ){ ?>
				<img src="<?php echo $b['img'] ?>" />
			<?php }else{ ?>
				<img />
			<?php } ?>
			<label class="sharingmobile_1" id="text">
				<?php echo Data::getValue( $b, 'text' ) ?>
			</label>
		</a>
	<?php $i++; } ?>
</div>