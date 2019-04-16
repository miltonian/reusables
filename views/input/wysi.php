<?php

namespace Reusables;




$size = Data::getValue( $viewdict, "size" );
$labeltext = Data::getValue( $viewdict, "labeltext" );
$placeholder = Data::getValue( $viewdict, "placeholder" );
$field_value = Data::getValue( $viewdict, "field_value" );
$height = Data::getValue( $viewdict, "height" );

$is_smart = Data::getValue( $viewoptions, "is_smart" );
if( $is_smart == "" ) {
	$is_smart = true;
} else {
	$is_smart = false;
}

if( $size == "" ) {
	$size = Data::getValue( $viewoptions, "size" );
}
if( $labeltext == "" ) {
	$labeltext = Data::getValue( $viewoptions, "labeltext" );
}
if( $placeholder == "" ) {
	$placeholder = Data::getValue( $viewoptions, "placeholder" );
}
if( $field_value == "" ) {
	$field_value = Data::getValue( $viewoptions, "field_value" );
}

if( $height == "" ) {
	$height = Data::getValue( $viewoptions, "height");
}
if( $height == "" ) {
	$height = '150';
}

if( $placeholder == "" ) {
	$placeholder = ucfirst(str_replace("_", " ", $identifier));
}
if( $labeltext == "" ) {
	$labeltext = ucfirst(str_replace("_", " ", $identifier));
}


if( $size == "" ) {
	$size = "large";
}
$sizeclass = "size_" . $size;

$field_name = "fieldarray[" . Data::getValue( $viewdict, 'field_index') . "][field_value]";
$field_id = "fieldarray_".$identifier."[". Data::getValue( $viewdict, 'field_index' ) . "][field_value]";
if( !$is_smart ) {
	$field_name = Data::getValue( $viewdict, 'field_name' );
	$field_id = $identifier;
	if( $field_name == "" ) {
		$field_name = Data::getValue( $viewoptions, 'field_name' );
		if( $field_name == "" ) {
			$field_name = $identifier;
		}
	}
}

if( !isset($viewdict['field_conditions'] ) ){
	$viewdict['field_conditions'] = [];
}

$help_modal = Data::getValue( $viewoptions, "help_modal" );
if( $help_modal != "" ) {
	$help_modal = $help_modal["modalclass"];
}

?>

<style>
.wysi img { max-width: 100%; }
</style>

<div class="viewtype_input <?php echo $identifier ?> wysi <?php echo $sizeclass ?>">
	<?php
		Data::add( ["title" => $labeltext], $identifier . "_label" );
		Options::add( $help_modal, "help_modal", $identifier . "_label" );
		echo Header::make( "basic_label", $identifier . "_label" );
	?>
	<!-- <input type="text" class="field_value" placeholder="<?php /*echo $viewdict['placeholder']*/ ?>" value="<?php /*echo $viewdict['field_value']*/ ?>" name="fieldarray[<?php /*echo $viewdict['field_index']*/ ?>][field_value]"> -->
	<textarea class="field_value" name='<?php echo $field_name ?>' id='<?php echo $field_id ?>' rows='10' cols='80'>
		<?php /*echo $viewdict['field_value']*/ ?>

	</textarea>
	<script>
		CKEDITOR.replace( '<?php echo $field_id ?>' );
		CKEDITOR.config.height = '<?php echo $height ?>' ;
		CKEDITOR.instances['<?php echo $field_id ?>'].setData( <?php echo json_encode($field_value) ?> );
		$('.cke_editor img').css({'max-width': '100%'})
	</script>

	<?php if( $is_smart ) { ?>
		<input type="hidden" class="field_type" name="fieldarray[<?php echo Data::getValue( $viewdict, 'field_index' ) ?>][field_type]" value="text" style="visibility: hidden; z-index: -1;">
		<input type="hidden" class="tablename" value="<?php echo Data::getValue( $viewdict, 'field_table' ) ?>" name="fieldarray[<?php echo Data::getValue( $viewdict, 'field_index' ) ?>][tablename]">
		<input type="hidden" class="col_name" value="<?php echo Data::getValue( $viewdict, 'field_colname' ) ?>" name="fieldarray[<?php echo Data::getValue( $viewdict, 'field_index' ) ?>][col_name]">
		<?php $i=0; ?>
		<?php foreach ($viewdict['field_conditions'] as $c) { ?>
			<input type="hidden" class="conditionkey_<?php echo $i ?>" value="<?php echo $c['key'] ?>" name="fieldarray[<?php echo $viewdict['field_index'] ?>][field_conditions][<?php echo $i ?>][key]">
			<input type="hidden" class="conditionvalue_<?php echo $i ?>" value="<?php echo $c['value'] ?>" name="fieldarray[<?php echo $viewdict['field_index'] ?>][field_conditions][<?php echo $i ?>][value]">
			<?php $i++; ?>
		<?php } ?>
	<?php } ?>
</div>


<script>

</script>
