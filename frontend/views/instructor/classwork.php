<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Custom;
use common\helpers\Security;
use common\models\Assignment;
use common\models\Submit;
use common\models\Material;
use frontend\models\UploadAssignment;
use frontend\models\UploadTutorial;
use frontend\models\UploadLab;
use frontend\models\UploadMaterial;

/* @var $this yii\web\View */
$this->params['courseTitle'] = "Course ".$cid;
$this->title = 'Classwork';
$this->params['breadcrumbs'] = [
  ['label'=>'classwork', 'url'=>Url::to(['/instructor/classwork', 'cid'=>$cid])],
  ['label'=>$this->title]
];

?>
 

<div class="site-index">
    <div class="body-content">
            <!-- Content Wrapper. Contains page content -->
   
       <div class="container-fluid">
      
 <div class="row">
          <!-- Left col -->
          <section class="col-lg-12">
          <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-forum" data-toggle="tab" href="#forum" role="tab" aria-controls="forum" aria-selected="true">Forum</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-materials" data-toggle="tab" href="#materials" role="tab" aria-controls="materials" aria-selected="false">Materials</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-assignments" data-toggle="tab" href="#assignments" role="tab" aria-controls="assignment" aria-selected="false">Assignments</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-lab" data-toggle="tab" href="#labs" role="tab" aria-controls="labs" aria-selected="false">Labs</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-tutorials" data-toggle="tab" href="#tutorials" role="tab" aria-controls="tutorials" aria-selected="false">Tutorials</a>
                  </li>
                </ul>
              
              </div>
             
              <div class="card-body">
             
                <div class="tab-content" id="custom-tabs-four-tabContent">

<!-- ########################################### forum work ######################################## --> 
                  <div class="tab-pane fade show active" id="forum" role="tabpanel" aria-labelledby="custom-tabs-forum">
                    TO DO FORUM!
                  </div>
<!-- ########################################### material work ######################################## --> 

<?php $mat = Material::find()->where(['course_code' => $cid])->count(); ?>

<!-- ########################################### material work ######################################## -->      

<div class="tab-pane fade" id="materials" role="tabpanel" aria-labelledby="custom-tabs-material">

      <div class="row">
        <div class="col-md-12">
              <a href="#" class="btn btn-sm btn-primary btn-rounded float-right mb-2" data-target="#createMaterialModal" data-toggle="modal"><i class="fas fa-plus" data-toggle="modal" ></i> Create</a>
        </div>
                  
      </div>

<div class="accordion" id="accordionExample_6">

<?php foreach( $materials as $material ) : ?>

  <div class="card">
    <div class="card-header p-2" id="heading<?=$mat?>">
      <h2 class="mb-0">
      <div class="row">
      <div class="col-sm-11">
      <button class="btn btn-link btn-block text-left col-md-11" type="button" data-toggle="collapse" data-target="#collapse<?=$mat?>" aria-expanded="true" aria-controls="collapse<?=$mat?>">
        <i class="fas fa-clipboard-list"></i> <?php echo "Material ".$mat?>
        </button>
      </div>
      <div class="col-sm-1">
      <i class="fas fa-ellipsis-v float-right text-secondary text-sm"></i>
      </div>
      </div>
         
       
      </h2>
    </div>

    <div id="collapse<?=$mat?>" class="collapse" aria-labelledby="heading<?=$mat?>" data-parent="#accordionExample_6">
      <div class="card-body">
         <p><span style="color:red"> Material Title: </span> <b> <?= $material -> title ?> </b></p>
      </div>
      <div class="card-footer p-2 bg-white border-top">
      <div class="row">
      <div class="col-md-6">
      <a href=""  class="text-mutted">Material <i class="fas fa-eye"></i></a>
      </div>
      <div class="col-md-6">
      <a href="#" class="btn btn-sm btn-danger float-right ml-2"><span><i class="fas fa-trash"></i></span></a>
      <a href="#" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-edit"></i></span></a>
      <a href="#" class="btn btn-sm btn-success float-right"><span><i class="fas fa-download"></i></span></a>
     
      </div>
      </div>
      </div>
    </div>
  </div>

  <?php 
         $mat--;
        
        ?>
  
  <?php endforeach ?>


</div>

</div>


<!-- ########################################### assignment work ######################################## -->

<?php $ass = Assignment::find()->where(['assNature' => 'assignment', 'course_code' => $cid])->count(); ?>      

