<?php

namespace Reusables;

$width = ( floatval( Data::getValue( $sectiondict, 'raised' ) ) / floatval( Data::getValue( $sectiondict, 'goal' ) ) ) * 100;

?>


<style>
</style>


<div class="bargraph_1 funding_container <?php echo $identifier ?>" >
	<label class="bargraph_1" id="fund_goal" ><span class="bargraph_1" id="raised" >$<?php echo number_format( Data::getValue( $sectiondict, 'raised' ) ) ?></span> / $<?php echo number_format( Data::getValue( $sectiondict, 'goal' ) ) ?></label>
	<div class="bargraph_1" id="bar" >
		<div class="bargraph_1" id="fill" style="width: <?php echo $width ?>%;">
			
		</div>
	</div>
</div>



<script></script>