<?php

namespace Reusables;

// raised, goal

$width = ( floatval( Data::getValue( $viewdict, 'raised' ) ) / floatval( Data::getValue( $viewdict, 'goal' ) ) ) * 100;

// exit( json_encode( $test ) );

?>


<style>
</style>


<div class="bargraph_1 funding_container <?php echo $identifier ?>" >
	<label class="bargraph_1" id="fund_goal" ><span class="bargraph_1" id="raised" >$<?php echo number_format( Data::getValue( $viewdict, 'raised' ) ) ?></span> / $<?php echo number_format( Data::getValue( $viewdict, 'goal' ) ) ?></label>
	<div class="bargraph_1" id="bar" >
		<div class="bargraph_1" id="fill" style="width: <?php echo $width ?>%;">
			
		</div>
	</div>
</div>



<script></script>