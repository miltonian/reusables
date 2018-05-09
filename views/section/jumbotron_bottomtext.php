<?php

namespace Reusables;

extract( Views::setUp( $identifier ) );

?>

<style>
	<?php if($isediting){ ?>
		.jumbotron_bottomtext { cursor: pointer; }
			.jumbotron_bottomtext:hover { opacity: 0.8; }
	<?php } ?>
		.jumbotron_bottomtext.link { position: absolute; display: inline-block; margin: 0; padding: 0; width: 100%; height: 100%; }
	<?php if( $linkpath == "" && $optiontype == "") { ?>
		/*.jumbotron_bottomtext.link { display: none; }*/
	<?php } ?>
</style>

<div class="viewtype_section jumbotron_bottomtext <?php echo $identifier ?> main">
	<?php foreach ($viewvalues as $key => $value) { ?>
	
		<div class="backgroundimage index_<?php echo $key ?> clicktoedit" style="background-image: url('<?php echo Data::getValue( $value, 'imagepath', $identifier ) ?>');">
			<div class="gradient"></div>
		</div>
		<div class="header">
			<img id="logo" src="<?php echo Data::getValue( $value, 'logo', $identifier ) ?>">
			<h3 id="title"><?php echo Data::getValue( $value, 'title', $identifier ) ?></h3>
		</div>
		<a class="jumbotron_bottomtext link" href="<?php echo Data::getValue( $value, 'linkpath', $identifier) ?>"></a>
	<?php } ?>
</div>

<?php ReusableClasses::clickToEditSection( $viewvalues, $viewoptions, $identifier, __FILE__ ) ?>