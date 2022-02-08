<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Custom;
use common\helpers\Security;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\ClassRoomSecurity;
use common\models\Instructor;
use frontend\models\AddPartner;

/* @var $this yii\web\View */
$cid=yii::$app->session->get('ccode');
$this->params['courseTitle'] =$cid. " Classmates";
$this->title = $cid. " Classmates";
$this->params['breadcrumbs'] = [
  ['label'=>$this->title]
];

?>
 

<div class="site-index">
    <div class="body-content ">
            <!-- Content Wrapper. Contains page content -->
   
       <div class="container-fluid">
      
 <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 ">
       
     <?php 
  

     //participating programs

       
       
       ?>
        
         
              <!-- /////////////////////////////////////////// -->

                  <div class="tab-content" id="custom-tabs-four-tabContent">
                                <!-- ########################################### Course materials ######################################## -->
                             <?php 
                             if($myca==null || empty($myca))
                             {
                              ?>
                              <div class="jumbotron"><i class="fa fa-info-circle"></i> No published CA</div>
                              <?php
                             }
                             else
                             {
                              ?>
                                <div class="accordion" id="accordionExample_3">
                                    <?php foreach( $myca as $index=>$ca ) : ?>
                                        <div class="card">
                                            <div class="card shadow-lg">
                                                <div class="card-header p-2" id="heading<?=$index?>" data-toggle="collapse" data-target="#collapse<?=$index?>" aria-expanded="true" aria-controls="collapse<?=$index?>">
                                                    <h2 class="mb-0">
                                                        <div class="row ">
                                                            <div class="col-sm-11">
                                                                <button class="btn btn-link btn-block text-left col-md-11" type="button" data-toggle="collapse" data-target="#collapse<?=$index?>" aria-expanded="true" aria-controls="collapse<?=$index?>">
                                                                 <?=$index?>
                                                                </button>
                                                                <div class="col d-flex justify-content-center">
                                                                <div class="card text-center" style="width:35%" data-toggle="collapse" data-target="#collapse<?=$index?>" aria-expanded="true" aria-controls="collapse<?=$index?>">
                                                                  <div class="card-header">
                                                                    <?=$ca['grandscore']?>
                                                                  </div>
                                                                  <div class="card-body">
                                                                  <?=$ca['grandmax']?>
                                                                  </div>
                                                                 </div></div>
                                                            </div>
                                                            <div class="col-sm-1">
                                                                <i class="fas fa-ellipsis-v float-right text-secondary text-sm"></i>
                                                            </div>
                                                        </div>
                                                    </h2>
                                                </div>

            <div id="collapse<?=$index?>" class="collapse" aria-labelledby="heading<?=$index?>" data-parent="#accordionExample_3">



                <div class="card-body" >

                    <?=$ca['details']?>
                  </div>
                        </div>


            </div>
          
        </div>

<?php 
endforeach;

                             }
 ?>


              <!-- ////////////////////////////////////////// -->
              
    </div>
    </div>
</div>

</section>
          
</div>

      </div><!--/. container-fluid -->

    </div>
</div>
</div>

                
    



<?php 
$script = <<<JS
$(document).ready(function(){
  $('#assignstudents').select2();
  $('#remstudents').select2();
  $(".headcard").on('show.bs.collapse','.collapse', function(e) {
  $(e.target).parent().addClass('shadow');
  });
  $(".headcard").on('hidden.bs.collapse','.collapse', function(e) {
  $(e.target).parent().removeClass('shadow');
  });
  $("#CoursesTable").DataTable({
    responsive:true,
  });
  //$("#studenttable").DataTable({
    //responsive:true,
  //});
  
  $('#studenttable').DataTable( );
$('.partnerdel').click(function(w){

 w.preventDefault();
var partner=$(this).attr('id');
  Swal.fire({
  text: "remove this partner from this course",
  icon: 'question',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, remove!'
}).then((result) => {
  if (result.isConfirmed) {
 
    $.ajax({
      url:'/instructor/remove-partner',
      method:'get',
      async:false,
      dataType:'JSON',
      data:{partner:partner},
      success:function(data){
        if(data.message){
          Swal.fire(
              '',
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
})

JS;

$this->registerJs($script);

?>
