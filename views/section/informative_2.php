<?php

?>

<style>


</style>

<?php

echo Structure::make(
	"structure_1", 
	[
		"maincolumn"=>array(
			"<img class='informative_2 featuredimage' src='" . $sectiondict['featured_imagepath'] . "' >",
			"<label class='informative_2 title' >" . $sectiondict['title'] . "</label>",
			"<label class='informative_2 subtitle' >" . $sectiondict['subtitle'] . "</label>"
		),
		"sidecolumn_right"=>array(
			"<div class='informative_2 desc' >" . $sectiondict['html_text'] . "</div>"
		)
	],
	"<?php echo $identifier ?> informative_2 main"
);

?>


<script>
	
</script>