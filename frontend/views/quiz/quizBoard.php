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
$this->params['courseTitle'] ="<i class='fa fa-pen'></i> Quiz";
$this->title = 'Quiz Taking';

$this->params['breadcrumbs'] = [
  ['label'=>$cid.' Quizzes', 'url'=>Url::to('/quiz/student-quizes')],
  ['label'=>$this->title]
];
?>


<div class="site-index">
    <div class="body-content">
        <!-- Content Wrapper. Contains page content -->

 
       
           <div class="card shadow" >
              <div class="card-body">
                <div  class="row border-bottom text-primary text-lg p-2 m-2 d-flex justify-content-center"><div class="col-sm-2"><marquee><?=($registered==true)?"You Are Already Registered To This Quiz, Make Sure You Submit Your Answers Otherwise Your Score Is By Default 0 (zero) !":"You Are Not Registered To This Quiz,Make Sure Your Quiz Has Loaded Properly Or Try Loading Again !"?></marquee></div><div class="col-sm-8 text-center"><?=$title?> <span class="text-muted pl-1"> <?=" (".$total_marks." Marks)"?></span></div><div class="col-sm-2 border-white p-2 " style="position:fixed; top:15%;right:0%"><div class="container p-2 bg-black text-center">Timer</div></div></div>
                <form action="/quiz/get-quiz-responses" method="post">
               <?php
                 $quizdata=$quizdata;
                 if(!empty($quizdata) || $quizdata!=null)
                 {
                  
                
                 $count=1;
                 
                 foreach($quizdata as $qindex=>$question)
                 {
                   $options=$question['options'];
                   ?>
                    <div class="row border-bottom">
                     <div class="col-sm-12 "><?=$count.". ".$question['question']." "?><span class="text-muted responsivetext"><?=($question['multiple']=='on')?"(Choose Many)":"(Choose One)"?></span></div>
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
                        if($question['multiple']=="on")
                        {
                        if($options['type']=="textual")
                        {
                          foreach($options['choices'] as $index=>$choice)
                          {
                                ?>
                                <li style="list-style:none" class="ml-4"><input type="checkbox" name="<?=$qindex?>[]"></input><span class="ml-1 text-muted responsivetext"><?=$choice?></span></li>
                             <?php
                           
                              }
                          
                        }
                        else
                        {
                          foreach($options['choices'] as $index=>$choice)
                          {
                        

                              ?>
 <li style="list-style:none" class="ml-4"><input type="checkbox" name="<?=$qindex?>[]"><img class="img-thumbnail m-1" src="/<?=$choice?>" width=60 height=40></input></li>
                              <?php
                            }
                          }
                        }
                        else
                        {
                          if($options['type']=="textual")
                          {
                            foreach($options['choices'] as $index=>$choice)
                            {
                                  ?>
                                  <li style="list-style:none" class="ml-4"><input type="radio" name="<?=$qindex?>[]" ></input><span class="ml-1  text-muted responsivetext"><?=$choice?></span></li>
                               <?php
                             
                                }
                            
                          }
                          else
                          {
                            foreach($options['choices'] as $index=>$choice)
                            {
                          
  
                                ?>
  <li style="list-style:none" class="ml-4"><input type="radio" name="<?=$qindex?>[]" ><img class="img-thumbnail ml-1 m-1" src="/<?=$choice?>" width=60 height=40></input></li>
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
            
               ?>
                <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                <button type="submit" class="btn btn-default text-primary shadow p-2 mt-3 col-sm-7 float-right"><i class="fa fa-send"></i> Submit</button>
             </form>
               </div>

         

        </div>
        </div>
              </div>
         

</div>
        <!--
        question add modal


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




