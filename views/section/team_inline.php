<?php

/* teamarray => imagepath, name, title, email, html_text */

namespace Reusables;

	Views::setParams( 
		[ ["imagepath", "name", "title", "email", "html_text", "slug"] ], 
		[],
		$identifier
	);

$exampledesc = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";

$exampleemail = "example@email.com";

$teamarray = Data::getValue( $viewdict );

if( $teamarray == "" ) {
	$teamarray = [];
}

$arraysize = sizeof($teamarray);
if(	isset($teamarray['value']) ) {
	$arraysize = sizeof( $teamarray['value'] );
}


?>

<style>
</style>

<div class="viewtype_section <?php echo $identifier ?> team_inline main">
	<div class="team_inline thecontainer">
		<?php for ($i=0; $i < $arraysize; $i++) { ?>
		<?php $teamdict = Data::getValue( $teamarray, $i); ?>
			<div class="team_inline person index_<?php echo $i ?>">
				<a class="team_inline link clicktoedit index_<?php echo $i ?>" href="<?php echo Data::getValue( $viewoptions, 'pre_slug' ) ?><?php echo Data::getValue( $viewdict, 'slug' ) ?>">
					<img class="team_inline image" src="<?php echo Data::getValue( $teamdict, 'imagepath' ) ?>" />
					<h3 class="team_inline name"><?php echo Data::getValue( $teamdict, 'name' ) ?></h3>
					<h5 class="team_inline title"><?php echo Data::getValue( $teamdict, 'title' ) ?></h5>
					<p class="team_inline email"><?php echo Data::getValue( $teamdict, 'email' ) ?></p>
					<p class="team_inline desc"><?php echo Data::getValue( $teamdict, 'html_text' ) ?></p>
				</a>
			</div>
		<?php } ?>
	</div>
</div>


<script>
	

		$('.team_inline.clicktoedit').off().click(function(e){ 

			<?php
				ReusableClasses::setUpEditingForSection( $viewdict, $viewoptions, $identifier );
			?>

			// if( typeof dataarray === "undefined" ) {
			// 	dataarray = []
			// }
			// var viewdict = <?php /* echo json_encode($viewdict)*/ ?>;
			// var viewoptions = <?php /* echo  json_encode( $viewoptions )*/ ?>;
			// Reusable.addAction( viewdict, [thismodalclass], 0, dataarray, this, e, viewoptions );
			
		});

</script>