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
                // ReusableClasses::makeCellEditing( $e['identifier'], $e['fullviewdict'], $e['celltype'] );
                Editing::makeCellEditing($e['identifier'], $e['fullviewdict'], $e['celltype']);
                echo " </script> ";
            } else {
                // echo " <script> ";
                // ReusableClasses::makeViewEditing( $e['viewdict'], $e['viewoptions'], $e['identifier'] );
                // echo " </script> ";
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


        // echo 'if( typeof dataarray === "undefined" ) {
        // 	dataarray = []
        // }
        // var viewdict = ' . json_encode($viewdict) . ';';
        // echo 'var viewoptions = ' . json_encode( $viewoptions ) . ';
        // Reusable.addAction( viewdict, [thismodalclass], 0, dataarray, this, e, viewoptions );';
        echo '}';
    }

    public static function makeViewEditing($viewdict, $viewoptions, $identifier, $alwayseditable=false)
    {
        echo " let alwayseditable = " . json_encode($alwayseditable) . "; ";

        echo " if( Reusable.isEditing() || alwayseditable ) { ";
        Data::makeViewEditing($viewdict, $viewoptions, $identifier, $alwayseditable);
        echo " } ";
        echo " if( Reusable.isEditingOptions() ) { ";
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

            // ReusableClasses::makeViewEditing( $viewdict, $viewoptions, $identifier, $alwayseditable );
        Editing::makeViewEditing($viewdict, $viewoptions, $identifier, $alwayseditable);
    }

    public static function clickToEditSection($viewdict, $viewoptions, $identifier, $filename, $alwayseditable=false)
    {
        $filename = basename($filename, ".php");
        echo "<script> ";
        echo "$('.".$identifier." ." . $filename . ".clicktoedit').click(function(e){ ";
        Editing::setUpEditingForSection($viewdict, $viewoptions, $identifier);
        echo "}); ";
        echo "</script>";
    }
}
