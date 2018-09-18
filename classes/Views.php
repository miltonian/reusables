<?php

namespace Reusables;

class Views
{
    protected static $viewidentifiers = [];
    protected static $viewparams = [];

    protected static $bufferedviews = [];

    protected static $bufferedforms = [];
    protected static $queue = [];
    protected static $formqueue = [];

    protected static $analyze = false;

    public static function setDefaultViewInfo($file, $identifier, $viewtype, $tablenames = [], $children = [])
    {
        $viewoptions = Options::get($identifier);
        Views::addEditableParts($identifier);
        // exit( json_encode( $viewtype ) );
        $dict = [
            "file" => $file,
            "identifier" => $identifier,
            "viewtype" => $viewtype,
            "tablenames" => $tablenames,
            "children" => $children,
        ];

        // if( strtolower($viewtype) == "section" && ($file == "smartform_inmodal" || $file == "smartform") ) {
        //     array_push( self::$bufferedforms, $dict );
        // } else {
        array_push(self::$bufferedviews, $dict);
        // }
    }

    public static function addEditableParts($identifier)
    {
        if (!empty($viewoptions['editable']) && !empty($viewoptions['insertonly']) && !empty($viewoptions['editable_dynamic']) && !empty($viewoptions['insertonly_dynamic'])) {
            if (isset($_SESSION['login'][0])) {
                if ($_SESSION['login'][0] == 1) {
                    Options::add(true, "editable", $identifier);
                }
            }
        }

        $viewoptions = Options::get($identifier);
        // $viewinfo = Info::get( $identifier );
        $viewinfo = Info::get($identifier);

        if (isset($viewoptions["editable"]) || isset($viewoptions["insertonly"]) || isset($viewoptions["editable_dynamic"]) || isset($viewoptions["insertonly_dynamic"])) {
            if (!isset($viewoptions["editable"])) {
                $viewoptions["editable"] = false;
            }
            if (!isset($viewoptions["insertonly"])) {
                $viewoptions["insertonly"] = false;
            }
            if (!isset($viewoptions["editable_dynamic"])) {
                $viewoptions["editable_dynamic"] = false;
            }
            if (!isset($viewoptions["insertonly_dynamic"])) {
                $viewoptions["insertonly_dynamic"] = false;
            }
            if (!isset($viewoptions["modal_table"])) {
                $viewoptions["modal_table"] = false;
            }

            if (
                $viewoptions["editable"] == true || $viewoptions["editable"] == "true" ||
                $viewoptions["insertonly"] == true || $viewoptions["insertonly"] == "true" ||
                $viewoptions["editable_dynamic"] == true || $viewoptions["editable_dynamic"] == "true" ||
                $viewoptions["insertonly_dynamic"] == true || $viewoptions["insertonly_dynamic"] == "true"
            ) {
                $viewdata = Data::get($identifier);

                Options::add("modal", "type", $identifier);
                Options::add($identifier . "_form", "modal", $identifier);

                Options::add("options_modal", "type", $identifier);
                Options::add($identifier . "_options_form", "options_modal", $identifier);
                Options::add("1", "is_option_form", $identifier . "_options_form");

                if ($viewoptions["insertonly"] == true) {
                    if (!isset($viewoptions["tb"])) {
                        exit("insertonly option needs a tablename option as well. the key to pass the tablename is 'tb'");
                    }
                    $tablename = Data::getValue($viewoptions, "tb");
                    Form::prepareInsertOnly($tablename, $identifier . "_form");
                    $formoptions = Options::get($identifier . "_form");
                    if (!isset($formoptions['input_keys'])) {
                        $viewtype = $viewinfo['viewtype'];
                        $filename = $viewinfo['file'];
                        $input_keys = Views::getViewInputs($viewtype, $filename);
                        if ($viewtype == "Table") {
                            $viewtype = "Cell";
                            $filename = $viewoptions['cellname'];
                            if ($filename == "") {
                                $filename = "imagetext_full";
                            }
                            $input_keys = Views::getViewInputs($viewtype, $filename);
                        }
                        Options::add($input_keys, "input_keys", $identifier . "_form");
                    }
                    // Reusables\Form::makeInsertOnly( "customdata_params", "main_button_form" );
                } elseif ($viewoptions["editable_dynamic"] == true) {
                    if (!isset($viewoptions["featured_content_id"])) {
                        exit("editable_dynamic option needs a featured_content_id option as well. the key to pass the featured_content_id is 'featured_content_id'");
                    }
                    if (!isset($viewoptions["form_data"])) {
                        exit("editable_dynamic option needs a form_data option as well. the key to pass the form_data is 'form_data'");
                    }
                    $user_id = 0;
                    if (isset($viewoptions["user_id"])) {
                        $user_id = $viewoptions["user_id"];
                    }
                    // exit( json_encode( $viewoptions["featured_content_id"] ) );
                    Form::makeDynamic($viewoptions['form_data'], $viewoptions["featured_content_id"], $identifier . "_form", $user_id);
                } elseif ($viewoptions["insertonly_dynamic"] == true) {
                    if (!isset($viewoptions["featured_content_id"])) {
                        exit("insertonly_dynamic option needs a featured_content_id option as well. the key to pass the featured_content_id is 'featured_content_id'");
                    }
                    $user_id = 0;
                    if (isset($viewoptions["user_id"])) {
                        $user_id = $viewoptions["user_id"];
                    }
                    Form::makeDynamicInsertOnly($viewoptions["featured_content_id"], $identifier . "_form", $user_id);
                } else {
                    if ($viewoptions["modal_table"] == true) {
                        if (!isset($viewoptions["modal_table_array"])) {
                            exit("missing modal_table_array");
                        }
                        Data::add($viewoptions['modal_table_array'], $identifier . "_form");
                    }
                    $formdata = Data::get($identifier . "_form");
                    if (!isset($formdata)) {
                        Data::add($viewdata, $identifier . "_form");
                    }

                    $formoptions = Options::get($identifier . "_form");
                    $options_formoptions = Options::get($identifier . "_options_form");
                    if (!isset($formoptions['input_keys'])) {
                        $viewtype = $viewinfo['viewtype'];
                        $filename = $viewinfo['file'];
                        $input_keys = Views::getViewInputs($viewtype, $filename);
                        if ($viewtype == "Table") {
                            $viewtype = "Cell";
                            if (!isset($viewoptions['cellname'])) {
                                $viewoptions['cellname'] = "";
                            }
                            $filename = $viewoptions['cellname'];
                            if ($filename == "") {
                                $filename = "imagetext_full";
                            }
                            $input_keys = Views::getViewInputs($viewtype, $filename);
                        }
                        Options::add($input_keys, "input_keys", $identifier . "_form");
                    }
                    // if( !isset($formoptions['input_keys']) ) {//asdfasdf

                    $text_color = Data::getValue($viewoptions, "text_color");
                    $background_color = Data::getValue($viewoptions, "background_color");
                    $image_size = Data::getValue($viewoptions, "image_size");
                    $image_corner_radius = Data::getValue($viewoptions, "image_corner_radius");
                    $text_align = Data::getValue($viewoptions, "text_align");
                    $title_size = Data::getValue($viewoptions, "title_size");
                    $subtitle_size = Data::getValue($viewoptions, "subtitle_size");
                    $description_size = Data::getValue($viewoptions, "description_size");
                    $title_color = Data::getValue($viewoptions, "title_color");
                    $subtitle_color = Data::getValue($viewoptions, "subtitle_color");
                    $description_color = Data::getValue($viewoptions, "description_color");
                    $text_offset_x = Data::getValue($viewoptions, "text_offset_x");
                    $text_offset_y = Data::getValue($viewoptions, "text_offset_y");
                    $editable_options = [
                        "identifier" /*, "view"*/, "number_of_columns", "data_type", "text_color", "padding", "margin", "background_color", "image_size", "image_corner_radius",
                        "text_align", "title_size", "subtitle_size", "description_size", "title_color",
                        "subtitle_color", "description_color", "text_offset_x", "text_offset_y", "overlay", "reverse",
                    ];
                    $input_keys = [];
                    foreach ($editable_options as $editable_option) {
                        if ($editable_option == "identifier") {
                            $input_keys[$editable_option] = ["type" => "hidden", "field_value" => $identifier];
                        } elseif ($editable_option == "view") {
                            // exit(json_encode(Data::getValue( $viewoptions, $editable_option )));
                            $input_keys[$editable_option] = ["type" => "select", "field_value" => Data::getValue($viewoptions, $editable_option), "options" => [["title" => "custom/section/imagetext_full", "value" => "custom/section/imagetext_full"], ["title" => "custom/section/imagetext_inline", "value" => "custom/section/imagetext_inline"], ["title" => "custom/section/imagetext_inside", "value" => "custom/section/imagetext_inside"]]];
                        } else {
                            $input_keys[$editable_option] = ["type" => "textfield", "field_value" => Data::getValue($viewoptions, $editable_option), "field_name" => $editable_option];
                        }
                    }

                    Options::add($input_keys, "input_keys", $identifier . "_options_form");
                    // }
                }
                $formoptions = Options::get($identifier . "_form");
                $goto = Data::getValue($formoptions, "goto");
                if ($goto == "") {
                    $redirecturl = "/";
                    if (isset($_SERVER['REDIRECT_URL'])) {
                        $redirecturl = $_SERVER['REDIRECT_URL'];
                    }
                    // exit( json_encode( $redirecturl ) );
                    Options::add($redirecturl, "goto", $identifier . "_form");
                }
                if ($viewoptions["modal_table"] == true) {
                    Options::add("/functions/change_featuredpost?featured_id=[[FEATURED_ID]]&post_id=", "pre_slug", $identifier . "_form");
                    Options::add(["id" => "slug"], "convert_keys", $identifier . "_form");
                    Options::add("table", "modal_type", $identifier);
                    $form_dict = [
                        "file" => "table",
                        "identifier" => $identifier . "_form",
                        "viewtype" => "modal",
                        "tablenames" => [],
                        "children" => [],
                    ];
                } else {
                    $form_dict = [
                        "file" => "smartform_inmodal",
                        "identifier" => $identifier . "_form",
                        "viewtype" => "section",
                        "tablenames" => [],
                        "children" => [],
                    ];
                }
                $options_form_dict = [
                    "file" => "smartform_inmodal",
                    "identifier" => $identifier . "_options_form",
                    "viewtype" => "section",
                    "tablenames" => [],
                    "children" => [],
                ];
                array_push(self::$bufferedviews, $form_dict);
                array_push(self::$bufferedviews, $options_form_dict);
            }
        }
    }

