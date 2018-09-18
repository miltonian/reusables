<?php

namespace Reusables;

class Translate
{
    public static function getViewLinkPath($identifier)
    {
        $data = Data::get($identifier);
        $options = Options::get($identifier);

        $linkpath = "";
        $linkpath .= Data::getValue($options, 'pre_slug');
        $optionalslug = Data::getValue($options, 'slug');
        if ($optionalslug != "") {
            $linkpath .= $optionalslug;
        } else {
            $linkpath .= Data::getValue($data, 'slug');
        }

        return $linkpath;
    }
}
