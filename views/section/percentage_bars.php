<?php

namespace Reusables;

// exit( json_encode( Data::getValue( $viewdict['skillsarray'] ) ) );

$skillsarray = Data::getValue( $viewdict, 'skillsarray' );

// exit( json_encode( $skillsarray ) );

if(!isset($skillset1array)){ $skillset1array = array(); }
if(!isset($viewdict['skillsarray'])){ $viewdict['skillsarray']=array(); }

$skillindex = 0;
if(sizeof($skillsarray)>0){
	$fieldname = $skillsarray[sizeof($skillsarray)-1]['name'];
	$skillindex = intval(substr($fieldname, strpos($fieldname, 'skillname')))+1;
}

//for testing 
$name = "test skill";
$score = "75%";
$skill = ["name"=>$name, "score"=>$score];
$skillset1array = array($skill, $skill);

if(!isset($viewdict['preview'])){ $viewdict['preview'] = 0; }

// exit( json_encode( Data::getValue( $viewdict ) ) );
$sectiontitle = Data::getValue( $viewdict, 'title' );
if( $sectiontitle == "" ) {
	$sectiontitle = "Skills";
}

?>

<style>
</style>


<div class="skillset_2 main <?php echo $identifer ?>">
	<?php /*if( ((!$GLOBALS['isadmin'] && !$GLOBALS['isuser']) || ($GLOBALS['isadmin'] != $viewdict['userprofile_userid'] && $GLOBALS['userid'] != $viewdict['userprofile_userid'])) || $viewdict['preview']==1 ){*/ ?>
	<h1 class="skillset_2 title"><?php echo $sectiontitle ?></h1>
		<?php $i=1; foreach ($skillsarray as $skill) { ?>
			<?php 
				$name=Data::getValue( $skill, 'custom_key'); $score=Data::getValue( $skill, 'custom_value' ); 
				if (substr($score, -1) != '%') { $score = $score . "%"; }
			?>
			<div class="skillset_2 wrapper">
				<div class="skillset_2 bar">
					<div class="skillset_2 fill" style="width: <?php echo $score ?>; background: <?php if($i % 3==0){ echo '#ff533d'; }else if($i % 2==0){ echo '#ab987a'; }else{ echo '#0f1626'; } ?>">
						<label><?php echo $name ?></label>
						<?php if( floatval( str_replace('%', '', $score) ) >= 80 ){ ?>
							<label style="float: right;"><?php echo $score ?></label>
						<?php } ?>
					</div>
					<div class="skillset_2 leftover" style="display: inline-block; position: relative; margin: 0; padding: 0; top: 50%; transform: translateY(-50%); width: calc(100% - <?php echo $score ?>);">
					<?php if( floatval( str_replace('%', '', $score) ) < 80 ){ ?>
						<label style="top: 0; transform: none; text-align: right; width: calc(100% - 20px); padding-right: 20px;"><?php echo $score ?></label>
					<?php } ?>
					</div>
				</div>
			</div>
			<?php $i++; ?>
		<?php } ?>
	<?php /*}else{*/ ?>
		<!-- <h1 class="title">Skills</h1> -->
		<?php /*$i=0; 
		foreach ($viewdict['skillsarray'] as $skill) { 
			<div class="wrapper">
				<input type="text" class="skillname editing" name="name_skillname<?php echo $i ?>" value="<?php echo $skill['fieldname'] ?>">
				<input type="text" class="skillvalue editing" name="name_skillvalue<?php echo $i ?>" value="<?php echo $skill['fieldvalue'] ?>"><br><br>
			</div>
			 $i++;
		}
	}*/
	?>
</div>


<script>

var skillindex = <?php echo $skillindex ?>;
var skillcount = <?php echo intval( sizeof($viewdict['skillsarray']) ) ?>;

<?php if( ((!$GLOBALS['isadmin'] && !$GLOBALS['isuser']) || ($GLOBALS['isadmin'] != $viewdict['userprofile_userid'] && $GLOBALS['userid'] != $viewdict['userprofile_userid'])) || $viewdict['preview']==1 ){}else{ ?>
if(skillcount<3){
	for(var i=0;i<3;i++){
		addskill();
	}
}

<?php } ?>

$('.skillset1 #add-skill').click(function(e){
	e.preventDefault();
	addskill();
});

function addskill(){
	var wrapper = document.createElement('div');
	var skillname = document.createElement('input');
	var skillvalue = document.createElement('input');
	$('.skillset1')[0].appendChild(wrapper);
	wrapper.appendChild(skillname);
	wrapper.appendChild(skillvalue);
	$(wrapper).attr("class", "wrapper");
	$(skillname).attr({'type':'text', 'class':'skillname editing', 'name':'name_skillname' + skillindex, 'value':'', 'placeholder':'skill name'});
	$(skillvalue).attr({'type':'text', 'class':'skillvalue editing', 'name':'name_skillvalue' + skillindex, 'value':'', 'placeholder':'skill value'});
	skillindex++;
}

$('.skillset1 .skillvalue').bind('input', function() { 
	var text = $(this).val();
	var lastChar = text.substr(text.length - 1);
	if(lastChar != "%"){ text = text + "%"; $(this).val(text); }
	var el = $(this).get(0);
    var elemLen = el.value.length-1;
    if(el.selectionStart>elemLen || el.selectionStart>elemLen){
		el.selectionStart = elemLen;
	    el.selectionEnd = elemLen;
    }
});

</script>