<?php 

class Footer {

	public static function make( $file, $data )
	{
		$View = View::factory( 'reusables/views/footer/' . $file );
		$View->set( 'footerdict', $data );
		return $View->render();
	}

}