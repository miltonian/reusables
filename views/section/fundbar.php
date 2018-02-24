<?php

namespace Reusables;

// raised, goal

$width = ( floatval( Data::getValue( $viewdict, 'raised' ) ) / floatval( Data::getValue( $viewdict, 'goal' ) ) ) * 100;

	Views::setParams( 
		[ "raised", "goal" ], 
		[],
		$identifier
	);

?>


<style>
</style>


<div class="viewtype_section fundbar funding_container <?php echo $identifier ?>" >
	<label class="fundbar" id="fund_goal" ><span class="fundbar" id="raised" >$<?php echo number_format( Data::getValue( $viewdict, 'raised' ) ) ?></span> / $<?php echo number_format( Data::getValue( $viewdict, 'goal' ) ) ?></label>
	<div class="fundbar" id="bar" >
		<div class="fundbar" id="fill" style="width: <?php echo $width ?>%;">
			
		</div>
	</div>
</div>



<script></script>