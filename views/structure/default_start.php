<?php

namespace Reusables;

$width = Data::getValue( $viewoptions, "width" );
if( $width == "" ) {
  $width = "100%";
}

?>

<style>
  .default.main.<?php echo $identifier ?> { display: inline-block; position: relative; margin: 0; padding: 0; float: left; width: <?php echo $width ?>; }
</style>

<div class="viewtype_structure <?php echo $identifier ?> default main">
