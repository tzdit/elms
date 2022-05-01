<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Custom;
use yii\helpers\VarDumper;
/* @var $this yii\web\View */

$this->title = 'My Courses';
$this->params['breadcrumbs'] = [
  ['label'=>'Courses', 'url'=>Url::to(['/student/courses'])],
  ['label'=>$this->title]
];

?>
<div class="site-index">
  <!-- <?=  VarDumper::dump($data)?> -->

    <div class="body-content">
            <!-- Content Wrapper. Contains page content -->
   
       <div class="container-fluid">
      
 <div class="accordion" id="accordionExample_3">
          <!-- Left col -->
          <section class="col-lg-12">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
        
        <div class="col-md-12">
      
        </div>
                <h3 class="card-title com-sm-12 text-secondary">
                  <i class="fas fa-book mr-1"></i>
                My courses
                
                </h3>
               
              
              </div><!-- /.card-header -->
              <div class="card-body">

 
             <div class="row">
             <div class="col-md-6">
              <h4><p style="text-align: center;"> <span class="badge bg-primary"> First Year Courses : semester 1</span></p></h4>

              <table class="table table-bordered table-striped" id="CoursesTable" style="width:100%; font-family: 'Times New Roman'">
              <thead>
              <tr>
              <th width="1%">#</th><th width="10%">Code</th><th>Name</th><th>Credit</th><th>Status</th>
              </tr>
              </thead>
            
              <?php foreach($courses1 as $key =>$courses): ?>
                <?php 
                if($courses->course_semester == 1):
                ?>
              
                  <tbody>
                  <?php $i=0; ?>
                  <tr>
                  <td><?= $key = $key + 1 ?></td>
                  <td><?= $courses->course_code ?> </td>
                  <td><?= $courses->course_name ?> </td>
                  <td><?= $courses->course_credit ?> </td>
                  <td><?= strtoupper( $courses->course_status ) ?> </td>
                  </tr> 
                  </tbody>
                  <?php endif; ?>
             
              <?php endforeach ?>
              </table>
              </div>
              <div class="col-md-6">
              <h4><p style="text-align: center;"> <span class="badge bg-primary">First Year Courses : semester 2</span></p></h4>

              <table class="table table-bordered table-striped" id="CoursesTable" style="width:100%; font-family: 'Times New Roman'">
              <thead>
              <tr>
              <th width="1%">#</th><th width="10%">Code</th><th>Name</th><th>Credit</th><th>Status</th>
              </tr>
              </thead>
            
              <?php foreach($courses1 as $key =>$courses): ?>
                <?php 
                if($courses->course_semester == 2):
                ?>
              
                  <tbody>
                  <?php $i=0; ?>
                  <tr>
                  <td><?= $key = $key + 1 ?></td>
                  <td><?= $courses->course_code ?> </td>
                  <td><?= $courses->course_name ?> </td>
                  <td><?= $courses->course_credit ?> </td>
                  <td><?= strtoupper( $courses->course_status ) ?> </td>
                  </tr> 
                  </tbody>
                 
                <?php endif; ?>
              <?php endforeach ?>
              </table>
              </div>
             </div>

             <div class="row">
             <div class="col-md-6">
             <h4><p style="text-align: center;"> <span class="badge bg-warning">Second Year Courses : semester 1</span></p></h4>
              <table class="table table-bordered table-striped" id="CoursesTable" style="width:100%; font-family: 'Times New Roman'">
              <thead>
              <tr>
              <th width="1%">#</th><th width="10%">Code</th><th>Name</th><th>Credit</th><th>Status</th>
              </tr>
              </thead>
            
              <?php foreach($courses2 as $key =>$courses): ?>
                <?php 
                if($courses->course_semester == 1):
                ?>
              
                  <tbody>
                  <?php $i=0; ?>
                  <tr>
                  <td><?= $key = $key + 1 ?></td>
                  <td><?= $courses->course_code ?> </td>
                  <td><?= $courses->course_name ?> </td>
                  <td><?= $courses->course_credit ?> </td>
                  <td><?= strtoupper( $courses->course_status ) ?> </td>
                  </tr> 
                  </tbody>
                 
                  <?php endif; ?>
              <?php endforeach ?>
              </table>
              </div>
              <div class="col-md-6">
             <h4><p style="text-align: center;"> <span class="badge bg-warning">Second Year Courses : semester 2</span></p></h4>
              <table class="table table-bordered table-striped" id="CoursesTable" style="width:100%; font-family: 'Times New Roman'">
              <thead>
              <tr>
              <th width="1%">#</th><th width="10%">Code</th><th>Name</th><th>Credit</th><th>Status</th>
              </tr>
              </thead>
            
              <?php foreach($courses2 as $key =>$courses): ?>
                <?php 
                if($courses->course_semester == 2):
                ?>
              
                  <tbody>
                  <?php $i=0; ?>
                  <tr>
                  <td><?= $key = $key + 1 ?></td>
                  <td><?= $courses->course_code ?> </td>
                  <td><?= $courses->course_name ?> </td>
                  <td><?= $courses->course_credit ?> </td>
                  <td><?= strtoupper( $courses->course_status ) ?> </td>
                  </tr> 
                  </tbody>
                 
                  <?php endif; ?>
              <?php endforeach ?>
              </table>
              </div>
             </div>

             <div class="row">
             <div class="col-md-6">
             <h4><p style="text-align: center;"> <span class="badge bg-success">Third Year Courses : semester 1</span></p></h4>
              <table class="table table-bordered table-striped" id="CoursesTable" style="width:100%; font-family: 'Times New Roman'">
              <thead>
              <tr>
              <th width="1%">#</th><th width="10%">Code</th><th>Name</th><th>Credit</th><th>Status</th>
              </tr>
              </thead>
            
              <?php foreach($courses3 as $key =>$courses): ?>
                <?php 
                if($courses->course_semester == 1):
                ?>
              
                  <tbody>
                  <?php $i=0; ?>
                  <tr>
                  <td><?= $key = $key + 1 ?></td>
                  <td><?= $courses->course_code ?> </td>
                  <td><?= $courses->course_name ?> </td>
                  <td><?= $courses->course_credit ?> </td>
                  <td><?= strtoupper( $courses->course_status ) ?> </td>
                  </tr> 
                  </tbody>
                 
                  <?php endif; ?>
              <?php endforeach; ?>
              </table>
              </div>
              <div class="col-md-6">
             <h4><p style="text-align: center;"> <span class="badge bg-success">Third Year Courses : semester 2</span></p></h4>
              <table class="table table-bordered table-striped" id="CoursesTable" style="width:100%; font-family: 'Times New Roman'">
              <thead>
              <tr>
              <th width="1%">#</th><th width="10%">Code</th><th>Name</th><th>Credit</th><th>Status</th>
              </tr>
              </thead>
            
              <?php foreach($courses3 as $key =>$courses): ?>
                <?php 
                if($courses->course_semester == 2):
                ?>
              
                  <tbody>
                  <?php $i=0; ?>
                  <tr>
                  <td><?= $key = $key + 1 ?></td>
                  <td><?= $courses->course_code ?> </td>
                  <td><?= $courses->course_name ?> </td>
                  <td><?= $courses->course_credit ?> </td>
                  <td><?= strtoupper( $courses->course_status ) ?> </td>
                  </tr> 
                  </tbody>
                 
                  <?php endif; ?>
              <?php endforeach; ?>
              </table>
              </div>
             </div>
              </div><!-- /.card-body -->
            </div>

          </section>
          </div>
      </div>
    </div>
</div>