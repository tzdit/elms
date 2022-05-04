<?php

use yii\helpers\Url;
use frontend\models\ClassRoomSecurity;
use common\models\Course;


/* @var $this yii\web\View */
$this->params['courseTitle'] ="<i class='fas fa-th'></i> ".$cid.' Dashboard'; 
$this->title = $cid.' Dashboard'; 
$this->params['breadcrumbs'] = [
  ['label'=>$this->title]
];
$course=Course::findOne($cid);
?>


<div class="site-index p-0">    
    <div class="body-content p-0">
            <!-- Content Wrapper. Contains page content -->
   
       <div class="container-fluid p-0">
      
 <div class="row p-0">
          <!-- Left col -->
          <section class="col-lg-12 ">
                      <div class="card-body p-0 pl-1" >
          <!--  ################################### classwork dashboard ######################################################### -->
                              <div class="row container-fluid ">

                                <div class="col-sm-3 col-12 ">
                                <a href="<?=Url::to(['student/view-normal-assignments/', 'cid'=> ClassRoomSecurity::encrypt($cid)])  ?>" class="card pl-2 pr-1  py-2 row result-card mx-1 my-2 ">
                                                                <?php
                                        $indiv_ass_count=$course->newIndividualAssignmentsCount();
                                        if($indiv_ass_count>0)
                                        {
                                        ?>
                                        <span class="nav-link float-right" data-toggle="dropdown" href="#" style="position:absolute;right:0">
                                        <span class="badge badge-danger navbar-badge"><?=$indiv_ass_count?></span>
                                        </span>
                                        <?php
                                        }
                                        ?>
                               
                                <img src="<?=  Yii::getAlias('@web/img/Assignment4.png')?>" height="34px" width="38px"/>
                                    <h5>
                                            Individual Assignments
                                    </h5>
                                </a>

                                </div>

                                  <div class="col-sm-3 col-12">

                                      <a href="<?=Url::to(['student/student-group/', 'cid'=> ClassRoomSecurity::encrypt($cid)])  ?>" class="card pl-2 pr-1  py-2 result-card mx-1 my-2">
                                      <?php
                                        $group_ass_count=$course->newGroupAssignmentsCount();
                                        if($group_ass_count>0)
                                        {
                                        ?>
                                        <span class="nav-link float-right" data-toggle="dropdown" href="#" style="position:absolute;right:0">
                                        <span class="badge badge-danger navbar-badge"><?=$group_ass_count?></span>
                                        </span>
                                        <?php
                                        }
                                        ?>
                                          <img src="<?=  Yii::getAlias('@web/img/groupass.png')?>" height="35px" width="35px"/>
                                          <h5>
                                              Group Assignments
                                          </h5>
                                      </a>

                                  </div>



                                  <div class="col-sm-3 col-12">

                                      <a href="<?=Url::to(['student/tutorial/', 'cid'=> ClassRoomSecurity::encrypt($cid)])  ?>" class="card pl-2 pr-1  py-2 result-card mx-1 my-2">
                                      <?php
                                        $tutorialscount=$course->newtutorialsCount();
                                        if($tutorialscount>0)
                                        {
                                        ?>
                                        <span class="nav-link float-right" data-toggle="dropdown" href="#" style="position:absolute;right:0">
                                        <span class="badge badge-danger navbar-badge"><?=$tutorialscount?></span>
                                        </span>
                                        <?php
                                        }
                                        ?>
                                          <img src="<?=  Yii::getAlias('@web/img/tutorials.png')?>" height="35px" width="35px"/>
                                          <h5>
                                                Tutorials
                                          </h5>
                                      </a>

                                  </div>

                                  <div class="col-sm-3 col-12">


                                      <a href="<?=Url::to(['videos-and-notes/modules/', 'cid' => ClassRoomSecurity::encrypt($cid)])  ?>" class="card pl-2 pr-1  py-2 result-card mx-1 my-2">
                                      <?php
                                        $materialscount=$course->newMaterialsCount();
                                        if($materialscount>0)
                                        {
                                        ?>
                                        <span class="nav-link float-right" data-toggle="dropdown" href="#" style="position:absolute;right:0">
                                        <span class="badge badge-danger navbar-badge"><?=$materialscount?></span>
                                        </span>
                                        <?php
                                        }
                                        ?>
                                          <img src="<?=  Yii::getAlias('@web/img/classmaterial.png')?>" height="35px" width="35px"/>
                                          <h5>
                                              Course Materials
                                          </h5>
                                      </a>

                                  </div>

                                  <div class="col-sm-3 col-12">

                                      <a href="<?=Url::to(['student/returned/', 'cid'=> ClassRoomSecurity::encrypt($cid)])  ?>" class="card pl-2 pr-1  py-2 result-card mx-1 my-2">
                                          <img src="<?=  Yii::getAlias('@web/img/submitted 3.png')?>" height="35px" width="35px"/>
                                          <h5>
                                              My submitted
                                          </h5>
                                      </a>

                                  </div>

                                  <div class="col-sm-3 col-12">

                                      <a href="<?=Url::to(['student/course-announcement/', 'cid'=> ClassRoomSecurity::encrypt($cid)])  ?>" class="card pl-2 pr-1  py-2 result-card mx-1 my-2">
                                      <?php
                                        $announcementscount=$course->NewAnnouncemntsCount();
                                        if($announcementscount>0)
                                        {
                                        ?>
                                        <span class="nav-link float-right" data-toggle="dropdown" href="#" style="position:absolute;right:0">
                                        <span class="badge badge-danger navbar-badge"><?=$announcementscount?></span>
                                        </span>
                                        <?php
                                        }
                                        ?>
                                          <img src="<?=  Yii::getAlias('@web/img/announcement.png')?>" height="35px" width="35px"/>
                                          <h5>
                                              Announcements
                                          </h5>
                                      </a>

                                  </div>


                                  <div class="col-sm-3 col-12">

                                      <a href="<?= Url::toRoute(['/student/quiz','cid' => ClassRoomSecurity::encrypt($cid)])  ?>" class="card pl-2 pr-1  py-2 result-card mx-1 my-2">
                                          <img src="<?=  Yii::getAlias('@web/img/quiz.png')?>" height="35px" width="35px"/>
                                          <h5>
                                              Quizes
                                          </h5>
                                      </a>

                                  </div>


                                  <div class="col-sm-3 col-12">
                                  <a href="<?=Url::to(['forum/index', 'cid'=>ClassRoomSecurity::encrypt($cid)])  ?>" class="card pl-2 pr-1  py-2 result-card mx-1 my-2">
                                  <?php
                                  
                                        $new_in_forum_count=$course->newInForumCount();
                                        if($new_in_forum_count>0)
                                        {
                                        ?>
                                        <span class="nav-link float-right" data-toggle="dropdown" href="#" style="position:absolute;right:0">
                                        <span class="badge badge-danger navbar-badge"><?=$new_in_forum_count?></span>
                                        </span>
                                        <?php
                                        }
                                        ?>
                                     
                                          <img src="<?=  Yii::getAlias('@web/img/forum1.png')?>" height="35px" width="35px"/>
                                          <h5>
                                              Forum
                                          </h5>
                                      </a>

                                  </div>

                                  <div class="col-sm-3 col-12">

                                      <a href="<?=Url::to(['student/classmates'])  ?>" class="card pl-2 pr-1  py-2 result-card mx-1 my-2">
                                          <img src="<?=  Yii::getAlias('@web/img/student.png')?>" height="35px" width="35px"/>
                                          <h5>
                                              Classmates
                                          </h5>
                                      </a>

                                  </div>

                                    <div class="col-sm-3 col-12">

                                            <a href="<?=Url::to(['student/my-ca'])  ?>" class="card pl-2 pr-1  py-2 result-card mx-1 my-2">
                                                <img src="<?=  Yii::getAlias('@web/img/ca3.png')?>" height="35px" width="35px"/>
                                                <h5>
                                                    My CA
                                                </h5>
                                            </a>

                                    </div>

                                  <div class="col-sm-3 col-12">
                                  <a href="<?=Url::to(['student/group-management-view/','cid'=> ClassRoomSecurity::encrypt($cid)])  ?>" class="card pl-2 pr-1  py-2 result-card mx-1 my-2">
                                  <?php
                                  
                                  $newgroupscount=$course->newGroupsCount();
                                  if($newgroupscount>0)
                                  {
                                  ?>
                                  <span class="nav-link float-right" data-toggle="dropdown" href="#" style="position:absolute;right:0">
                                  <span class="badge badge-danger navbar-badge"><?= $newgroupscount?></span>
                                  </span>
                                  <?php
                                  }
                                  ?>

                                     
                                          <img src="<?=  Yii::getAlias('@web/img/group.png')?>" height="35px" width="35px"/>
                                          <h5>
                                              My Groups
                                          </h5>
                                      </a>

                                  </div>

                                  <div class="col-sm-3 col-12">

                                      <a href="<?=Url::to(['student-lectureroom/lectures/','cid'=> ClassRoomSecurity::encrypt($cid)])  ?>" class="card pl-2 pr-1  py-2 result-card mx-1 my-2">
                                      <?php
                                  
                                  $newlecturescount=$course->newLecturesCount();
                                  if($newlecturescount>0)
                                  {
                                  ?>
                                  <span class="nav-link float-right" data-toggle="dropdown" href="#" style="position:absolute;right:0">
                                  <span class="badge badge-danger navbar-badge"><?=$newlecturescount?></span>
                                  </span>
                                  <?php
                                  }
                                  ?>
                                          <img src="<?=  Yii::getAlias('@web/img/school 2.png')?>" height="37px" width="40px"/>
                                          <h5>
                                              Lecture Room
                                          </h5>
                                      </a>

                                  </div>

                                  <div class="col-sm-3 col-12">

                                    <a href="<?=Url::to(['student/externals/'])  ?>" class="card pl-2 pr-1  py-2 result-card mx-1 my-2">
                                    <?php
                                  
                                  $newExtAssesscount=$course->NewExtAssessCount();
                                  if($newExtAssesscount>0)
                                  {
                                  ?>
                                  <span class="nav-link float-right" data-toggle="dropdown" href="#" style="position:absolute;right:0">
                                  <span class="badge badge-danger navbar-badge"><?=$newExtAssesscount?></span>
                                  </span>
                                  <?php
                                  }
                                  ?>
                                        <img src="<?=  Yii::getAlias('@web/img/external.png')?>" height="37px" width="40px"/>
                                        <h5>
                                            External Assessments
                                        </h5>
                                    </a>

                                  </div>

                                  </div>
                                  
                                  
          <!--  ################################### classwork dashboard end ######################################################### -->


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
