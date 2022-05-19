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





?>


<div class="site-index p-0">
    <div class="body-content p-0">
        <!-- Content Wrapper. Contains page content -->

  
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
                    <div class="row border-bottom" id=<?=$index?>>
                     <div class="col-sm-12 responsivetext"><?=$count.". ".$question['question']." "?><span class="text-muted responsivetext"><?=($question['multiple']=='on')?"(Choose Many)":"(Choose One)"?></span></div>
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
                          ?>
                          <ul>
                          <?php
                          foreach($options['choices'] as $indexc=>$choice)
                          {
            
                              if(array_key_exists($indexc,$options['true-choices']))
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
                          ?>
                          </ul>
                          <?php
                        }
                        else
                        {
                          ?>
                          <ul>
                          <?php
                          foreach($options['choices'] as $indexd=>$choice)
                          {
                            if(array_key_exists($indexd,$options['true-choices']))
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
                          ?>
                          </ul>
                          <?php
                        }
                      ?>
                     
                     
                     </div>
                 </div>

                 
                   <?php
                   $count++;
                 }
                }
             
               ?>
             
               </div>

           </div>

        </div>
              </div>
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

$('body').on('change','.chooseq',function(){
  var name=$(this).prop('value');
 
    if(this.checked){
    var q=$(this).parent().parent().clone();
    q.find('.chooseq').remove();
    q.find('.qdel').remove();
    q.appendTo('.chosenquestions');
   $(this).parent().parent().addClass('border');
   $(this).parent().parent().addClass('m-2');
   $(this).parent().parent().addClass('p-2');
  }
  else
  {
  
    $('.chosenquestions').find($(document.getElementById(name))).remove();
    //.remove();
    $(this).parent().parent().removeClass('border');
    $(this).parent().parent().removeClass('m-2');
   $(this).parent().parent().removeClass('p-2');
  }
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




