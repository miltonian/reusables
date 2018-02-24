<?php

namespace Reusables;

$subtitles = Data::getValue( $viewdict, 'subtitles' );
if( $subtitles == "" ) { $subtitles = []; }



	Views::setParams( 
		[ "title", "subtitles"=>[] ], 
		[],
		$identifier
	);

?>

<style>
	
</style>

<div class="viewtype_header title_withsubtitles main <?php echo $identifier ?>">
	<div class="title_withsubtitles title_container">
		<h3 class="title_withsubtitles title"><?php echo Data::getValue( $viewdict, "title" ) ?></h3>
	</div>

	<div class="title_withsubtitles subtitles_div">
		<?php $i=0; ?>
		<?php foreach ($subtitles as $s) { ?>
			<label class="title_withsubtitles subtitle index_<?php echo $i ?>"><?php echo $s ?></label>
			<?php $i++; ?>
		<?php } ?>

	</div>
</div>