<?php

?>

<style>
.searchbar1 {
	display: inline-block;
	position: relative;
	margin: 0;
	padding: 0;
}
	.searchbar1 img {
		display: inline-block;
		position: relative;
		margin: 0;
		padding: 0;
		float: left;
		cursor: pointer;
	}
	.searchbar1 form {
		display: inline-block;
		position: relative;
		margin: 0;
		padding: 0;
		width: 0px;
		height: 30px;
		float: left;
		border: 0;
		opacity: 0;
	}
	.searchbar1 input {
		display: inline-block;
		position: relative;
		margin: 0;
		padding: 0;
		width: 100%;
		height: 100%;
		background-color: white;
		float: left;
		text-align: right;
		font-weight: 300;
		font-size: 1em;
		border: 0;
		border-bottom: 0.5px solid #777777;
	}
		.searchbar1 input:focus {outline:0;}
</style>

<div class="searchbar1">
	<form action="<?php echo $baseurlminimal ?>search" method="get">
		<input type="text" name="s" placeholder="Search">
	</form>
	<img src="<?php echo $baseurlminimal ?>reusables/uploads/icons/search-icon.png" width="30" height="30">
</div>

<script>
	$('.searchbar1 img').click(function(){
		$('.searchbar1 form').animate({'width': '180px', 'margin': '0px 15px', 'opacity': '1'}, 500, function(){
			$('.searchbar1 input').focus(); 
		});
	});
</script>