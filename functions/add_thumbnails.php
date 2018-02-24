<?php

error_reporting(E_ALL);
ini_set('display_errors','On');

// header('Content-type: image/jpeg');

// $image = new Imagick('image.jpg');

$img = $_FILES['photoimg']['tmp_name'];

if($img){
	$img = $_FILES['photoimg']['tmp_name'];
	$path = "testing_uploads/";


	$dst = $path . $_FILES['photoimg']['name'];

	if (($img_info = getimagesize($img)) === FALSE)
	  die("Image not found or not an image");

	$width = $img_info[0];
	$height = $img_info[1];

	switch ($img_info[2]) {
	  case IMAGETYPE_GIF  : $src = imagecreatefromgif($img);  break;
	  case IMAGETYPE_JPEG : $src = imagecreatefromjpeg($img); break;
	  case IMAGETYPE_PNG  : $src = imagecreatefrompng($img);  break;
	  default : die("Unknown filetype");
	}

	$tmp = imagecreatetruecolor($width, $height);
	imagecopyresampled($tmp, $src, 0, 0, 0, 0, $width, $height, $width, $height);
	imagejpeg($tmp, $dst.".jpg");
	echo "SUCCESS!<br><br>";

	$im = new Imagick(); 
	// $im->setResolution( 300, 300 ); 
	// $im->readImage( $_FILES['photoimg']['name'] . ".jpg" );

	// $magick_wand=NewMagickWand();
}

?>

<form method="post" action="" enctype="multipart/form-data">
	<input type="file" name="photoimg">
	<br>
	<input type="submit">
</form>

<br><br><br>

<?php if($img){ ?>
	<img src="<?php echo $im ?>" width="auto" height="auto" style="max-width: 300px; max-height: 300px;">
<?php } ?>


