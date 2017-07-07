<?php
	/*
		$sectiondict = [

		];
	*/
?>

<style>
</style>

<div class="purchase_1 <?php echo $identifier ?>">

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