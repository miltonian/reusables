<?php

if(!isset($navtype)){ $navtype=1; }

if(!isset($isadmin)){ $isadmin=false; }

if(!isset($navbar2categoryfeatured)){ $navbar2categoryfeatured=false; }

if(isset($isadmin)){ if($isadmin){ $navbar2categoryfeatured = true; } }

if(!isset($tagline)){$tagline="";}

if( !isset($brandlogo) ){ $brandlogo=false; }

if( !isset($brandname) ){ $brandname = "Brand Name"; }

?>

<style>
</style>


<div class="navbar_3 main <?php echo $identifier ?>" style="<?php if($isadmin){ echo "margin-top: 60px"; } ?>">
	<div class="navbar_3 container">
		<div class="navbar_3 main-content">
			<a href="/">
				<div class="navbar_3 logo-div">
					<?php if($brandlogo){ ?>
						<img src=<?php echo $logoimgthumb ?> width="auto" height="auto">
					<?php }else{ ?>
						<h3><?php echo $navdict['brandname'] ?></h3>
					<?php } ?>
					
				</div>
			</a>
			<div class="navbar_3 search-container" style="position: absolute; right: 30px; top: 50%; transform: translateY(-50%);">
				<?php
					Button::make( "searchbar_1", [], "search-btn" );
				?>
			</div>
		</div>
	</div>
</div>

<script>

</script>