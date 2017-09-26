<?php

namespace Reusables;
?>

<style>
	.<?php echo $identifier ?>_dropdown { margin: 0; float: left; width: <?php echo 100 / floatval( ((sizeof($viewdict['pages']) ) )) ?>% }
	.navbar_5 { z-index: 99999; }
	.navbar_5 .dropdown_2 .inner-dropdown .show { z-index: 99999; }
</style>

<div class="navbar_5 main <?php echo $identifier ?>">
	<div class="navbar_5 logo_div">
		<?php if(isset($viewdict['logo'])){ ?>
			<img src=<?php echo $viewdict['logo'] ?> width="auto" height="auto">
		<?php }else{ ?>
			<h3><?php echo $viewdict['brandname'] ?></h3>
		<?php } ?>
	</div>

	<div class="buttons_div">
	<?php $i=0; ?>
		<?php foreach( $viewdict['pages'] as $b ){
			echo Menu::make( "dropdown_2", ["title"=>"testing", "index"=>$i, "list"=>["idk"] ], $identifier . "_dropdown");
			$i++;
		} ?>
	</div>
</div>


<script>
	
</script>