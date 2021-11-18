<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\bootstrap4\Modal;
use \dominus77\sweetalert2\Alert;
/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Carry');
$this->params['courseTitle'] = 'Carry Classes';

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">

 <!-- <?php
 echo '<pre>';
 VarDumper::dump($data) ;
 echo '</pre>';
 ?> -->

    

    <div class="body-content">
            <!-- Content Wrapper. Contains page content -->
   
       <div class="container-fluid">
      
 <div class="row">
          <!-- Left col -->
          <section class="col-lg-12">
            <!-- Custom tabs (Charts with tabs)-->
            
            <div class="card">
            <a value="<?= Url::to('/student/add_carry') ?>" class="btn btn-primary btn-sm float-right m-0 col-xs-12" id = "modal_button">
              <i class="fas fa-user-plus fa-lg"></i> Add Carry 
        </a>
              <?php
                  Modal::begin([
                    'title' => '<h2>Add Carry</h2>',
                    'id' => 'modal',
                    'size' => 'modal-lg'
                  ]);

                  echo "<div id = 'modal_content'></div>";
                  Modal::end();
                ?>
            </div>
            <!-- /.card -->

          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
         
          <!-- right col -->
        </div>

      </div><!--/. container-fluid -->

    </div>
</div>



<!-- <?= VarDumper::dump($data) ?> -->
<div class="site-index">

    

    <div class="body-content">
   
        <div class="container-fluid">
     
        <div class="row">
        <?php foreach($data as $course): ?>
            <?php
            $secretKey=Yii::$app->params['app.dataEncryptionKey'];
            $cid=Yii::$app->getSecurity()->encryptByPassword($course->course_code, $secretKey);
            ?>

          <div class="col-lg-3 col-6 ">
                <a href="<?=Url::to(['student/classwork/', 'cid'=>$cid])  ?>" >

                    <div class="small-box bg-info ">
                          <div class="inner p-2 ">
                              <h3><?= $course->course_code ?></h3>

                              <p class="m-0">Credit <?= $course->course_credit ?></p>
                              <h5 class="m-0 p-0 text-muted"> <?= strtoupper($course->course_status) ?></h5>

                              <div class="icon ">
                                <i class="fa fa-book"></i>
                              </div>
                          </div>

                          

                        <div class="small-box-footer" >
                          <div class="row" > 
                            <div class="col-sm-10  ">
                            </div>
                            <div class="col-sm-2 m-0 p-0">
                                  <a href="#" class="  btn-delete " id = "btn-delete" carry_id = "<?= $course->studentCourses[0]->SC_ID ?>" ><i class="fas fa-times-circle fa-lg carry-delete"></i></i>
                                    </a>
                            </div>
                          </div>
                        </div>
                    </div> 
           
                </a>
              </div>
          <?php endforeach ?>
        </div>
      </div>

    </div>
</div>
















