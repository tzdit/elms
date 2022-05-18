<?php
use frontend\models\ClassRoomSecurity;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use frontend\models\QuizManager;


/* @var $this yii\web\View */
$cid=yii::$app->session->get('ccode');
$this->params['courseTitle'] ="<i class='fa fa-bank'></i> Questions Bank";
$this->title = 'Questions Bank';
$this->params['breadcrumbs'] = [
    ['label'=>$cid.' Quizes', 'url'=>Url::to(['class-quizes','cid'=>ClassRoomSecurity::encrypt(yii::$app->session->get("ccode"))])],
    ['label'=>$this->title]
];

?>


<div class="site-index">
    <div class="body-content">
        <!-- Content Wrapper. Contains page content -->
        <div class="row">
          <div class="col-sm-10">
        <div class="container-fluid">
           <div class="card shadow">
              <div class="card-body p-3 pr-1 text-center">
               
               <a href="#" class="text-primary" data-toggle="modal" data-target="#questionmodal"><i class="fa fa-plus-circle"></i> New Question</a>

                </div>      </div>

                </div>

                </div>
                <div class="col-sm-2 p-0 ">
                <div class="container-fluid">
           <div class="card shadow">
              <div class="card-body p-2 pl-1 text-center">
                <?php $bankfile=(new QuizManager)->getBankHome()?>
               <a href="#" class="btn btn-default shadow text-primary" data-toggle="modal" data-target="#uploadermodal" ><i class="fa fa-upload" data-toggle="tooltip" data-title="Upload Questions Bank File" ></i></a>
               <a href="/<?=$bankfile?>" class="btn btn-default shadow text-primary" data-toggle="tooltip" data-title="Download Questions Bank File"  ><i class="fa fa-download"></i></a>
               <a href="<?=Url::to("/quiz/download-bank")?>" class="btn btn-default shadow text-primary" data-toggle="tooltip" data-title="Download As PDF"  ><i class="fa fa-file-pdf-o text-danger"></i></a>
               </div></div></div></div></div>
         
        <div class="container-fluid">
           <div class="card shadow">
              <div class="card-body">
               
               <?php
                 $bank=(new QuizManager)->questionsBankReader();
                 if(!empty($bank) || $bank!=null)
                 {
                 $bank=array_reverse($bank,true);
                
                 $count=1;
                 
                 foreach($bank as $index=>$question)
                 {
                   $options=$question['options'];
                   ?>
                    <div class="row border-bottom">
                     <div class="col-sm-12 responsivetext"><?=$count.". ".$question['question']." "?><span class="text-muted responsivetext"><?=($question['multiple']=='on')?"(Choose Many)":"(Choose One)"?></span><span class="float-right"><a class="float-right qdel" href="#" id=<?=$index?>><i class="fa fa-trash text-danger text-sm" data-toggle="tooltip" data-title="Delete Question"></i></span></a></div>
                     <?php
                      if($question['questionImage']!=null)
                      {
                        ?>
                        <img class="ml-3 p-2 border-muted" src="/<?=$question['questionImage']?>" width="250" height="250">
                        <?php
                      }
                     ?>
                     <div class="responsivetext col-sm-12">
                      <?php
                        if($options['type']=="textual")
                        {
                          foreach($options['choices'] as $index=>$choice)
                          {
            
                              if(array_key_exists($index,$options['true-choices']))
                              {
                          ?>
                             <li class="ml-4  responsivetext text-success"><?=$choice?></li>
                          <?php
                         
                              }
                              else
                              {
                                ?>
                                <li class="ml-4  text-muted responsivetext"><?=$choice?></li>
                             <?php
                           
                              }
                            
                          }
                        }
                        else
                        {
                          foreach($options['choices'] as $index=>$choice)
                          {
                            if(array_key_exists($index,$options['true-choices']))
                            {

                      ?>
                      <li class="ml-4 p-2 text-success"><img class="img-thumbnail border-success" src="/<?=$choice?>" width=60 height=40></li>
                      <?php
                            }
                            else
                            {
                              ?>
                              <li class="ml-4 p-2"><img class="img-thumbnail" src="/<?=$choice?>" width=60 height=40></li>
                              <?php
                            }
                          }
                        }
                      ?>
                     </div>
                 </div>

                 
                   <?php
                   $count++;
                 }
                }
                else
                {
               ?>
                 <div class="container-fluid d-flex justify-content-center p-5"><span class="text-center text-muted text-lg"><i class="fa fa-info-circle"></i> Questions Bank Empty !</span></div>
               <?php
                }
               ?>
               </div>

           </div>

        </div>
        <!--
        question add modal

        -->
<?=
$this->render('newQuestion');

?>
<?=
$this->render('questionsUploader');

?>
    </div>


<?php
$script = <<<JS
$(document).ready(function(){
  $("#CourseList").DataTable({
    responsive:true,
  });
//Remember active tab
$('a[data-toggle="tab"]').on('show.bs.tab', function(e) {

localStorage.setItem('activeTab', $(e.target).attr('href'));

});

var activeTab = localStorage.getItem('activeTab');

if(activeTab){

$('#custom-tabs-four-tab a[href="' + activeTab + '"]').tab('show');

}

$(document).on('click', '.qdel', function(){
      var question = $(this).attr('id');
      Swal.fire({
  title: 'Delete Question?',
  text: "You won't be able to revert this!",
  icon: 'question',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Delete !'
}).then((result) => {
  if (result.isConfirmed) {
 
    $.ajax({
      url:'/quiz/delete-question',
      method:'post',
      async:false,
      dataType:'JSON',
      data:{question:question},
      success:function(data){
        if(data.message){
          Swal.fire(
              'Deleted !',
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
<?php 
$this->registerCssFile('@web/plugins/select2/css/select2.min.css');
$this->registerJsFile(
  '@web/plugins/select2/js/select2.full.js',
  ['depends' => 'yii\web\JqueryAsset']
);
$this->registerJsFile(
  '@web/js/create-assignment.js',
  ['depends' => 'yii\web\JqueryAsset'],

);



?>




