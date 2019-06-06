<?php

namespace Reusables;

class Info {

    protected static $allinfo = array();

    public static function get($identifier)
    {
        if (is_array($identifier)) {
            return null;
        }
        if (!isset(Info::$allinfo[ $identifier ])) {
            return null;
        } else {
            return Info::$allinfo[ $identifier ];
        }
    }

    public static function add($data, $key, $identifier)
    {
        if (!isset(Info::$allinfo[ $identifier ])) {
            Info::$allinfo[ $identifier ] = [];
        }
        Info::$allinfo[ $identifier ][ $key ] = $data;
    }

    public static function addInfo($data, $identifier)
    {
        if (!isset(Info::$allinfo[ $identifier ])) {
  					Info::$allinfo[ $identifier ] = $data;
  			}
    }

    public static function getAll()
    {
        return Info::$allinfo;
    }

    public static function file_name($identifier)
    {

        $info = Info::get($identifier);

        return $info['file'];
    }

    public static function viewtype($identifier)
    {
        $info = Info::get($identifier);
        return $info['viewtype'];
    }

    public static function viewtype_base($identifier)
    {
      return basename(strtolower(Info::viewtype($identifier)));
    }

    public static function fileAbsolutePath($identifier)
    {
        return BASE_DIR . "/vendor/miltonian/" . strtolower(Info::get($identifier)['viewtype']) . "/" . Info::file_name($identifier) . ".php";
    }

    public static function isCustomView($identifier)
    {

        $file = Info::viewtype($identifier);
        $file_parts = explode("/", $file);
        $first_part = $file_parts[0];

        if(strtolower($first_part) == "custom") {
            return true;
        }
        return false;
    }

}
