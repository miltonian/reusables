<?php
namespace Reusables;

?>

<!-- <button class="<?php echo $identifier ?> sort_1"><?php echo Data::getValue( $viewdict, 'title' ) ?></button> -->
<?php
	Data::addData( $viewdict['dropdown_array'], $identifier . "_dropdown" );
	echo Menu::make( "dropdown_1", $identifier . "_dropdown" );
?>

<script>

var sortarray = <?php echo json_encode( $viewdict['table_array'] ) ?>;
var dropdown_list = <?php echo json_encode( $viewdict['dropdown_array']['list'] ) ?>;
var tableclass = <?php echo json_encode( $viewdict['table_class'] ) ?>;
var sortkey = '<?php echo $viewdict['sort_key'] ?>';

$('.<?php echo $identifier ?>_dropdown.dropdown_1 .inner-dropdown-content a').click(function(e){
	e.preventDefault();

	var sortvalue = dropdown_list[this.id]

	for( var i=0; i < sortarray.length; i++ ){
		if(sortvalue.toLowerCase() == "all"){
			$('.'+tableclass+' .'+tableclass+'_cell_'+i+'.index_'+i).removeClass('hide');
		}else if(sortarray[i][sortkey] == sortvalue){
			$('.'+tableclass+' .'+tableclass+'_cell_'+i+'.index_'+i).removeClass('hide');
		}else{
			$('.'+tableclass+' .'+tableclass+'_cell_'+i+'.index_'+i).addClass('hide');
		}
		
	}
})
	
</script>