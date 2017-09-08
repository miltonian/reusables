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

	if( !isset($tabledict['convert_keys'])){ 
		$convertkeys = false; 
	}else { 
		$convertkeys = $tabledict['convert_keys']; 
	}
// exit( json_encode( $tabledict[$identifier.'_posts'][1] ) );
	$tabledict[$identifier . '_posts' ] = Data::retrieveDataWithID( $identifier . '_posts' );
	if( isset($tabledict[ $identifier . '_posts' ]['value']) ){
		$tablearray = $tabledict[ $identifier . '_posts' ]['value'];
	}else{
		$tablearray = $tabledict[ $identifier . '_posts' ];
	}

	$featured_cellname = "cell_8";
	$normal_cellname = "cell_2";
	if( isset( $tabledict['featured_cellname'] ) ){
		$featured_cellname = $tabledict['featured_cellname'];
	}
	if( isset( $tabledict['cellname'] ) ){
		$normal_cellname = $tabledict['cellname'];
	}

	$temp_tablearray = $tablearray; 
	unset( $temp_tablearray['data_id'] );

	// exit( json_encode( sizeof($tabledict[ $identifier . '_posts' ]) ) );

?>

<style>
</style>

<div class="<?php echo $identifier ?>">
	<div class="table">
		<?php 
			for ( $i=0; $i < sizeof($temp_tablearray ); $i++) { 
				$postdict = $tablearray[$i];
				$postkeys = array_keys( $postdict );
				$post = [];
				foreach ($postkeys as $pk) {
					$post[$pk] = [ "data_id"=> $identifier . '_posts' , "key"=>$pk, "index"=>$i ];
				}
				foreach ( $postkeys as $k ) {
					// if( isset( $convertkeys[$k] ) ){ $post[$convertkeys[$k]] = $postdict[$k]; }
					if( isset( $convertkeys[$k] ) ){ 
						if( is_array( $convertkeys[$k] ) ){
							foreach ($convertkeys[$k] as $ck) {
								$post[$ck] = $post[$k];
							}
						}else{
							$post[$convertkeys[$k]] = $post[$k]; 
						}
						// $post[$convertkeys[$k] ]['key'] = $convertkeys[$k];
					}
				}
				// exit( json_encode( $post ) );
				$post['network_slug'] = ["data_id"=>"network_info", "key"=>"slug"];
				$post['index'] = $i;
				$post['pre_slug'] = Data::getValue( $tabledict, 'pre_slug' );
				if( isset( $tabledict['slug'] ) ) { $post['slug'] = Data::getValue( $tabledict, 'slug' ); }
				
				if( isset( $tabledict['cellactions'] ) ){ $post['actions'] = $tabledict['cellactions']; }else{ $post['actions'] = array(); }
				Data::addData( $post, $identifier . "_cell_" . $i );
				if($i==0 || sizeof($tablearray) < 4 ){
					echo Cell::make( $featured_cellname, $identifier . "_cell_" . $i );
				}else{
					echo Cell::make( $normal_cellname, $identifier . "_cell_" . $i );
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