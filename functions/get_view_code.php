<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if( !isset($_POST['view_path']) ){ exit("missing parameters"); }
if( !isset($_POST['identifier']) ){ exit("missing parameters"); }

$view_path = $_POST['view_path'];
$identifier = $_POST['identifier'];
$data = $_POST['data'];
$options = $_POST['options'];
$unformatteddata = $_POST['unformatteddata'];

$file_arr = explode("/", $view_path);
$is_custom = false;
if( sizeof($file_arr) == 3  ) {
  if( $file_arr[0] == "custom" ) {
    $is_custom = true;
    $viewtype = $file_arr[0]."/".$file_arr[1];
    $file = $file_arr[2];
  } else {
    exit("invalid view format");
  }
} else {
  $viewtype = $file_arr[0];
  $file = $file_arr[1];
}
// exit(json_encode($unformatteddata));
Reusables\RFormat::data($unformatteddata, "");
Reusables\Data::add($data, $identifier);
Reusables\Options::addOptions($options, $identifier);
Reusables\Info::add($viewtype, "viewtype", $identifier);
Reusables\Info::add($file, "file", $identifier);
if( $is_custom ) {
  $code = Reusables\Views::makeView( $file, $identifier, "custom/section" );
} else {
  $code = Reusables\Section::make($file, $identifier);
}


exit(($code));
