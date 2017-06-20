<?php

	$percentage_funded = strval(ceil(( floatval($sectiondict['funded']) / floatval($sectiondict['goal']) ) * 100)) . "%";
?>

<style>
	.fundview1 { display: inline-block; position: relative; margin: 0; padding: 0; width: 100%; }
		.fundview1 .header { display: inline-block; position: relative; margin: 0; padding: 0; width: 100%; text-align: center; text-transform: uppercase; color: #777777; font-size: 30px; font-weight: 400; }
			.fundview1 .header span { color: green; }
		.fundview1 .bar { display: inline-block; position: relative; margin: 15px 0; padding: 0; width: 100%; height: 10px; background-color: rgba(0,0,5,0.2); border-radius: 5px; }
			.fundview1 .bar .inner { display: inline-block; position: relative; margin: 0; padding: 0; height: 100%; border-radius: 5px; background-color: green; float: left; }
		.fundview1 .stats .goal { width: 50%; float: left; font-weight: 300; }
			.fundview1 .stats .goal .value span { font-size: 1.4em; }
		.fundview1 .stats .funders { width: 50%; float: left; text-align: right; }
		.fundview1 .stats .value { display: inline-block; position: relative; width: 100%; }
			.fundview1 .stats .funders .value { font-size: 1.4em; }
		.fundview1 .stats .name { display: inline-block; position: relative; font-weight: 300; font-size: 10px; text-transform: uppercase; color: #555555; width: 100%; }
		.fundview1 button.fund { display: inline-block; position: relative; margin: 20px 0 10px 0; padding: 20px 0px; width: 100%; background-color: green; color: white; border: 1px solid rgba(0,0,0,0.3); border-radius: 5px; font-size: 18px; font-weight: 500; cursor: pointer; }
</style>

<div class="fundview1">
	<label class="header"><span><?php echo $percentage_funded ?></span> FUNDED</label>
	<div class="bar">
		<div class="inner" style="width: <?php echo $percentage_funded ?>"></div>
	</div>
	<div class="stats">
		<div class="goal">
			<label class="value"><span>$<?php echo number_format( $sectiondict['funded']/100.0 ) ?></span> / $<?php echo number_format( $sectiondict['goal']/100.0 ) ?></label>
			<label class="name">GOAL</label>
		</div>
		<div class="funders">
			<label class="value"><?php echo $sectiondict['funders'] ?></label>
			<label class="name">FUNDERS</label>
		</div>
	</div>
	<button class="fund">Fund</button>
</div>

<script>
</script>