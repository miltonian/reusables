<?php

namespace Reusables;

	/*
		$tabledict = [
			"postarray"=>array()
		]
	*/

	// $ReusableClasses = new ReusableClasses();
	// $shortcuts = new Shortcuts();
?>

<style>
</style>

<div class="<?php echo $identifier ?>">
	<div class="table">
		<?php 

			for ( $i=0; $i < sizeof($tabledict['postarray']['value'] ); $i++) { 
				$postdict = $tabledict['postarray']['value'][$i];
				$postkeys = array_keys( $postdict );
				$post = [];
				foreach ($postkeys as $pk) {
					$post[$pk] = [ "data_id"=>"postarray", "key"=>$pk, "index"=>$i ];
				}
				$post['network_slug'] = ["data_id"=>"network_info", "key"=>"slug"];
				$post['index'] = $i;
				
				if( isset( $tabledict['cellactions'] ) ){ $post['actions'] = $tabledict['cellactions']; }else{ $post['actions'] = array(); }
				if($i==0 || sizeof($tabledict['postarray']) < 4 ){
					echo Cell::make( "cell_8", $post, $identifier . "_cell" );
				}else{
					echo Cell::make( "cell_2", $post, $identifier . "_cell" );
				}
			}

			/*$i=0;
			foreach ($tabledict['postarray'] as $post) { 
				if($i==0 || sizeof($tabledict['postarray']) < 4 ){
					echo Cell::make( "cell_8", $post, $identifier . "_cell" );
				}else{
					echo Cell::make( "cell_2", $post, $identifier . "_cell" );
				}
				$i++;
			}*/ ?>
	</div>
</div>

<script>
</script>