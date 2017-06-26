<?php
	/*
		$sectiondict = [

		];
	*/
?>

<style>
	.purchase1 { display: inline-block; position: relative; margin: 0; padding: 0; width: 100%; }
		.purchase1 .header { display: inline-block; position: relative; margin: 0; padding: 20px; width: calc( 100% - 40px); text-align: center; }
			.purchase1 .header h1 { display: inline-block; position: relative; margin: 0; padding: 5px; width: calc( 100% - 10px); font-weight: 400; }
			.purchase1 .header label { display: inline-block; position: relative; margin: 0; padding: 5px; width: calc( 100% - 10px); }
		.purchase1 .tf-wrapper { display: inline-block; margin: 10px; padding: 0; position: relative; width: 100%; text-align: left; }
		.purchase1 .tf-wrapper .tf-header { display: inline-block; position: relative; font-weight: 700; font-size: 12px; }
			.purchase1 .tf-wrapper .customtf { display: inline-block; position: relative; margin: 10px 0; padding: 10px 0px; width: calc( 100% - 0px); background: transparent; border: 0; border-bottom: 1px solid #e0e0e0; font-size: 13px; }
			.purchase1 .tf-wrapper.half { width: calc( 50% - 20px ); float: left; }
				.purchase1 .tf-wrapper .customtf#amount { text-align: right; font-size: 30px; font-weight: 700; }
				.purchase1 .tf-wrapper .customtf:focus { outline: none; }
			.purchase1 .fund-btn { display: inline-block; position: relative; margin: 0; padding: 10px; color: white; background-color: blue; border: 0; -webkit-appearance: none; border-radius: 5px; float: left; font-size: 15px; cursor: pointer; }
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

	<div class="tf-wrapper">
		<label class="tf-header">Amount</label>
		<input type="text" class="customtf" id="amount" placeholder="25">
	</div>

	<div class="tf-wrapper">
		<label class="tf-header">Email address</label>
		<input type="text" class="customtf" id="email" placeholder="Your email">
	</div>

	<div class="tf-wrapper">
		<label class="tf-header">Name</label>
		<input type="text" class="customtf" id="name" placeholder="Your name">
	</div>

	<div class="tf-wrapper">
		<label class="tf-header">Credit Card Number</label>
		<input type="text" class="customtf" id="card-number" placeholder="4111 **** **** ****">
	</div>

	<div class="tf-wrapper half">
		<label class="tf-header">CVC</label>
		<input type="text" class="customtf" id="cvc" placeholder="On the back of your card">
	</div>
	<div class="tf-wrapper half">
		<label class="tf-header">Expiration Date</label>
		<input type="text" class="customtf" id="exp" placeholder="MM/YY">
	</div>

	<button class="fund-btn">Fund Now</button>
</div>