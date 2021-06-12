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
            <!-- Content Wrapper. Contains page content -->
   
       <div class="container-fluid">
      
 <div class="row">
          <!-- Left col -->
          <section class="col-lg-12">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title com-sm-12 text-secondary">
                  <i class="fas fa-book mr-1"></i>
               My Courses
                 
                </h3>
               
              
              </div><!-- /.card-header -->
              <div class="card-body">
 
             <div class="row">
               <div class="col-md-12">
                  <table class="table table-bordered table-striped" id="CoursesTable" style="width:100%; font-family: 'Times New Roman'">
                  <thead>
                  <tr>
                  <th width="1%">#</th><th width="10%">Code</th><th>Name</th><th>Credit</th><th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                  <td>1</td>
                  <td>TN 330</td>
                  <td>Microwaves</td>
                  <td>8</td>
                  <td>Active</td>
                  </tr> 
                  <tr>
                  <td>2</td>
                  <td>TN 310</td>
                  <td>Antena and waves propagations</td>
                  <td>8</td>
                  <td>Active</td>
                  </tr>         
                  </tbody>
                  </table>
             </div>
            
             </div>
              </div><!-- /.card-body -->
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