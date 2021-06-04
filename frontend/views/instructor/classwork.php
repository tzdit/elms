<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Custom;
use common\helpers\Security;
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


<div class="tab-pane fade" id="materials" role="tabpanel" aria-labelledby="custom-tabs-materials">
          <div class="row">
            <div class="col-md-12">
            <a href="#" class="btn btn-sm btn-primary btn-rounded float-right mb-2" data-target="#createMaterialModal" data-toggle="modal"><i class="fas fa-plus"  ></i> Create</a>
            </div>
                  
        </div>

   <div class="accordion" id="accordionExample4">
                 
              
             
  <?php for($i = 1; $i<=10; $i++): ?>
  <div class="card">
    <div class="card-header p-2" id="heading<?=$i?>">
      <h2 class="mb-0">
      <div class="row">
      <div class="col-sm-11">
      <button class="btn btn-link btn-block text-left col-md-11" type="button" data-toggle="collapse" data-target="#collapse<?=$i?>" aria-expanded="true" aria-controls="collapse<?=$i?>">
        <i class="fas fa-clipboard-list"></i> Material # <?=$i?>
        </button>
      </div>
      <div class="col-sm-1">
      <i class="fas fa-ellipsis-v float-right text-secondary text-sm"></i>
      </div>
      </div>
        
       
      </h2>
    </div>

    <div id="collapse<?=$i?>" class="collapse" aria-labelledby="heading<?=$i?>" data-parent="#accordionExample4">
      <div class="card-body">
       <?php if($i==1): ?>
       <p>This is Material One. </p>
       <?php elseif ($i==2): ?>
       This is Material Two 
       <?php elseif ($i==3): ?>
       This is Material Three my students 
       <?php else: ?>
       <p>Aisee kazi naiendeleeeeee</p>
       <?php endif ?>
      </div>
      <div class="card-footer p-2 bg-white border-top">
      <div class="row">
      <div class="col-md-6">
      <a href="#" class="text-mutted">View this Material</a>
      </div>
      <div class="col-md-6">
      <a href="#" class="btn btn-sm btn-info float-right ml-2"><span>Edit</span></a>
      <a href="#" class="btn btn-sm btn-danger float-right"><span>Delete</span></a>
     
      </div>
      </div>
      </div>
    </div>
  </div>
  <?php endfor ?>


</div>

</div>





<!-- ########################################### assignment work ######################################## -->      

<div class="tab-pane fade" id="assignments" role="tabpanel" aria-labelledby="custom-tabs-assignment">
      <div class="row">
        <div class="col-md-12">
              <a href="#" class="btn btn-sm btn-primary btn-rounded float-right mb-2" data-target="#createAssignmentModal" data-toggle="modal"><i class="fas fa-plus" data-toggle="modal" ></i> Create</a>
        </div>
                  
      </div>

<div class="accordion" id="accordionExample">
  <?php for($i = 1; $i<=10; $i++): ?>
  <div class="card">
    <div class="card-header p-2" id="heading<?=$i?>">
      <h2 class="mb-0">
      <div class="row">
      <div class="col-sm-11">
      <button class="btn btn-link btn-block text-left col-md-11" type="button" data-toggle="collapse" data-target="#collapse<?=$i?>" aria-expanded="true" aria-controls="collapse<?=$i?>">
        <i class="fas fa-clipboard-list"></i> Assignment # <?=$i?>
        </button>
      </div>
      <div class="col-sm-1">
      <i class="fas fa-ellipsis-v float-right text-secondary text-sm"></i>
      </div>
      </div>
        
       
      </h2>
    </div>

    <div id="collapse<?=$i?>" class="collapse" aria-labelledby="heading<?=$i?>" data-parent="#accordionExample">
      <div class="card-body">
       <?php if($i==1): ?>
       <p>This is Assignment One. All Students must attempt this assignemt</p>
       <?php elseif ($i==2): ?>
       This is assignment Two 
       <?php elseif ($i==3): ?>
       This is assignment Three my students 
       <?php else: ?>
       <p>Aisee kazi naiendeleeeeee</p>
       <?php endif ?>
      </div>
      <div class="card-footer p-2 bg-white border-top">
      <div class="row">
      <div class="col-md-6">
      <a href="#" class="text-mutted">View this assignment</a>
      </div>
      <div class="col-md-6">
      <a href="#" class="btn btn-sm btn-info float-right ml-2"><span>Edit</span></a>
      <a href="#" class="btn btn-sm btn-danger float-right"><span>Delete</span></a>
     
      </div>
      </div>
      </div>
    </div>
  </div>
  <?php endfor ?>


