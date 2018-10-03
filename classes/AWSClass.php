<?php

/*
TO USE AWS S3

Type in terminal from the root of your project: composer require aws/aws-sdk-php

*/


namespace Reusables;

use \Aws\S3\S3Client;
use \Aws\S3\Exception\S3Exception;
use \Aws\S3\MultipartUploader;
use \Aws\Exception\MultipartUploadException;


class AWSClass {

    public static $bucket = '';
    public static $keyname = '';
    public static $region = ''; //'us-east-1'
    public static $s3;
    public static $AWS_ACCESS_KEY_ID = '';
    public static $AWS_SECRET_ACCESS_KEY = '';

    public static function setBucket( $bucket )
    {
      AWSClass::$bucket = $bucket;
    }

    public static function setKeyName( $keyname )
    {
      //*** Your Object Key ***
      AWSClass::$keyname = $keyname;
    }

    public static function setAccessKey( $AWS_ACCESS_KEY_ID )
    {
      //*** Your Object Key ***
      AWSClass::$AWS_ACCESS_KEY_ID = $AWS_ACCESS_KEY_ID;
    }

    public static function setSecretKey( $AWS_SECRET_ACCESS_KEY )
    {
      //*** Your Object Key ***
      AWSClass::$AWS_SECRET_ACCESS_KEY = $AWS_SECRET_ACCESS_KEY;
    }

    public static function setRegion( $region )
    {
      AWSClass::$region = $region;

      if( $region == '' ) {
        return;
      }

      // Instantiate the S3 client with your AWS credentials
      // $s3Client = S3Client::factory(array(
      //     'credentials' => array(
      //         'key'    => AWSClass::$AWS_ACCESS_KEY_ID,
      //         'secret' => AWSClass::$AWS_SECRET_ACCESS_KEY,
      //     )
      // ));
      AWSClass::$s3 = new S3Client([
          'version' => 'latest',
          'region'  => $region,
          'key'    => AWSClass::$AWS_ACCESS_KEY_ID,
          'secret' => AWSClass::$AWS_SECRET_ACCESS_KEY,
      ]);
    }

    public static function is_set()
    {
      if( AWSClass::$bucket == '' || AWSClass::$keyname == '' || AWSClass::$region == '' || AWSClass::$AWS_ACCESS_KEY_ID == '' || AWSClass::$AWS_SECRET_ACCESS_KEY == '' ) {
        return false;
      }
      return true;
    }

    public static function upload( $file )
    {

      if( AWSClass::$bucket == "" ) {
        exit("missing s3 bucket");
      } else if( AWSClass::$keyname == "" ) {
        exit("missing s3 keyname");
      } else if ( AWSClass::$region == "" ) {
        exit("missing s3 region");
      } else if ( AWSClass::$AWS_ACCESS_KEY_ID == "" ) {
        exit("missing AWS_ACCESS_KEY_ID");
      } else if ( AWSClass::$AWS_SECRET_ACCESS_KEY == "" ) {
        exit("missing AWS_SECRET_ACCESS_KEY");
      }

      // Perform the upload.
      try {
          $result = AWSClass::$s3->upload(AWSClass::$bucket, Media::createFileName( $file ), fopen($file['tmp_name'], 'rb'), 'public-read');

          return $result['ObjectURL'];
      } catch (MultipartUploadException $e) {
          exit(json_encode( $e->getMessage() . PHP_EOL ) );
      }
    }

}
