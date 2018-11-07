<?php

namespace Reusables;

class Ad {

	protected static $ads_onpage = [];

	public static function place( $file, $identifier )
	{
		View::place( "Ad", $file, $identifier );
	}

	public static function set( $file, $identifier )
	{
		Views::setDefaultViewInfo( $file, $identifier, "ad" );
	}

	public static function setInContainer( $file, $identifier )
	{
		return View::setInContainer( "Ad", $file, $identifier );
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

			if( isset( self::$ads_onpage[$a['tempads.id']] ) ) {
				continue;
			}

			$adsize = "";
			if( isset( $a['tempads.adsize'] ) ) {
				$adsize = $a['tempads.adsize'];
			}else if( isset( $a['tempads.size'] ) ) {
				$adsize = $a['tempads.size'];
			}else{
				exit("needs adsize or size key in ad (/classes/Ad.php)");
			}

			if( $size_needed == $adsize ) {
				if( $position != null ) {
					if( $a['tempads.position'] != $position) {
						continue;
					}
				}
				$adsonpage_ids = array_keys(self::$ads_onpage);
				$matches_partner = false;
				foreach ($adsonpage_ids as $ad_dict) {
					if( $ad_dict['core_partner'] == $a['tempads.core_partner'] ) {
						$matches_partner = true;
						break;
					}
				}
				if( $matches_partner ) {
					continue;
				}
				if( isset( $a['tempads.link_path'] ) && !isset( $a['tempads.link'] ) ) {
					$a['link'] = $a['tempads.link_path'];
				}
				self::$ads_onpage[$a['tempads.id']] = $a;
				return $a;

			}

		}
}

// FOR CUSTOM VIEWS

	public static function cplace( $file, $identifier )
	{
		View::cplace( "Ad", $file, $identifier );
	}

	public static function cset( $file, $identifier )
	{
		Views::setDefaultViewInfo( $file, $identifier, "custom/ad" );
	}

}