</div>

</div>


<!-- ########################################### lab work ######################################## -->

<div class="tab-pane fade" id="labs" role="tabpanel" aria-labelledby="custom-tabs-lab">
<div class="row">
        <div class="col-md-12">
              <a href="#" class="btn btn-sm btn-primary btn-rounded float-right mb-2" data-target="#createLabModal" data-toggle="modal"><i class="fas fa-plus" data-toggle="modal" ></i> Create</a>
        </div>
                  
      </div>

<div class="accordion" id="accordionExample3">
  <?php for($i = 1; $i<=10; $i++): ?>
  <div class="card">
    <div class="card-header p-2" id="heading<?=$i?>">
      <h2 class="mb-0">
      <div class="row">
      <div class="col-sm-11">
      <button class="btn btn-link btn-block text-left col-md-11" type="button" data-toggle="collapse" data-target="#collapse<?=$i?>" aria-expanded="true" aria-controls="collapse<?=$i?>">
        <i class="fas fa-clipboard-list"></i> Lab # <?=$i?>
        </button>
      </div>
      <div class="col-sm-1">
      <i class="fas fa-ellipsis-v float-right text-secondary text-sm"></i>
      </div>
      </div>
        
       
      </h2>
    </div>

    <div id="collapse<?=$i?>" class="collapse" aria-labelledby="heading<?=$i?>" data-parent="#accordionExample">
      <div class="card-body">
       <?php if($i==1): ?>
       <p>This is Lab One. All Students must attempt this lab</p>
       <?php elseif ($i==2): ?>
       This is lab Two 
       <?php elseif ($i==3): ?>
       This is lab Three my students 
       <?php else: ?>
       <p>Aisee kazi naiendeleeeeee</p>
       <?php endif ?>
      </div>
      <div class="card-footer p-2 bg-white border-top">
      <div class="row">
      <div class="col-md-6">
      <a href="#" class="text-mutted">View this lab</a>
      </div>
      <div class="col-md-6">
      <a href="#" class="btn btn-sm btn-info float-right ml-2"><span>Edit</span></a>
      <a href="#" class="btn btn-sm btn-danger float-right"><span>Delete</span></a>
     
      </div>
      </div>
      </div>
    </div>
  </div>
  <?php endfor ?>


</div>

  </div>
    
       
<!-- ########################################### tutorial work ######################################## -->
     <div class="tab-pane fade" id="tutorials" role="tabpanel" aria-labelledby="custom-tabs-tutorials">
          <div class="row">
            <div class="col-md-12">
            <a href="#" class="btn btn-sm btn-primary btn-rounded float-right mb-2" data-target="#createTutorialModal" data-toggle="modal"><i class="fas fa-plus"  ></i> Create</a>
            </div>
                  
        </div>

   <div class="accordion" id="accordionExample4">
                 
              
             
  <?php for($i = 1; $i<=10; $i++): ?>
  <div class="card">
    <div class="card-header p-2" id="heading<?=$i?>">
      <h2 class="mb-0">
      <div class="row">
      <div class="col-sm-11">
      <button class="btn btn-link btn-block text-left col-md-11" type="button" data-toggle="collapse" data-target="#collapse<?=$i?>" aria-expanded="true" aria-controls="collapse<?=$i?>">
        <i class="fas fa-clipboard-list"></i> Tutorial # <?=$i?>
        </button>
      </div>
      <div class="col-sm-1">
      <i class="fas fa-ellipsis-v float-right text-secondary text-sm"></i>
      </div>
      </div>
        
       
      </h2>
    </div>

    <div id="collapse<?=$i?>" class="collapse" aria-labelledby="heading<?=$i?>" data-parent="#accordionExample1">
      <div class="card-body">
       <?php if($i==1): ?>
       <p>This is Tutorial One. All Students must attempt this assignemt</p>
       <?php elseif ($i==2): ?>
       This is Tutorial Two 
       <?php elseif ($i==3): ?>
       This is Tutorial Three my students 
       <?php else: ?>
       <p>Aisee kazi naiendeleeeeee</p>
       <?php endif ?>
      </div>
      <div class="card-footer p-2 bg-white border-top">
      <div class="row">
      <div class="col-md-6">
      <a href="#" class="text-mutted">View this tutorial</a>
      </div>
      <div class="col-md-6">
      <a href="#" class="btn btn-sm btn-info float-right ml-2"><span>Edit</span></a>
      <a href="#" class="btn btn-sm btn-danger float-right"><span>Delete</span></a>
     
      </div>
      </div>
      </div>
    </div>
  </div>
  <?php endfor ?>


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
