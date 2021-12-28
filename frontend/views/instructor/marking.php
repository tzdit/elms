<?php 
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Security;
use common\helpers\Custom;
use common\models\QMarks;
use common\models\Instructor;
use yii\helpers\ArrayHelper;
use frontend\models\ClassRoomSecurity;
$this->params['courseTitle'] = "Marking:<span class='text-primary text-sm'>".substr(yii::$app->session->get('ccode')." ".$assignment->assName,0,30)."<span>...";
$this->title = 'Assignment Marking';

$this->params['breadcrumbs'] = [
  ['label'=>'class Assignments', 'url'=>Url::to(['/instructor/class-assignments', 'cid'=>ClassRoomSecurity::encrypt(yii::$app->session->get('ccode'))])],
  ['label'=>$this->title]
];

$submits=[];
$asstype="";
$quantity="one";
if($assignment->assType=="allgroups" || $assignment->assType=="groups")
{
  if(!empty($singlesub)){
    $submits=$singlesub;
    $quantity="one";
  }
  else
  {
    $submits=$assignment->groupAssignmentSubmits;
    $quantity="many";
  }
    
  $asstype="group";
}
else
{
  if(!empty($singlesub)){
    $submits=$singlesub;
    $quantity="one";
  }
  else
  {
    $submits=$assignment->submits;
    $quantity="many";
  }
  $asstype="class";
}
?>
<body>
  <div class="container-fluid">
<div class="row d-none"><div class="col-md-6" id="coursecode" ><?=$assignment->course_code?></div><div class="col-md-6" id="assidt"><?=$assignment->assID?></div></div>
<div class="row pt-2 pb-2 shadow">
  <div class="col-md-3 col-ms-3 "  >
    <div class="row ">
    <span class="text-md col-md-4 shadow pt-1 pb-1">Marked:</span><span id="markedperc" class="text-primary col-md-3 shadow"></span><span class="col-md-5 shadow">of &nbsp&nbsp&nbsp&nbsp<?=count($assignment->submits)?> </span>
</div>
    <div class="row pt-2 pb-2 shadow bg-light" id="markcontrol2" style="position:fixed;z-index:20;left:50%">
    <div class="col-md-12 col-ms-12 d-flex  justify-content-center" >
      <span class="btn btn-sm btn-default mr-5" data-toggle="tooltip" data-title="Skip Back" id="skipback"><i class="fa fa-arrow-circle-left fa-2x text-primary"></i>
    </span>
    <span class="btn btn-lg btn-default shadow text-primary" id="savemove"data-toggle="tooltip" data-title="Save And Move"><i class="fa fa-save ">Save</i>
  </span>
  <span class="btn btn-sm btn-default ml-5" id="skipnext" data-toggle="tooltip" data-title="Skip Next"><i class="fa fa-arrow-circle-right fa-2x text-primary"></i>
</span>
</div>
</div>
</div>
<div class="col-md-6 col-ms-6 d-flex justify-content-center" >
  <span class=" text-primary text-center" id="currentass"></span>
</div>
<div class="col-md-3 col-ms-3 ">
  <div class="row"><a href="<?=Url::to(['/instructor/change-marking-mode','mode'=>'ordinary'])?>" class="col-md-3" data-toggle="tooltip" data-title="Ordinary Mode"><img src="/img/normal.png" width="53%" height="73%"></img></a><a href="<?=Url::to(['/instructor/change-marking-mode','mode'=>'presentation'])?>" class="col-md-3" data-toggle="tooltip" data-title="Presentation Mode"><img src="/img/pres.png" width="60%" height="80%"></img></a><a href="" class="col-md-2"><i class="fa fa-undo-alt text-dark " data-toggle="tooltip" data-title="Re-assign"></i></a><a href="" class="col-md-2" id="collabo"><i class="fas fa-user-friends text-dark " data-toggle="tooltip" data-title="RealTime collaboration"></i></a><a href="<?=Url::to(['/instructor/download-submits','assignment'=>ClassRoomSecurity::encrypt($assignment->assID)])?>" class="col-md-2"><i class="fas fa-download text-dark " data-toggle="tooltip" data-title="Download all submits"></i></a>
</div>
</div>
</div>

