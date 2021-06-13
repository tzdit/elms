<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Custom;
/* @var $this yii\web\View */

$this->title = 'My Courses';
$this->params['breadcrumbs'] = [
  ['label'=>'Courses', 'url'=>Url::to(['/student/courses'])],
  ['label'=>$this->title]
];

?>
<div class="site-index">

<div class="body-content">
      
 <div class="accordion" id="accordionExample_3">
          <!-- Left col -->
          <section class="col-lg-12">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
        
        <div class="col-md-12">
        <a href="#" class="btn btn-sm btn-primary btn-rounded float-right mb-2" data-target="#createcarryoverModal" data-toggle="modal"><i class="fas fa-plus" data-toggle="modal" ></i>&nbsp;Carryover</a>
        </div>
                <h3 class="card-title com-sm-12 text-secondary">
                  <i class="fas fa-book mr-1"></i>
                My courses
                
                </h3>
               
              
              </div><!-- /.card-header -->
              <div class="card-body">
 
             <div class="row">
               <div class="col-md-12">
                  <table class="table table-bordered table-striped" id="CoursesTable" style="width:100%; font-family: 'Times New Roman'">
                  <thead>
                  <tr>
                  <th width="5%">#</th><th width="10%">Code</th><th>Name</th><th>Credit</th><th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $i=0; ?>
                  <?php foreach($courses as $course): ?>
                  <tr>
                  <td><?= ++$i; ?></td>
                  <td><?= $course->course_code;  ?></td>
                  <td><?= $course->course_name;  ?></td>
                  <td><?= $course->course_credit;  ?></td>
                  <td><?= $course->course_status;  ?></td>
                  </tr>
                  <?php endforeach ?>
                  </tbody>
                  </table>
             
                  </div>
                </div>
              </div>
            </div>

          </section>
          </div>
      </div>
    </div>
</div>