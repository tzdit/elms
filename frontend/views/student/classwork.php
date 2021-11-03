<?php

use yii\helpers\Url;


/* @var $this yii\web\View */
$this->params['courseTitle'] =$cid;
$this->title = 'Class'; 
$this->params['breadcrumbs'] = [
  ['label'=>'Class', 'url'=>Url::to(['/student/classwork', 'cid'=>$cid])],
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
                      <div class="card-body" >
          <!--  ################################### classwork dashboard ######################################################### -->
                              <div class="row container-fluid">

                                 <div class="col-sm-3 col-12">

                                     <a href="<?=Url::to(['student/assignment/', 'cid'=>$cid])  ?>" class="card p-3 row result-card ">
                                         <img src="<?=  Yii::getAlias('@web/img/assignment.png')?>" height="35px" width="35px"/>
                                         <h5>
                                             Assignment
                                         </h5>
                                     </a>

                                 </div>

                                  <div class="col-sm-3 col-12">

                                      <a href="<?=Url::to(['student/group-assignment/', 'cid'=>$cid])  ?>" class="card p-3 result-card">
                                          <img src="<?=  Yii::getAlias('@web/img/group.png')?>" height="35px" width="35px"/>
                                          <h5>
                                              Group Assignment
                                          </h5>
                                      </a>

                                  </div>

                                  <div class="col-sm-3 col-12">

                                      <a href="<?=Url::to(['student/labs/', 'cid'=>$cid])  ?>" class="card p-3 result-card">
                                          <img src="<?=  Yii::getAlias('@web/img/computer_lab.png')?>" height="35px" width="35px"/>
                                          <h5>
                                              Lab Work's
                                          </h5>
                                      </a>

                                  </div>

                                  <div class="col-sm-3 col-12">

                                      <a href="<?=Url::to(['student/tutorial/', 'cid'=>$cid])  ?>" class="card p-3 result-card ">
                                          <img src="<?=  Yii::getAlias('@web/img/tutorials.png')?>" height="35px" width="35px"/>
                                          <h4>
                                                Tutorials
                                          </h4>
                                      </a>

                                  </div>

                                  <div class="col-sm-3 col-12">

                                      <a href="<?=Url::to(['student/course-materials/', 'cid'=>$cid])  ?>" class="card p-3 result-card">
                                          <img src="<?=  Yii::getAlias('@web/img/classmaterial.png')?>" height="35px" width="35px"/>
                                          <h5>
                                              Course Material
                                          </h5>
                                      </a>

                                  </div>

                                  <div class="col-sm-3 col-12">

                                      <a href="<?=Url::to(['student/returned/', 'cid'=>$cid])  ?>" class="card p-3 result-card">
                                          <img src="<?=  Yii::getAlias('@web/img/exam-results.png')?>" height="35px" width="35px"/>
                                          <h5>
                                              Returned
                                          </h5>
                                      </a>

                                  </div>

                                  <div class="col-sm-3 col-12">

                                      <a href="<?=Url::to(['student/course-announcement/', 'cid'=>$cid])  ?>" class="card p-3 result-card">
                                          <img src="<?=  Yii::getAlias('@web/img/announcement.png')?>" height="35px" width="35px"/>
                                          <h5>
                                              Announcement
                                          </h5>
                                      </a>

                                  </div>

                                  <div class="col-sm-3 col-12">

                                      <a href="<?= Url::toRoute(['/student/quiz','cid' => $cid])  ?>" class="card p-3 result-card">
                                          <img src="<?=  Yii::getAlias('@web/img/quiz.png')?>" height="35px" width="35px"/>
                                          <h5>
                                              Quiz
                                          </h5>
                                      </a>

                                  </div>

                             </div>
          <!--  ################################### classwork dashboard end ######################################################### -->

        <!-- ########################################### forum work ######################################## -->
                          <div class="tab-pane fade show active" id="forum" role="tabpanel" aria-labelledby="custom-tabs-forum">

                          </div>
        <!-- ########################################### forum work end ######################################## -->



         <!-- ########################################### quiz ######################################## -->
<!--           <div class="tab-pane fade" id="quiz" role="tabpanel" aria-labelledby="custom-tabs-quiz">-->
<!--           <div class="accordion" id="accordionExample_4">-->
<!---->
<!--           <div class="row">-->
<!---->
<!---->
<!--            <div class="container-fluid admin">-->
<!--                <div class="col-md-12 alert alert-primary">My Quiz List</div>-->
<!--                <br>-->
<!--                <div class="card">-->
<!--                    <div class="card-body">-->
<!--                        <table class="table table-bordered" id='table'>-->
<!--                            <colgroup>-->
<!--                                <col width="10%">-->
<!--                                <col width="30%">-->
<!--                                <col width="20%">-->
<!--                                <col width="20%">-->
<!--                                <col width="20%">-->
<!--                            </colgroup>-->
<!--                            <thead>-->
<!--                                <tr>-->
<!--                                    <th>#</th>-->
<!--                                    <th>Quiz</th>-->
<!--                                    <th>Score</th>-->
<!--                                    <th>Status</th>-->
<!--                                    <th>Action</th>-->
<!--                                </tr>-->
<!--                            </thead>-->
<!--                            <tbody>-->
<!--                            <tr>-->
<!--                                <td>MMMMMM</td>-->
<!--                                <td>NNNNNNN</td>-->
<!--                                <td>YYYYYYY</td>-->
<!--                                <td>MMMMMMM</td>-->
<!--                                <td>-->
<!--                                    <center>-->
<!--                                        <a class="btn btn-sm btn-outline-primary" href="--><?//= Url::toRoute(['student/quiz_answer'])?><!--"><i class="fa fa-pencil"></i> Take Quiz</a>-->
<!---->
<!--                                        <a class="btn btn-sm btn-outline-primary" href="--><?//= Url::toRoute(['student/quiz_view'])?><!--"><i class="fa fa-eye"></i>Results</a>-->
<!---->
<!--                                    </center>-->
<!--                                </td>-->
<!--                            </tr>-->
<!--                            </tbody>-->
<!--                        </table>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--          </div>-->
<!---->
<!---->
<!--        </div>-->
<!---->
<!---->
<!---->
<!--        </div>-->
<!---->
   <!-- ########################################### quiz end ################################# -->
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
