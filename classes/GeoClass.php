<?php


//GeoClass.php

namespace reusables;

class GeoClass
{
   public static $CLIENT;
   public static $API_KEY = '';
   private static $SALT = '';

   // Add to your autoload or env
   public static function setGeoApiKey($API_KEY)
   {
      GeoClass::$API_KEY = $API_KEY;
   }

   //Add to your autoload or env
   public static function setSalt($SALT)
   {
      GeoClass::$SALT = $SALT;
   }

   /**
    * @author Duncan Pierce <devduncanrocks@gmail.com> <github.com/sigkar>
    * @params null
    * @description Checks if the API key has been set or is expired
    * @returns {boolean} (anonymous)
    */
   public static function is_set()
   {
      if (!isset(GeoClass::$API_KEY) || GeoClass::$API_KEY == "") {
         return false;
      }
      return true;
   }

   /**
    * @author Duncan Pierce <devduncanrocks@gmail.com> <github.com/sigkar>
    * @params {mixed} $unique
    * @params {mixed} $email
    * 
    * @description
    *       Just makes a basic geo-location request via IPs.
    * 
    * @usage
    *       Unique email:
    *          basicGeoRequest(true, 'email@email.com');
    *       Unique IP:
    *          basicGeoRequest(true);
    *       Nonunique Email:
    *          basicGeoRequest(false, 'email@email.com');
    *       Nonunique IP:
    *          basicGeoRequest();
    * 
    * @returns {mixed} array
    */
   public static function basicGeoRequest($unique = false, $email = false)
   {
      // Get IP
      
      $ip = GeoClass::getIp();
      if (!$ip) { 
         return [false, "ip not valid", $ip];
      }

      $loc = GeoClass::returnGeoLocation($ip);
      if (!$loc[0]) {
         return [false, "location not found or invalid", $loc];
      }
      $geoData = GeoClass::updateGeoTable($loc[1], $ip, $unique, false, $email);
      return [true, $geoData, $loc];
   }


   /**
    * @author Duncan Pierce <devduncanrocks@gmail.com> <github.com/sigkar>
    * @params {*} $usingIp
    * @params {*} $usingEmail
    * @params {*} $unique
    * 
    * @description
    *       Developed to create pre-authorized geo requests.
    *       Will only allow the logging of IPs and Email information if you have
    *       obtained an authorization of some kind and have passed this
    *       data to the database already.
    * 
    * @usage
    *       First: run acceptLocationTerms(true);
    *                - This does not store any data for IPs. The reason for this
    *                   is in case you wish to prevent specific IP ranges or countries
    *                   from having more data logged from their geolocation.
    *                   AKA: the is_european value and compliance with european laws.
    *       *Unique using ips: 
    *             preAuthorizedGeoRequest('ip value', false, true);
    *       *Unique using email: 
    *             preAuthorizedGeoRequest(false, 'email@dot.com', true);
    *       *Just use IP: 
    *             preAuthorizedGeoRequest();
    * 
    * @returns {mixed} array
    */
   public static function preAuthorizedGeoRequest($usingIp = true, $usingEmail = false, $unique = false)
   {
      $ip = GeoClass::getIp();
      if (!$usingIp) {
         // Check terms by email
         $locationTermsCheck = GeoClass::checkLocationTerms(false, $usingEmail);

         if (!$locationTermsCheck[0]) {
            return [false, "user has not accepted"];
         }
      } else {
         if (!$ip) {
            return [false, "ip not valid"];
         }
         // Check if user has accepted terms
         $locationTermsCheck = GeoClass::checkLocationTerms($ip);
         if (!$locationTermsCheck[0]) {
            return [false, "user has not accepted"];
         }
      }
      // Get the location
      $geoData = GeoClass::returnGeoLocation($ip);
      if (!$geoData[0]) {
         return [false, "geolocation lookup failed", $geoData];
      }

      // Log the location
      $update = GeoClass::updateGeoTable($geoData[1], $ip, $unique, false, $usingIp, $usingEmail);
      if (!$update[0]) {
         return [false, "geo table update failed", $update];
      }

      return [true, [$update, $geoData, $ip]];
   }

