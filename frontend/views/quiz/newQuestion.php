<?php

use common\models\Course;
use common\models\GroupAssignment;
use common\models\GroupGenerationAssignment;
use common\models\Groups;
use common\models\Student;
use common\models\StudentGroup;
use frontend\models\ClassRoomSecurity;
use frontend\models\GroupAssSubmit;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\VarDumper;


/* @var $this yii\web\View */
$cid=yii::$app->session->get('ccode');
$this->params['courseTitle'] ="<i class='fa fa-bank'></i> Questions Bank";
$this->title = 'Questions Bank';
$this->params['breadcrumbs'] = [
    ['label'=>$cid.' Quizes', 'url'=>Url::to(['class-quizes','cid'=>ClassRoomSecurity::encrypt(yii::$app->session->get("ccode"))])],
    ['label'=>$this->title]
];

?>


        <!-- Content Wrapper. Contains page content -->
  <div class="modal fade" id="questionmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header bg-info pt-2 pb-2">
        <span class="modal-title" id="exampleModalLabel"><h6><i class='fa fa-plus-circle'></i> Add New Question</h6></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid questionwidget">
                 <form enctype="multipart/form-data" method="post" action="/quiz/save-question">
                 <div class="row mb-2 ml-2 p-0 m-0">
                    <div class="col-sm-12 m-0 p-0">
                   
                 <select class="form-control float-right questiontype" name="questiontype">
                    <option value="multiple-choice" name="questiontype">Multiple Choices</option>
                    <option value="true-false" name="questiontype">True/False</option>
                 </select>
                 </div>
                </div>
            
             
               <div class="row  ml-2 p-0 material-background">
               
                <div class="col-sm-1 p-0 d-flex justify-content-center m-0">
                <i class="fa fa-image fa-3x  qimage text-info" data-toggle="tooltip" data-title="Add Image To the Question"></i>
                <input type="file" name="questionImage" accept="image/*" class="d-none questionpic"></input>
                </div>
               
                <div class="col-sm-11 m-0">
              
                  <textarea class="form-control" name="question" rows=8 cols=3 placeholder="Type Your Question Here"></textarea>
                  
                 </div>
             
                  </div>

                  <div class="row p-3 questionsoptions">

                  <div class="card col-sm-3 material-background firstopt">
                  <div class="card-header p-2 text-info">
                    <div class="row p-0">
                      <div class="col-sm-12 p-0">
                    <i data-toggle="tooltip" data-title="Remove Option" class="fa fa-trash-alt fa-1x text-info btn btn-sm btn-default float-left mr-1 p-0 remove" ></i>
                   <i data-toggle="tooltip" data-title="Turn To An Image Option" class="fa fa-image text-info float-left btn btn-default btn-sm p-0 img" style="font-size:20px"></i>
                   <input type="checkbox" name="" class="m-0 p-0 float-right trueq"></input>
                   <input type="file" name="optionImage[]"  accept="image/*" class="d-none thefile"></input>
                   </div>
                  </div>
                </div>
                  <div class="card-body p-0 pb-1">
                  <textarea class="form-control" name="options[]" placeholder="Type Answer Option"></textarea>
                 
                  </div>
                   </div>
                    
                  <div class="card material-background col-sm-3 secopt">
                  <div class="card-header p-2 text-info">
                    <div class="row p-0">
                      <div class="col-sm-12 p-0">
                      <i data-toggle="tooltip" data-title="Remove Option" class="fa fa-trash-alt fa-1x btn btn-sm text-info btn-default float-left mr-1 p-0 remove" ></i>
                   <i data-toggle="tooltip" data-title="Turn To An Image Option" class="fa fa-image float-left text-info btn btn-default btn-sm p-0 img" style="font-size:20px"></i>
                   <input type="checkbox" name="" class="m-0 p-0 float-right trueq"></input>
                   <input type="file" name="optionImage[]"  accept="image/*" class="d-none thefile"></input>
                   </div>
                  </div>
                </div>
                  <div class="card-body p-0 pb-1">
                  <textarea class="form-control" name="options[]"  placeholder="Type Answer Option"></textarea>
                  
                  </div>
                  </div>
                  <div class="card material-background col-sm-3">
                  <div class="card-header p-2 text-info">
                    <div class="row p-0">
                      <div class="col-sm-12 p-0">
                      <i data-toggle="tooltip" data-title="Remove Option" class="fa fa-trash-alt fa-1x btn btn-sm btn-default text-info float-left mr-1 p-0 remove" ></i>
                   <i data-toggle="tooltip" data-title="Turn To An Image Option" class="fa fa-image float-left btn btn-default text-info btn-sm p-0 img" style="font-size:20px"></i>
                   <input type="checkbox" name="" class="m-0 p-0 float-right trueq"></input>
                   <input type="file" name="optionImage[]"  accept="image/*" class="d-none thefile"></input>
                   </div>
                  </div>
                </div>
                  <div class="card-body p-0 pb-1">
                  <textarea class="form-control" name="options[]" placeholder="Type Answer Option"></textarea>
                  </div>
                  </div>
                  <div class="card material-background col-sm-3">
                  <div class="card-header p-2 text-info">
                    <div class="row p-0 ">
                      <div class="col-sm-12 p-0 text-info">
                      <i data-toggle="tooltip" data-title="Remove Option" class="fa fa-trash-alt fa-1x btn btn-sm btn-default text-info float-left mr-1 p-0 remove" ></i>
                   <i data-toggle="tooltip" data-title="Turn To An Image Option" class="fa fa-image float-left btn btn-default text-info btn-sm p-0 img" style="font-size:20px"></i>
                   <input type="checkbox" name="" class="m-0 p-0 float-right trueq"></input>
                   <input type="file" name="optionImage[]" accept="image/*" class="d-none thefile"></input>
                   </div>
                  </div>
                </div>
                  <div class="card-body p-0 pb-1">
                  <textarea class="form-control" name="options[]" placeholder="Type Answer Option"></textarea>
                  </div>
                  </div>

                  
                    </div>
                    <span class="row btn btn-sm shadow btn-default addmore" data-toggle="tooltip" data-title="Add more options" style="position:absolute; right:1%; top:60%"><i class="fa fa-plus-circle fa-1x"></i></span>
                  <div class="row p-0 ">
                    <div class="col-sm-6 form-check ">
                  <span class="form-group float-left ml-3 answerdec"><input type="checkbox" name="answerdecision" class="form-check-input" id="moreq"></input><label for="moreq">Accept More Than One Correct Answer</label></span>
                 
                  </div>
                  <div class="col-sm-6 ">
                  <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                  <span class="float-right"><button type="submit"  class="btn btn-default btn-md shadow text-info"><i class="fa fa-save"></i> Save</button></span>
                  </div>
                  </div>
                  </div>

