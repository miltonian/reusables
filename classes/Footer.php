<?php 

class Footer {

	public static function make( $file, $data, $identifier )
	{
		$View = View::factory( 'reusables/views/footer/' . $file );
		$View->set( 'footerdict', $data );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

}