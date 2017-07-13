<?php

namespace Reusables;

	/*
		$sectiondict = [

		];
	*/
?>

<style>
</style>

<div class="purchase_1 main <?php echo $identifier ?>">

	<div class="purchase_1 header">
		<h1 class="purchase_1 title">Thank You For Your Contribution</h1>
		<label>Only $<?php echo number_format($sectiondict['neededforgoal']) ?> until we reach our goal. Every dollar counts</label>
	</div>

	<div class="purchase_1 tf-wrapper">
		<label class="purchase_1 tf-header">Amount</label>
		<input type="text" class="purchase_1 customtf" id="amount" placeholder="25">
	</div>

	<div class="purchase_1 tf-wrapper">
		<label class="purchase_1 tf-header">Email address</label>
		<input type="text" class="purchase_1 customtf" id="email" placeholder="Your email">
	</div>

	<div class="purchase_1 tf-wrapper">
		<label class="purchase_1 tf-header">Name</label>
		<input type="text" class="purchase_1 customtf" id="name" placeholder="Your name">
	</div>

	<div class="purchase_1 tf-wrapper">
		<label class="purchase_1 tf-header">Credit Card Number</label>
		<input type="text" class="purchase_1 customtf" id="card-number" placeholder="4111 **** **** ****">
	</div>

	<div class="purchase_1 tf-wrapper half">
		<label class="purchase_1 tf-header">CVC</label>
		<input type="text" class="purchase_1 customtf" id="cvc" placeholder="On the back of your card">
	</div>
	<div class="purchase_1 tf-wrapper half">
		<label class="purchase_1 tf-header">Expiration Date</label>
		<input type="text" class="purchase_1 customtf" id="exp" placeholder="MM/YY">
	</div>

	<button class="purchase_1 fund-btn">Fund Now</button>
</div>