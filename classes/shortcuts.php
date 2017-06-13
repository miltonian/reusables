<?php

class Shortcuts {
	
	public function changeURLForTesting($url){

			$docroot;
			$baseurlminimal;
			$baseurl;
			if($_SERVER['HTTP_HOST'] == "theanywherecard.com"){
				$docroot = $_SERVER['DOCUMENT_ROOT']."/experiencenash_dev";
				$baseurlminimal = "/experiencenash_dev/";
				// $baseurl = "http://" . $_SERVER['SERVER_NAME']."/experiencenash_dev";
				$baseurl = "http://" . $_SERVER['HTTP_HOST']."/experiencenash_dev";
			}else{
				$docroot = $_SERVER['DOCUMENT_ROOT'];
				$baseurlminimal = "/";
				// $baseurl = "http://" . $_SERVER['SERVER_NAME'];
				$baseurl = "http://" . $_SERVER['HTTP_HOST'];
			}

		$testroot = ["http://theanywherecard.com/", "https://theanywherecard.com/"];
		$testurls = ["https://theanywherecard.com/experiencenash_dev/", "http://theanywherecard.com/experiencenash_dev/"];
		if(substr($url, 0,1) == "/"){
			$url = substr_replace( $url, $baseurlminimal, 0, 1 );
		}else if(substr($url, 0, sizeof($testroot[0])) == $testroot[0] || substr($url, 0, sizeof($testroot[1])) == $testroot[1]){
			$change = true;
			$changeindex = 0;
			if(substr($url, 0, sizeof($testroot[1])) == $testroot[1]){$changeindex = 1;}
			foreach ($testurls as $u) {
				if(substr($url, 0, sizeof($u)) == $u){
					$change = false;
				}
			}
			if($change){
				$url = substr_replace( $url, $baseurlminimal, 0, $testroot[$changeindex] );
			}
		}else{

		}
		return $url;
	}


}

?>