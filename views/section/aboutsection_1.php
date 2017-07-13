<?php

namespace Reusables;

$exampledesc = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";

$exampleemail = "example@email.com";

?>

<style>
</style>

<div class="<?php echo $identifier ?> about1">
	<div class="container">
		<?php for ($i=0; $i < sizeof($teamarray); $i++) { ?>
			<div class="person <?php echo $i ?>">
				<img src="<?php echo $teamarray[$i]['imagepath'] ?>" />
				<h3 class="name"><?php echo $teamarray[$i]['name'] ?></h3>
				<h5 class="title"><?php echo $teamarray[$i]['title'] ?></h5>
				<p class="email"><?php echo $teamarray[$i]['email'] ?></p>
				<p class="desc"><?php echo $teamarray[$i]['desc'] ?></p>
			</div>
		<?php } ?>
	</div>
</div>


<script>
</script>