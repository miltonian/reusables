<?php

namespace Reusables;
?>

<style>
	.<?php echo $identifier ?>_dropdown { margin: 0; float: left; width: <?php echo 100 / floatval( ((sizeof($navdict['pages']) ) )) ?>% }
	.navbar_5 { z-index: 99999; }
	.navbar_5 .dropdown_2 .inner-dropdown .show { z-index: 99999; }
</style>

<div class="navbar_5 main <?php echo $identifier ?>">
	<div class="navbar_5 logo_div">
		<?php if(isset($navdict['logo'])){ ?>
			<img src=<?php echo $navdict['logo'] ?> width="auto" height="auto">
		<?php }else{ ?>
			<h3><?php echo $navdict['brandname'] ?></h3>
		<?php } ?>
	</div>

	<div class="buttons_div">
	<?php $i=0; ?>
		<?php foreach( $navdict['pages'] as $b ){
			echo Menu::make( "dropdown_2", ["title"=>"testing", "index"=>$i, "list"=>["idk"] ], $identifier . "_dropdown");
			$i++;
		} ?>
	</div>
</div>


<script>
	
</script>