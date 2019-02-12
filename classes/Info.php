<?php

namespace Reusables;

class Info {

    protected static $allinfo = array();

    // Info::get() get info for a certain view
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

    // Info::add() add info to identifier
    public static function add($data, $key, $identifier)
    {
        if (!isset(Info::$allinfo[ $identifier ])) {
            Info::$allinfo[ $identifier ] = [];
        }
        Info::$allinfo[ $identifier ][ $key ] = $data;
    }

    // Info::getAll() get all info that is currently stored
    public static function getAll()
    {
        return Info::$allinfo;
    }

    // Info::file_name() gets the view name
    public static function file_name($identifier)
    {

        $info = Info::get($identifier);

        return $info['file'];
    }

    // Info::viewtype() gets the viewtype with either custom, vibrant, or reusable as a precursor
    public static function viewtype($identifier)
    {
        $info = Info::get($identifier);
        return $info['viewtype'];
    }

    // Info::viewtype_base() gets the basename of the viewtype
    public static function viewtype_base($identifier)
    {
      return basename(strtolower(Info::viewtype($identifier)));
    }

    // Info::fileAbsolutePath() gets absolutepath of view
    public static function fileAbsolutePath($identifier)
    {
        return BASE_DIR . "/vendor/miltonian/" . strtolower(Info::get($identifier)['viewtype']) . "/" . Info::file_name($identifier) . ".php";
    }

    // Info::isCustomView() checks to see if the view is custom or not
    // returns a boolean
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
