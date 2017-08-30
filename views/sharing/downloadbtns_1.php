<?php

namespace Reusables;

$appstore = Data::getValue( $sharingdict, 'appstore' );
$googleplay = Data::getValue( $sharingdict, 'googleplay' );
$otherdevice = Data::getValue( $sharingdict, 'otherdevice' );

?>

<div class="downloadbtns_1 main <?php echo $identifier ?>">
	<?php if( $appstore != "" ){ ?>
		<a href="<?php echo $appstore ?>"><img src="http://sites.superfanu.com/bbnrewards.com/download/img/appstore.png" class="appstore" alt="Download on the App Store" /></a>
	<?php } ?>
	<?php if( $googleplay != "" ){ ?>
		<a href="<?php echo $googleplay ?>"><img src="http://sites.superfanu.com/bbnrewards.com/download/img/gpsmall.png" class="appstore" alt="Download on Google Play" /></a>
	<?php } ?>
	<?php if( $otherdevice != "" ){ ?>
		<a href="<?php echo $otherdevice ?>"><img src="http://sites.superfanu.com/bbnrewards.com/download/img/other-device.png" class="appstore" alt="Login" /></a>
	<?php } ?>
</div>