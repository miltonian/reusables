<?php 

namespace Reusables;

$required = array(
	"title" => ""
);

ReusableClasses::checkRequired( $identifier, $viewdict, $required );

?>

<style>
</style>

<div class="<?php echo $identifier ?> linethrough main">
	<div class="linethrough line"></div>
	<label class="linethrough backgroundcolor"><?php echo Data::getValue( $viewdict, 'title' ) ?></label>
</div>


<script>
</script>