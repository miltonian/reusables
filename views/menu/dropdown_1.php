<?php


// exit( json_encode( Data::getValue( $menudict['otherusers'] ) ) );
// exit( json_encode( sizeof( $menudict['otherusers'] ) ) );

$otheruservalues = Data::retrieveDataWithID( "otherusers" )['value'];

?>

<style>

</style>

<div class="dropdown_1">
	<div class="inner-dropdown">
		<button onclick="myFunction()" class="inner-dropbtn">Other Users</button>
		<div id="inner-myDropdown" class="inner-dropdown-content">
			<?php for ($i=0; $i < sizeof( $otheruservalues ); $i++) { ?>
				<a href="/u/<?php echo $otheruservalues[$i]['slug'] ?>"><?php echo $otheruservalues[$i]['first_name'] . " " . $otheruservalues[$i]['last_name'] ?></a>
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