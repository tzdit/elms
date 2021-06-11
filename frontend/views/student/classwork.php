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
                    <a class="nav-link" id="custom-tabs-assessments" data-toggle="tab" href="#assessments" role="tab" aria-controls="assessments" aria-selected="false">Assessment</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-coursematerials" data-toggle="tab" href="#coursematerials" role="tab" aria-controls="coursematerials" aria-selected="false">Course materials</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-returned" data-toggle="tab" href="#returned" role="tab" aria-controls="returned" aria-selected="false">Returned</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-Announcements" data-toggle="tab" href="#announcements" role="tab" aria-controls="announcements" aria-selected="false">Announcements</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-quiz" data-toggle="tab" href="#quiz" role="tab" aria-controls="quiz" aria-selected="false">Quiz</a>
                  </li>
                </ul>
              
              </div>
             
              <div class="card-body">
             
                <div class="tab-content" id="custom-tabs-four-tabContent">

<!-- ########################################### forum work ######################################## --> 
                  <div class="tab-pane fade show active" id="forum" role="tabpanel" aria-labelledby="custom-tabs-forum">
                    WASHA PENZI KAMA MOTO
                  </div>     

<div class="tab-pane fade" id="assessments" role="tabpanel" aria-labelledby="custom-tabs-assessments">
<!-- ########################################### kazi ######################################## --> 
      <div class="row">
      <p>KAZI TUTAYAVUTA HAPA</p>
                  
      </div>

<div class="accordion" id="accordionExample_6">
</div>

</div>

<!-- ########################################### materials ######################################## -->      

<div class="tab-pane fade" id="coursematerials" role="tabpanel" aria-labelledby="custom-tabs-coursematerials">

      <div class="row">
      <p>MATERIALS TUTAZIVUTA HAPA</p>           
      </div>

<div class="accordion" id="accordionExample">
</div>

</div>
<!-- ########################################### returned marks ######################################## -->

<div class="tab-pane fade" id="returned" role="tabpanel" aria-labelledby="custom-tabs-returned">
<div class="row">
<p>RETURNED MARKS TUTAZIVUTA HAPA</p>
                  
</div>

<div class="accordion" id="accordionExample_3">
</div>

  </div>
  <!-- ########################################### announcements ######################################## --> 
     <div class="tab-pane fade" id="announcements" role="tabpanel" aria-labelledby="custom-tabs-Announcements">
          <div class="row">
            <p>ANOUNCEMENTS TUTAZIVUTA HAPA</p>
                  
        </div>

   <div class="accordion" id="accordionExample_4"></div>
   </div>
   <!-- ########################################### quiz######################################## --> 
   <div class="tab-pane fade" id="quiz" role="tabpanel" aria-labelledby="custom-tabs-quiz">
          <div class="row">
            <p>QUIZ TUTAZIVUTA HAPA</p>
                  
        </div>

   <div class="accordion" id="accordionExample_4">
   
  

</div>



     <!-- ########################################### end ################################# -->
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
