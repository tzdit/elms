<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Custom;
use common\helpers\Security;
use common\models\StudentCourse;
use frontend\models\StudentGroups;

/* @var $this yii\web\View */
$this->params['courseTitle'] = "Course ".$cid;
$this->title = 'student groups';
$this->params['breadcrumbs'] = [
  ['label'=>'classwork', 'url'=>Url::to(['/instructor/classwork', 'cid'=>$cid])],
  ['label'=>$this->title]
];

?>




      <div class="row">
        <div class="col-md-12">
        <a href="#" class="btn btn-sm btn-primary btn-rounded float-right mb-2" data-target="#mymodal" data-toggle="modal"><i class="fas fa-group" ></i>Student Groups</a>
        </div>
                  
      </div>
<?php foreach($groups as $group)  {?>
<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header p-2" id="heading">
      <h2 class="mb-0">
      <div class="row">
      <div class="col-sm-11">
      <button class="btn btn-link btn-block text-left col-md-11" type="button" data-toggle="collapse" data-target="#collapse" aria-expanded="true" aria-controls="collapse">
        <i class="fas fa-clipboard-list"></i> <?php $course=$group->groups[0]->course_code; if($course==$cid){print $group->generation_type;}?>
        </button>
      </div>
      <div class="col-sm-1">
      <i class="fas fa-ellipsis-v float-right text-secondary text-sm"></i>
      </div>
      </div>
         
       
      </h2>
    </div>

    <div id="collapse" class="collapse" aria-labelledby="heading" data-parent="#accordionExample">
      <div class="card-body">
         <div class="card-footer p-0">
                <ul class="nav flex-column">
                <?php for($g=0;$g<count($group->groups);$g++){?>
                  <li class="nav-item">
                    <a href="" class="nav-link">
                    <span style="color: green"><?php print $group->groups[$g]->groupName; ?></span> <span class="float-right badge bg-success"> </span>
                    </a>
                  </li>
                  <?php }?>
                </ul>
              </div> 
      </div>

      <div class="card-footer p-2 bg-white border-top">
      <div class="row">
      <div class="col-md-9">
      <i class="fas fa-clock" aria-hidden="true"></i> <b>Deadline : </b> 
      </div>
      <div class="col-md-3">
        
      <a href="#" class="btn btn-sm btn-danger float-right ml-2" data-toggle="modal" data-target="#modal-danger"><span><i class="fas fa-trash"></i></span></a>
      <a href="/storage/temp/" download target="_blank" class="btn btn-sm btn-success float-right ml-2"><span><i class="fas fa-download"></i></span></a>
      <a href="#" class="btn btn-sm btn-danger float-right"><span> <i class="fa fa-check-circle"></i></span></a>
     
      </div>
      </div>
      </div>
    </div>
  </div>

  <?php 
      
  }
        ?>
        
<div class="modal fade" id="modal-danger">

        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">Deleting <b>  </b> Assignment</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <div class="modal-body">
            
              <p>Are you sure, you want to delete <b>  </b> assignment&hellip;?</p>
              
            </div>
            <div class="modal-footer justify-content-between">
            
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
        
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        
      </div>
      <!-- /.modal -->
  
  <?php// endforeach ?>
<!-- ################################################## model for new groups################################  -->

<?php 
$studentGroups = new StudentGroups();
?>
<?= $this->render('students/generate_group',['studentGroups'=>$studentGroups]) ?>

</div>

</div>