<div class="tab-pane fade" id="assignments" role="tabpanel" aria-labelledby="custom-tabs-assignment">

      <div class="row">
        <div class="col-md-12">
              <a href="#" class="btn btn-sm btn-primary btn-rounded float-right mb-2" data-target="#createAssignmentModal" data-toggle="modal"><i class="fas fa-plus" data-toggle="modal" ></i> Create</a>
        </div>
                  
      </div>

<div class="accordion" id="accordionExample">
<?php $assk = "Assignment".$ass ;
$assk = "Assignment".$ass;
?>
<?php foreach( $assignments as $assign ) : ?>

  <div class="card">
    <div class="card-header p-2" id="heading<?=$ass?>">
      <h2 class="mb-0">
      <div class="row">
      <div class="col-sm-11">
      <button class="btn btn-link btn-block text-left col-md-11" type="button" data-toggle="collapse" data-target="#collapse<?=$ass?>" aria-expanded="true" aria-controls="collapse<?=$ass?>">
        <i class="fas fa-clipboard-list"></i> <?php echo "Assignment ".$ass;?>
        </button>
      </div>
      <div class="col-sm-1">
      <i class="fas fa-ellipsis-v float-right text-secondary text-sm"></i>
      </div>
      </div>
         
       
      </h2>
    </div>

    <div id="collapse<?=$ass?>" class="collapse" aria-labelledby="heading<?=$ass?>" data-parent="#accordionExample">
      <div class="card-body">
       <center>  <p><h6><span> Assignment Name: </span> <b> <?= $assign -> assName ?> </b></h6></p></center>
         
         <div class="card-footer p-0">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a href="<?=Url::to(['instructor/stdwork/', 'cid'=>$assign->course_code, 'id' => $assign->assID]) ?>" class="nav-link">
                    <span style="color: green">  Submitted Assignments</span> <span class="float-right badge bg-success"><?php echo $assi = Submit::find()->where(['assID' => $assign->assID])->count(); ?> </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?=Url::to(['instructor/stdworkmark/', 'cid'=>$assign->course_code, 'id' => $assign->assID]) ?>" class="nav-link">
                    <span style="color: red"> Marked Assignments </span> <span class="float-right badge bg-danger"><?php echo  $assi = Submit::find()->where(['assID' => $assign->assID, 'score' => " " or 'Null'])->count(),  " / " ,Submit::find()->where(['assID' => $assign->assID])->count(); ?> </span>
                    </a>
                  </li>
                </ul>
              </div> 
      </div>

      <div class="card-footer p-2 bg-white border-top">
      <div class="row">
      <div class="col-md-9">
      <i class="fas fa-clock" aria-hidden="true"></i> <b>Deadline : </b> <?= $assign -> finishDate ?>
      </div>
      <div class="col-md-3">
        
      <a href="#" class="btn btn-sm btn-danger float-right ml-2" data-toggle="modal" data-target="#modal-danger<?= $assign -> assID ?>"><span><i class="fas fa-trash"></i></span></a>
      <?= Html::a('<i class="fas fa-edit"></i>',['update', 'id'=>$assign->assID], ['class'=>'btn btn-sm btn-warning float-right ml-2']) ?>
      <a href="/storage/temp/<?= $assign -> fileName ?>" download target="_blank" class="btn btn-sm btn-success float-right ml-2"><span><i class="fas fa-download"></i></span></a>
      <a href="#" class="btn btn-sm btn-danger float-right"><span> <i class="fa fa-check-circle"></i></span></a>
     
      </div>
      </div>
      </div>
    </div>
  </div>

  <?php 
         $ass--;
        
        ?>
        
<div class="modal fade" id="modal-danger<?= $assign -> assID ?>">

        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">Deleting <b> <?= $assign -> assName ?> </b> Assignment</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <div class="modal-body">
            
              <p>Are you sure, you want to delete <b> <?= $assign -> assName ?> </b> assignment&hellip;?</p>
              
            </div>
            <div class="modal-footer justify-content-between">
            
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <?= Html::a('Delete', ['delete', 'cid'=>$assign->course_code, 'id'=>$assign -> assID], ['class'=>'btn btn-sm btn-danger float-right ml-2 btn-outline-light']) ?>
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        
      </div>
      <!-- /.modal -->
  
  <?php endforeach ?>


</div>

</div>


<?php $labb = Assignment::find()->where(['assNature' => 'lab', 'course_code' => $cid])->count(); ?>
<!-- ########################################### lab work ######################################## -->

