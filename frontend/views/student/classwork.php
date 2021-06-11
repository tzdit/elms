<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Custom;
use common\helpers\Security;
use common\models\Assignment;
use frontend\models\UploadMaterial;

/* @var $this yii\web\View */
$this->params['courseTitle'] = "TN 330";
$this->title = 'Classwork';
$this->params['breadcrumbs'] = [
  ['label'=>'classwork', 'url'=>Url::to(['/student/classwork'])],
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
                    WASHA PENZI KAMA MOTO
                  </div>     

<div class="tab-pane fade" id="materials" role="tabpanel" aria-labelledby="custom-tabs-material">

      <div class="row">
      <p>MATERIALS  TUTAYAVUTA HAPA</p>
                  
      </div>

<div class="accordion" id="accordionExample_6">
</div>

</div>

<!-- ########################################### assignment work ######################################## -->      

<div class="tab-pane fade" id="assignments" role="tabpanel" aria-labelledby="custom-tabs-assignment">

      <div class="row">
      <p>TUTORIALS TUTAZIVUTA HAPA</p>           
      </div>

<div class="accordion" id="accordionExample">
</div>

</div>
<!-- ########################################### lab work ######################################## -->

<div class="tab-pane fade" id="labs" role="tabpanel" aria-labelledby="custom-tabs-lab">
<div class="row">
<p>LABS NITAZIVUTA HAPA</p>
                  
      </div>

<div class="accordion" id="accordionExample_3">
</div>

  </div>
     <div class="tab-pane fade" id="tutorials" role="tabpanel" aria-labelledby="custom-tabs-tutorials">
          <div class="row">
            <p>TUTORIALS TUTAZIVUTA HAPA</p>
                  
        </div>

   <div class="accordion" id="accordionExample_4">
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
<?php 
$script = <<<JS
$(document).ready(function(){
  $("#CoursesTable").DataTable({
    responsive:true,
  });
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
