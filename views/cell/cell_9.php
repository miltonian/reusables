<?php

?>

<style>
	.cell9 { display: inline-block; position: relative; margin: 0; padding: 5px; width: calc(100% - 5px); text-align: left; }
		.cell9 #goal { display: inline-block; position: relative; margin: 5px 0; padding: 0; width: 100%; color: green; font-size: 20px; }
		.cell9 #title { display: inline-block; position: relative; margin: 5px 0; padding: 0; width: 100%: color: #555555; font-weight: 600; }
		.cell9 #desc { display: inline-block; position: relative; margin: 5px 0; padding: 0; width: 100%; color: #333333; font-weight: 300; }
		.cell9 button#select { display: inline-block; position: relative; margin: 5px 0 20px 0; padding: 13px 23px; background-color: yellow; color: white; border: 1px solid rgba(0,0,0,0.3); -webkit-appearance: none; border-radius: 5px; font-size: 14px; text-shadow: 1px 1px rgba(0,0,0,0.3); cursor: pointer; }
</style>

<div class="cell9">
	<label id="goal"><?php echo $celldict['price'] ?></label>
	<h5 id="title"><?php echo $celldict['title'] ?></h5>
	<p id="desc"><?php echo $celldict['desc'] ?></p>
	<button id="select">Select</button>
</div>

<script>

$('.cell9 button#select').click(function(e){
	e.preventDefault();
	alert();
});

</script>