<?php

namespace Reusables;

class Preview
{

    public static function isTrue($identifier)
    {
        $viewoptions = Options::get($identifier);
        
        $preview = Data::getValue($viewoptions, "preview", $identifier);

        if ($preview == "true" || $preview) {
            return true;
        } 
        
        return false;
    }
    
    public static function title($identifier, $dict=null)
    {
        
        if($dict == null){
            $dict = Data::get($identifier);
        }

        $viewoptions = Options::get($identifier);

        $title = Data::getValue($dict, "title", $identifier);
        $limit = Data::getValue($viewoptions, "title_limit");
        if ($limit != "" && $title != "") {
            $title = Shortcuts::substrwords($title, intval($limit));
        }

        return $title;
    }

    public static function description($identifier, $dict=null)
    {

        if($dict == null){
            $dict = Data::get($identifier);
        }
        $dict = Data::get($identifier);
        $viewoptions = Options::get($identifier);

        $description = View::getDescription($identifier, $dict);
        $limit = Data::getValue($viewoptions, "description_limit", $identifier);

        $description = trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($description))))));
        if ($limit == "") {
            $limit = 300;
        } else {
            $limit = intval($limit);
        }
        if ($description != "") {
            $description = Shortcuts::substrwords($description, $limit);
        }

        return $description;
    }

}
