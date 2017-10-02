<?php

namespace Reusables;

?>

<style>


</style>

<?php

echo Structure::make(
	"main_withside", 
	[
		"maincolumn"=>array(
			"<img class='imagetext_desc featuredimage' src='" . $viewdict['featured_imagepath'] . "' >",
			"<label class='imagetext_desc title' >" . $viewdict['title'] . "</label>",
			"<label class='imagetext_desc subtitle' >" . $viewdict['subtitle'] . "</label>"
		),
		"sidecolumn_right"=>array(
			"<div class='imagetext_desc desc' >" . $viewdict['html_text'] . "</div>"
		)
	],
	"<?php echo $identifier ?> imagetext_desc main viewtype_section"
);

?>


<script>
	
</script>