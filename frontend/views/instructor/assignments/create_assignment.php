<?php  
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$winner="theinner";
?>
<div class="modal fade " id="createAssignmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <span class="modal-title" id="exampleModalLabel"><h4>Create New Assignment</h4></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php $form = ActiveForm::begin(['method'=>'post', 'action'=>['/instructor/upload-assignment', 'enctype'=>'multipart/form-data','id'=>'assform']])?>
        <div class="row">
        <div class="col-md-12">
        <?= $form->field($assmodel, 'assTitle')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Assignment Title'])->label(false)?>
        </div> 
        </div>
        <div class="row">
        <div class="col-md-12">
        <?= $form->field($assmodel, 'description')->textarea(['class'=>'form-control form-control-sm', 'placeholder'=>'Further instructions'])->label(false)?>
        </div>
        </div>
        <div class="row">
        <div class="col-md-3">
        <?= $form->field($assmodel, 'startDate')->input('date', ['class'=>'form-control form-control form-control-sm'])->label('Start Date')?>
        </div>
        <div class="col-md-3">
        <?= $form->field($assmodel, 'endDate')->input('date', ['class'=>'form-control form-control form-control-sm'])->label('End Date')?>
        </div>
        <div class="col-md-3">
        <?= $form->field($assmodel, 'submitMode')->dropdownList(['resubmit'=>'Can resubmit', 'unresubmit'=>'Cant resubmit'], ['class'=>'form-control form-control-sm', 'prompt'=>'--select--'])->label('Submission Mode')?>
        </div>
        <div class="col-md-3">
        <?= $form->field($assmodel, 'totalMarks')->textInput(['type'=>'text','class'=>'form-control form-control-sm','id'=>'qnumber'])->label('Number of questions')?>
        </div>
      </div>
      <div class="row" style="border:solid 1px #ccc;margin-bottom:1%">
        <div class="col-md-9" id="questions">
        
        </div>
        <div class="col-md-3">
        <?= $form->field($assmodel, 'totalMarks')->textInput(['type'=>'text','class'=>'form-control form-control-sm','id'=>'totm'])->label('Total Marks')?>
        </div>
      </div>
      <div class="row" id="asstypearea" style="border:solid 1px #ccc;margin-bottom:1%">
        <div class="col-md-4">
        <?= $form->field($assmodel, 'assType')->dropdownList(['allstudents'=>'All students','allgroups'=>'All groups','groups'=>'Chosen groups','students'=>'Chosen students'], ['class'=>'form-control form-control-sm','id'=>'asstype', 'prompt'=>'--select--'])->label('Assigned to')?>
        </div>
       
      </div>
      <div class="row">
      <div class="col-md-12">
     
       <?= $form->field($assmodel, 'the_assignment')->textarea(['class'=>'form-control form-control-sm', 'placeholder'=>'Type your assignment'])->label(false)?>
    
       </div>
      </div>
      <div class="row">
      <div class="col-md-12">
      <div class="custom-file">
      <?= $form->field($assmodel, 'assFile')->fileInput(['class'=>'form-control form-control-sm custom-file-input', 'id'=>'customFile'])->label('Select File', ['class'=>'custom-file-label col-form-label-sm', 'for'=>'customFile'])?>
      </div>
      <?= $form->field($assmodel, 'ccode')->hiddenInput(['class'=>'form-control form-control-sm'])->label(false)?>
      </div>
       </div>
        <div class="row">
        <div class="col-md-12">
        <?= Html::submitButton('Create', ['class'=>'btn btn-primary btn-md float-right ml-2']) ?>
        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
      
        </div>
        </div>
        <?php ActiveForm::end()?>
    </div>
    </div>
  </div>
