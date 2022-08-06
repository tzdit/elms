<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Students List';
$this->params['courseTitle']="<i class='fa fa-graduation-cap'></i> Students";
?>
<div class="site-index">

    

    <div class="body-content">
            <!-- Content Wrapper. Contains page content -->
   
       <div class="container-fluid">
      
 <div class="row">
          <!-- Left col -->
          <section class="col-lg-12">
            <!-- Custom tabs (Charts with tabs)-->
                
                <a href="<?= Url::toRoute('/instructor/create-student') ?>" class="btn btn-info btn-sm float-right m-0 col-xs-12"><i class="fas fa-user-plus"></i> Create User</a>
              
         
           
            <table class="table table-bordered table-striped table-hover" id="StudentList" style="width:100%; font-family:'Time New Roman'; font-size:14px;">
            <thead>
            <tr><th>Full Name</th><th>Reg#</th><th>YOS</th><th>Department</th><th width="15%">Action</th></tr>
            
            </thead>
            <tbody>
            
            <?php 
            for($a=0;$a<count($students); $a++)
            {
              $current_students=$students[$a];

              for($b=0;$b<count($current_students); $b++)
              {
                ?>
                <tr>
                <td><?=ucwords(strtolower($current_students[$b]->fullName))?></td>
                <td><?=$current_students[$b]->reg_no?></td>
                <td><?=$current_students[$b]->YOS?></td>
                <td><?=$current_students[$b]->program->department->depart_abbrev?></td>
                <td>
                  <?=Html::a("<i class='fas fa-edit'> </i>",["updatestudent", "id"=>$current_students[$b]->reg_no], ["class"=>"text-info btn-sm m-0"])?>
                <a href="#" id=<?= $current_students[$b]->reg_no ?> class="text-danger btn-sm m-0 studentdel"><i class="fas fa-trash"></i></a>
              </td>
               </tr>


                <?php 
              }
              
            }
            
            ?>
            
           
            </tbody>
            </table>
             
          

          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
         
     

      </div><!--/. container-fluid -->

    </div>
</div>
<?php 
$script = <<<JS
$(document).ready(function(){
  $("#StudentList").DataTable({
    responsive:true,
    dom: 'Bfrtip',
        buttons: [
            'csv',
            {
                extend: 'pdfHtml5',
                title: 'students list'
            },
            {
                extend: 'excelHtml5',
                title: 'students list'
            },
            'print',
        ]
  });
  // alert("JS IS OKAY")
});

//Deleting Student 
$(document).on('click', '.studentdel', function(){
var studentid = $(this).attr('id');
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
      url:'/instructor/deletestudent',
      method:'post',
      async:false,
      dataType:'JSON',
      data:{id:studentid },
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
JS;
$this->registerJs($script);
?>
