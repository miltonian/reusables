<?php 

namespace Reusables;

$required = array(
	"title" => ""
);

// ReusableClasses::checkRequired( $identifier, $viewdict, $required );


	Views::setParams( 
		[ "title" ],
		[],
		$identifier
	);

?>

<style>
</style>

<div class="viewtype_header clicktoedit <?php echo $identifier ?> linethrough main">
	<div class="linethrough line"></div>
	<label class="linethrough backgroundcolor"><?php echo Data::getValue( $viewdict, 'title' ) ?></label>
</div>



<script>

		$('.<?php echo $identifier ?>.linethrough.clicktoedit').click(function(e){
			<?php
				ReusableClasses::setUpEditingForSection( $viewdict, $viewoptions, $identifier );
			?>
		})


</script>