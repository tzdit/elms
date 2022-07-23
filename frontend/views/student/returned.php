<?php

use frontend\models\GroupAssSubmit;
use yii\helpers\Url;
use frontend\models\ClassRoomSecurity;


/* @var $this yii\web\View */
$this->params['courseTitle'] ='<img src="/img/submitted 3.png" height="30px" width="30px"/>'.$cid." My Submitted";
$this->title ="Submitted";
$this->params['breadcrumbs'] = [
    ['label'=>$cid." Dashboard", 'url'=>Url::to(['/student/classwork', 'cid'=>ClassRoomSecurity::encrypt($cid)])],
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
                  
                        <div class="row p-0 border-bottom-0 ">
                            <ul class="nav nav-tabs responsivetext p-0" id="custom-tabs-four-tab" role="tablist">
                                <li class="nav-item p-0">
                                    <a class="nav-link active p-1 pt-2" id="custom-tabs-forum" data-toggle="tab" href="#forum" role="tab" aria-controls="forum" aria-selected="true"><i class="fa fa-user text-info"></i> Individual Assignments</a>
                                </li>
                                <li class="nav-item p-0">
                                    <a class="nav-link p-1 pt-2" id="custom-tabs-materials" data-toggle="tab" href="#materials" role="tab" aria-controls="materials" aria-selected="false"><i class="fa fa-group text-info"></i> Group Assignments</a>
                                </li>
                            </ul>

                        </div>

                 

                            <div class="tab-content" id="custom-tabs-four-tabContent">
                                <div class="tab-pane fade show active" id="forum" role="tabpanel" aria-labelledby="custom-tabs-forum">
                                    <div class="card-body" >
                                        <div class="tab-content" id="custom-tabs-four-tabContent">


                                            <!-- ########################################### returned marks ######################################## -->

                                            <!-- Left col -->
                                            <section class="col-lg-12">
                                                <?php
                                                if(empty($returned)){
                                                    echo "<p class='text-muted text-lg p-1 text-center responsivetext'>";
                                                    echo "<i class='fa fa-info-circle text-info'></i> No submissions found";
                                                    echo "</p>";
                                                }
                                                ?>

                                                <?php foreach($returned as $returne): ?>

                                                            <?php
                                                    $assignmentDetails = \common\models\Assignment::findOne($returne->assID);
                                                    ?>
                                                    
                  
                      
                                                            <div class="card m-3 shadow-lg rounded result-card">
                                                                <div class="card-body">
                                                                    <div class="m-0">
                                                                        <div class="row">
                                                        
                                                                            <div class="col-sm-9 pl-2">
                                                                                <h5 class="responsiveheader assignment-header"><i class="fa fa-file-text text-primary mr-1 fa-lg" ></i><?php echo " ".ucwords($assignmentDetails->assName) ?> </h5>
                                                                                <span class="text-muted mt-0 responsivetext"><?= ucfirst($assignmentDetails->assType) ?> Assignment</span>
                               

                                                                    <div class="m-0 responsivetext">
                                                                        <p class="responsivetext"> Submitted file: <a class="m-0" style="color: #007bff;
                                                                    font-style: italic;" href="/storage/submit/<?= $returne->fileName?>" target="_blank"><i class="fa fa-eye"></i> View </a></p>
                                                                    </div>

                                                                  
                                                                    <div class="row responsivetext">
                                                                      
                                                                      <div class="col-sm-12 text-center responsivetext">
                                                                          <p>Comment: <span class="text-muted m-0"><?php
                                                                                  if (is_null($returne->comment)){
                                                                                      echo "No comment";
                                                                                  }
                                                                                  else
                                                                                      echo $returne->comment;

                                                                                  ?></span></p>
                                                                      </div>
                                                                      
                                                                  </div>
                                                              
                                                           
                                                            </div>
                                                           
                                                            <div class="col-sm-3">
                                                                                <div class="float-right mr-4">
                                                                                <?php 
                                                                                 date_default_timezone_set('Africa/Dar_es_Salaam');
                                                                                if(strtotime(date('Y-m-d H:i:s')) > strtotime($returne->ass->finishDate) && $returne->score != NULL ){
                                                                                 ?>
                                                                                     <div class="shadow p-3 responsivetext">
                                                                                     <b><span class="text-muted">Score:</span> <span style="color: #007bff;"><?= $returne->score ?></span></b><br>
                                                                                    <b><span class="text-muted">Total:</span> <span style="color: #007bff;"><?= $assignmentDetails->total_marks  ?></span> </b>
                                                                                 
                                                                                </div>
                                                                                    <?php
                                                                                }
                                                                                      else
                                                                                      {

                                        
                                                                                    ?>
                                                                                        <span class="btn btn-sm btn-xs shadow btn-default text-primary p-2 responsivetext">Not Returned</span>
                                                                                    <?php
                                                                                      }
                                                                                    ?>
                                                                                </div>
                                                                            </div>
                                                                            </div>
                                                               
              
                                                        </div>
                                                        </div>
                                                        </div>

                                                <?php endforeach ?>

                                            </section>
                                            <!-- ########################################### returned marks end ######################################## -->
                                    
                                </div></div></div>
                                <div class="tab-pane fade" id="materials" role="tabpanel" aria-labelledby="custom-tabs-materials">
                                    <div class="tab-pane fade show active" id="forum" role="tabpanel" aria-labelledby="custom-tabs-forum">
                                        <div class="card-body" >
                                            <div class="tab-content" id="custom-tabs-four-tabContent">


                                                <!-- ########################################### returned marks ######################################## -->

                                                <!-- Left col -->
                                                <section class="col-lg-12">
<!--                                                    --><?php
//                                                    if(empty(returnedGroups)){
//                                                        echo "<p class='text-muted text-lg'>";
//                                                        echo "No return found";
//                                                        echo "</p>";
//                                                    }
//                                                    ?>
                                                    
                                                    <?php 
                                                                        if(empty($studentGroups)){
                                                                            echo "<p class='text-muted text-lg text-center p-1 responsivetext'>";
                                                                            echo "<i class='fa fa-info-circle text-info'></i> No submissions found";
                                                                            echo "</p>";
                
                                                                          
                                                                        }
                                                    for($g=0;$g<count($studentGroups);$g++)
                                                    {
                                                        $returnedGroups=$studentGroups[$g];
                                                        $assignments=$returnedGroups->groupAssignmentSubmits;
                                                        
                                                    
                                                        if(empty($assignments)){
                                                            echo "<p class='text-muted text-lg text-center p-1 responsivetext'>";
                                                            echo "No submissions found";
                                                            echo "</p>";

                                                            break;
                                                        }
                                                     
                                                    for($a=0;$a<count($assignments);$a++)
                                                    {
                                                        $returneGroups=$assignments[$a];
                                                    ?>

                                                      
                                                            <div class="card m-3 shadow-lg rounded result-card">
                                                                <div class="card-body">
                                                                    <div class="m-0">
                                                                        <div class="row">
                                                                            <div class="col-sm-9 pl-2">
                                                                                <h5 class="responsiveheader assignment-header"><i class="fa fa-file-text text-primary  mr-1 fa-lg" ></i><?php echo " ".ucwords($returneGroups->ass->assName)?> </h5>
                                                                                <span class="text-muted mt-0 responsivetext"><?= ucfirst($returneGroups->group->generationType->generation_type)." (".$returneGroups->group->groupName.")" ?></span>

                                                                                <div class="m-0 responsivetext">
                                                                        <p>Submitted file: <a class="m-0" style="color: #007bff;
                                                                    font-style: italic;" href="/storage/submit/<?= $returneGroups->fileName?>" target="_blank"><i class="fa fa-eye"></i> View </a></p>
                                                                    </div>

                                                                    <div class="m-0 responsivetext">
                                                                        <div class="row">
                                                                           
                                                                            <div class="col-sm-12 text-center">
                                                                                <p>Comment: <span class="text-muted m-0"><?php
                                                                                        if (is_null($returneGroups->comment)){
                                                                                            echo "No comment";
                                                                                        }
                                                                                        else
                                                                                            echo $returneGroups->comment;

                                                                                        ?></span></p>
                                                                            </div>
                                                                          
                                                                        </div>
                                                                    </div>
                                                                            </div>

                                                                            <div class="col-sm-3 responsivetext">
                                                            
                                                                                <div class="float-right mr-4">
                                                                                <?php 
                                                                                 date_default_timezone_set('Africa/Dar_es_Salaam');
                                                                                if(strtotime(date('Y-m-d H:i:s')) > strtotime($returneGroups->ass->finishDate) && $returneGroups->score != NULL ){
                                                                                    if($returneGroups->isSigned())
                                                                                    {
                                                                                 ?>
                                                                                     <div class="shadow p-3 responsivetext">
                                                                                     <b><span class="text-muted">Score:</span> <span style="color: #007bff;"><?= $returneGroups->score ?></span></b><br>
                                                                                    <b><span class="text-muted">Total:</span> <span style="color: #007bff;"><?=$returneGroups->ass->total_marks   ?></span> </b>
                                                                                    
                                                                                </div>
                                                                                    <?php
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        ?>
                                                                                            <span class="btn btn-sm  btn-default text-danger p-3"> <i class="fa fa-exclamation-triangle"></i> Not signed</span>
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                                      else
                                                                                      {

                                        
                                                                                    ?>
                                                                                        <span class="btn btn-sm  btn-default text-primary p-2">Not Returned</span>
                                                                                    <?php
                                                                                      }
                                                                                    ?>
                                                                                </div>
                                                                          
                                                                        </div>
                                                                    </div>

                                                              
                                                               
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php 
                                                    }
                                                                                    }
                                                    ?>

                                                </section>
                                                <!-- ########################################### returned marks end ######################################## -->
                                            </div>
                                        </div>
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
