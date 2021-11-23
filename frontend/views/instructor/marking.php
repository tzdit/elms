<?php 
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Security;
use common\helpers\Custom;
use common\models\QMarks;
use common\models\Instructor;
use yii\helpers\ArrayHelper;

$this->params['courseTitle'] = "Marking:".yii::$app->session->get('ccode')." ".$assignment->assName;
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

<div class="row shadow">
  <?php
if($submits!=null)
{
  ?>
<div class="col-md-2 shadow" style="height:100%;overflow:auto;position:absolute">  
<table class="table d-flex mytable" style="font-size:10px;cursor:pointer">
<tr class="d-flex"><th>s/no</th><th>reg #</th></tr>

<?php 

for($sub=0;$sub<count($submits);$sub++)
{
  if($submits[$sub]->score!=null || $submits[$sub]->score!="")
  {
?>
<tr class="d-flex bg-primary"><td id="<?=$submits[$sub]->submitID;?>"><?=$sub+1?><td id="<?=$submits[$sub]->fileName;?>"><?php if($asstype=="class"){print $submits[$sub]->reg_no;}else{ print $submits[$sub]->group->groupName;}?></td></tr>
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
    <iframe src="" style="width:100%;border:none" height="426" id="fileobj"  type="application/pdf">
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
<div id="mrow" class="col-md-12">
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
<textarea id="<?=$asstype?>"class="form-control comment" placeholder="Comment" style="margin-bottom:4px"></textarea>
</div>
</div>
</div>
<?php
}
else
{
  print '<div class="container-fluid text-primary text-center">No any submits</div>';
}
?>
</div>
<?php
$this->registerJsFile(
  '@web/js/marking.js',
  ['depends' => 'yii\web\JqueryAsset'],

);
?>