</form>
               </div>
               
               </div>

        
     
    </div>
    </div>
     
     </div>


<?php
$script = <<<JS
$(document).ready(function(){
  var optarea=$('.questionwidget').find('.questionsoptions');
  var addmore=$('.addmore');
  var initialoption='<div class="card col-sm-3">';
  initialoption+='<div class="card-header p-2 text-primary">';
  initialoption+='<div class="row p-0">';
  initialoption+='<div class="col-sm-12 p-0">';
  initialoption+='<i data-toggle="tooltip" data-title="Remove Option" class="fa fa-trash-alt fa-1x text-info btn btn-sm btn-default float-left mr-1 p-0 remove" ></i>';
  initialoption+='<i data-toggle="tooltip" data-title="Turn To An Image Option" class="fa fa-image text-info float-left btn btn-default btn-sm p-0 img" style="font-size:20px"></i>';
  initialoption+=' <input type="checkbox" name="" class="m-0 p-0 float-right trueq"></input>';
  initialoption+='<input type="file" name="questionfile" accept="image/*" class="d-none thefile"></input>';
  initialoption+='</div>';
  initialoption+='</div>';
  initialoption+='</div>';
  initialoption+='<div class="card-body p-0 pb-1">';
  initialoption+='<textarea class="form-control" name="options[]" placeholder="Type Answer Option"></textarea>';
  initialoption+='</div>';
  initialoption+=' </div>';
$('.questiontype').on('change',function(){



  
  if($('.questiontype').val()=="true-false")
  {
    optarea.html("");
    var optiontrue= $(initialoption);
    optiontrue.find('textarea').val('True');
    optiontrue.find(".img").addClass('d-none');
    optiontrue.find(".remove").addClass('d-none');
    var optionfalse= $(initialoption);
    optionfalse.find('textarea').val('False');
    optionfalse.find(".img").addClass('d-none');
    optionfalse.find(".remove").addClass('d-none');
    optarea.append(optiontrue).append(optionfalse);
    $('.addmore').remove();
    $('.answerdec').addClass("d-none");

  }
  else
  {
    optarea.html("").append(initialoption).append(addmore);
    $('.answerdec').removeClass("d-none");
  }
})
$('.addmore').parent().parent().on('click','.addmore',function(){
  $('.questionsoptions').append(initialoption);
})
$('body').on('click','.remove',function(){

  $(this).parent().parent().parent().parent().remove();

 
})

$('body').on('click','.img',function(){
  $(this).parent().find('.thefile').trigger('click');
})


$('body').on('click','.qimage',function(){
  $(this).parent().find('.questionpic').trigger('click');
})

$('body').on('change','.questionpic',function(){
  if($(this).prop('files')[0].length!=0){
   $('.qimage').addClass('text-success');
  }
})

$('body').on('change','.thefile',function(){
  if($(this).prop('files')[0].length!=0){
    $(this).parent().find('.img').addClass('text-success');
    $(this).parent().find('.remove').addClass('text-success');
    $(this).parent().parent().parent().parent().addClass('shadow');
    $(this).parent().parent().parent().parent().find('textarea').val('Image').prop('disabled',true);
  }
})

$('body').on('change','.trueq',function(){

 if(this.checked){
  
  $(this).prop('name',$('.trueq').index($(this)));
  
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