<div class="row shadow">
  <?php
  
if(yii::$app->session->get('markingmode')=='ordinary')
{
if($submits!=null)
{
  ?>
<div class="col-md-2 shadow studenttable" style="max-height:400px;overflow:auto">  
<table class="table d-flex mytable" style="font-size:10px;cursor:pointer">
<tr class="d-flex"><th>s/no</th><th>reg #</th></tr>

<?php 

for($sub=0;$sub<count($submits);$sub++)
{
  if($submits[$sub]->score!=null || $submits[$sub]->score!="")
  {
?>
<tr class="d-flex text-primary"><td id="<?=$submits[$sub]->submitID;?>"><?=$sub+1?><td id="<?=$submits[$sub]->fileName;?>"><?php if($asstype=="class"){print $submits[$sub]->reg_no;}else{ print $submits[$sub]->group->groupName;}?></td></tr>
<?php
  }
  else
  {
    ?>

<tr class="d-flex"><td id="<?=$submits[$sub]->submitID;?>"><?=$sub+1?><td id="<?=$submits[$sub]->fileName;?>"><?php if($asstype=="class"){print $submits[$sub]->reg_no;}else{ print $submits[$sub]->group->groupName;}?></td></tr>
    <?php
  }
}
?>

</table>
</div>
  <div class="col-md-8 shadow d-flex justify-content-center">
    <span class="d-none savespin bg-primary overlay p-4 opacity-75 rounded-pill" style="position:absolute;z-index:2;bottom:50%;opacity:.7"><i class="fas fa-sync-alt fa-spin fa-2x " ></i>Saving...</span>
    <iframe src="" style="position: relative; height: 100%; width: 100%;border:none" frameborder="0" height="426" id="fileobj"  type="application/pdf">
    file not found or could not be read

    </iframe>
    <!-- <div id="viewpdf"></div> -->

  </div>

<div class="col-md-2 shadow">
<!--question marking-->
<?php 
$questions=$assignment->assqs;
for($q=0;$q<count($questions);$q++)
{ 
?>
<div id="marks" class="row qmarking">
<div id="mrow" class="col-md-12" style="margin-top:7px">
  <?php
    $mark=QMarks::find()->where(['assq_ID'=>$questions[$q]->assq_ID])->one();
    $mark=(!empty($mark) || $mark!==null)?$mark->q_score:null;
    $value=($quantity==="one")?$mark:null;
   
  ?>
<div class="form-group"><input type="text" class="form-control score" id="<?=$questions[$q]->assq_ID?>"placeholder="<?php print "Q".$questions[$q]->qno;?>" value="<?=$value?>"></input><input type="text" class="form-control maxscore" value="<?=$questions[$q]->total_marks ?>" readonly></input></div>
</div>
</div>
<?php }?>
<div class="row">
<div class="col-md-12">
<div class="row"><div class="col-md-12">Total score</div></div>
<div class="row">
<div class="col-md-6 form-group score_mark">

   <input id="scoremark" type="text" name="grad" class="form-control" style="color:blue"></input>
</div>
<div class="col-md-6 form-group">
<input id="tot" type="text"  name="tat" value="<?=$assignment->total_marks?>" class="form-control"  readonly></input>
</div>
</div>
<!--end of question marking-->
</div>
</div>
<div class="row">
<div class="col-md-12">
<textarea id="<?=$asstype?>" class="form-control comment" placeholder="Comment" style="margin-bottom:4px"></textarea>
</div>
</div>

</div>

<?php
}
else
{
  print '<div class="container-fluid text-primary text-center p-5">No any submits</div>';
}
}
else
{
  //###########################################################
   //presentation mode starts here

   //###########################################################

   if($submits!=null)
{
  ?>
<div class="col-md-12 shadow studenttable" style="height:inherit;">  
<table class="table table-hover mytable" style="font-size:10px;cursor:pointer;width:inherit;">
<tr class="p-1"><th>s/no</th><th>reg #</th><th class="pl-1">
<div class="row text-center p-0">
<?php 
$questions=$assignment->assqs;

for($q=0;$q<count($questions);$q++)
{ 
?>
<div class="col-md-1 mr-1 p-1 bg-white">
 
<?= "Q".$questions[$q]->qno;?>


<?= "/".$assignment->total_marks;?>

</div>
<?php }?>
<div class="col-md-1 p-0"><i class="fa fa-plus-circle fa-2x" data-toggle="tooltip" data-title="Add Assessment Item"></i><i class="fa fa-minus-circle fa-2x" data-toggle="tooltip" data-title="Remove Assessment Item"></i></div>
<div class="col-md-3" style="position:absolute;right:0;z-index:2">
<textarea id="<?=$asstype?>" rows="1" class="form-control shadow comment" placeholder="Comment"></textarea>
</div>
</div>
</th></tr>

<?php 

for($sub=0;$sub<count($submits);$sub++)
{
  if($submits[$sub]->score!=null || $submits[$sub]->score!="")
  {
?>
<tr class="text-primary p-0"><td  id="<?=$submits[$sub]->submitID;?>"><?=$sub+1?><td id="<?=$submits[$sub]->fileName;?>"><?php if($asstype=="class"){print $submits[$sub]->reg_no;}else{ print $submits[$sub]->group->groupName;}?></td>
<td class="p-1">
<!--question marking-->
<div id="marks" class="row qmarking p-0">
<?php 
$questions=$assignment->assqs;
for($q=0;$q<count($questions);$q++)
{ 
?>

<div id="mrow" class="col-md-1 p-0 mr-1">
  <?php
    $mark=QMarks::find()->where(['assq_ID'=>$questions[$q]->assq_ID])->one();
    $mark=(!empty($mark) || $mark!==null)?$mark->q_score:null;
    $value=($quantity==="one")?$mark:null;
   
  ?>
  <input type="text" class="form-control p-0 score" id="<?=$questions[$q]->assq_ID?>" placeholder="" value="<?=$value?>"></input>
</div>
<?php }?>
</div>
</td>
</tr>
<?php
  }
  else
  {
    ?>

<tr class=""><td  id="<?=$submits[$sub]->submitID;?>"><?=$sub+1?><td id="<?=$submits[$sub]->fileName;?>"><?php if($asstype=="class"){print $submits[$sub]->reg_no;}else{ print $submits[$sub]->group->groupName;}?></td>
<td class="p-1">
<div id="marks" class="row qmarking p-0">
<!--question marking-->
<?php 
$questions=$assignment->assqs;
for($q=0;$q<count($questions);$q++)
{ 
?>

<div id="mrow" class="col-md-1 p-0 mr-1">
  <?php
    $mark=QMarks::find()->where(['assq_ID'=>$questions[$q]->assq_ID])->one();
    $mark=(!empty($mark) || $mark!==null)?$mark->q_score:null;
    $value=($quantity==="one")?$mark:null;
   
  ?>
  <input type="text" class="form-control p-0 score" id="<?=$questions[$q]->assq_ID?>" placeholder="" value="<?=$value?>"></input>
</div>
<?php }?>
</div>
</td>
</tr>
    <?php
  }
}
?>

</table>
</div>
  <div class="shadow d-none justify-content-center pt-4 bg-white" style="position:fixed;z-index:5;min-height:40%;width:50%;right:0;top:40%" id="presentationmodeviewer">
    <span class="d-none savespin bg-primary overlay p-4 opacity-75 rounded-pill" style="position:absolute;z-index:2;bottom:50%;opacity:.7"><i class="fas fa-sync-alt fa-spin fa-2x " ></i>Saving...</span>
    <iframe src="" style="position: absolute;height:100%;width: 100%;border:none" frameborder="0" height="426" id="fileobj"  type="application/pdf">
    file not found or could not be read
    </iframe>
    <!-- <div id="viewpdf"></div> -->

  </div>

<?php
}
else
{
  print '<div class="container-fluid text-primary text-center p-5">No any submits</div>';
}
?>
<?php

//the end of presentation mode
}
?>
</div>
</div>
<?php
if((yii::$app->session->get('markingmode'))=='ordinary')
{
$this->registerJsFile(
  '@web/js/marking.js',
  ['depends' => 'yii\web\JqueryAsset'],

);
}
else
{
  $this->registerJsFile(
    '@web/js/marking2.js',
    ['depends' => 'yii\web\JqueryAsset'],
  
  );
}
?>