   /**
    * @author Duncan Pierce <devduncanrocks@gmail.com> <github.com/sigkar>
    * @params null
    * @description Attempts to reach the IP. If the IP is set to ::1 then we just return false.
    * @returns {boolean} $ip
    * @returns {string} anonymous
    */
   public static function getIp()
   {
      if (session_status() == PHP_SESSION_NONE) {
         session_start();
      }
      if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
         $ip = $_SERVER['HTTP_CLIENT_IP'];
      } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
         //ip pass from proxy
         $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
      } else {
         $ip = $_SERVER['REMOTE_ADDR'];
      }
      if ($ip == "::1" || !isset($ip) || $ip = "127.0.0.1") {
         return false;
      }

      return $ip;
   }

   /**
    * @author Duncan Pierce <devduncanrocks@gmail.com> <github.com/sigkar>
    * @params {boolean} $accepted
    * @params {boolean} $useIp
    * @params {any} $useEmail (Encrypts to ensure privacy of IP and location to email)
    * @description Sets the MySQL database once the user has accepted or denied the terms.
    * Encrypts to ensure Privacy.
    *
    * @usage:
    *       accept with an IP: 
    *             GeoClass::acceptLocationTerms(true);
    *
    *       reject with an IP: 
    *             Do nothing. Need permission to use an IP. Save a cookie to their browser if accepted to not
    *             bother the user again, or keep bothering them. Choose your own adventure.
    *
    *       accept with an email: 
    *             GeoClass::acceptLocationTerms(true, false, 'email@place.com');
    * 
    *       reject with an email: 
    *             GeoClass::acceptLocationTerms(false, false, 'email@place.com');
    *             Note: (Users may be logged with an email because we already have this data if it is available)
    *
    * @returns {array} $response
    */
   public static function acceptLocationTerms($accepted, $useIp = true, $useEmail = false)
   {
      // If we are using the IP and they rejected terms
      if ($useIp && !$accepted) {
         return [false, "User did not accept logging their IP"];
      }
      // Use the IP of the current user
      if ($useIp) {
         $userInfo = GeoClass::getIp();
         $query = 'INSERT INTO location (ip, accepted_terms) values (?, ?)';
      } else if ($useEmail) {
         // Use the email of the user
         try {
            $userInfo = encryptText($useEmail);
         } catch (Exception $e) {
            return [false, $e];
         }
         $query = 'INSERT INTO location (encrypted_user, accepted_terms) values (?, ?)';
      } else {
         // all wrong
         return [false];
      }
      // Get the response

      $response = DBClasses::querySQL($query, [$userInfo, $accepted], "insert");

      // If the response failed, exit
      if ($response[0] === 0) {
         return [false];
      }
      // Return the response
      return [true, $response];
   }

   /**
    * @author Duncan Pierce <devduncanrocks@gmail.com> <github.com/sigkar> <github.com/sigkar>
    * @params {string} $useSentIp
    * @params {string} $useEmail
    * @returns {array} anonymous
    */
   public static function checkLocationTerms($useSentIp = false, $useEmail = false)
   {


      // If we aren't using email
      if (!$useEmail) {
         $query = 'SELECT * FROM location WHERE ip=?';
         if ($useSentIp) {
            $data = $useSentIp;
         } else {
            $data = GeoClass::getIp();
         }
         //if we are using email
      } else if ($useEmail) {
         $query = 'SELECT * FROM location WHERE encrypted_user=?';
         $data = encryptText($useEmail);
         //Broke
      } else {
         return [false];
      }

      // try to query
      try {
         $user = \DBClasses::querySQL($query, [$data], "select");
      } catch (Exception $e) {
         return [false, $e];
      }

      // If the query failed or is empty
      if ($user[0] === 0) {
         return [false];
      }

      // If the data exists
      if ($user[1][0]["accepted_terms"]) {
         return [true];
      } else {
         return [false];
      }
   }

   /**
    * @author Duncan Pierce <devduncanrocks@gmail.com> <github.com/sigkar>
    * @params null
    * @description Initializes the construct
    * @returns {object} $this->ip
    */
   private static function returnGeoLocation($ip)
   {
      // Create the guzzle client for the API
      GeoClass::$CLIENT = new \GuzzleHttp\Client();
      try {
         // Try to get a response
         $response = GeoClass::$CLIENT->get('https://api.ipdata.co/' . $ip . '/?api-key=' . GeoClass::$API_KEY);
         $formatted_response = $response->getBody()->getContents();
         $formatted_response = json_decode($formatted_response);
      } catch (Exception $e) {
         return [false, $e];
      }
      return [true, $formatted_response];
   }

   /**
    * @author Duncan Pierce <devduncanrocks@gmail.com> <github.com/sigkar>
    * @params {object} $loc
    * @params {string} $ip
    * @params
    * @description Sets the Location Table to include the
    * new users information based upon their location. This can be
    * used for analytics. Only updates once the user has accepted
    * the terms of service and has agreed to having their location
    * used. This agreement can be expected or accepted.
    */
   public static function updateGeoTable($loc, $ip, $addToUniqueOnly = false, $requireExplicitAcceptance = false, $usingEmail = false)
   {
      // If we require an explicit acceptance in the database before logging
      if ($requireExplicitAcceptance) {
         $response = GeoClass::checkLocationTerms($usingIp, $usingEmail);
         if (!$response) {
            return [false, "user rejected storing data"];
         }
      }
      if ($usingEmail) {
         $email = GeoClass::encryptText($usingEmail);
      } else {
         // No email provided;
         $email = false;
      }


      $sitelocation = $_SERVER['REQUEST_URI'];
      // Unique table by IP per session is added to the location table
      // Might also want to consider adding a by-ipv6 Address table.
      if (!isset($_SESSION['IP_DATA'])) {
         $query = "INSERT INTO location  (ip, encrypted_user, accepted_terms, time_inserted, city, region_code, continent_name, country_name, country_code, postal, longitude, latitude, iplookup, sitelocation) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ";
         $unique_interactions = \DBClasses::querySQL($query, [$ip, $email, true, time(), $loc->city, $loc->region_code, $loc->continent_name, $loc->country_name, $loc->country_code, $loc->postal, $loc->longitude, $loc->latitude, true, $sitelocation], 'insert');
         if ($unique_interactions[0] === 0) {
            return [false];
         }
      } else if (!$addToUniqueOnly) {
         // Table that includes all interactions by page - this is for analytics and not queries.
         $query = "INSERT INTO `vibrant_location_by_page`  (ip, encrypted_user, accepted_terms, time_inserted, city, region_code, continent_name, country_name, country_code, postal, longitude, latitude, iplookup, sitelocation) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ";
         $all_interactions = \DBClasses::querySQL($query, [$ip, $email, true, time(), $loc->city, $loc->region_code, $loc->continent_name, $loc->country_name, $loc->country_code, $loc->postal, $loc->longitude, $loc->latitude, true, $sitelocation], 'insert');
         return $all_interactions;
      } else {
         return [false];
      }


      $resArray = [];
      try {
         // Add this data to the session.
         $resArray['region'] = $loc->region;
         $resArray['region_code'] = $loc->region_code;
         $resArray['continent_name'] = $loc->continent_name;
         $resArray['continent_code'] = $loc->continent_code;
         $resArray['country_name'] = $loc->country_name;
         $resArray['country_code'] = $loc->country_code;
         $resArray['postal'] = $loc->postal;
         $resArray['city'] = $loc->city;
         $resArray['is_eu'] = $loc->is_eu;
      } catch (Exception $e) {
         return [false, $e];
      }
      try {
         $_SESSION['IP_DATA'][2] = $resArray;
      } catch (Exception $e) {
         return [false, $e];
      }
      return [true, $unique_interactions];
   }

   /**
    * @author Duncan Pierce <devduncanrocks@gmail.com> <github.com/sigkar>
    * @params {string} $string
    * @returns {string} anonymous (encrypted)
    */
   protected static function encryptText($string)
   {

      return crypt($string, '$6$rounds=5000$' . GeoClass::$SALT . '$');
   }
}
