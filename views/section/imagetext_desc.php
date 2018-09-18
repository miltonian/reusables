<?php

namespace Reusables;

	Views::setParams( 
		[ "featured_imagepath", "title", "subtitle", "html_text" ], 
		[],
		$identifier
	);

	$viewdict = Convert::keys( $viewdict );

?>

<style>


</style>

<div class="<?php echo $identifier ?> imagetext_desc main clicktoedit">
	<?php

		echo Structure::make(
			"main_withside", 
			[
				"maincolumn"=>array(
					"<img class='imagetext_desc featuredimage' src='" . Data::getValue( $viewdict, 'featured_imagepath' ) . "' >",
					"<label class='imagetext_desc title' >" . Data::getValue( $viewdict, 'title' ) . "</label>",
					"<label class='imagetext_desc subtitle' >" . Data::getValue( $viewdict, 'subtitle' ) . "</label>"
				),
				"sidecolumn_right"=>array(
					"<div class='imagetext_desc desc' >" . Data::getValue( $viewdict, 'html_text' ) . "</div>"
				)
			],
			$identifier . " imagetext_desc main viewtype_section"
		);

	?>
</div>

<script>

		$('.imagetext_desc.clicktoedit').click(function(e){
			<?php
				Editing::setUpEditingForSection( $viewdict, $viewoptions, $identifier );
			?>
		})

</script>