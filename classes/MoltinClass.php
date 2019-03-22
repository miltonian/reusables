<?php

/*
TO USE Moltin

Type in terminal from the root of your project: composer require moltin/php-sdk

*/

namespace Reusables;

class MoltinClass {

  public static $MOLTIN_CLIENT_ID = '';
  public static $MOLTIN_CLIENT_SECRET = '';
  public static $GRANT_TYPE = '';
  public static $TOKEN = '';
  public static $MOLTIN_ID = '';

  public static $CLIENT;

  public static function setClientID( $MOLTIN_CLIENT_ID )
  {
    MoltinClass::$MOLTIN_CLIENT_ID = $MOLTIN_CLIENT_ID;
  }

  public static function setClientSecret( $MOLTIN_CLIENT_SECRET )
  {
    MoltinClass::$MOLTIN_CLIENT_SECRET = $MOLTIN_CLIENT_SECRET;
  }

  public static function setGrantType( $GRANT_TYPE )
  {
    MoltinClass::$GRANT_TYPE = $GRANT_TYPE;
  }

  public static function is_set()
  {
    if( MoltinClass::$MOLTIN_CLIENT_ID == '' || MoltinClass::$MOLTIN_CLIENT_SECRET == '' || MoltinClass::$GRANT_TYPE == '' || MoltinClass::$TOKEN == '') {
      return false;
    }
    return true;
  }

  public static function setAuthToken()
  {

    MoltinClass::$CLIENT = new \GuzzleHttp\Client();
    $response = MoltinClass::$CLIENT->post('https://api.moltin.com/oauth/access_token', [
      'form_params' => [
        'client_id' => MoltinClass::$MOLTIN_CLIENT_ID,
        'client_secret' => MoltinClass::$MOLTIN_CLIENT_SECRET,
        'grant_type' => MoltinClass::$GRANT_TYPE
      ]
    ]);
    $formatted_response = $response->getBody()->getContents();
    $formatted_response = json_decode($formatted_response);
    $token =  $formatted_response->access_token;

    MoltinClass::$TOKEN = $token;

    return $token;
  }

  public static function createCustomer($first_name, $last_name, $email)
  {

    if(MoltinClass::is_set() == false) {
      return;
    }

    $json = '{"data": {"type": "customer","name": "' . $first_name . ' ' . $last_name . '","email": "' . $email . '"}}';
    $response = MoltinClass::$CLIENT->post('https://api.moltin.com/v2/customers', [
      'headers' => [
        'Authorization' => 'Bearer ' . MoltinClass::$TOKEN,
        'Content-Type' => 'application/json',
      ],
      'body' => $json,
    ]);
    $formatted_response = $response->getBody()->getContents();
    $formatted_response = json_decode($formatted_response);
    $moltin_id = $formatted_response->data->id;

    MoltinClass::$MOLTIN_ID = $moltin_id;

    return $moltin_id;
  }

}