    // Views::makeView() creates a View object and sets its parameters
    public static function makeView($file, $identifier, $viewtype, $tablenames = [], $children = [])
    {
        Views::analyzeViewInputs($identifier);

        if ($viewtype == "wrapper" && $file != "wrapper_start" && $file != "wrapper_end") {

            // Wrappers & Structures are a little different from the other view types, so they have their own function for creating a View object and setting its parameters
            $View = Wrapper::amalgamate($file, $identifier, $viewtype, $tablenames, $children);
        } elseif ($viewtype == "structure") {

            // Wrappers & Structures are a little different from the other view types, so they have their own function for creating a View object and setting its parameters
            $View = Structure::amalgamate($file, $identifier, $viewtype, $tablenames, $children);
        } else {

            // Queue the file to add necessary assets
            Page::addAssetFile($viewtype, $file);

            $lowercased_viewtype = strtolower($viewtype);

            // Create the View object
            if (substr($lowercased_viewtype, 0, strlen("custom")) === "custom") {
                $arr = explode("/", $viewtype);
                $viewtype = $arr[1];
                $View = View::factory(Page::$customdir . $viewtype . '/' . $file);
            } else {
                $View = View::factory('reusables/views/' . $viewtype . '/' . $file);
            }

            // Get the view's data and options
            $data = Data::get($identifier);
            $options = Options::get($identifier);

            // This is custom code and will be removed soon
            $data = Views::makeViewIfCustom($file, $identifier, $viewtype, $tablenames, $children);

            // Converts action keys from $options into a Reusable readable format
            $options = RFormat::convertViewActions($options);

            // Set the View object's parameters
            $View->set('viewdict', $data);
            $View->set('viewoptions', $options);
            if ($viewtype == "section") {
                $View->set('tablenames', $tablenames);
            }
            $View->set('identifier', $identifier);
        }

        // Queue the view's identifier
        array_push(self::$viewidentifiers, $identifier);

        // Render the View object to a string then return it
        return $View->render();
    }

