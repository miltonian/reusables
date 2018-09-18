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

    public static function setBucket( $bucket )
    {
      AWSClass::$bucket = $bucket;
    }

    public static function setKeyName( $keyname )
    {
      //*** Your Object Key ***
      AWSClass::$keyname = $keyname;
    }

    public static function setRegion( $region )
    {
      AWSClass::$region = $region;

      if( $region == '' ) {
        return;
      }

      AWSClass::$s3 = new S3Client([
          'version' => 'latest',
          'region'  => $region
      ]);
    }

    public static function is_set()
    {
      if( AWSClass::$bucket == '' || AWSClass::$keyname == '' || AWSClass::$region == '' ) {
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
      }

      // Prepare the upload parameters.
      // $uploader = new MultipartUploader(AWSClass::$s3, $file, [
      //     'bucket' => AWSClass::$bucket,
      //     'key'    => AWSClass::$keyname
      // ]);

      // Perform the upload.
      try {
          // $result = $uploader->upload();
          // echo "Upload complete: {$result['ObjectURL']}" . PHP_EOL;
          $result = AWSClass::$s3->upload(AWSClass::$bucket, Media::createFileName( $file ), fopen($file['tmp_name'], 'rb'), 'public-read');

          return $result['ObjectURL'];
      } catch (MultipartUploadException $e) {
          exit(json_encode( $e->getMessage() . PHP_EOL ) );
      }
    }

}
