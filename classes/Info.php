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

    public static function getAll()
    {
        return Info::$allinfo;
    }

    public static function file_name($identifier)
    {

        $info = Info::get($identifier);

        return $info['file'];
    }

}