<?php

	$funded = floatval( Data::getValue( $sectiondict['funded'] ) );
	$goal = floatval( Data::getValue( $sectiondict['goal'] ) );

	$percentage_funded = strval(ceil(( floatval($funded) / floatval($goal) ) * 100)) . "%";

	$posttitle = "";
	if ( isset($sectiondict['post_title']) ) {
		$posttitle = Data::getValue( $sectiondict['post_title'] );
	}

	$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

// exit(json_encode($sectiondict));
?>

<style>
</style>

<div class="<?php echo $identifier ?> fundview_1">
	<label class="header"><span><?php echo $percentage_funded ?></span> FUNDED</label>
	<div class="bar">
		<div class="inner" style="width: <?php echo $percentage_funded ?>"></div>
	</div>
	<div class="stats">
		<div class="goal">
			<label class="value"><span>$<?php echo number_format( $funded / 100.0 ) ?></span> / $<?php echo number_format( $goal / 100.0 ) ?></label>
			<label class="name">GOAL</label>
		</div>
		<div class="funders">
			<label class="value"><?php echo Data::getValue( $sectiondict['funders'] ) ?></label>
			<label class="name">FUNDERS</label>
		</div>
	</div>
	<a href="<?php echo $actual_link ?>/fund"><button class="fund">Fund</button></a>
</div>

<script>
</script>