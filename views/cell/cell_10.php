<?php
	// cell for admin side

	// $celldict

?>

<style>
	.<?php echo $identifier ?> { display: inline-block; position: relative; margin: 0; padding: 5px; width: calc(100% - 5px); text-align: left; }
		.<?php echo $identifier ?> .featuredimage-div { display: inline-block; position: relative; margin: 0; padding: 0; border: 0; border-radius: 5px; width: 100%; padding-bottom: 100%; background-size: cover; background-position: center; background-repeat: no-repeat; }
		
</style>

<?php 
	echo "<div class='" . $identifier . "'>";
		echo Wrapper::wrapper1( 
			[],
			array(
				Structure::make( "three_columns", [
					"sidecolumn_left"=>array(
						"<div class='featuredimage-div' style='background-image: url(" . $celldict['featured_imagepath'] . ")'></div>"
					),
					"maincolumn"=>array(
						"
						<div class='content'>
							<h4 id='title'>New Bus/Coach For Away Games</h4>
							<p id='status'>This project is Active</p>
						</div>
						"
					),
					"sidecolumn_right"=>array(
						"
						<div class='actions-div'>
							<button>btn</button>
							<button>btn</button>
							<button>btn</button>
						</div>
						"
					),
				], $identifier."-structure")
			),
			$identifier."-wrapper"
		);

		echo "</div>";
	?>

<script>

$('.<?php echo $identifier ?> button#select').click(function(e){
	e.preventDefault();
});

</script>