</div>
<?php 
$script = <<<JS
$('document').ready(function(){

//the labels

$('label').css('fontSize','11px');
  //handling assignment questions
  $('#qnumber').keyup(function(){
	//$('#totm').val(0);
   $('#questions').html("");
   var noq=parseInt($(this).val());
   for(var n=1; n<=noq; n++){
   var d="q"+n;
   var qobj='<input id="q'+n+'" class="form-control" type="text" placeholder="Q'+n+'" name="q_max[]" style="width:50px;height:50px;border-color:#ccc; border-radius:7px;float:left;margin:1px;font-size:12px" />';
   $('#questions').append(qobj);


   }
   
   })
   
   var maxima=0;
   
   $('#questions').on('keyup','input',function(){
   var num_item=$('#questions').children().length;
   var total_marks=0;
   for(var t=0;t<num_item;t++)
   {
	   
	   
	       var qm=0;
		   if(isNaN(parseFloat($('#questions').children().eq(t).val()))){qm=0;}
		   else{ qm=parseFloat($('#questions').children().eq(t).val());}
		   total_marks=total_marks+qm;
	
		 
	   
   }
   
   if(isNaN(total_marks)){total_marks=parseFloat(total_marks);}
   $('#totm').val(total_marks);
   maxima=total_marks;

   })
   
  $('#totm').blur(function(){

 if($('#qnumber').val()!="" && parseInt($('#qnumber').val())>0)
 {
   
   if(parseFloat($('#totm').val())!=maxima)
   {
    Swal.fire(
              'input error!',
              'the total maxima must be equal to the total of all questions maxima',
              'error'
    );
	   if(maxima>0){ $('#totm').val(maxima); }else{ $('#totm').val(''); }
   }
    

 }

  });

  //the end of questions handling###############################

  //handling the assignment chosing
  $('#asstype').change(function(){
  var selected=$(this).val();
  
  if(selected=="groups"){

    if($('#students2').length>0)
    {
      $('#students2').parent().remove();
    }

  //creating the generation type element
  $.ajax({
                url: '/instructor/get-gentypes',
                type: "POST",
                data:"hey",  
                error: function(xhr,tStatus,e){
                    if(!xhr){
                        alert(tStatus+"   "+e.message);
                    }else{
                        alert("else: "+e.message); 
                    }
                    },
                success: function(resp){
                  var data=$.parseJSON(resp);
                  var genelem='<div class="col-md-4"><label for="gentypes" style="font-size:11px">Generation types</label><select id="gentypes" name="gentypes" class="form-control form-control-sm">';
                  var genelemmid="<option>--select generation--</option>";
                  var genelem2='</select></div>';

                  for(var item in data)
                  {
                    var option='<option value="'+item+'">'+data[item]+'</option>';
                        genelemmid+=option;

                  }

                  genelem=genelem+genelemmid+genelem2;

                    if($('#gentypes').length<=0)
                    {
                    $('#asstypearea').append(genelem);
                    }

                    }
                });
  }
  else if(selected=="allgroups")
  {
                   if($('#gengroups').length>0)
                    {
                      $('#gengroups').parent().remove();

                    }
                    if($('#students2').length>0)
                    {
                      $('#students2').parent().remove();
                    }
               

     //creating the generation type element
  $.ajax({
                url: '/instructor/get-gentypes',
                type: "POST",
                data:"",  
                error: function(xhr,tStatus,e){
                    if(!xhr){
                        alert(tStatus+"   "+e.message);
                    }else{
                        alert("else: "+e.message); 
                    }
                    },
                success: function(resp){
                  var data=$.parseJSON(resp);
                  var genelem='<div class="col-md-4"><label for="gentypes" style="font-size:11px">Generation types</label><select id="gentypes" name="gentypes" class="form-control form-control-sm">';
                  var genelemmid="<option>--select generation--</option>";
                  var genelem2='</select></div>';

                  for(var item in data)
                  {
                    var option='<option value="'+item+'">'+data[item]+'</option>';
                        genelemmid+=option;

                  }

                  genelem=genelem+genelemmid+genelem2;

                    if($('#gentypes').length<=0)
                    {
                    $('#asstypearea').append(genelem);
                    }

                    }
                });



  }
  else if(selected=="allstudents")
  {
    if($('#gengroups').length>0)
    {
      $('#gengroups').parent().remove();

    }
    if($('#gentypes').length>0)
    {
      $('#gentypes').parent().remove();

    }
    if($('#students2').length>0)
    {
      $('#students2').parent().remove();
    }

  }
  else{

    if($('#gengroups').length>0)
    {
      $('#gengroups').parent().remove();

    }
    if($('#gentypes').length>0)
    {
      $('#gentypes').parent().remove();

    }
     
   //finding all students for this course

   $.ajax({
                url: '/instructor/get-students',
                type: "POST",
                data:"",  
                error: function(xhr,tStatus,e){
                    if(!xhr){
                        alert(tStatus+"   "+e.message);
                    }else{
                        alert("else: "+e.message); 
                    }
                    },
                success: function(resp){
                  var data=$.parseJSON(resp);
                  var stdelem='<div class="col-md-4"><label for="students2" style="font-size:11px">Students</label><select id="students2" name="mystudents[]" class="form-control form-control-sm">';
                  var stdelemmid='<option>--select students--</option>';
                  var stdelem2='</select></div>';

                  for(var item in data)
                  {
                    var option='<option value="'+item+'">'+item+'</option>';
                    stdelemmid+=option;

                  }

                  stdelem=stdelem+stdelemmid+stdelem2;
                    if($('#students2').length<=0)
                    {
                    $('#asstypearea').append(stdelem);
                    }
                

                    }
                });


  }
  });
  //the groups
  $('#asstypearea').on('change','#gentypes',function(){
  var selected=parseInt($(this).val());
  if($('#asstype').val()=="groups"){
  
  //creating the generation type element
    //creating the generation type element
    $.ajax({
                url: '/instructor/get-groups',
                type: "GET",
                data:{'genid':selected},  
                error: function(xhr,tStatus,e){
                    if(!xhr){
                        alert(tStatus+"   "+e.message);
                    }else{
                        alert(" "+e.message); 
                    }
                    },
                success: function(resp){
                  var data=$.parseJSON(resp);
                  console.log(data);
                  var grpelem='<div class="col-md-4" id="groups"><label for="gengroups" id="grplabel" style="font-size:11px">Groups</label><select id="gengroups" name="gengroups[]" class="form-control form-control-sm" multiple="multiple">';
                  var grpelemmid="<option>--select group(s)--</option>";
                  var grpelem2='</select></div>';

                  for(var item in data)
                  {
                    var option='<option value="'+item+'">'+data[item]+'</option>';
                    grpelemmid+=option;

                  }

                  grpelem=grpelem+grpelemmid+grpelem2;

                  if($('#gengroups').length<=0)
                    {
                    $('#asstypearea').append(grpelem);

                    }
                    else
                    {
                      $('#groups').replaceWith(grpelem);
                    }
                    }
                });

 

  }



  })

})
JS;
$this->registerJs($script);
?>
