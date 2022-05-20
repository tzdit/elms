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
         <span class="d-none quiz"><?=$quiz?></span>
           <div class="card shadow" >
              <div class="card-body">
                <div  class="row border-bottom text-primary text-lg p-2 m-2 d-flex justify-content-center"><div class="col-sm-2 text-danger text-md p-0"><marquee><?=($registered==true)?"You Are Already Registered To This Quiz, Make Sure You Submit Your Answers Otherwise Your Score Is By Default 0 (zero) !":"You Are Not Registered To This Quiz,You will be registered during submission !"?></marquee></div><div class="col-sm-8 text-center"><?=$title?> <span class="text-muted pl-1"> <?=" (".$total_marks." Marks)"?></span></div><div class="col-sm-2 border-white p-2 " style="position:fixed; top:15%;right:0%"><div class="container p-2 bg-black text-center"><span class="float-left p-0"><img src="/img/loader.gif" class="img-circle" width="17px" height="17px" /></span><span class='timing'><?=($inititalTimer!=null)?$inititalTimer:"Time is Over!"?></span><br><span class='text-sm subinfo'></span></div></div></div>
                <form action="/quiz/get-quiz-responses" id="form" method="post">
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
                                <li style="list-style:none" class="ml-4"><input type="checkbox" class="trueq" name="<?=$qindex?>[]"></input><span class="ml-1 text-muted responsivetext"><?=$choice?></span></li>
                             <?php
                           
                              }
                          
                        }
                        else
                        {
                          foreach($options['choices'] as $index=>$choice)
                          {
                        

                              ?>
 <li style="list-style:none" class="ml-4"><input type="checkbox" class="trueq" name="<?=$qindex?>[]"><img class="img-thumbnail m-1" src="/<?=$choice?>" width=60 height=40></input></li>
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
                                  <li style="list-style:none" class="ml-4"><input type="radio"  class="qradio" name="<?=$qindex?>[]" ></input><span class="ml-1  text-muted responsivetext"><?=$choice?></span></li>
                               <?php
                             
                                }
                            
                          }
                          else
                          {
                            foreach($options['choices'] as $index=>$choice)
                            {
                          
  
                                ?>
  <li style="list-style:none" class="ml-4"><input type="radio"  class="qradio" name="<?=$qindex?>[]" ><img class="img-thumbnail ml-1 m-1" src="/<?=$choice?>" width=60 height=40></input></li>
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
               <input type="hidden" name="quiz" value="<?= $quiz; ?>" />
                <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                <button type="submit" class="btn btn-default text-primary shadow p-2 mt-3 col-sm-7 float-right submitbtn"><i class="fa fa-send"></i> Submit</button>
             </form>
             <audio class="d-none messageaudio">
              <source src="/media/anxious-586.mp3"  type="audio/mpeg">
              </audio>
              <audio class="d-none overaudio">
              <source src="/media/over.mp3"  type="audio/mpeg">
              </audio> 
              <audio class="d-none successaudio">
              <source src="/media/success.mp3"  type="audio/mpeg">
              </audio> 
              <audio class="d-none failaudio">
              <source src="/media/fail.mp3"  type="audio/mpeg">
              </audio>
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
$('body').on('change','.trueq',function(){

if(this.checked){
 
  var index=$(this).parent().parent().find('.trueq').index($(this));
 $(this).prop('value',index);
 
  }
 
})

$('body').on('change','.qradio',function(){
 var radios=$(this).parent().parent().find('.qradio').index($(this));
 $(this).prop('value',radios);
 
  
 
})
  var allradios=$('.qradio');
  for(var i=0; i<allradios.length;i++)
  {
    var radioinput=allradios.eq(i);
    var radioindex=radioinput.parent().parent().find('.qradio').index(radioinput);
     radioinput.prop('value',radioindex); 

  }

  var allcheck=$('.trueq');
  for(var i=0; i<allcheck.length;i++)
  {
    var checkinput=allcheck.eq(i);
    var checkindex=checkinput.parent().parent().find('.trueq').index(checkinput);
    checkinput.prop('value',checkindex); 

  }

  $("#form").on("submit", function(event){
        event.preventDefault();


     
 
   
    var formValues= $(this).serialize();
 
 $.post("/quiz/get-quiz-responses", formValues, function(data){
     // Display the returned data in browser
    
     if(data.score)
     {
     var res=$.parseJSON(data.score);
     $('.successaudio').get(0).play();
     Swal.fire(
      "Your Score",
      res.score+"/"+res.totalmarks,
      'success'
     );
   }
   else
   {
    $('.failaudio').get(0).play();
     Swal.fire(
      "Submission failed",
      data.failed,
      'error'
     );
   }
 });
 
    });

    $('.submitbtn').click(function(b){

      b.preventDefault();

      Swal.fire({
  title: 'Submit Quiz?',
  text: "You won't be able to revert this! And once submitted you will no longer be able to submit",
  icon: 'question',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Submit'
}).then((result) => {
  if (result.isConfirmed) {

     $('#form').submit();

  }

}
)

    })

    function updatetime()
    {
      var quiz=$('.quiz').text();
      $.post("/quiz/update-quiz-timer", {quiz:quiz}, function(data){
     // Display the returned data in browser
     if(data.time!=null)
     {
       
      $('.timing').text(data.time);
      
     }
     else
       {
        $('.timing').text("Time is Over!");
        $('.img-circle').addClass('d-none');
        $('.messageaudio').get(0).play();
        $('.overaudio').get(0).play();
        var time=10;
        var subinterval=setInterval(()=>{
          $('.subinfo').text("submitting in "+time+" seconds...");
          time=time-1;
        },1000);
        
        clearInterval(timeinterval);
        
        var timeout=setTimeout(()=>{
         $('#form').submit();
         clearInterval(subinterval);
         clearTimeout(timeout);
         $('.subinfo').text("submitted !");
        
        },10000);
       
       }
 
 });
    }

    var timeinterval=setInterval(updatetime, 1000);
    var quizz=$('.quiz').text();
    var localfocus=localStorage.getItem("offcus"+quizz);
    var off_focus_no=(localfocus!="" || localfocus!=null)?localfocus:0;
document.addEventListener("visibilitychange", function() {
 
  if (document.visibilityState === 'hidden') {
    off_focus_no++;
    var quiz2=$('.quiz').text();
    localStorage.setItem("offcus"+quiz2,off_focus_no);
    if(off_focus_no<=1)
    {
    Swal.fire(
      'Attention ! Your quiz will be automatically submitted',
      'You should not got outside this window during the quiz by either opening another tab, another window or minimizing it ! if this is repeated your quiz will be automatically submitted !!',
      'info'
    )
    }
    else
    {
      $("#form").submit();
    }
  }
});
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




