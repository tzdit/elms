$(document).ready(function() {
    //$('#dataTables-ex2').DataTable();
<<<<<<< HEAD
     $("#dataTables-ex2").DataTable();
=======
     $("#dataTables-ex2").DataTable({
    	dom: 'Bfrtip',
         buttons: ['csv','pdf','excel','print']
    });
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd

   
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {

        localStorage.setItem('activeTab', $(e.target).attr('href'));

    });

    var activeTab = localStorage.getItem('activeTab');

    if(activeTab){
  
        $('#tabs a[href="' + activeTab + '"]').tab('show');

    }

   });