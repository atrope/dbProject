$(document).ready(function() {
    $(".table").on("click",".btn-delete", function(event) {
      var id = $(this).data("id");
      var parent = $(this).closest("tr");
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
    $(".table").on("click",".btn-edit", function(event) {
      var id = $(this).data("id");
      window.location.href = window.location.href.replace("list.php","add.php?id="+id);
    });
    $(".table").on("click",".btn-milestones", function(event) {
      var id = $(this).data("id");
      window.location.href = window.location.href.replace("projects/list.php","milestones/list.php?pid="+id);
    });

    $(".table").on("click",".btn-engineer", function(event) {
      var id = $(this).data("id");
      $.post("../defaults/getJSON.php",{"type":"getAvailableEngineers","project":id},function(data){
        try {
          parsing = $.parseJSON(data);
          if (parsing.length){
            var s = $('<select/>').addClass("form-control");
            $.each(parsing, function(index, item) {
              s.append($('<option/>').html(item.name).val(item.id));
            });
            swal({title: 'Choose the Engineer to Assign',type: 'info',html: s,showCancelButton: true,confirmButtonText:'<i class="fa fa-thumbs-up"></i>',cancelButtonText:'<i class="fa fa-ban"></i>'}).then((result) => {
            if (result.value) {
              var eid = s.val();
              $.post("../defaults/getJSON.php",{"type":"assignEngineerProject","project":id,"engineer":eid},function(data){
                parsed = $.parseJSON(data);
                  if (parsed.status==200) swal('Assigned!','Engineer Assigned to Project','success');
                  else swal('Error!','Something is not right.','error');
              });
            }
          });
        } else swal('Error!','No Engineers Available.','error');
        }
        catch (e){
          swal('Error!','Error Ocurred in the backend.','error');
        }
        });
    });

    $(".table").on("click",".btn-project", function(event) {
      var id = $(this).data("id");
      $.post("../defaults/getJSON.php",{"type":"getAvailableProjects","engineer":id},function(data){
        try {
          parsing = $.parseJSON(data);
          if (parsing.length){
            var s = $('<select/>').addClass("form-control");
            $.each(parsing, function(index, item) {
              s.append($('<option/>').html(item.name).val(item.id));
            });
            swal({title: 'Choose the Project to Assign',type: 'info',html: s,showCancelButton: true,confirmButtonText:'<i class="fa fa-thumbs-up"></i>',cancelButtonText:'<i class="fa fa-ban"></i>'}).then((result) => {
            if (result.value) {
              var pid = s.val();
              $.post("../defaults/getJSON.php",{"type":"assignEngineerProject","project":pid,"engineer":id},function(data){
                parsed = $.parseJSON(data);
                  if (parsed.status==200) swal('Assigned!','Engineer Assigned to Project','success');
                  else swal('Error!','Something is not right.','error');
              });
            }
          });
        } else swal('Error!','No Projects Available.','error');
        }
        catch (e){
          swal('Error!','Error Ocurred in the backend.','error');
        }
        });
    });
  });
