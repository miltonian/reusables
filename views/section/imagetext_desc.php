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
			"<img class='informative_2 featuredimage' src='" . $viewdict['featured_imagepath'] . "' >",
			"<label class='informative_2 title' >" . $viewdict['title'] . "</label>",
			"<label class='informative_2 subtitle' >" . $viewdict['subtitle'] . "</label>"
		),
		"sidecolumn_right"=>array(
			"<div class='informative_2 desc' >" . $viewdict['html_text'] . "</div>"
		)
	],
	"<?php echo $identifier ?> informative_2 main"
);

?>


<script>
	
</script>