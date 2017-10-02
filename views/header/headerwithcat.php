<?php

namespace Reusables;

$categories = Data::getValue( $viewdict, 'categories' );
if( $categories == "" ) {
	$categories = [];
}

?>

<style>

</style>



<div class="viewtype_header headerwithcat main <?php echo $identifier ?>" >
	<h4 class="headerwithcat title"><?php echo Data::getValue( $viewdict, 'title' ) ?></h4>
	<div class="headerwithcat categories_wrapper">
		<div class="headerwithcat categoriesinner_wrapper">
			<?php $i=0; ?>
			<?php foreach ( $categories as $c) { ?>
				<?php if( $i > 0 ){ ?>
					<p class="headerwithcat" id="separator"> | </p>
				<?php } ?>
				<a class="headerwithcat link" id="" href="<?php echo Data::getValue( $c, 'link' ) ?>" ><?php echo Data::getValue( $c, 'name' ) ?></a>
				<?php $i++; ?>
			<?php } ?>
		</div>
	</div>
</div>




<script>
	
</script>