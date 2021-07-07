$(function(){

  //click event of the add carry button
 $('#modal_button').click(function(){
   $('#modal').modal('show')
              .find('#modal_content')
              .load($(this).attr('value'));
 });
});

$(function(){
  $('#document-file').change(ev => {
    $(ev.target).closest('form').trigger('submit');
  })
});
