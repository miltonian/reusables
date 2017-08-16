<?php

namespace Reusables;


// exit( json_encode( Data::getValue( $menudict['otherusers'] ) ) );
// exit( json_encode( sizeof( $menudict['otherusers'] ) ) );

// $otheruservalues = Data::retrieveDataWithID( "otherusers" )['value'];

$dropdownlist = $menudict['list'];
$dropdownlist_keydicts = $dropdownlist;
// exit( json_encode( $menudict ) );
$dropdownlist_keys = array_keys($dropdownlist);

$dropdownlist_onlykeys = [];

$inputs = array();
$i=0;
foreach ($dropdownlist_keys as $ik) {
	$thekey = $ik;
	if( is_numeric( $ik ) ){ $thekey = $dropdownlist_keydicts[$ik]; }
	array_push( $dropdownlist_onlykeys, $thekey );
	$i++;
}

// exit( json_encode( $dropdownlist_keydicts ) );

?>

<style>

</style>

<div class="dropdown_1 <?php echo $identifier ?>">
	<div class="inner-dropdown">
		<button onclick="myFunction()" class="inner-dropbtn"><?php echo Data::getValue( $menudict, "title" ) ?></button>
		<div id="inner-myDropdown" class="inner-dropdown-content">
		<?php $i=0; ?>
			<?php foreach ($dropdownlist as $row) { ?>
				<a href="<?php echo Data::getValue( $row, 'pre_slug' ) ?><?php echo Data::getValue( $row, 'slug' ) ?>" id="<?php echo $i ?>"><?php echo $dropdownlist_onlykeys[$i] ?></a>
				<?php $i++; ?>
			<?php } ?>
		</div>
	</div>
</div>

<script>
/* change this shit */
	function myFunction(e) {
		// e.preventDefault();
		// $('#inner-dropdown-content').toggle("show");
	    document.getElementById("inner-myDropdown").classList.toggle("show");
	}

	// Close the dropdown if the user clicks outside of it
	window.onclick = function(event) {
		// event.preventDefault();
		// alert(event.target)
	  if (!event.target.matches('.inner-dropbtn')) {

	    var dropdowns = document.getElementsByClassName("inner-dropdown-content");
	    var i;
	    for (i = 0; i < dropdowns.length; i++) {
	      var openDropdown = dropdowns[i];
	      if (openDropdown.classList.contains('show')) {
	        openDropdown.classList.remove('show');
	      }
	    }
	  }else{
	  	event.preventDefault();
	  }
	}
	/* change the above shit */
</script>