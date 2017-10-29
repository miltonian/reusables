<?php

namespace Reusables;

	$funded = floatval( Data::getValue( $viewdict, 'funded' ) );
	$goal = floatval( Data::getValue( $viewdict, 'goal' ) );

	$percentage_funded = strval(ceil(( floatval($funded) / floatval($goal) ) * 100)) . "%";

	$posttitle = "";
	if ( isset($viewdict['post_title']) ) {
		$posttitle = Data::getValue( $viewdict, 'post_title' );
	}

	$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";



	Views::setParams( 
		[ "funded", "goal", "post_title", "funders" ], 
		[],
		$identifier
	);

?>

<style>
</style>

<div class="viewtype_section <?php echo $identifier ?> fundview_1">
	<label class="header"><span><?php echo $percentage_funded ?></span> FUNDED</label>
	<div class="bar">
		<div class="inner" style="width: <?php echo $percentage_funded ?>"></div>
	</div>
	<div class="stats">
		<div class="goal">
			<label class="value"><span>$<?php echo number_format( $funded ) ?></span> / $<?php echo number_format( $goal ) ?></label>
			<label class="name">GOAL</label>
		</div>
		<div class="funders">
			<label class="value"><?php echo Data::getValue( $viewdict, 'funders' ) ?></label>
			<label class="name">FUNDERS</label>
		</div>
	</div>
	<a href="<?php echo $actual_link ?>/fund"><button class="fund">Fund</button></a>
</div>

<script>
</script>