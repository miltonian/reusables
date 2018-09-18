<?php

namespace Reusables;

	Views::setParams( 
		[ "title", "html_text" ], 
		[],
		$identifier
	);

	$viewdict = Convert::keys( $viewdict );

?>

<style>
	.<?php echo $identifier ?>_structure.main { padding: 60px; padding-left: 150px; padding-right: 150px; width: calc(100% - 300px); }
		.<?php echo $identifier ?>_structure .main_withside.maincolumn { width: 65%; }
		.<?php echo $identifier ?>_structure .main_withside.sidecolumn_right { width: calc(35% - 20px); }
		
</style>

<div class="viewtype_postinternal title_desc main <?php echo $identifier ?> clicktoedit">
	<h2 class='title_desc' id='title'><?php echo Data::getValue( $viewdict, 'title' ) ?></h2>
	<div class='title_desc' id='desc'><?php echo Data::getValue( $viewdict, 'html_text' ) ?></div>
</div>


<script>
	$('.title_desc.clicktoedit').click(function(e){
		<?php
			Editing::setUpEditingForSection( $viewdict, $viewoptions, $identifier );
		?>
	})
</script>