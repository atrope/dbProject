$(document).ready(function() {
    $("form").on("submit", function(event) {
        event.preventDefault(); 
        var formObj = $(this);
        var formURL = formObj.attr("action");
        formObj.find(".submit").replaceWith(getLoadingIMG());
        $.post(formURL,formObj.serialize(),function(data){
                try {
                    parsing = $.parseJSON(data);
                    if (parsing.status == 200)
                        swal({title: 'Success! :)',type: 'success'})
                        .then((result) => { if (result.value)       window.location.href = window.location.href.split('?')[0].replace("add.php","list.php");
 });
                    else swal("Oops...", "There were errors with your data :)", "error");
                    formObj.find(".loading").replaceWith('<button type="submit" class="btn btn-lg btn-primary submit">Save</button>');
                } catch (e) {
                    swal("Oops...", "There were errors with our backend", "error");
                    formObj.find(".loading").replaceWith('<button type="submit" class="btn btn-lg btn-primary submit">Save</button>');
                }    
            });         
    });

});


function getLoadingIMG(size) {
    return "<img class='loading' src='../img/ajax-loader.gif'/>"
}
