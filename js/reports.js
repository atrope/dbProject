$(document).ready(function() {

    $(".wrapper").on("click", ".btn-success", function(e) {
        e.preventDefault();
        $.post("../defaults/getJSON.php", {
            "type": "budgetNextMonth"
        }, function(data) {
            parsed = $.parseJSON(data);
            $('.results').html("<h1>Budget for all active milestones </h1>" + tableFromJSON(parsed));
        });
    });
    $(".wrapper").on("click", ".btn-info", function(e) {
        e.preventDefault();
        $.post("../defaults/getJSON.php", {
            "type": "busyEngineer"
        }, function(data) {
            parsed = $.parseJSON(data);
            $('.results').html("<h1>Engineers that works in all active projects</h1>" + tableFromJSON(parsed));
        });
    });
    $(".wrapper").on("click", ".btn-primary", function(e) {
        e.preventDefault();

        swal({
            title: 'Select Option',
            input: 'select',
            inputOptions: {
                '0': '3 Worts',
                '1': '3 Best'
            },
            inputClass: "form-control",
            inputPlaceholder: 'Select Type',
            showCancelButton: true,
            inputValidator: function(value) {
                return new Promise(function(resolve, reject) {
                    if (!isNaN(value)) resolve();
                })
            }
        }).then(function(result) {
            if (result.hasOwnProperty('value'))
                $.post("../defaults/getJSON.php", {
                    "type": "getAVGgrades",
                    "fun": result.value
                }, function(data) {
                    parsed = $.parseJSON(data);
                    if (result.value)
                        $('.results').html("<h1>Projects most fun</h1>" + tableFromJSON(parsed, false));
                    else
                        $('.results').html("<h1>Projects least fun</h1>" + tableFromJSON(parsed, false));
                });
        });




    });




    $(".wrapper").on("click", ".btn-dark", function(e) {
        e.preventDefault();
        $.post("../defaults/getJSON.php", {
            "type": "getAvailableProjects",
            "engineer": 0,
            "available": 1
        }, function(data) {
            try {
                parsing = $.parseJSON(data);
                if (parsing.length) {
                    swal({
                        title: 'Choose the Project to list',
                        input: 'select',
                        inputClass: "form-control",
                        type: 'info',
                        inputOptions: dictFromParse(parsing),
                        inputPlaceholder: 'Select Project',
                        showCancelButton: true,
                        inputValidator: function(value) {
                            return new Promise(function(resolve, reject) {
                                if (!isNaN(value)) resolve();
                            })
                        }
                    }).then(function(result) {
                        if (result.hasOwnProperty('value'))
                            $.post("../defaults/getJSON.php", {
                                "type": "getAvailableEngineers",
                                "project": result.value,
                                "group": 1
                            }, function(data) {
                                parsed = $.parseJSON(data);
                                $('.results').html("<h1>Engineers that works in the Project grouped by Spec</h1>" + tableFromJSON(parsed));
                            });
                    });
                } else swal('Error!', 'No Projects Exists.', 'error');
            } catch (e) {
                swal('Error!', 'Error Ocurred in the backend.', 'error');
            }
        });




    });
    $(".wrapper").on("click", ".btn-warning", function(e) {
        e.preventDefault();
        $.post("../defaults/getJSON.php", {
            "type": "getStages",
            "project": 0,
            "available": 1
        }, function(data) {
            try {
                parsing = $.parseJSON(data);
                if (parsing.length) {
                    swal({
                        title: 'Choose the stage to list',
                        input: 'select',
                        inputClass: "form-control",
                        type: 'info',
                        inputOptions: dictFromParse(parsing),
                        inputPlaceholder: 'Select Project',
                        showCancelButton: true,
                        inputValidator: function(value) {
                            return new Promise(function(resolve, reject) {
                                if (!isNaN(value)) resolve();
                            })
                        }
                    }).then(function(result) {
                        if (result.hasOwnProperty('value'))
                            $.post("../defaults/getJSON.php", {
                                "type": "stageTools",
                                "stage": result.value
                            }, function(data) {
                                parsed = $.parseJSON(data);
                                $('.results').html("<h1>Tools used by project by stage</h1>" + tableFromJSON(parsed));
                            });
                    });
                } else swal('Error!', 'No Projects Exists.', 'error');
            } catch (e) {
                swal('Error!', 'Error Ocurred in the backend.', 'error');
            }
        });




    });



    function tableFromJSON(parsed, usd = true) {
        var tblSomething = '<table class="table"><thead> <tr>';
        var keys = Object.keys(parsed[0]);
        $.each(keys, function(idx, obj) {
            tblSomething += '<td>' + obj + '</td>';
        });
        tblSomething += '</thead> <tbody>'
        $.each(parsed, function(idx, obj) {
            tblSomething += '<tr>';
            $.each(obj, function(key, value) {
                if (/[0-9][.]+[0-9]/.test(value) && usd) tblSomething += '<td>' + getUSD(value) + '</td>';
                else tblSomething += '<td>' + value + '</td>';
            });
            tblSomething += '</tr>';
        });
        tblSomething += '</tbody></table>';
        return tblSomething;
    }
});

function dictFromParse(parsing) {
    var dict = {};
    $.each(parsing, function(index, item) {
        dict[item.id] = item.name;
    });
    return dict;
}

function getUSD(price) {
    var formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2,
    });
    return formatter.format(price);
}
