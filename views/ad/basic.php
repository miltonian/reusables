<?php 

namespace Reusables;

$adsetlink = Data::getValue( $viewdict, "link");
$adsetid = Data::getValue( $viewdict, "id" );
$adsetimg = Data::getValue( $viewdict, "imagepath" );
// $adsetimg = "http://experiencenash.com/reusables/uploads/ads/BV-300x600-Ad.png";

// exit( json_encode( $viewdict ) );

?>

<style>

</style>


<div class="viewtype_ad <?php echo $identifier ?> basic" style='position: relative; display: inline-block; width: 100%; padding: 10px 0px; text-align: center;'>
	<?php if($adsetlink!=""){ ?><a href="/reusables/functions/adclicked.php?ad_id=<?php echo $adsetid ?>" ><?php } ?>
	<img src=<?php echo $adsetimg ?> style='position: relative; display: inline-block; width: 100%;'>
	<?php if($adsetlink!=""){ echo '</a>'; } ?>
</div>


<script>

</script>