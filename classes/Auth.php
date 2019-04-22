<?php

namespace Reusables;

require_once(BASE_DIR . '/vendor/miltonian/custom/data/DBClasses.php');

class Auth {

    public static function check() {

      if (session_status() == PHP_SESSION_NONE) {
      	session_start();
      }
      $loggedin = false;
      if( isset($_SESSION['login']) ) {
      		if( $_SESSION['login'][0] == 1 ) {
      			$logindict = $_SESSION['login'][1][0];
      		}
      }

      if( isset($logindict) ) {
        $login = \DBClasses::querySQL('select * from admins where email=? and password=?', [$logindict['email'], $logindict['password']], 'select');
        if($login[0] == 1) {
          $loggedin = true;
        }
      }

      return $loggedin;
    }

}
