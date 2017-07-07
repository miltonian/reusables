<?php

	/*
		$tabledict = [
			"postarray"=>array()
		]
	*/

$required = array(
	"postarray"=>array("link", "name|imagepath|emoji"), 
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
			for ($i=0; $i < sizeof($tabledict['postarray']['value']); $i++) { 
				$postdict = $tabledict['postarray']['value'][$i];
				$postkeys = array_keys( $postdict );
				$post = [];
				foreach ($postkeys as $pk) {
					$post[$pk] = [ "data_id"=>"postarray", "key"=>$pk, "index"=>$i ];
				}
				$post['index'] = $i;
				// $post['key'] = $tabledict['postarray']['db_info'];
				// exit(json_encode($post));
				// foreach ($tabledict['postarray']['value'] as $post) { 
				if(isset($tabledict['cellactions'])){ $post['actions'] = $tabledict['cellactions']; }else{ $post['actions'] = array(); }
				echo Cell::make( $tabledict['cellname'], $post, $identifier . "_cell" );
				// $i++;
			}
		?>
	</div>
</div>

<script>
</script>