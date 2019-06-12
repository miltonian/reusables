<?php

namespace Reusables;

class Media
{
    public static $base = BASE_DIR;
    public static $uploads = "vendor/miltonian/custom/uploads/";
    public static $uploads_relative = "vendor/miltonian/custom/uploads/";

    public static function setBase($base="")
    {
        if ($base == "") {
            Media::$base = BASE_DIR;
        }

        Media::$base = $base;
    }

    public static function setUploadsDir($dir="")
    {
        if ($dir == "") {
          if( Media::$uploads == Media::$uploads_relative ) {
            Media::$uploads = rtrim(Media::$base, '/') . '/' . Media::$uploads_relative;
            return;
          } else {
            return;
          }
        }
        Media::$uploads_relative = $dir;
        Media::$uploads = Media::$base . $dir;
    }

    public static function base()
    {
        return Media::$base;
    }

    public static function uploadsDir()
    {
        return Media::$uploads;
    }

    public static function uploadsRelative()
    {
        return Media::$uploads_relative;
    }

    public static function uploadImage($file)
    {
        Media::setUploadsDir();
        if (AWSClass::is_set()) {
            return AWSClass::upload( $file );
        } else {
            return Media::uploadImageToLocalDir($file);
        }
    }

    public static function uploadImageToLocalDir($file)
    {

        $allowedImageExts = array("jpg", "jpeg", "gif", "png");
        $allowedVideoExts = array("mp3", "mp4", "wma", "m4v", "mov", "wmv", "avi", "mpg", "ogv", "3gp", "3g2");
        $allowedExts = array("jpg", "jpeg", "gif", "png", "mp3", "mp4", "wma", "m4v", "mov", "wmv", "avi", "mpg", "ogv", "3gp", "3g2");
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);

        $extension = strtolower($extension);


        $uploadOk = 0;

        if ($file['name'] != null && $file['name'] != "") {
            if (($file["size"] < 20000000) && in_array($extension, $allowedExts)) {
                $newname = time()."_".$file["name"];
                $newname = str_replace(" ", "_", $newname);
                if ($file["error"] > 0) {
                } else {
                    if (file_exists(Media::$uploads . $newname)) {
                        $uploadOk = 0;
                    } else {
                        move_uploaded_file($file["tmp_name"], Media::$uploads . $newname);
                        if (filesize(Media::$uploads . $newname) > 3000000) {
                            // $scalefactor = round(100*(3000000 / filesize( BASE_DIR . "/vendor/miltonian/custom/uploads/" . $newname)));
                                // $result = self::convertImage( BASE_DIR . '/vendor/miltonian/custom/uploads/' . $newname, BASE_DIR . '/vendor/miltonian/custom/uploads/thumbs_small/' . $newname, $scalefactor);
                        } else {
                            // $result = Shortcuts::convertImage( '../../custom/uploads/' . $newname, '../../custom/uploads/thumbs_small/' . $newname, 100);
                                // exit( json_encode( [ "result" => [ "1" ] ] ) );
                        }
                        $uploadOk = 1;
                    }
                }
            } else {
                $uploadOk = 0;
            }
            if ($uploadOk != 0) {
                $mediapathname = $newname;
                $imagepath = Media::$uploads_relative . $mediapathname;
                return $imagepath;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function createFileName( $file )
    {

      $newname = time()."_".$file["name"];
      $newname = str_replace(" ", "_", $newname);

      return Media::$uploads_relative . $newname;
    }

    public static function convertImage($originalImage, $outputImage, $quality)
    {
        // jpg, png, gif or bmp?
        //exit("hello");
        $exploded = explode('.', $originalImage);
        $ext = $exploded[count($exploded) - 1];

        if (preg_match('/jpg|jpeg/i', $ext)) {
            $imageTmp=imagecreatefromjpeg($originalImage);
            exit(json_encode(["result"=>[$originalImage] ]));
        } elseif (preg_match('/png/i', $ext)) {
            $imageTmp=imagecreatefrompng($originalImage);
        } elseif (preg_match('/gif/i', $ext)) {
            $imageTmp=imagecreatefromgif($originalImage);
        } elseif (preg_match('/bmp/i', $ext)) {
            $imageTmp=imagecreatefrombmp($originalImage);
        } else {
            return 0;
        }
        // quality is a value from 0 (worst) to 100 (best)
        imagejpeg($imageTmp, $outputImage, $quality);
        imagedestroy($imageTmp);

        return 1;
    }




    public static function uploadFilesMultiple($filesarray_multiple, $indexes, $index, $imagepath)
    {

      if( isset($filesarray_multiple[$indexes[$index]]) ) {
				if( sizeof($filesarray_multiple[$indexes[$index]]) > 0 ) {

					$imagepath_array = [];
					// $current_imagepath
					$current_imagepaths = [];
					if( isset($current_imagepath) ) {
						$current_imagepaths = explode(",", $current_imagepath);
						$current_imagepaths[0] = $imagepath;
						$imagepaths_index = 1;
						foreach ($filesarray_multiple[$indexes[$index]] as $file) {
							if( isset($file['name']) ) {
								if( isset($images_names[$file['name']]) ) {
									break;
								} else {
									$images_names[$file['name']] = true;
								}
							}
							if( isset($file['name']) ) {
								$current_imagepaths[$imagepaths_index] = Media::uploadImage( $file );
							} else if( isset($current_imagepaths[$imagepaths_index]) ) {
								$current_imagepaths[$imagepaths_index] = $current_imagepaths[$imagepaths_index];
							}
							$imagepaths_index++;
						}
					}


					// $imagepath = "";
					$imagepaths_index=0;
					foreach ($current_imagepaths as $image) {

						if( $imagepaths_index > 0 ) {
							$imagepath .= ",";
						}
						$imagepath .= $image;
						$imagepaths_index++;
					}
				}
			}
      return [
        "imagepath" => $imagepath,
        "current_imagepaths" => $current_imagepaths
      ];
    }



    public static function uploadFieldImage( $files, $file, $indexes, $index, $fieldimages, $filesarray_multiple )
    {

  		$images_names = [];
  		if( $files['fieldimage']['name'][$indexes[$index]]['field_value'] != "" ) {

  			// upload this file and get the path
  			$imagepath = Media::uploadImage( $file );
  			// skip this
  			$uploadfilemultiple_result = Media::uploadFilesMultiple($filesarray_multiple, $indexes, $index, $imagepath);
  			$imagepath = $uploadfilemultiple_result['imagepath'];

  			$current_imagepaths = $uploadfilemultiple_result['current_imagepaths'];

  			// add file path to fieldimages array
  			$fieldimages[$indexes[$index]]['field_value'] = $imagepath;
  		} else {

  			// there is no file to upload
  			$imagepath = "";

  			// skip this
  			$uploadfilemultiple_result = Media::uploadFilesMultiple($filesarray_multiple, $indexes, $index, $imagepath);
  			$imagepath = $uploadfilemultiple_result['imagepath'];
  			$current_imagepaths = $uploadfilemultiple_result['current_imagepaths'];

  			// add file path to fieldimages array
  			$fieldimages[$indexes[$index]]['field_value'] = $imagepath;
  		}

      return $fieldimages;
    }
}
