$(document).ready(function(){

    var file_id="";
    var filename="";
    var record="";
    var pos="";
    var maxima=0; //used by the questions score handler
    var qscores=[];
    var qids=[];
    var obj=$('#fileobj');
    var qid="";
 
   var rw="";
   var crow="";
   var colum="";
   var regno="";
    
   file_id=localStorage.getItem('file_id');
   record=$('#'+file_id).parent();
   
 
 
   //gone through the local storage, no last one found, we set up the first record as en entry record
   rw=1;
   crow=$("tr:eq("+rw+")");
   colum=crow.find($('td')[0]);
   file_id=colum.attr('id');
   //filename=colum.text();
   filename = crow.children('td').eq(1).attr('id');
   regno=crow.children('td').eq(1).text();
   obj.attr("src","/storage/submit/"+$.trim(filename));
   $('h4').text(regno);
   $('#heading').text(regno);
   $("#heading").animate({width: "100%"});
   $("#asshead").animate({width: "50%"});
    
   crow.css('backgroundColor',"lightblue");
 
//the validations

  //handling enter key clicks: the current entry is recorded and we set up the next one
  $('body').keyup(function(e){
  var kcode = e.keyCode || e.which;
  if(kcode == 13) { 
 //taking all the questions score
    var num_item=$('.qmarking').length;
    for(var t=0;t<num_item;t++)
    {
        if($('.qmarking').eq(t).find('.score'))
        {
         if($('.qmarking').eq(t).find('.score').val()==""){Swal.fire("question no "+(t+1)+" is not marked","","error"); return false;}
         else
         {
            var qm=0;
            if(isNaN(parseFloat($('.qmarking').eq(t).find('.score').val()))){qm=0;}
            else{ qm=$('.qmarking').eq(t).find('.score').val();}
            qid=$('.qmarking').eq(t).find('.score').attr('id');
            qscores.push(qm);
            qids.push(qid);
       }
      }
        
    }
 //end taking all the questions score
  if(parseFloat($('#scoremark').val())!=maxima && $('#scoremark').val()!=""){Swal.fire("the total score must be equal to the total of questions scores","","error");}
  else{
  var marks="";
  //we call the marking script for the current entry
  if(file_id!=""){ //test again and again
  if($('#scoremark').val()==""){Swal.fire("please mark each question then click 'enter'","","info");}
  else{
  var tot_marks=parseFloat($('#tot').val());
  if(parseFloat($('#scoremark').val())>tot_marks){Swal.fire("marks provided exceed the maximum scoring","","error"); $('#scoremark').val("");}
  else{
  marks=parseFloat($('#scoremark').val());
  var comment=$('.comment').val();
  var asstype=$('.comment').attr('id');
  $.post("/instructor/mark-inputing",{ score:marks, fid:file_id, qscores:qscores,qids:qids, asstype:asstype, comment:comment,_csrf: yii.getCsrfToken()},returnAnswer)
 
 //done sending the current user, we point to the next one
 .done(function(){
 record.css('backgroundColor',"");
 

//console.log($("tr:eq("+rw+")"));
 if($(".mytable tr:eq("+rw+")").is($('.mytable tr').last())){
    Swal.fire("end of the list","","info");
   //emptying them
   $('#scoremark').val("");
   var num_item=$('.qmarking').length;
   for(var t=0;t<num_item;t++)
   {
       
     $('.qmarking').eq(t).find('.score').val("");  
   }
  
   }
 else{
 rw++;
 crow=$("tr:eq("+rw+")");
 colum=crow.children('td').eq(0);
 file_id=colum.attr('id');
 filename = crow.children('td').eq(1).attr('id');
 crow.css('backgroundColor',"lightblue");
 obj.attr("src","/storage/submit/"+$.trim(filename));
 /*
 regno=crow.children('td').eq(1).text();
 $('h4').text(regno);
 $('#heading').text(regno);
 $("#heading").css("width", "0%");
 $("#heading").animate({width: "100%"});
 $("#asshead").css("width", "0%");
 $("#asshead").animate({width: "50%"});

 
 //Putting the last entry into the local storage
 localStorage.setItem('file_id',file_id);
 localStorage.setItem('filename',filename);
 localStorage.setItem('course_code',course_code);
 localStorage.setItem('ass_name',ass_name);
 */
 $('#scoremark').val("");
 
 //emptying the questions score
 maxima=0; 
 var num_item=$('.qmarking').length;
    for(var t=0;t<num_item;t++)
    {
        
      $('.qmarking').eq(t).find('.score').val("");  
    }
   }
 //emptying the scores buffer
 qscores=[];
 });
 function returnAnswer(answer)
  {
  //alert(answer);
    
  }
  crow.css("background-color","");
 }
 
 }
 }
 
 
  }
  }
 
  });
 
 //handling next button;
$('body').keyup(function(e){
var code=e.keyCode || e.which;
if(code==39 || code==40)
{
 crow.css('backgroundColor',"");
 if($(".mytable tr:eq("+rw+")").is($('.mytable tr').last())){
   Swal.fire("end of the list","","info");
  //emptying them
  $('#scoremark').val("");
  var num_item=$('.qmarking').length;
  for(var t=0;t<num_item;t++)
  {
      
    $('.qmarking').eq(t).find('.score').val("");  
  }
 
  }
 else{rw++; crow=$("tr:eq("+rw+")");}
 colum=crow.children('td').eq(0);
 file_id=colum.attr('id');
 filename=crow.children('td').eq(1).attr('id');
 crow.css('backgroundColor',"lightblue");
 if($.trim(filename)!="")
 {
 obj.attr("src","/storage/submit/"+$.trim(filename));
 }
 //emptying them

 $('#scoremark').val("");
 var num_item=$('.qmarking').length;
 for(var t=0;t<num_item;t++)
 {
     
   $('.qmarking').eq(t).find('.score').val("");  
 }
 regno=crow.children('td').eq(1).text();
 $('h4').text(regno);
 $('#heading').text(regno);
 $("#heading").css("width", "0%");
 $("#heading").animate({width: "100%"});
 $("#asshead").css("width", "0%");
 $("#asshead").animate({width: "50%"});
 
 
 //Putting the last entry into the local storage
 //localStorage.setItem('file_id',file_id);
 //localStorage.setItem('filename',filename);
 //localStorage.setItem('course_code',course_code);
 //localStorage.setItem('ass_name',ass_name);
 
 crow=$("tr:eq("+rw+")"); //set the current row
 $('#scoremark').val("");
}
 });
 
 
 //handling prev 
 $('body').keyup(function(d){
var code=d.keyCode || d.which;
if(code==37 || code==38)
{
 crowpr=$("tr:eq("+rw+")");
 if($(".mytable tr:eq("+rw+")").is($('.mytable tr:eq(1)'))){
    Swal.fire("no previous record","","info");
    $('#scoremark').val("");
    var num_item=$('.qmarking').length;
    for(var t=0;t<num_item;t++)
    {
        
      $('.qmarking').eq(t).find('.score').val("");  
    }
   }
 else{rw--; crow=$("tr:eq("+rw+")");}
 crowpr.css("background-color","");
 colum=crow.children('td').eq(0);
 file_id=colum.attr('id');
 filename=crow.children('td').eq(1).attr('id');
 crow.css('backgroundColor',"lightblue");
 if($.trim(filename)!="")
 {
 obj.attr("src","/storage/submit/"+$.trim(filename));
 }
 //emptying them
 $('#scoremark').val("");
 var num_item=$('.qmarking').length;
 for(var t=0;t<num_item;t++)
 {
     
   $('.qmarking').eq(t).find('.score').val("");  
 }
 regno=crow.children('td').eq(1).text();
 $('h4').text(regno);
 //$('#heading').text(regno);
 //$("#heading").css("width", "0%");
 //$("#heading").animate({width: "100%"});
 //$("#asshead").css("width", "0%");
 //$("#asshead").animate({width: "50%"});
 
 
 //Putting the last entry into the local storage
 //localStorage.setItem('file_id',file_id);
 //localStorage.setItem('filename',filename);
 //localStorage.setItem('course_code',course_code);
 //localStorage.setItem('ass_name',ass_name);
 
 crow=$("tr:eq("+rw+")"); //set the current row
 //crow.css("background-color","");
 $('#scoremark').val("");
}
 });
 //row clicking handler
 $('tr').click(function(){
 crow.css("background-color",""); //the current record is cleared
 rw=$('tr').index($(this));
 file_id=$(this).children('td').eq(0).attr('id');
 filename=$(this).children('td').eq(1).attr('id');
 regno=$(this).children('td').eq(1).text();
 crow=$("tr:eq("+rw+")");
 //updating UI
 obj.attr("src","/storage/submit/"+$.trim(filename));

 //$('h4').text(regno);
 //$('#heading').text(regno);
 //$("#heading").css("width", "0%");
 //$("#heading").animate({width: "100%"});
 //$("#asshead").css("width", "0%");
 //$("#asshead").animate({width: "50%"});
 
 //showing the clicked record
 crow.css('backgroundColor',"lightblue");
 
 $('#scoremark').val("");
 
 
 
 
 })
 
 
 
 
  
 
 
 
 
 //handling questions marking
 
 
    
    $('.qmarking').on('keyup','input',function(){

    var currentscore=!isNaN(parseFloat($(this).val()))?parseFloat($(this).val()):"";
    var maxscore=parseFloat($(this).parent().find('.maxscore').val());
    if(currentscore<=maxscore)
    {
    var num_item=$('.qmarking').length;

    
    //var max=$('#maxima input').length;
    var total_marks=0;
    for(var t=0;t<num_item;t++)
    {
     var qm=0;
     
       
    if(isNaN(parseFloat($('.qmarking').eq(t).find('.score').val()))){qm=0;}
    else{ qm=parseFloat($('.qmarking').eq(t).find('.score').val());}
    total_marks=total_marks+qm;   
    }
    if(isNaN(total_marks)){total_marks=parseFloat(total_marks);}
    $('#scoremark').val(total_marks);
    maxima=total_marks;
   }
   else
   {
      Swal.fire("","exceeding the max question scoring","error");
      $(this).val("");
   }
   })
    
   $('#scoremark').blur(function(){
 
    if(parseFloat($('#scoremark').val())!=maxima || isNaN(parseFloat($('#scoremark').val()))==false)
    {
        //alert(isNaN(parseFloat($('#scoremark').val())));
        Swal.fire("","the total score must be equal to the total of questions scores","error");
        if(maxima>0){$('#scoremark').val(maxima);}else{$('#scoremark').val("");}
    }
     
 
 
 
 
   });
 

 });