<div class="tab-pane fade" id="labs" role="tabpanel" aria-labelledby="custom-tabs-lab">
<div class="row">
        <div class="col-md-12">
              <a href="#" class="btn btn-sm btn-primary btn-rounded float-right mb-2" data-target="#createLabModal" data-toggle="modal"><i class="fas fa-plus" data-toggle="modal" ></i> Create</a>
        </div>
                  
      </div>

<div class="accordion" id="accordionExample_3">
<?php foreach( $labs as $lab ) : ?>
  <div class="card">
    <div class="card-header p-2" id="heading<?=$labb?>">
      <h2 class="mb-0">
      <div class="row">
      <div class="col-sm-11">
      <button class="btn btn-link btn-block text-left col-md-11" type="button" data-toggle="collapse" data-target="#collapse<?=$labb?>" aria-expanded="true" aria-controls="collapse<?=$labb?>">
        <i class="fas fa-clipboard-list"></i> <?php echo "Lab ".$labb;?>
        </button>
      </div>
      <div class="col-sm-1">
      <i class="fas fa-ellipsis-v float-right text-secondary text-sm"></i>
      </div>
      </div>
        
       
      </h2>
    </div>

    <div id="collapse<?=$labb?>" class="collapse" aria-labelledby="heading<?=$labb?>" data-parent="#accordionExample_3">
      <div class="card-body">
      <center>  <p><h6><span> Lab Name: </span> <b> <?= $lab -> assName ?> </b></h6></p></center>
         
         <div class="card-footer p-0">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a href="<?=Url::to(['instructor/stdworklab/', 'cid'=>$lab->course_code, 'id' => $lab->assID]) ?>" class="nav-link">
                    <span style="color: green">  Submitted Labs</span> <span class="float-right badge bg-success"><?php echo $labi = Submit::find()->where(['assID' => $lab->assID])->count(); ?> </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?=Url::to(['instructor/stdlabmark/', 'cid'=>$lab->course_code, 'id' => $lab->assID]) ?>" class="nav-link">
                    <span style="color: red"> Marked Labs </span> <span class="float-right badge bg-danger"><?php echo  $assi = Submit::find()->where(['assID' => $lab->assID, 'score' => " " or 'Null'])->count(),  " / " ,Submit::find()->where(['assID' => $lab->assID])->count(); ?> </span>
                    </a>
                  </li>
                </ul>
              </div> 
      </div>
      
      <div class="card-footer p-2 bg-white border-top">
      <div class="row">
      <div class="col-md-9">
      <i class="fas fa-clock" aria-hidden="true"></i> <b>Deadline : </b> <?= $lab -> finishDate ?>
      </div>
      <div class="col-md-3">
        
      <a href="#" class="btn btn-sm btn-danger float-right ml-2" data-toggle="modal" data-target="#modal-danger<?= $lab -> assID ?>"><span><i class="fas fa-trash"></i></span></a>
      <?= Html::a('<i class="fas fa-edit"></i>',['update', 'id'=>$assign->assID], ['class'=>'btn btn-sm btn-warning float-right ml-2']) ?>
      <a href="/storage/temp/<?= $lab -> fileName ?>" download target="_blank" class="btn btn-sm btn-success float-right ml-2"><span><i class="fas fa-download"></i></span></a>
      <a href="#" class="btn btn-sm btn-danger float-right"><span> <i class="fa fa-check-circle"></i></span></a>
     
      </div>
      </div>
      </div>
    </div>
  </div>
  <?php 
         $labb--;
        
        ?>
  <div class="modal fade" id="modal-danger<?= $lab -> assID ?>">

<div class="modal-dialog">
  <div class="modal-content bg-danger">
    <div class="modal-header">
      <h4 class="modal-title">Deleting <b> <?= $lab -> assName ?> </b> Lab</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    
    <div class="modal-body">
    
      <p>Are you sure, you want to delete <b> <?= $lab -> assName ?> </b> lab&hellip;?</p>
      
    </div>
    <div class="modal-footer justify-content-between">
    
      <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
      <?= Html::a('Delete', ['deletelab', 'cid'=>$lab->course_code, 'id'=>$lab -> assID], ['class'=>'btn btn-sm btn-danger float-right ml-2 btn-outline-light']) ?>
    </div>
    
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->



</div>
  <?php endforeach ?>


</div>

  </div>
    
       
  <?php $tutt = Assignment::find()->where(['assNature' => 'tutorial', 'course_code' => $cid])->count(); ?>