    public static function makeViewIfCustom($file, $identifier, $viewtype, $tablenames = [], $children = [])
    {
        $data = Data::get($identifier);
        $options = Options::get($identifier);

        if ($identifier == "program_form") {
            if (isset($options['input_keys'])) {
                $input_keys = $options['input_keys'];
                foreach ($input_keys as $key => $value) {
                    if (is_array($value)) {
                        $field_value = "";
                        $arraykeys = array_keys($value);

                        foreach ($arraykeys as $ak) {
                            if ($ak == "field_value") {
                                $field_value = $value['field_value'];
                                if (isset($data['value'])) {
                                    if (isset($data['value'][$key])) {
                                        $data['value'][$key] = $field_value;
                                    }
                                } else {
                                    if (isset($data[$key])) {
                                        $data[$key] = $field_value;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        Data::add($data, $identifier);
        return $data;
    }

    // Views::makeViews() loops through each buffered view, creates the View object and sets its parameters
    public static function makeViews()
    {
        // Start buffer
        ob_start();

        foreach (self::$bufferedviews as $dict) {
            $viewtype = $dict["viewtype"];
            if ($viewtype == "CustomCode") {
                // This is custom code so you only need to echo it
                echo $dict["code"];
            } else {
                $file = $dict["file"];
                $identifier = $dict["identifier"];
                $tablenames = $dict["tablenames"];
                $children = $dict["children"];

                // Creates a View object and sets its parameters
                echo Views::makeView($file, $identifier, $viewtype, $tablenames, $children = []);
            }
        }

        // Place body end tag
        echo "</body>";

        // Store and return the buffered contents
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    public static function makeForms()
    {
        exit(json_encode(self::$bufferedforms));
        foreach (self::$bufferedforms as $dict) {
            $viewtype = $dict["viewtype"];
            if ($viewtype == "CustomCode") {
                echo $dict["code"];
            } else {
                $file = $dict["file"];
                $identifier = $dict["identifier"];
                $tablenames = $dict["tablenames"];
                $children = $dict["children"];

                echo Views::makeView($file, $identifier, $viewtype, $tablenames, $children = []);
            }
        }
    }

    public static function addView($identifier)
    {
        array_push(Views::$viewidentifiers, $identifier);
    }

    public static function getViewIdentifiers()
    {
        return self::$viewidentifiers;
    }

    public static function setParams($dataparams, $optionparams, $identifier, $numofrows = 0)
    {
        self::$viewparams[$identifier]['data'] = $dataparams;
        self::$viewparams[$identifier]['options'] = $optionparams;
        self::$viewparams[$identifier]['numofrows'] = $numofrows;
        // Views::analyzeViewInputs( $identifier );
    }

    public static function getDataParams($identifier)
    {
        if (!isset(self::$viewparams[$identifier]['data'])) {
            return [];
        }

        return self::$viewparams[$identifier]['data'];
    }

    public static function getOptionParams($identifier)
    {
        if (!isset(self::$viewparams[$identifier]['options'])) {
            return [];
        }

        return self::$viewparams[$identifier]['options'];
    }

    public static function clearArrays()
    {
        self::$viewidentifiers = null;
        self::$viewparams = null;
        self::$bufferedviews = null;
        self::$bufferedforms = null;

        self::$viewidentifiers = [];
        self::$viewparams = [];
        self::$bufferedviews = [];
        self::$bufferedforms = [];
    }

    public static function analyze($turnOn = false)
    {
        self::$analyze = $turnOn;
    }

    // analyzeViewInputs() Tries to translate view inputs into something the reusable view will understand
    public static function analyzeViewInputs($identifier)
    {
        if (self::$analyze) {
            $data = Data::get($identifier);
            $options = Options::get($identifier);
            $info = Info::get($identifier);
            if (!$info) {
                return;
            }
            // $dataparams = Views::getDataParams( $identifier );
            $viewtype = $info['viewtype'];
            $filename = $info['file'];
            if ($filename == "smartform" || $filename == "smartform_inmodal" || $viewtype == "Modal") {
                return;
            }
            $dataparams = Views::getViewInputs($viewtype, $filename);
            // exit( json_encode( [$dataparams, $viewtype, $filename, $options, $identifier] ) );
            if ($data && $dataparams) {
                // ready to start analyzing
                if (isset($data['value'])) {
                    $data = $data['value'];
                }
                Views::deduct($data, $dataparams, "featured_imagepath", "imagepath", $identifier);
                Views::deduct($data, $dataparams, "name", "title", $identifier);
            }
        }
    }

    public static function deduct($data, $dataparams, $datakey, $paramkey, $identifier)
    {
        $datakey_value = Data::getValue($data, $datakey);
        $paramkey_value = Data::getValue($data, $paramkey);
        if (($datakey_value == "" && $paramkey_value != "") && ($datakey == "featured_imagepath" || $paramkey == "featured_imagepath")) {
            unset($data[$datakey]);
            Data::add($data, $identifier);
            Options::add([$paramkey => $datakey], "convert_keys", $identifier);
        }

        if (isset($data[$paramkey]) && !isset($data[$datakey])) {
            if (isset($dataparams)) {
                if (!is_int(array_search($paramkey, $dataparams)) && is_int(array_search($datakey, $dataparams))) {
                    // suggest convert keys [imagepath=>featured_imagepath]
                    // exit( json_encode( $options ) );
                    Options::add([$paramkey => $datakey], "convert_keys", $identifier);
                }
            }
        } elseif (!isset($data[$paramkey]) && isset($data[$datakey])) {
            if (isset($dataparams)) {
                if (is_int(array_search($paramkey, $dataparams)) && !is_int(array_search($datakey, $dataparams))) {
                    // suggest convert keys [featured_imagepath=>imagepath]
                    Options::add([$datakey => $paramkey], "convert_keys", $identifier);
                }
            }
        } elseif (isset($data[0][$paramkey]) && !isset($data[0][$datakey])) {
            if (isset($dataparams[0])) {
                if (is_array($dataparams[0])) {
                    if (!is_int(array_search($paramkey, $dataparams[0])) && is_int(array_search($datakey, $dataparams[0]))) {
                        // suggest convert keys [imagepath=>featured_imagepath]
                        // exit( json_encode( $identifier ) );
                        Options::add([$paramkey => $datakey], "convert_keys", $identifier);
                    }
                }
            }
        } elseif (!isset($data[0][$paramkey]) && isset($data[0][$datakey])) {
            if (isset($dataparams[0])) {
                if (is_array($dataparams[0])) {
                    if (is_int(array_search($paramkey, $dataparams[0])) && !is_int(array_search($datakey, $dataparams[0]))) {
                        // suggest convert keys [featured_imagepath=>imagepath]
                        Options::add([$datakey => $paramkey], "convert_keys", $identifier);
                    }
                }
            }
        }

        // if( isset( $data[$paramkey] ) && !isset( $data[$datakey] ) ) {
        //     if( !is_int( array_search($paramkey, $dataparams) ) && is_int( array_search($datakey, $dataparams) ) ) {
        //         // suggest convert keys [imagepath=>featured_imagepath]
        //         // exit("1");
        //         Options::add( [$datakey=>$paramkey], "convert_keys", $identifier );
        //     }
        // }else if( !isset( $data[$paramkey] ) && isset( $data[$datakey] ) ) {
        //     if( is_int( array_search($paramkey, $dataparams) ) && !is_int( array_search($datakey, $dataparams) ) ) {
        //         // suggest convert keys [featured_imagepath=>imagepath]
        //         Options::add( [$datakey=>$paramkey], "convert_keys", $identifier );
        //         // exit("2");
        //     }
        // }else if( isset( $data[0][$paramkey] ) && !isset( $data[0][$datakey] ) ) {
        //     if( !is_int( array_search($paramkey, $dataparams[0]) ) && is_int( array_search($datakey, $dataparams[0]) ) ) {
        //         // suggest convert keys [imagepath=>featured_imagepath]
        //         Options::add( [$datakey=>$paramkey], "convert_keys", $identifier );
        //         // exit("3");
        //     }
        // }else if( !isset( $data[0][$paramkey] ) && isset( $data[0][$datakey] ) ) {
        //     if( is_int( array_search($paramkey, $dataparams[0]) ) && !is_int( array_search($datakey, $dataparams[0]) ) ) {
        //         // suggest convert keys [featured_imagepath=>imagepath]
        //         // exit("4");
        //     }
        // }
    }

    public static function addToQueue($viewtype, $file, $identifier, $data = [])
    {
        Info::add($viewtype, 'viewtype', $identifier);
        Info::add($file, 'file', $identifier);
        Info::add($identifier, 'identifier', $identifier);

        // if( $viewtype == "Section" && ($file == "smartform_inmodal" || $file == "smartform") ) {
        //     array_push(
        //         self::$formqueue,
        //         [
        //             "viewtype" => $viewtype,
        //             "file" => $file,
        //             "identifier" => $identifier,
        //             "data"=>$data
        //         ]
        //     );
        // } else {
        // exit( json_encode( [$viewtype, $file, $identifier] ) );
        array_push(
            self::$queue,
            [
                "viewtype" => $viewtype,
                "file" => $file,
                "identifier" => $identifier,
                "data" => $data,
            ]
        );
        // }
    }

    // Loops through each view and combines its data and options to a new View object
    public static function setViews()
    {
        // Loop through view in the queue and add the queued data, options, and info to each one
        // Once the data, options, and info is added to each queued view, add the object to the $bufferedviews
        foreach (Views::$queue as $v) {
            switch ($v["viewtype"]) {
                case 'CustomCode':

                    // Since this is custom code, no need to add anything to it. Just push it to the $bufferedviews
                    array_push(self::$bufferedviews, $v);
                    break;

                case 'Structure':

                    // Adding to the viewtype Structure is slightly different from the rest
                    call_user_func_array("Reusables\\" . $v['viewtype'] . "::set", [$v['file'], $v['data'], $v['identifier']]);
                    break;

                default:

                    // This is a normal view type, so add the data, options, and info
                    $viewtype = $v['viewtype'];
                    $lowercased_viewtype = strtolower($viewtype);
                    if (substr($lowercased_viewtype, 0, strlen("custom")) === "custom") {

                        // This is a custom view type so we use the cset function
                        $arr = explode("/", $viewtype);
                        $viewtype = $arr[1];
                        call_user_func_array("Reusables\\" . $viewtype . "::cset", [$v['file'], $v['identifier']]);
                    } else {

                        // This is a normal view type so we use the set function
                        call_user_func_array("Reusables\\" . $v['viewtype'] . "::set", [$v['file'], $v['identifier']]);
                    }
                    break;
            }
        }
    }

    public static function setForms()
    {
        ob_start();

        foreach (self::$formqueue as $v) {
            if ($v["viewtype"] == "CustomCode") {
                array_push(self::$bufferedviews, $v);
            } elseif ($v["viewtype"] == "Structure") {
                call_user_func_array("Reusables\\" . $v['viewtype'] . "::set", [$v['file'], $v['data'], $v['identifier']]);
            } else {
                call_user_func_array("Reusables\\" . $v['viewtype'] . "::set", [$v['file'], $v['identifier']]);
            }
        }
        Views::makeForms();

        echo "</body>";

        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    public static function addCustomCodeToQueue($code)
    {
        array_push(
            self::$queue,
            [
                "viewtype" => "CustomCode",
                "code" => $code,
            ]
        );
    }

    public static function convertOptionKeys($options_formatted)
    {
        if (isset($options_formatted['value'])) {
            $options_formatted = $options_formatted['value'];
        } else {
            $options_formatted = [];
        }
        $options = [];
        foreach ($options_formatted as $option) {
            $key = Data::getValue($option, 'option_key');
            $value = Data::getValue($option, 'title');
            $identifier = Data::getValue($option, 'identifier');
            $dict = [
                "key" => $key,
                "value" => $value,
                "identifier" => $identifier,
            ];
            array_push($options, $dict);
        }
        return $options;
    }

    public static function getViewInputs($viewtype, $filename)
    {
        $path = BASE_DIR . '/vendor/miltonian/reusables/views/' . $viewtype . '/' . $filename . '.php';
        $searchthis = 'Data::getValue';

        $matches = array();

        $handle = @fopen($path, "r");
        if ($handle) {
            while (!feof($handle)) {
                $buffer = fgets($handle);
                if (strpos($buffer, $searchthis) !== false) {
                    $matches[] = $buffer;
                }
            }
            fclose($handle);
        }

        $input_keys = [];

        foreach ($matches as $str) {
            $fullstring = $str;
            $fullstring = str_replace(" ", '', $fullstring);
            $fullstring = str_replace(',$table_identifier', '', $fullstring);
            $idk = explode('?>', $fullstring);
            $arr = [];
            foreach ($idk as $fullstring) {
                // $fullstring = Views::get_string_between($idkstr, 'Data::getValue($viewdict,', ')');
                // exit( json_encode( ($arr ) ) );
                $parsed = Views::get_string_between($fullstring, 'Data::getValue($viewdict,', ')');
                if (!$parsed) {
                    $parsed = Views::get_string_between($fullstring, ',', ')');
                }
                if (!$parsed) {
                    $parsed = Views::get_string_between($fullstring, 'Data::getValue(', ')');
                }
                $parsed = str_replace('$', '', $parsed);

                if ($parsed) {
                    $parsed = str_replace("'", '', $parsed);
                    $parsed = str_replace('"', '', $parsed);
                    $parsed = str_replace(" ", '', $parsed);
                    $add = true;
                    foreach ($input_keys as $added_string) {
                        if ($parsed == $added_string || $parsed == "value" || $parsed == "") {
                            $add = false;
                            break;
                        }
                    }
                    if ($add) {
                        array_push($input_keys, $parsed);
                    }
                }
            }
        }

        return $input_keys;
    }

    public static function get_string_between($string, $start, $end)
    {
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) {
            return '';
        }
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

    // Views::setUp() is deprecated -- Use Views::prepare() instead
    public static function setUp($identifier)
    {
        return Convert::viewParamsToVars($identifier);
    }

    public static function prepare($file, $identifier)
    {
        $vars = Convert::viewParamsToVars($identifier);
        Style::defaultView($file, $identifier, $vars['viewvalues']);
        return $vars;
    }

    public static function getPaddingOrMargin($identifier, $type = "padding")
    {
        $viewoptions = Options::get($identifier);

        $padding = Data::getValue($viewoptions, $type);
        if ($padding == "") {
            $padding = "0";
        }
        $padding_width = "0";
        // if( $identifier == "structure_left" ) {

        $padding_arr = explode(" ", $padding);
        switch (sizeof($padding_arr)) {
            case 0:
                $padding_width = "0";
                break;
            case 1:
                $padding_width = $padding_arr[0];
                $measurement = "px";
                if (strpos($padding_width, 'px') !== false) {
                    $measurement = "px";
                } elseif (strpos($padding_width, '%') !== false) {
                    $measurement = "%";
                } elseif (strpos($padding_width, 'em') !== false) {
                    $measurement = "em";
                }
                $padding_width = str_replace("px", "", $padding_width);
                $padding_width = str_replace("%", "", $padding_width);
                $padding_width = str_replace("em", "", $padding_width);
                $padding_width = intval($padding_width);
                $padding_width = $padding_width * 2;
                $padding_width = strval($padding_width);
                $padding_width = $padding_width . $measurement;

                break;
            case 2:
                $padding_width = $padding_arr[1];
                $measurement = "px";
                if (strpos($padding_width, 'px') !== false) {
                    $measurement = "px";
                } elseif (strpos($padding_width, '%') !== false) {
                    $measurement = "%";
                } elseif (strpos($padding_width, 'em') !== false) {
                    $measurement = "em";
                }
                $padding_width = str_replace("px", "", $padding_width);
                $padding_width = str_replace("%", "", $padding_width);
                $padding_width = str_replace("em", "", $padding_width);
                $padding_width = intval($padding_width);
                $padding_width = $padding_width * 2;
                $padding_width = strval($padding_width);
                $padding_width = $padding_width . $measurement;
                break;
            case 3:
                $padding_width = $padding_arr[1];
                $measurement = "px";
                if (strpos($padding_width, 'px') !== false) {
                    $measurement = "px";
                } elseif (strpos($padding_width, '%') !== false) {
                    $measurement = "%";
                } elseif (strpos($padding_width, 'em') !== false) {
                    $measurement = "em";
                }
                $padding_width = str_replace("px", "", $padding_width);
                $padding_width = str_replace("%", "", $padding_width);
                $padding_width = str_replace("em", "", $padding_width);
                $padding_width = intval($padding_width);
                $padding_width = $padding_width * 2;
                $padding_width = strval($padding_width);
                $padding_width = $padding_width . $measurement;
                break;
            case 4:
                $padding_width_left = $padding_arr[1];
                $padding_width_right = $padding_arr[3];
                $measurement = "px";
                if (strpos($padding_width_left, 'px') !== false) {
                    $measurement = "px";
                } elseif (strpos($padding_width_left, '%') !== false) {
                    $measurement = "%";
                } elseif (strpos($padding_width_left, 'em') !== false) {
                    $measurement = "em";
                }
                $padding_width_left = str_replace("px", "", $padding_width_left);
                $padding_width_left = str_replace("%", "", $padding_width_left);
                $padding_width_left = str_replace("em", "", $padding_width_left);
                $padding_width_left = intval($padding_width_left);

                $padding_width_right = str_replace("px", "", $padding_width_right);
                $padding_width_right = str_replace("%", "", $padding_width_right);
                $padding_width_right = str_replace("em", "", $padding_width_right);
                $padding_width_right = intval($padding_width_right);

                $padding_width = $padding_width_left + $padding_width_right;
                $padding_width = strval($padding_width);
                $padding_width = $padding_width . $measurement;
                break;

            default:
                $padding_width = "0";
                break;
        }

        return [$padding, $padding_width];
        // }
    }

    // Views::setContainerClass() is deprecated -- Use CustomView::setContainerClass() instead
    public static function setContainerClass($file, $identifier)
    {
        CustomView::setContainerClass($file, $identifier);
    }

    // Views::defaultStyling() is deprecated -- Use Style::defaultView()
    public static function defaultStyling($file, $identifier, $viewvalues)
    {
        Style::defaultView($file, $identifier, $viewvalues);
    }
}
