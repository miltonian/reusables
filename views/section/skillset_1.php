<?php

if(!isset($skillset1array)){ $skillset1array = array(); }
if(!isset($sectiondict['skillsarray'])){ $sectiondict['skillsarray']=array(); }

$skillindex = 0;
if(sizeof($sectiondict['skillsarray'])>0){
	$fieldname = $sectiondict['skillsarray'][sizeof($sectiondict['skillsarray'])-1]['name'];
	$skillindex = intval(substr($fieldname, strpos($fieldname, 'skillname')))+1;
}

//for testing 
$name = "test skill";
$score = "75%";
$skill = ["name"=>$name, "score"=>$score];
$skillset1array = array($skill, $skill);

?>

<style>
.skillset1 { display: inline-block; position: relative; margin: 0; padding: 0; width: 100%; text-align: left;}
	.skillset1 .title {display: inline-block; position: relative; margin: 0; padding: 20px; width: calc(100% - 40px); font-weight: 500;}
	.skillset1 .wrapper {display: inline-block; position: relative; margin: 0; padding: 0; width: 100%; }
	.skillset1 .wrapper .bar {display: inline-block; position: relative; margin: 10px; padding: 0; width: calc(100% - 20px); height: 60px; background-color: #efefef; overflow: hidden; border-radius: 5px; max-width: 600px;}
		.skillset1 .wrapper .bar .fill {display: inline-block; position: relative; margin: 0; padding: 0; height: 100%; background-color: blue; float: left; border-radius: 5px;}
			.skillset1 .wrapper .bar .fill label {display: inline-block; position: relative; margin: 0; padding: 0px 20px; color: white; top: 50%; transform: translateY(-50%);}
		.skillset1 .wrapper .bar .leftover {display: inline-block; position: relative; margin: 0; padding: 0; height: 100%; background: transparent; float: left;}
			.skillset1 .wrapper .bar .leftover label {display: inline-block; position: relative; margin: 0; padding: 0; color: #333333; width: 100%; text-align: center; top: 50%; transform: translateY(-50%);}
</style>


<div class="skillset1">
	<?php if(!$GLOBALS['isadmin'] || ($GLOBALS['isadmin'] && $GLOBALS['userid'] != $sectiondict['userprofile_userid'])){ ?>
	<h1 class="title">Skills</h1>
		<?php foreach ($sectiondict['skillsarray'] as $skill) { ?>
			<?php 
				$name=$skill['fieldname']; $score=$skill['fieldvalue']; 
			?>
			<div class="wrapper">
				<div class="bar">
					<div class="fill" style="width: <?php echo $score ?>">
						<label><?php echo $name ?></label>
					</div>
					<div class="leftover" style="width: calc(100% - <?php echo $score ?>)">
						<label><?php echo $score ?></label>
					</div>
				</div>
			</div>
		<?php } ?>
	<?php }else{ ?>
		<h1 class="title">Skills<a href="" id="add-skill" style="font-size: 15px; margin-left: 15px; cursor: pointer;">Add</a></h1>
		<?php $i=0; ?>
		<?php foreach ($sectiondict['skillsarray'] as $skill) { ?>
			<div class="wrapper">
				<input type="text" name="name_skillname<?php echo $i ?>" value="<?php echo $skill['fieldname'] ?>">
				<input type="text" class="skillvalue" name="name_skillvalue<?php echo $i ?>" value="<?php echo $skill['fieldvalue'] ?>"><br><br>
			</div>
			<?php $i++; ?>
		<?php } ?>
	<?php } ?>
	
</div>


<script>

var skillindex = <?php echo $skillindex ?>;

$('.skillset1 #add-skill').click(function(e){
	e.preventDefault();
	var wrapper = document.createElement('div');
	var skillname = document.createElement('input');
	var skillvalue = document.createElement('input');
	$('.skillset1')[0].appendChild(wrapper);
	wrapper.appendChild(skillname);
	wrapper.appendChild(skillvalue);
	$(wrapper).attr("class", "wrapper");
	$(skillname).attr({'type':'text', 'name':'name_skillname' + skillindex, 'value':'', 'placeholder':'skill name'});
	$(skillvalue).attr({'type':'text', 'name':'name_skillvalue' + skillindex, 'value':'', 'placeholder':'skill value'});
	skillindex++;
});

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