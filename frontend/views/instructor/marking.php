<?php 
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Security;
use common\helpers\Custom;
use common\models\QMarks;
use common\models\Instructor;
use yii\helpers\ArrayHelper;

$this->params['courseTitle'] = "Marking:<span class='text-primary text-sm'>".substr(yii::$app->session->get('ccode')." ".$assignment->assName,0,30)."<span>...";
$this->title = 'Assignment Marking';



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
<div class="row pt-2 pb-2 shadow "><div class="col-md-2 col-ms-2 "  ><div class="row pt-2 pb-2 shadow bg-light" id="markcontrol2" style="position:fixed;z-index:20;left:50%"><div class="col-md-12 col-ms-12 d-flex  justify-content-center" ><span class="btn btn-sm btn-default mr-5" data-toggle="tooltip" data-title="Skip Back" id="skipback"><i class="fa fa-arrow-circle-left fa-2x text-primary"></i></span><span class="btn btn-lg btn-default shadow text-primary" id="savemove"data-toggle="tooltip" data-title="Save And Move"><i class="fa fa-save ">Save</i></span><span class="btn btn-sm btn-default ml-5" id="skipnext" data-toggle="tooltip" data-title="Skip Next"><i class="fa fa-arrow-circle-right fa-2x text-primary"></i></span></div></div></div><div class="col-md-7 col-ms-7 " ></div><div class="col-md-3 col-ms-3 "><div class="row"><a href="" class="col-md-3" data-toggle="tooltip" data-title="Ordinary Mode"><img src="/img/normal.png" width="53%" height="73%"></img></a><a href="" class="col-md-3" data-toggle="tooltip" data-title="Presentation Mode"><img src="/img/pres.png" width="60%" height="80%"></img></a><a href="" class="col-md-3"><i class="fa fa-undo-alt text-dark " data-toggle="tooltip" data-title="Re-assign"></i></a></div></div></div>

<div class="row shadow">
  <?php
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
  <div class="col-md-8 shadow">
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
?>
</div>
</div>
<?php
$this->registerJsFile(
  '@web/js/marking.js',
  ['depends' => 'yii\web\JqueryAsset'],

);
?>