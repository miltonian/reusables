<?php

namespace Reusables;

class Convert
{
    public static function keys($data, $identifier=null)
    {
        $testing=false;
        if (!$identifier) {
            $identifier = Data::getDefaultDataID($data);
        } else {
            $testing=true;
        }
        if ($testing) {
            exit(json_encode($data));
        }
        // exit( json_encode( $identifier ) );
        // $data = Data::get( $identifier );
        $options = Options::get($identifier);
        // exit( json_encode( $data ) );
        $convertkeys = Data::getValue($options, 'convert_keys');
        if ($convertkeys == "") {
            return $data;
        }
        if (!isset($convertkeys)) {
            $convertkeys = false;
        } else {
            $convertkeys = $convertkeys;
        }
        $convertdict = $data;
        if (isset($data['value'])) {
            $convertdict = $data['value'];
        }

        $sectionkeys = array_keys($convertdict);
        foreach ($sectionkeys as $k) {
            $k_no_table = $k;
            $k_arr = explode(".", $k);
            if (sizeof($k_arr) == 2) {
                $k_no_table = $k_arr[1];
            }
            // exit( json_encode( $convertkeys ) );
            // if( isset( $convertkeys[$k] ) ){ $convertdict[$convertkeys[$k]] = $convertdict[$k]; }
            if (isset($convertkeys[$k_no_table])) {
                if (is_array($convertkeys[$k_no_table])) {
                    foreach ($convertkeys[$k_no_table] as $ck) {
                        $convertdict[$ck] = $convertdict[$k];
                    }
                } else {
                    $convertdict[$convertkeys[$k_no_table]] = $convertdict[$k];
                }
            }
        }

        if (isset($data['value'])) {
            $data['value'] = $convertdict;
        } else {
            $data = $convertdict;
        }

        return $data;
    }

    public static function keysInTable($identifier, $post)
    {
        $data = Data::get($identifier);
        $options = Options::get($identifier);

        if (!isset($options['convert_keys'])) {
            $convertkeys = false;
        } else {
            $convertkeys = $options['convert_keys'];
        }

        $postkeys = array_keys($post);

        foreach ($postkeys as $k) {
            $k_no_table = $k;
            $k_arr = explode(".", $k);
            if (sizeof($k_arr) == 2) {
                $k_no_table = $k_arr[1];
            }
            if (isset($convertkeys[$k_no_table])) {
                if (is_array($convertkeys[$k_no_table])) {
                    foreach ($convertkeys[$k_no_table] as $ck) {
                        $post[$ck] = $post[$k];
                    }
                } else {
                    // exit( json_encode($post[$k]));
                    $post[$convertkeys[$k_no_table]] = $post[$k];
                }
                // $post[$convertkeys[$k] ]['key'] = $convertkeys[$k];
            }
        }

        return $post;
    }

    public static function convertDataForArray($identifier, $index)
    {
        $dict = self::retrieveDataWithID($identifier)['value'][$index];

        $allkeys = array_keys($dict);
        $returningdict = [];
        foreach ($allkeys as $k) {
            $returningdict[$k] = [ "data_id"=>$identifier, "key"=>$k, "index"=>$index ];
        }
        $returningdict['index'] = $index;

        return $returningdict;
    }

    public static function viewParamsToVars($identifier)
    {
        // Get view data, options, and tablename
        $viewdict = Data::get($identifier);
        $viewoptions = Options::get($identifier);
        $tablename = Data::getDefaultTableNameWithID($identifier);

        // Get the view's unformatted data array
        $unformatted_arr = Data::getUnformatted($identifier);

        // Get the links
        $links = Data::getValue($viewoptions, "links");

        $viewvalues = [];
        foreach ($unformatted_arr as $key => $value) {

            $dict = Convert::keysInTable($identifier, $value);

            $linkpath = View::getFullLink($identifier, $dict);
            $title = Preview::title($identifier, $dict);

            if (Preview::isTrue($identifier)) {
                $description = Preview::description($identifier, $dict);
            } else {
                $description = Text::limitDescription($identifier, $dict);
            }

            if ($title != "") {
                $dict['title'] = $title;
            }
            if ($description != "") {
                $dict['description'] = $description;
                $dict['html_text'] = $description;
            }
            $dict['linkpath'] = $linkpath;

            array_push($viewvalues, $dict);
        }
        if (!isset($linkpath)) {
            $linkpath = "#";
        }

        $text_color = Data::getValue($viewoptions, "text_color");
        $background_color = Data::getValue($viewoptions, "background_color");
        $padding_arr = Views::getPaddingOrMargin($identifier);
        $padding = $padding_arr[0];
        $padding_width = $padding_arr[1];
        $margin_arr = Views::getPaddingOrMargin($identifier, "margin");
        $margin = $margin_arr[0];
        $margin_width = $margin_arr[1];

        return [
            "viewvalues" => $viewvalues,
            "linkpath" => $linkpath,
            "data_id" => $identifier,
            "text_color" => $text_color,
            "background_color" => $background_color,
            "padding" => $padding,
            "padding_width" => $padding_width,
            "margin" => $margin,
            "margin_width" => $margin_width,
            "links" => $links,
        ];
    }
}
