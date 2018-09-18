<?php

namespace Reusables;

extract( Views::setUp( $identifier ) );


?>

<style>
	<?php if($isediting){ ?>
		.hero { cursor: pointer; }
			.hero:hover { opacity: 0.8; }
	<?php } ?>
		.hero.link { position: absolute; display: inline-block; margin: 0; padding: 0; width: 100%; height: 100%; }
	<?php if( $linkpath == "" && $optiontype == "") { ?>
		/*.hero.link { display: none; }*/
	<?php } ?>
</style>

<div class="viewtype_section hero <?php echo $identifier ?> main">
	<?php foreach ($viewvalues as $key => $value) { ?>
		
		<div class="hero backgroundimage index_<?php echo $key ?> clicktoedit" style="background-image: url('<?php echo Data::getValue( $value, 'imagepath' ) ?>');">
			<div class="hero overlay"></div>
			<div class="hero header">
				<img class="hero" id="logo" src="<?php echo Data::getValue( $value, 'logo', $identifier ) ?>">
				<h3 class="hero" id="title"><?php echo Data::getValue( $value, 'title', $identifier ) ?></h3>
				<h3 class="hero" id="subtitle"><?php echo Data::getValue( $value, 'subtitle', $identifier ) ?></h3>
			</div>
		</div>
		<a class="hero link" href="<?php echo Data::getValue( $value, "linkpath", $identifier ) ?>"></a>
	<?php } ?>
</div>

<?php Editing::clickToEditSection( $viewdict, $viewoptions, $identifier, __FILE__ ) ?>