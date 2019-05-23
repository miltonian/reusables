<?php

namespace Reusables;

if (!defined('PROJECT_ROOT')) {
    define('PROJECT_ROOT', "");
}

class Editing
{
    protected static $editable_views = [];

    public static function set()
    {
        foreach (Editing::$editable_views as $e) {
            if (strtolower($e['viewtype']) == 'cell') {
                echo " <script> ";

                Editing::makeCellEditing($e['identifier'], $e['fullviewdict'], $e['celltype']);
                echo " </script> ";
            }
        }
    }

    public static function makeCellEditing($identifier, $fullviewdict, $celltype)
    {
        $viewdict = Data::get($identifier);
        $viewoptions = Options::get($identifier);

        echo 'var viewdict = ' . json_encode($viewdict) . ';
    		var viewoptions = ' . json_encode($viewoptions) . ';';
        $formid = substr($identifier, 0, strpos($identifier, "_cell_")) . "_form";
        $formviewoptions = Options::get($formid);
        echo '
    		var formviewoptions = ' . json_encode($formviewoptions) . ';';
        if ($celltype == "modal") {
            echo 'thismodalclass = new ' . $viewoptions['modal']['modalclass'] . 'Classes();';
            echo 'var dataarray = ' . json_encode($fullviewdict) . ';';
        } elseif ($celltype == "attached") {
            echo 'var dataarray = ' . json_encode($fullviewdict) . ';';
        }
        echo '
			var celltype = ' . json_encode($celltype) . ';
			if( celltype == "modal" || celltype == "dropdown" ) {
				e.preventDefault();
				if( typeof dataarray === "undefined" ) {
					dataarray = []
				}
				Reusable.addAction( viewdict, [thismodalclass], 0, dataarray, this, e, viewoptions, formviewoptions );
			}else if( celltype == "attached" ){
				e.preventDefault();
				dataarray = ' . json_encode($fullviewdict) . ';
				if( typeof dataarray === "undefined" ) {
					dataarray = []
				}
				var firstkey = ' . json_encode(array_keys($viewdict)[0]) . ';
				var theindex = parseInt( viewdict[firstkey]["index"] )
				Reusable.addAction( viewdict, [], theindex, dataarray, this, e, viewoptions );
			}';

        Editing::getEditingFunctionsJS($viewoptions) ;

        echo '}';
    }

    // determine which type of editing you are going to do -- data or options -- then call the correct method
    public static function makeViewEditing($viewdict, $viewoptions, $identifier, $alwayseditable=false)
    {
        echo " let alwayseditable = " . json_encode($alwayseditable) . "; ";

        // check if editing data
        echo " if( Reusable.isEditing() || alwayseditable ) { ";

            // makeViewEditing
            Data::makeViewEditing($viewdict, $viewoptions, $identifier, $alwayseditable);
        echo " } ";


        // check if editing options
        echo " if( Reusable.isEditingOptions() ) { ";

            // if you are editing options,
            Options::makeViewEditing($viewdict, $viewoptions, $identifier, $alwayseditable);
        echo " } ";
    }



    public static function addEditingToCell($identifier, $fullviewdict, $celltype)
    {
        $dict = [
            'identifier' => $identifier,
            'fullviewdict' => $fullviewdict,
            'celltype' => $celltype,
            'viewtype' => 'Cell'
        ];
        array_push(Editing::$editable_views, $dict);
    }


    public static function getEditingFunctionsJS($dict, $is_options=false)
    {
        $action_key = RFormat::getViewActionKey($dict);
        // if( $action_key == '' ){ return []; }
        $multiple = false;
        if ($action_key == '') {
            $actiondict = $dict;
        } else {
            $actiondict = $dict[$action_key];
            $multiple = true;
        }
        echo "var editingfunctions = [];";
        if ($multiple) {
            $i=0;
            foreach ($actiondict as $ca) {
                if ($ca_type == "modal") {
                    if (isset($ca_type[ 'modal' ])) {
                        echo "var thismodalclass = new " . $ca['modal']['modalclass'] . "Classes();
						editingfunctions.push( thismodalclass );";
                    } else {
                        echo 'editingfunctions.push( "nothing" );';
                    }
                } else {
                    echo 'editingfunctions.push( "nothing" );';
                }
                $i++;
            }
        } else {
            if ($is_options) {
                $ca_type = Data::getValue($actiondict, 'options_type');
            } else {
                $ca_type = Data::getValue($actiondict, 'type');
            }
            if ($ca_type == "modal") {
                if (isset($actiondict[ 'modal' ])) {
                    echo "var thismodalclass = new " . $actiondict['modal']['modalclass'] . "Classes();
					editingfunctions.push( thismodalclass );";
                } else {
                    echo 'editingfunctions.push( "nothing" );';
                }
            } elseif ($ca_type == "options_modal") {
                if (isset($actiondict[ 'options_modal' ])) {
                    echo "var thismodalclass = new " . $actiondict['options_modal']['modalclass'] . "Classes();
					editingfunctions.push( thismodalclass );";
                } else {
                    echo 'editingfunctions.push( "nothing" );';
                }
            } else {
                echo 'editingfunctions.push( "nothing" );';
            }
        }
    }


    public static function setUpEditingForSection($viewdict, $viewoptions, $identifier, $alwayseditable=false)
    {

        Editing::makeViewEditing($viewdict, $viewoptions, $identifier, $alwayseditable);
    }

    // add click to edit functionality to view
    public static function clickToEditSection($viewdict, $viewoptions, $identifier, $filename, $alwayseditable=false)
    {
        // get filename
        $filename = basename($filename, ".php");

        // start javascript
        echo "<script> ";

        // add click action to view -- connected to the container that wraps around every reusable view
        echo "$('.".$identifier." ." . $filename . ".clicktoedit').click(function(e){ ";

          Editing::setUpEditingForSection($viewdict, $viewoptions, $identifier);

        echo "}); ";

        // end javascript
        echo "</script>";
    }
}
