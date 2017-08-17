<?php

	namespace Reusables;

	$buttontext = Data::getValue( $inputdict, "buttontext" );
	if( $buttontext == "" ){
		$buttontext = "Copy";
	}

?>

<style>
	.copybutton_1.main { display: inline-block; position: relative; margin: 0; padding: 0; width: 100%; text-align: left; }
		.copybutton_1.title { display: inline-block; position: relative; margin: 0; padding: 10px; width: calc( 100% - 20px); }
		.copybutton_1.copy { display: inline-block; position: relative; margin: 0; padding: 10px; border: 0; background-color: blue; color: white; cursor: pointer; }
		.copybutton_1.field_value { visibility: hidden; display: none; }
</style>


<div class="<?php echo $identifier ?> copybutton_1 main">
	<label class="copybutton_1 title" style="margin-bottom: -5px; font-weight: 700; font-size: 11px"><?php echo Data::getValue( $inputdict, "labeltext") ?></label>
	<label type="text" class="copybutton_1 field_value" value="<?php echo Data::getValue( $inputdict, 'field_value') ?>" ></label>
	<button class="copybutton_1 copy"><?php echo $buttontext ?></button>
</div>


<script>

$('.<?php echo $identifier ?> .copybutton_1.copy').text("Copy");
	$('.<?php echo $identifier ?> .copybutton_1.copy').click(function(e){
		e.preventDefault();
		copyToClipboard( $('.copybutton_1.field_value')[0] );

		$(this).text("Copied! Now go to the '/vendor/miltonian' in terminal and paste the copied text")
	});

	function copyToClipboard(elem) {
		  // create hidden text element, if it doesn't already exist
	    var targetId = "_hiddenCopyText_";
	    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
	    var origSelectionStart, origSelectionEnd;
	    if (isInput) {
	        // can just use the original source element for the selection and copy
	        target = elem;
	        origSelectionStart = elem.selectionStart;
	        origSelectionEnd = elem.selectionEnd;
	    } else {
	        // must use a temporary form element for the selection and copy
	        target = document.getElementById(targetId);
	        if (!target) {
	            var target = document.createElement("textarea");
	            target.style.position = "absolute";
	            target.style.left = "-9999px";
	            target.style.top = "0";
	            target.id = targetId;
	            document.body.appendChild(target);
	        }
	        target.textContent = elem.textContent;
	    }
	    // alert(JSON.stringify(target));
	    // select the content
	    var currentFocus = document.activeElement;
	    target.focus();
	    target.setSelectionRange(0, target.value.length);
	    
	    // copy the selection
	    var succeed;
	    try {
	    	  succeed = document.execCommand("copy");
	    } catch(e) {
	        succeed = false;
	    }
	    // restore original focus
	    if (currentFocus && typeof currentFocus.focus === "function") {
	        currentFocus.focus();
	    }
	    
	    if (isInput) {
	        // restore prior selection
	        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
	    } else {
	        // clear temporary content
	        target.textContent = "";
	    }
	    return succeed;
	}
</script>