$(document).ready(function() {
    $(".table").on("click",".btn-delete", function(event) {
      var id = $(this).data("id");
      var parent = $(this).closest("tr");
      console.log(parent);
      swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: true,
      }).then((result) => {
        if (result.value) {
        swal.showLoading();
      $.post("post.php",{"type":"delete","id":id},function(data){
        parsing = $.parseJSON(data);
        if (parsing.status == 200){
          parent.remove();
          swal('Deleted!','Your file has been deleted.','success');
        }
        else  swal('Error!','Error Ocurred in the backend.','error');
      });
      } else if (result.dismiss === 'cancel') swal('Cancelled','Your imaginary file is safe :)','error');

      })









    });
  });
