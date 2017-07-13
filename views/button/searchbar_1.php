<?php

namespace Reusables;

?>

<style>
</style>

<div class="<?php echo $identifier ?> searchbar_1">
	<form action="/search" method="get">
		<input type="text" name="s" placeholder="Search">
	</form>
	<img src="/vendor/miltonian/reusables/uploads/icons/search-icon.png" width="30" height="30">
</div>

<script>
	$('.<?php echo $identifier ?> img').click(function(){
		$('.<?php echo $identifier ?> form').animate({'width': '180px', 'margin': '0px 15px', 'opacity': '1'}, 500, function(){
			$('.<?php echo $identifier ?> input').focus(); 
		});
	});
</script>