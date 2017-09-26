<?php 

namespace Reusables;

$required = array(
	"title" => ""
);

ReusableClasses::checkRequired( $identifier, $viewdict, $required );

?>

<style>
</style>

<div class="<?php echo $identifier ?> linethrough_1 main">
	<div class="linethrough_1 line"></div>
	<label class="linethrough_1 backgroundcolor"><?php echo Data::getValue( $viewdict, 'title' ) ?></label>
</div>


<script>
</script>