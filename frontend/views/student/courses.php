<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Custom;
use yii\helpers\VarDumper;
/* @var $this yii\web\View */

$this->title = 'My Curriculum';
$this->params['courseTitle']='<i class="fas fa-book mr-1"></i>My Curriculum';
$this->params['breadcrumbs'] = [
  ['label'=>$this->title]
];

?>
<div class="site-index">
    <div class="body-content">
            <!-- Content Wrapper. Contains page content -->
   
       <div class="container-fluid">
          <!-- Left col -->
          <section class="text-sm">
          <div id="accordion">
            <div class="row">
                <?php if(!empty($courses1)): ?>
              <div class="col-md-6">
                  <div class="card card-default">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                        <i class="fas fa-book mr-1"> </i> First Year Semester #1
                        </a>
                      </h4>
                    </div>
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                      <div class="card-body">
                      <table class="table table-bordered table-striped" id="CoursesTable" style="width:100%; font-family: 'Times New Roman'">
              <thead>
              <tr>
              <th>#</th><th>Code</th><th>Name</th><th>Credit</th><th>Status</th>
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
                    </div>
                  </div>
                </div>
                <?php endif; ?>

                <?php if(!empty($courses1)): ?>
                <div class="col-md-6">
                  <div class="card card-default">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapseOne1">
                        <i class="fas fa-book mr-1"> </i>First Year Semester #2
                        </a>
                      </h4>
                    </div>
                    <div id="collapseOne1" class="collapse show" data-parent="#accordion">
                      <div class="card-body">
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
                  </div>
                </div>
                <?php endif; ?>
              </div>
              <div class="row">
                  <?php if(!empty($courses2)): ?>
              <div class="col-md-6">
                  <div class="card card-default">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                        <i class="fas fa-book mr-1"> </i>Second Year Semester #1
                        </a>
                      </h4>
                    </div>
                    <div id="collapseTwo" class="collapse show" data-parent="#accordion">
                      <div class="card-body">
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
                    </div>
                  </div>
                </div>
                  <?php endif; ?>
                  <?php if(!empty($courses2)): ?>
                <div class="col-md-6">
                  <div class="card card-default">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo2">
                        <i class="fas fa-book mr-1"> </i>Second Year Semester #2
                        </a>
                      </h4>
                    </div>
                    <div id="collapseTwo2" class="collapse show" data-parent="#accordion">
                      <div class="card-body">
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
                  </div>
                </div>
                  <?php endif; ?>
              </div>
              <div class="row">
                  <?php if(!empty($courses3)): ?>
              <div class="col-md-6">
                  <div class="card card-default">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                        <i class="fas fa-book mr-1"> </i>Third Year Semester #1
                        </a>
                      </h4>
                    </div>
                    <div id="collapseThree" class="collapse show" data-parent="#accordion">
                      <div class="card-body">
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
              <?php endforeach ?>
              </table>
                      </div>
                    </div>
                  </div>
                </div>
                  <?php endif; ?>
                  <?php if(!empty($courses3)): ?>
                <div class="col-md-6">
                  <div class="card card-default">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapseThree3">
                        <i class="fas fa-book mr-1"> </i>Third Year Semester #2
                        </a>
                      </h4>
                    </div>
                    <div id="collapseThree3" class="collapse show" data-parent="#accordion">
                      <div class="card-body">
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
              <?php endforeach ?>
              </table>
                      </div>
                    </div>
                  </div>
                </div>
                  <?php endif; ?>
              </div>
              <div class="row">
                  <?php if(!empty($courses4)): ?>
              <div class="col-md-6">
                  <div class="card card-default">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapseFour">
                        <i class="fas fa-book mr-1"> </i>Fourth Year Semester #1
                        </a>
                      </h4>
                    </div>
                    <div id="collapseFour" class="collapse show" data-parent="#accordion">
                      <div class="card-body">
                      <table class="table table-bordered table-striped" id="CoursesTable" style="width:100%; font-family: 'Times New Roman'">
              <thead>
              <tr>
              <th width="1%">#</th><th width="10%">Code</th><th>Name</th><th>Credit</th><th>Status</th>
              </tr>
              </thead>
            
              <?php foreach($courses4 as $key =>$courses): ?>
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
                    </div>
                  </div>
                </div>
                  <?php endif; ?>
                  <?php if(!empty($courses4)): ?>
                <div class="col-md-6">
                  <div class="card card-default">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapseFour4">
                        <i class="fas fa-book mr-1"> </i>Fourth Year Semester #2
                        </a>
                      </h4>
                    </div>
                    <div id="collapseFour4" class="collapse show" data-parent="#accordion">
                      <div class="card-body">
                      <table class="table table-bordered table-striped" id="CoursesTable" style="width:100%; font-family: 'Times New Roman'">
              <thead>
              <tr>
              <th width="1%">#</th><th width="10%">Code</th><th>Name</th><th>Credit</th><th>Status</th>
              </tr>
              </thead>
            
              <?php foreach($courses4 as $key =>$courses): ?>
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
                  </div>
                </div>
                  <?php endif; ?>
              </div>
              <div class="row">
                  <?php if(!empty($courses5)): ?>
              <div class="col-md-6">
                  <div class="card card-default">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapseFive">
                        <i class="fas fa-book mr-1"> </i>Fifth Year Semester #1
                        </a>
                      </h4>
                    </div>
                    <div id="collapseFive" class="collapse show" data-parent="#accordion">
                      <div class="card-body">
                      <table class="table table-bordered table-striped" id="CoursesTable" style="width:100%; font-family: 'Times New Roman'">
              <thead>
              <tr>
              <th width="1%">#</th><th width="10%">Code</th><th>Name</th><th>Credit</th><th>Status</th>
              </tr>
              </thead>
            
              <?php foreach($courses5 as $key =>$courses): ?>
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
                    </div>
                  </div>
                </div>
                  <?php endif; ?>
                  <?php if(!empty($courses5)): ?>
                <div class="col-md-6">
                  <div class="card card-default">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapseFive5">
                        <i class="fas fa-book mr-1"> </i>Fifth Year Semester #2
                        </a>
                      </h4>
                    </div>
                    <div id="collapseFive5" class="collapse show" data-parent="#accordion">
                      <div class="card-body">
                      <table class="table table-bordered table-striped" id="CoursesTable" style="width:100%; font-family: 'Times New Roman'">
              <thead>
              <tr>
              <th width="1%">#</th><th width="10%">Code</th><th>Name</th><th>Credit</th><th>Status</th>
              </tr>
              </thead>
            
              <?php foreach($courses5 as $key =>$courses): ?>
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
                  </div>
                </div>
                  <?php endif; ?>
              </div>
                </div>
          

          </section>
          </div>
      </div>
    </div>
</div>