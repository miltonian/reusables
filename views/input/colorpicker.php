<?php

namespace Reusables;

include_once 'vendor/miltonian/reusables/assets/thirdparty/spectrum.php';


$size = Data::getValue( $viewdict, "size" );

if( $size == "" ) {
	$size = "large";
}
$sizeclass = "size_" . $size;
?>

<style>
	
</style>



<div class="viewtype_input <?php echo $identifier ?> colorpicker main <?php echo $sizeclass ?>">
	<label style="margin-bottom: -5px; /* font-weight: 700; font-size: 11px; */"><?php echo Data::getValue( $viewdict, "labeltext") ?></label>
	<input type="text" class="field_value" placeholder="<?php echo $viewdict['placeholder'] ?>" value="<?php echo $viewdict['field_value'] ?>" name="fieldarray[<?php echo $viewdict['field_index'] ?>][field_value]">
	<input type="hidden" class="field_type" name="fieldarray[<?php echo $viewdict['field_index'] ?>][field_type]" value="text" style="visibility: hidden; z-index: -1;">
	<input type="hidden" class="tablename" value="<?php echo $viewdict['field_table'] ?>" name="fieldarray[<?php echo $viewdict['field_index'] ?>][tablename]">
	<input type="hidden" class="col_name" value="<?php echo $viewdict['field_colname'] ?>" name="fieldarray[<?php echo $viewdict['field_index'] ?>][col_name]">
	<?php $i=0; ?>
	<?php foreach ($viewdict['field_conditions'] as $c) { ?>
		<input type="hidden" class="conditionkey_<?php echo $i ?>" value="<?php echo $c['key'] ?>" name="fieldarray[<?php echo $viewdict['field_index'] ?>][field_conditions][<?php echo $i ?>][key]">
		<input type="hidden" class="conditionvalue_<?php echo $i ?>" value="<?php echo $c['value'] ?>" name="fieldarray[<?php echo $viewdict['field_index'] ?>][field_conditions][<?php echo $i ?>][value]">
		<?php $i++; ?>
	<?php } ?>
</div>



<script>

var identifier = "<?php echo $identifier ?>";
		identifier = identifier.replace('.', '\\.')
	$('.'+identifier+' .field_value').spectrum({
		color: "<?php echo $viewdict['field_value'] ?>",
		preferredFormat: "hex",
		backgroundColor: "#ffffff",
		showPalette: true,
	});
</script>