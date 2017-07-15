<?php

namespace Reusables;

	/*
		$tabledict = [
			"postarray"=>array()
		]
	*/

$required = array(
	 $identifier . '_posts' =>array("link", "name|imagepath|emoji"), 
	"cellactions"=>"",  
	"cellname"=>""
);

// ReusableClasses::checkRequired( $identifier, $tabledict, $required );
// exit( json_encode( $tabledict['postarray'] ) );
?>

<style>
</style>

<div class="<?php echo $identifier ?> table_2">
	<div class="table">
		<?php 
			$i=0;
			for ($i=0; $i < sizeof($tabledict[ $identifier . '_posts' ]['value']); $i++) { 
				// $postdict = $tabledict['postarray']['value'][$i];
				// $postkeys = array_keys( $postdict );
				// $post = [];
				// foreach ($postkeys as $pk) {
				// 	$post[$pk] = [ "data_id"=>"postarray", "key"=>$pk, "index"=>$i ];
				// }
				// $post['index'] = $i;
				$post = Data::formatCellWithDefaultData( $identifier . '_posts' , $i );
				$post['pre_slug'] = Data::getValue( $tabledict, 'pre_slug' );
				if( isset( $tabledict['slug'] ) ) { $post['slug'] = Data::getValue( $tabledict, 'slug' ); }
				if(isset($tabledict['cellactions'])){ $post['actions'] = $tabledict['cellactions']; }else{ $post['actions'] = array(); }
				echo Cell::make( $tabledict['cellname'], $post, $identifier . "_cell" );
			}
		?>
	</div>
</div>

<script>
</script>