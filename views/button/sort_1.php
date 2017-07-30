<?php
namespace Reusables;

?>

<!-- <button class="<?php echo $identifier ?> sort_1"><?php echo Data::getValue( $buttondict, 'title' ) ?></button> -->
<?php
	echo Menu::make( "dropdown_1", $buttondict['dropdown_array'], $identifier . "_dropdown" );
?>

<script>

var sortarray = <?php echo json_encode( $buttondict['table_array'] ) ?>;
var dropdown_list = <?php echo json_encode( $buttondict['dropdown_array']['list'] ) ?>;
var tableclass = <?php echo json_encode( $buttondict['table_class'] ) ?>;
var sortkey = '<?php echo $buttondict['sort_key'] ?>';

$('.<?php echo $identifier ?>_dropdown.dropdown_1 .inner-dropdown-content a').click(function(e){
	e.preventDefault();

	var sortvalue = dropdown_list[this.id]

	for( var i=0; i < sortarray.length; i++ ){
		if(sortvalue.toLowerCase() == "all"){
			$('.'+tableclass+' .'+tableclass+'_cell'+'.index_'+i).removeClass('hide');
		}else if(sortarray[i][sortkey] == sortvalue){
			$('.'+tableclass+' .'+tableclass+'_cell'+'.index_'+i).removeClass('hide');
		}else{
			$('.'+tableclass+' .'+tableclass+'_cell'+'.index_'+i).addClass('hide');
		}
		
	}
})
	
</script>