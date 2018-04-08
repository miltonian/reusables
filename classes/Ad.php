<?php 

namespace Reusables;

class Ad {

	protected static $ads_onpage = [];

	public static function place( $file, $identifier, $in_html=false )
	{
		if( $in_html ) {
			CustomCode::end();
		}

		Views::addToQueue( "Ad", $file, $identifier );
		
		if( $in_html ) {
			CustomCode::start();
		}
	}

	public static function set( $file, $identifier )
	{
		Views::setDefaultViewInfo( $file, $identifier, "ad" );
	}

	public static function setincontainer( $file, $identifier )
	{
		Data::addInfo( 'Ad', 'viewtype', $identifier );
		Data::addInfo( $file, 'file', $identifier );
		Data::addInfo( $identifier, 'identifier', $identifier );

		Views::addEditableParts( $identifier );
		return Ad::make( $file, $identifier );
	}

	public static function make( $file, $identifier )
	{
		return Views::makeView( $file, $identifier, "ad" );
	}

	public static function getAdForSet( $size_needed, $ads, $position=null )
	{
		if( isset( $ads['value'] ) ) {
			$ads = Data::getValue( $ads )['value'];
		}
		shuffle($ads);
		foreach ($ads as $a) {

			if( isset( self::$ads_onpage[$a['id']] ) ) {
				continue;
			}

			$adsize = "";
			if( isset( $a['adsize'] ) ) {
				$adsize = $a['adsize'];
			}else if( isset( $a['size'] ) ) {
				$adsize = $a['size'];
			}else{
				exit("needs adsize or size key in ad (/classes/Ad.php)");
			}

			if( $size_needed == $adsize ) {
				if( $position != null ) {
					if( $a['position'] != $position) {
						continue;
					}
				}
				$adsonpage_ids = array_keys(self::$ads_onpage);
				$matches_partner = false;
				foreach ($adsonpage_ids as $ad_dict) {
					if( $ad_dict['core_partner'] == $a['core_partner'] ) {
						$matches_partner = true;
						break;
					}
				}
				if( $matches_partner ) {
					continue;
				}
				if( isset( $a['link_path'] ) && !isset( $a['link'] ) ) {
					$a['link'] = $a['link_path'];
				}
				self::$ads_onpage[$a['id']] = $a;
				return $a;

			}

		}
}


	// public static function make( $file, $identifier )
	// {
	// 	ReusableClasses::addfile( "ad", $file );
	// 	$View = View::factory( 'reusables/views/ad/' . $file );
	// 	$data = Data::retrieveDataWithID( $identifier );
	// 	$View->set( 'addict', $data );
	// 	$View->set( 'identifier', $identifier );
	// 	return $View->render();
	// }



// FOR CUSTOM VIEWS

	public static function cplace( $file, $identifier, $in_html=false )
	{
		if( $in_html ) {
			CustomCode::end();
		}

		Views::addToQueue( "Custom/Ad", $file, $identifier );

		if( $in_html ) {
			CustomCode::start();
		}
	}

	public static function cset( $file, $identifier )
	{
		// exit( json_encode( [$file, $identifier] ) );
		Views::setDefaultViewInfo( $file, $identifier, "custom/ad" );
	}

}