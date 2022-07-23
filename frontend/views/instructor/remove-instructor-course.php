<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Instructors $ Courses';
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
              <div class="card-header p-2">
                <h3 class="card-title com-sm-12">
                  <i class="fas fa-list mr-1 text-info"></i>
                 List of Instructors with their respective courses 
                </h3>
        
                <?= Html::a('<i class=""> Back</i>',['instructor-course'], ['class'=>'btn btn-sm btn-primary btn-rounded m-0 float-right m-0 col-xs-12'])?> 
              </div><!-- /.card-header -->
              <div class="card-body">
            <table class="table table-bordered table-striped table-hover" id="StudentList" style="width:100%; font-family:'Time New Roman'; font-size:14px;">
            <thead>
            <tr><th>Instructor Name</th><th>Courses</th><th width="14%">Action</th></tr>
            
            </thead>
            <tbody>

            
                
                <?php foreach($instructorCoz as $coz ): ?>
                  <tr>
                  <td> <b><?= $coz-> instructor -> full_name; ?></b></td> 
                  <td> <b><?= $coz-> course_code; ?></b></td>
                  <td><a href="#" cozid="<?=$coz->IC_ID?>" class="btn btn-sm btn-danger float-right ml-2 coursedel"><span><i class="fas fa-minus-circle"> Remove</i></span></a></td>
                  </tr>
                  <?php endforeach; ?>
            </tbody>
            </table>
             
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
<?php 
$script = <<<JS
$(document).ready(function(){
  $("#StudentList").DataTable({
    responsive:true
  });
  // alert("JS IS OKAY")
//Deleting Course 
$(document).on('click', '.coursedel', function(){
var courseid = $(this).attr('cozid');
Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'question',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, Delete it!'
}).then((result) => {
  if (result.isConfirmed) {
 
    $.ajax({
      url:'/instructor/delete-instructor-coz',
      method:'get',
      async:false,
      dataType:'JSON',
      data:{id:courseid },
      success:function(data){
        if(data.message){
          Swal.fire(
              'Deleted!',
              data.message,
              'success'
    )
    setTimeout(function(){
      window.location.reload();
    },100);
   

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
