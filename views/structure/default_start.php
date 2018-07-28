<?php

namespace Reusables;

extract( Views::setUp( $identifier ) );

$width = Data::getValue( $viewoptions, "width" );
if( $width == "" ) {
  $width = "100%";
}

?>

<style>
  .default.main.<?php echo $identifier ?> { display: inline-block; position: relative; margin: 0; padding: 0; float: left; }
  @media(min-width: 0px) {
    .default.main.<?php echo $identifier ?> { padding: 0 !important; margin: 0 !important; width: 100%; }
  }

  @media(min-width: 768px) {
    .default.main.<?php echo $identifier ?> { padding: <?php echo $padding ?> !important; margin: <?php echo $margin ?> !important; width: calc(<?php echo $width ?> - <?php echo $padding_width ?> - <?php echo $margin_width ?>); }
  }
</style>

<div class="viewtype_structure <?php echo $identifier ?> default main">
