<?php

namespace Reusables;

	/*
		$viewdict = [

		];
	*/
?>

<style>
</style>

<div class="purchase_full main <?php echo $identifier ?>">

	<div class="purchase_full header">
		<h1 class="purchase_full title">Thank You For Your Contribution</h1>
		<label>Only $<?php echo number_format($viewdict['neededforgoal']) ?> until we reach our goal. Every dollar counts</label>
	</div>

	<div class="purchase_full tf-wrapper">
		<label class="purchase_full tf-header">Amount</label>
		<input type="text" class="purchase_full customtf" id="amount" placeholder="25">
	</div>

	<div class="purchase_full tf-wrapper">
		<label class="purchase_full tf-header">Email address</label>
		<input type="text" class="purchase_full customtf" id="email" placeholder="Your email">
	</div>

	<div class="purchase_full tf-wrapper">
		<label class="purchase_full tf-header">Name</label>
		<input type="text" class="purchase_full customtf" id="name" placeholder="Your name">
	</div>

	<div class="purchase_full tf-wrapper">
		<label class="purchase_full tf-header">Credit Card Number</label>
		<input type="text" class="purchase_full customtf" id="card-number" placeholder="4111 **** **** ****">
	</div>

	<div class="purchase_full tf-wrapper half">
		<label class="purchase_full tf-header">CVC</label>
		<input type="text" class="purchase_full customtf" id="cvc" placeholder="On the back of your card">
	</div>
	<div class="purchase_full tf-wrapper half">
		<label class="purchase_full tf-header">Expiration Date</label>
		<input type="text" class="purchase_full customtf" id="exp" placeholder="MM/YY">
	</div>

	<button class="purchase_full fund-btn">Fund Now</button>
</div>