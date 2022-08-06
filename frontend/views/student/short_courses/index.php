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

$this->title = Yii::t('app', 'short courses');
$this->params['courseTitle'] = '<i class="fa fa-book"></i> Short Courses';

$this->params['breadcrumbs'][] = $this->title;
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
            <a value="<?= Url::to('/student/registershortcourse') ?>" class="btn btn-info btn-sm float-right m-0 col-xs-12" id = "modal_button">
              <i class="fas fa-user-plus fa-lg"></i> Register Course
        </a>
              <?php
                  Modal::begin([
                    'title' => '<h5 class="text-info"><i class="fa fa-plus-circle"></i> Register Course</h5>',
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
      <div class="container-fluid">
        <table class="table">
        <tr class="text-info text-bold"><td>#</td><td>Course Code</td><td>Course Name</td><td>Toolbar</td></tr>
        <?php $count=0; foreach($courses as $course){?>

        <tr><td><?=++$count?></td><td><?=$course->course_code?></td><td><?=$course->course_name?></td><td><a href="#" id=<?=$course->course_code?> class="text-info del"><i class="fa fa-trash "  data-toggle="tooltip" data-title="remove course"></i></a></td></tr>
        <?php } ?>
        </table>
      </div>

    </div>

</div>
<?php 
$script = <<<JS
$(document).ready(function(){
$(document).on('click', '.del', function(){
      var ccode = $(this).attr('id');
      Swal.fire({
  title: 'Remove this course?',
  text: "You won't be able to revert to this!",
  icon: 'question',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, remove it!'
}).then((result) => {
  if (result.isConfirmed) {
 
    $.ajax({
      url:'/student/removeshortcourse',
      method:'post',
      async:false,
      dataType:'JSON',
      data:{ccode:ccode},
      success:function(data){
        if(data.message){
          Swal.fire(
              'Successfull!',
              data.message,
              'success'
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














