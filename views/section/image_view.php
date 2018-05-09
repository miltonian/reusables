<?php

namespace Reusables;
	
extract( Views::setUp( $identifier ) );

?>

<div class="viewtype_section image_view main <?php echo $identifier ?>">

	<?php $i=0; ?>
	<?php foreach ($viewvalues as $key => $value) {  ?>
		<img class="image_view image index_<?php echo $i ?> clicktoedit" src="<?php echo Data::getValue($value, 'imagepath', $identifier) ?>">
		<?php $i++; ?>
	<?php } ?>
</div>





<?php ReusableClasses::clickToEditSection( $viewdict, $viewoptions, $identifier, __FILE__ ); ?>