<!-- ########################################### tutorial work ######################################## -->
     <div class="tab-pane fade" id="tutorials" role="tabpanel" aria-labelledby="custom-tabs-tutorials">
          <div class="row">
            <div class="col-md-12">
            <a href="#" class="btn btn-sm btn-primary btn-rounded float-right mb-2" data-target="#createTutorialModal" data-toggle="modal"><i class="fas fa-plus"  ></i> Create</a>
            </div>
                  
        </div>

   <div class="accordion" id="accordionExample_4">
                 
              
             
   <?php foreach( $tutorials as $tutorial ) : ?>
  <div class="card">
    <div class="card-header p-2" id="heading<?=$tutt?>">
      <h2 class="mb-0">
      <div class="row">
      <div class="col-sm-11">
      <button class="btn btn-link btn-block text-left col-md-11" type="button" data-toggle="collapse" data-target="#collapse<?=$tutt?>" aria-expanded="true" aria-controls="collapse<?=$tutt?>">
        <i class="fas fa-clipboard-list"></i> <?php echo "Tutorial ".$tutt;?>
        </button>
      </div>
      <div class="col-sm-1">
      <i class="fas fa-ellipsis-v float-right text-secondary text-sm"></i>
      </div>
      </div>
        
       
      </h2>
    </div>

    <div id="collapse<?=$tutt?>" class="collapse" aria-labelledby="heading<?=$tutt?>" data-parent="#accordionExample_4">
      <div class="card-body">
      <p><span style="color:red"> Tutorial Title: </span> <b> <?= $tutorial -> assName ?> </b></p>
      </div>
      <div class="card-footer p-2 bg-white border-top">
      <div class="row">
      <div class="col-md-6">
      <a href=""  class="text-mutted">Tutorials <i class="fas fa-eye"></i></a>
      </div>
      <div class="col-md-6">
      <a href="#" class="btn btn-sm btn-danger float-right ml-2"><span><i class="fas fa-trash"></i></span></a>
      <a href="#" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-edit"></i></span></a>
      <a href="#" class="btn btn-sm btn-success float-right"><span><i class="fas fa-download"></i></span></a>
     
      </div>
      </div>
      </div>
    </div>
  </div>
  <?php 
         $tutt--;
        
        ?>
  <?php endforeach ?>


</div>

</div>



     <!-- ########################################### end tutorial ################################# -->
    </div>
    </div>
</div>

</section>
          
</div>

      </div><!--/. container-fluid -->

    </div>
</div>
<!--  ###################################render model to create_assignment ###########################################-->
<?php 
$assmodel = new UploadAssignment();
?>
<?= $this->render('assignments/create_assignment', ['assmodel'=>$assmodel, 'ccode'=>$cid]) ?>

<!--  ###################################render model to Create_tutorial ##############################################-->
<?php 
$tutmodel = new UploadTutorial();
?>
<?= $this->render('tutorials/create_tutorial', ['tutmodel'=>$tutmodel, 'ccode'=>$cid]) ?>

<!--  ###################################render model to Create_lab ####################################################-->
<?php 
$labmodel = new UploadLab();
?>
<?= $this->render('labs/create_lab', ['labmodel'=>$labmodel, 'ccode'=>$cid]) ?>

<!--  ###################################render model to create_material ####################################################-->
<?php 
$assmodel = new UploadMaterial();
?>
<?= $this->render('materials/create_material', ['assmodel'=>$assmodel, 'ccode'=>$cid]) ?>



<?php 
$script = <<<JS
$(document).ready(function(){
  $("#CoursesTable").DataTable({
    responsive:true,
  });
  
  $(document).on('click', '.enroll', function(){
      $('.course-description').text($(this).attr('ccode')+'=>'+$(this).attr('cname'));
      $("#ccode").val($(this).attr('ccode'));
    })
    //sweetalert start here
    $(document).on('click', '.drop', function(){
      var ccode = $(this).attr('ccode');
 

      Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'question',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, Drop it!'
}).then((result) => {
  if (result.isConfirmed) {
 
    $.ajax({
      url:'/instructor/dropcourse',
      method:'post',
      async:false,
      dataType:'JSON',
      data:{ccode:ccode},
      success:function(data){
        if(data.message){
          Swal.fire(
              'Droped!',
              data.message,
              'success'
    )
    setTimeout(function(){
      window.location.reload();
    }, 1500);
   

        }
      }
    })
   
  }
})

})

//Remember active tab
$('a[data-toggle="tab"]').on('show.bs.tab', function(e) {

localStorage.setItem('activeTab', $(e.target).attr('href'));

});

var activeTab = localStorage.getItem('activeTab');

if(activeTab){

$('#custom-tabs-four-tab a[href="' + activeTab + '"]').tab('show');

}
  
});
JS;
$this->registerJs($script);
?>
