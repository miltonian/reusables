<?php

namespace Reusables;

$appstore = Data::getValue( $viewdict, 'appstore' );
$googleplay = Data::getValue( $viewdict, 'googleplay' );
$otherdevice = Data::getValue( $viewdict, 'otherdevice' );

	Views::setParams( 
		[ "appstore", "googleplay", "otherdevice" ], 
		[],
		$identifier
	);

?>

<div class="viewtype_sharing download_buttons main <?php echo $identifier ?>">
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