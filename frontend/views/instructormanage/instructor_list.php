<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use yii\helpers\Url;
use yii\helpers\Html;
use frontend\models\ClassRoomSecurity;
/* @var $this yii\web\View */

$this->params['courseTitle']='<i class="fa fa-chalkboard-teacher"></i> Instructors & HODs';
$this->title = 'Instructors & HODs';
$this->params['breadcrumbs'] = [
    ['label'=>$this->title]
];


?>
<div class="site-index">

    

    <div class="body-content">
            <!-- Content Wrapper. Contains page content -->
   
       <div class="container-fluid">
      
 <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 table-responsive">
            <!-- Custom tabs (Charts with tabs)-->
           
             
           
                <a href="#" data-toggle="modal" data-target="#instructormodal" class="btn btn-default btn-sm float-right m-0 col-xs-12"><i class="fas fa-user-plus"></i> Register Instructor</a>
                <a href="#" data-toggle="modal" data-target="#hodmodal" class="btn btn-default btn-sm float-right m-0 col-xs-12 mr-2"><i class="fas fa-user-plus"></i> Register HOD</a>
            
            <table class="table table-bordered table-striped table-hover " id="InstructorTable" style="width:100%;font-size:11.5px;">
            <thead>
            <tr><th width="1%">#</th><th>Full Name</th><th>Email</th><th>Phone Number</th><th>Gender</th><th>College</th><th>Department</th><th width="10%">Manage</th></tr>
            
            </thead>
            <tbody>
            <?php $i = 0; ?>
            <?php foreach($instructors as $inst): ?>
          
            <tr class="<?=($inst->user!=null && $inst->user->isLocked())?"text-danger":""?>">
            <td><?= ++$i; ?></td>
            <td><?= $inst->full_name?></td>
            <td><?= $inst->email?></td>
            <td><?= $inst->phone?></td>
            <td><?= $inst->gender?></td>
            <td><?= $inst->department->college->college_abbrev ?></td>
            <td><?= $inst->department->depart_abbrev ?></td>
            <td>
            <a href="<?=Url::to(['/instructormanage/update','id'=>urlencode(base64_encode($inst->instructorID))])?>" data-toggle="tooltip" data-title="Update User" class="mr-1"><i class="fas fa-edit"></i></a> 
            <a href="<?=Url::to(['/instructormanage/reset','id'=> urlencode(base64_encode($inst->userID))])?>"  data-toggle="tooltip" data-title="Reset User Password" class="mr-1"><i class="fa fa-refresh"></i></a> 
            <?php
            if($inst->user!=null && $inst->user->isLocked())
            {
            ?>
            <a href="<?=Url::to(['/instructormanage/unlock','id'=>urlencode(base64_encode($inst->userID))])?>"  data-toggle="tooltip" data-title="Reactivate/Unlock User" class="mr-1"><i class="fa fa-unlock"></i></a>  
            <?php
            }
            else
            {
            ?>
            <a href="<?=Url::to(['/instructormanage/lock','id'=>urlencode(base64_encode($inst->userID))])?>"  data-toggle="tooltip" data-title="Lock User" class="mr-1"><i class="fas fa-user-lock"></i></a>
            <?php
            }
            ?>
            
            <a href="#"  id=<?=$inst->userID?> data-toggle="tooltip" data-title="Delete User" class="mr-1  userdel"><i class="fa fa-trash"></i></a> 
            </td>
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
         <?=$this->render("create_hods")?>
         <?=$this->render("createInstructor")?>
          <!-- right col -->
        </div>

      </div><!--/. container-fluid -->

  
</div>
<?php 
$script = <<<JS
$(document).ready(function(){
  $("#InstructorTable").DataTable({
    responsive:true
  });

  $(document).on('click', '.userdel', function(){
      var user = $(this).attr('id');
      Swal.fire({
  title: 'Delete User?',
  text: "You won't be able to revert to this, and the user will not be able to recover his account. consider locking the user instead, if this decision is for temporary reasons !",
  icon: 'question',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Delete'
}).then((result) => {
  if (result.isConfirmed) {
 
    $.ajax({
      url:'/instructormanage/delete',
      method:'post',
      async:false,
      dataType:'JSON',
      data:{userid:user},
      success:function(data){
        if(data.deleted){
          Swal.fire(
              'Deleted !',
              data.deleted,
              'success'
    )
    setTimeout(function(){
      window.location.reload();
    }, 100);
   

        }
        else
        {
          Swal.fire(
              'Deleting failed !',
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
  // alert("JS IS OKEY")
});
JS;
$this->registerJs($script);
?>
