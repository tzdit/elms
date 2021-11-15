

$(function(){

  //click event of the add carry button
 $('#modal_button').click(function(){
   $('#modal').modal('show')
              .find('#modal_content')
              .load($(this).attr('value'));
 });
});

$(function(){

//click event to view announcent
$('#modal_button2').click(function(){
  $('#modal2').modal('show')
             .find('#modal_content2')
             .load($(this).attr('value'));
});
});



$(function(){

  $('#document-file').change(ev => {

    $(ev.target).closest('form').trigger('submit');
  })
});


/**
 * sweet alert for delete carry
 */

$(document).on('click', '.btn-delete', function(){
 
  var carry_id = $(this).attr('carry_id');

  Swal.fire({
title: '<small>Are you sure?</small>',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Delete'
}).then((result) => {
if (result.isConfirmed) {

$.ajax({
  url: '/student/delete_carry' ,
  method:'post',
  async:true,
  cache: false,
  dataType:'JSON',
  data:{carry_id:carry_id},
  success:function(data){
    if(data.message){
      Swal.fire(
          'Deleted!',
          data.message,
          'success'
)
setTimeout(function(){
  window.location.reload();
},20);


    }
  }
})

}
})

});



//submit by drug file
 const dragFile = document.querySelector('#drag-over');

  dragFile.addEventListener('dragover',)




