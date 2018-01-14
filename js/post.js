$(document).ready(function() {
    $("form").on("submit", function(event) {
        event.preventDefault(); 
        var formObj = $(this);
        var formURL = formObj.attr("action");
        formObj.find(".submit").replaceWith(getLoadingIMG());
        var serial = formObj.serialize();
        if(window.location.href.indexOf("adds") && getParameterByName("eid",location.href)!=null)
        serial+="&eid="+getParameterByName("eid",location.href);
        $.post(formURL, serial, function(data) {
            try {
                parsing = $.parseJSON(data);
                if (parsing.status == 200)
                    swal({
                        title: 'Success! :)',
                        type: 'success'
                    })
                    .then((result) => {
                        if (result.value) {

                          if(window.location.href.indexOf("adds"))
                          window.location.href = window.location.href.split('?')[0].replace("adds.php", "list.php");
                          else window.location.href = window.location.href.split('?')[0].replace("add.php", "list.php");
                        }
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

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

function getLoadingIMG(size) {
    return "<img class='loading' src='../img/ajax-loader.gif'/>"
}
