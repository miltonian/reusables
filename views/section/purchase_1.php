<?php
	/*
		$sectiondict = [

		];
	*/
?>

<style>
	.purchase1 { display: inline-block; position: relative; margin: 0; padding: 0; width: 100%; }
		.purchase1 .header { display: inline-block; position: relative; margin: 0; padding: 20px; width: calc( 100% - 40px); text-align: center; }
			.purchase .header h1 { display: inline-block; position: relative; margin: 0; padding: 5px; width: calc( 100% - 10px); font-weight: 400; }
			.purchase .header label { display: inline-block; position: relative; margin: 0; padding: 5px; width: calc( 100% - 10px); }
			
		@media (min-width: 0px) {
			
		}
		@media (min-width: 768px) {
			
		}
		@media (min-width: 992px) {

		}
</style>

<div class="purchase1">
	<div class="header">
		<h1 class="title">Thank You For Your Contribution</h1>
		<label>Only $<?php echo number_format($sectiondict['neededforgoal']) ?> until we reach our goal. Every dollar counts</label>
	</div>
</div>