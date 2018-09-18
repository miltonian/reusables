<?php

namespace Reusables;

class Text {

    public static function limit($text, $limit="")
    {
        if ($limit != "") {
            if ($text != "") {
                $text = Shortcuts::substrwords($text, intval($limit));
            }
        }

        return $text;
    }

    public static function limitDescription($identifier, $dict=null)
    {

        if($dict == null){
            $dict = Data::get($identifier);
        }
        $viewoptions = Options::get($identifier);

        $description = View::getDescription($identifier, $dict);
        $limit = Data::getValue($viewoptions, "description_limit", $identifier);

        if ($limit != "") {
            if ($description != "") {
                $description = Shortcuts::substrwords($description, intval($limit));
            }
        }

        return $description;
    }

}