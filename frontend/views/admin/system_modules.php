<?php

use common\models\Course;
use common\models\GroupAssignment;
use common\models\GroupGenerationAssignment;
use common\models\Groups;
use common\models\Student;
use common\models\StudentGroup;
use frontend\models\ClassRoomSecurity;
use frontend\models\GroupAssSubmit;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use common\models\Instructor;


/* @var $this yii\web\View */

$this->params['courseTitle'] ="<i class='fa fa-cubes'></i> System Modules";
$this->title = 'System Modules';
$this->params['breadcrumbs'] = [
    ['label'=>'Dashboard', 'url'=>Url::to('/home/dashboard')],
    ['label'=>$this->title]
];

?>


<div class="site-index">
    <div class="body-content">
        <!-- Content Wrapper. Contains page content -->
                           
                                        <div class="tab-content" id="custom-tabs-four-tabContent">


                                            <!-- ########################################### group by  instructor ######################################## -->

                                            <!-- Left col -->
                                            <div class="container-fluid">
                                            <div class="row">
                                            <div class="col-lg-12">
                                            <a href="#" class="btn btn-default btn-sm float-right mr-3" data-toggle="modal" data-target="#modulemodal"> <i class="fa fa-plus-circle"></i> New Module</a>
                                            </div>
                                            </div>
                                            <div class="row">
                                            <div class="col-lg-12">

                                                      
                                                <div class="card-body" >
                                                    <div class="tab-content" id="custom-tabs-four-tabContent">
                                                    <div class="container border p-1 pl-3" id="accordion">
                                                    <div class="row text-sm text-bold ">
                                                            <div class="col-sm-1"></div>
                                                            <div class="col-sm-3">Name</div>
                                                            <div class="col-sm-6">Description</div>
                                                            <div class="col-sm-1">status</div>
                                                            <div class="col-sm-1"></div>

                                                        </div>
                                                        <?php
                                                   
                                                        if(empty($modules)){
                                                        
                                                            echo '<div style="width:91%"  class="container border p-2  d-flex justify-content-center p-5"><span class="text-center text-muted text-lg"><i class="fa fa-info-circle"></i> No Modules found</span></div>';
                                                        
                                                        }
                                                    
                                                        ?>
                                                         
                                                        <?php
                                                        $count=1;
                                                        foreach($modules as $module)
                                                        {

                                                        ?>
                                                        <div class="row text-sm <?=$module->status=='active'?'text-success':''?>">
                                                            <div class="col-sm-1"><?=$count?></div>
                                                            <div class="col-sm-3"><?=$module->moduleName?></div>
                                                            <div class="col-sm-6"><?=$module->moduleDescription?></div>
                                                            <div class="col-sm-1"><?=$module->status?></div>
                                                            <div class="col-sm-1">
                                                                <?php if($module->status=="active"){ ?>
                                                                    <a href="<?=Url::to(['/admin/deactivate-module','module'=>ClassRoomSecurity::encrypt($module->moduleID)])?>" data-toggle="tooltip" data-title="Deactivate Module"><i class="fa fa-toggle-on" style="font-size:17px" aria-hidden="true"></i></a>
                                                                <?php
                                                                }
                                                                else
                                                                {
                                                                ?>
                                                                 <a href="<?=Url::to(['/admin/activate-module','module'=>ClassRoomSecurity::encrypt($module->moduleID)])?>" data-toggle="tooltip" data-title="Activate Module"><i class="fa fa-toggle-off" style="font-size:17px" aria-hidden="true"></i></a>
                                                                <?php 
                                                                }
                                                                ?>
                                                            </div>
                                                            

                                                        </div>
                                                        <?php
                                                        $count++;
                                                        }
                                                        ?>
                                                        
                                                                <?=$this->render(Url::to('/admin/newModule'))?>
                                                            </div>

                                                            </div>

                                                   
                                                      

                                                    </div>
                                                    <!-- ########################################### GROUPS END ######################################## -->
                                                    </div>

                                                    </div>

                                                    </div>
                                          
                                            <!-- ########################################### group by instructor end ######################################## -->
                                    
                             
                             

                                                           



                               

                                                                           <?php $script = <<<JS
                                                                            $(document).ready(function(){

                                                                                $(document).on('click', '.back', function(){
                                                                                                var quiz = $(this).attr('id');
                                                                                                Swal.fire({
                                                                                            title: 'Migrate Backwards?',
                                                                                            text: "You won't be able to revert this!",
                                                                                            icon: 'question',
                                                                                            showCancelButton: true,
                                                                                            confirmButtonColor: '#3085d6',
                                                                                            cancelButtonColor: '#d33',
                                                                                            confirmButtonText: 'Migrate'
                                                                                            }).then((result) => {
                                                                                            if (result.isConfirmed) {

                                                                                            $.ajax({
                                                                                                url:'/admin/migrate-backwards',
                                                                                                method:'post',
                                                                                                async:false,
                                                                                                dataType:'JSON',
                                                                                                data:{},
                                                                                                success:function(data){
                                                                                                if(data.backward){
                                                                                                    Swal.fire(
                                                                                                        'Migration successful !',
                                                                                                         data.backward,
                                                                                                        'success'
                                                                                            )
                                                                                            setTimeout(function(){
                                                                                                window.location.reload();
                                                                                            }, 100);


                                                                                                }
                                                                                                else
                                                                                                {
                                                                                                    Swal.fire(
                                                                                                        'Migration Failed!',
                                                                                                        data.failure,
                                                                                                        'error'
                                                                                            )
                                                                                            setTimeout(function(){
                                                                                                window.location.reload();
                                                                                            }, 100);

                                                                                                }
                                                                                                }
                                                                                            })

                                                                                            }
                                                                                            })

                                                                                            })                                                                    
                                                                            });
                                                                            JS;
                                                                            $this->registerJs($script);

                                                                            ?>

                                                                        </div>

                                                                </div>



                                                <!-- ########################################### group by student end ######################################## -->
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            </section>



            </div>
        </div>
    </div><!--/. container-fluid -->
</div>


<?php
$script = <<<JS
$(document).ready(function(){
  $("#CourseList").DataTable({
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
<?php 
$this->registerCssFile('@web/plugins/select2/css/select2.min.css');
$this->registerJsFile(
  '@web/plugins/select2/js/select2.full.js',
  ['depends' => 'yii\web\JqueryAsset']
);
$this->registerJsFile(
  '@web/js/create-assignment.js',
  ['depends' => 'yii\web\JqueryAsset'],

);



?>




