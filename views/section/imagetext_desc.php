<?php

namespace Reusables;

	Views::setParams( 
		[ "featured_imagepath", "title", "subtitle", "html_text" ], 
		[],
		$identifier
	);

?>

<style>


</style>

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
	"<?php echo $identifier ?> imagetext_desc main viewtype_section"
);

?>


<script>
	
</script>