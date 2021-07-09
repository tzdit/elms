<?php 
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Security;
use common\helpers\Custom;
use common\models\Instructor;
use yii\helpers\ArrayHelper;

$this->params['courseTitle'] = "Marking:".yii::$app->session->get('ccode')." ".$assignment->assName;
$this->title = 'Assignment Marking';
$submits=[];
$asstype="";
if($assignment->assType=="allgroups" || $assignment->assType=="groups")
{
  $submits=$assignment->groupAssignmentSubmits;
  $asstype="group";
}
else
{
  $submits=$assignment->submits;
  $asstype="class";
}
?>
<body>

<div class="row shadow">
<div class="col-md-2 shadow">  
<table class="table d-flex mytable" style="font-size:10px;cursor:pointer">
<tr class="d-flex"><th>s/no</th><th>reg #</th></tr>

<?php 
for($sub=0;$sub<count($submits);$sub++)
{
?>
<tr class="d-flex"><td id="<?=$submits[$sub]->submitID;?>"><?=$sub+1?><td id="<?=$submits[$sub]->fileName;?>"><?php if($asstype=="class"){print $submits[$sub]->reg_no;}else{ print $submits[$sub]->group->groupName;}?></td></tr>
<?php
}
?>

</table>
</div>
  <div class="col-md-8 shadow">
    <iframe src="/storage/submit/AFB5xyOReilly.Head.First.PHP.and.MySQL.Dec.2008.pdf" style="width:100%;border:none" height="426" id="fileobj"  type="application/pdf">
    the file here

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
<div class="form-group"><input type="text" class="form-control score" id="<?=$questions[$q]->assq_ID?>"placeholder="<?php echo "Q".$questions[$q]->qno;?>"></input><input type="text" class="form-control maxscore" value="<?=$questions[$q]->total_marks ?>" readonly></input></div>
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
</div>
<?php
$this->registerJsFile(
  '@web/js/marking.js',
  ['depends' => 'yii\web\JqueryAsset'],

);
?>