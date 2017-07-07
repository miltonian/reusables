<?php 

$required = array(
	"title" => ""
);

ReusableClasses::checkRequired( $identifier, $headerdict, $required );

?>

<style>
</style>

<div class="<?php echo $identifier ?> linethrough_1">
	<div class="line"></div>
	<label class="backgroundcolor"><?php echo Data::getValue( $headerdict['title'] ) ?></label>
</div>


<script>
</script>