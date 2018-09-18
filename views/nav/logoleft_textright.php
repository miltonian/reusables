<?php

namespace Reusables;

if (!isset($viewdict['logolink'])) { $viewdict['logolink'] = ""; }

Views::setParams(
	["logolink", "logo", "brandname", "imagepath", "title"],
	["type", "modal", "attached", "link"],
	$identifier
);

?>


<style>

</style>

<div class="viewtype_nav logoleft_textright <?php echo $identifier ?> all">
<div class='logoleft_textright main <?php echo $identifier ?> mobilenav'>
	<a class="logoleft_textright" id="brandlink" href='/<?php echo Data::getValue( $viewdict, 'logolink' ) ?>'>
		<?php if(isset($viewdict['logo'])){ ?>
			<img class='logoleft_textright topbarlogo' src='<?php echo Data::getValue( $viewdict, 'logo' ) ?>' width="auto" height="auto">
		<?php }else{ ?>
			<h3 class="logoleft_textright" id="brandname"><?php echo Data::getValue( $viewdict, 'brandname' ) ?></h3>
		<?php } ?>
	</a>
</div>

<div class='logoleft_textright main <?php echo $identifier ?> desktopnav navbar-shadow'>
	<div class="logoleft_textright logo_container">
		<a href='/<?php echo $viewdict['logolink'] ?>' class='logoleft_textright logo-div'>
			<?php if(isset($viewdict['logo'])){ ?>
				<img class='logoleft_textright topbarlogo' src='<?php echo  Data::getValue( $viewdict, 'logo' ) ?>' width="auto" height="auto">
			<?php } ?>
				<h3><?php echo  Data::getValue( $viewdict, 'brandname' ) ?></h3>
		</a>
	</div>
	<div class="logoleft_textright right_container">
		<div class="logoleft_textright right_inner">
			<img src="<?php echo Data::getValue( $viewdict, 'imagepath' ) ?>" class="logoleft_textright info_img">
			<label class="logoleft_textright info_label"><?php echo Data::getValue( $viewdict, 'title' ) ?></label>
		</div>
	</div>

</div>
