<?php

namespace Reusables;

	/*
		$tabledict = [
			"postarray"=>array()
		]
	*/

	// $ReusableClasses = new ReusableClasses();
	// $shortcuts = new Shortcuts();
		// exit( json_encode( sizeof($tabledict[ $identifier . '_posts' ]) ) );
?>

<style>
</style>

<div class="<?php echo $identifier ?>">
	<div class="table">
		<?php 
			for ( $i=0; $i < sizeof($tabledict[ $identifier . '_posts' ]['value'] ); $i++) { 
				$postdict = $tabledict[ $identifier . '_posts' ]['value'][$i];
				$postkeys = array_keys( $postdict );
				$post = [];
				foreach ($postkeys as $pk) {
					$post[$pk] = [ "data_id"=> $identifier . '_posts' , "key"=>$pk, "index"=>$i ];
				}
				$post['network_slug'] = ["data_id"=>"network_info", "key"=>"slug"];
				$post['index'] = $i;
				$post['pre_slug'] = Data::getValue( $tabledict, 'pre_slug' );
				if( isset( $tabledict['slug'] ) ) { $post['slug'] = Data::getValue( $tabledict, 'slug' ); }
				
				if( isset( $tabledict['cellactions'] ) ){ $post['actions'] = $tabledict['cellactions']; }else{ $post['actions'] = array(); }
				if($i==0 || sizeof($tabledict[ $identifier . '_posts' ]) < 4 ){
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