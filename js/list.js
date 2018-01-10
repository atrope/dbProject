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
      window.location.href = window.location.href.split('?')[0].replace("list.php","add.php?id="+id);
    });
    $(".table").on("click",".btn-milestones", function(event) {
      var id = $(this).data("id");
      window.location.href = window.location.href.split('?')[0].replace("projects/list.php","milestones/list.php?pid="+id);
    });
    $(".table").on("click", ".btn-engineer", function(event) {
        var id = $(this).data("id");
        $.post("../defaults/getJSON.php",{"type":"getAvailableEngineers","project":id,"available":1}, function(data) {
            try {
                parsing = $.parseJSON(data);
                if (parsing.length) {
                    swal({title: 'Choose the Engineer to Assign',input: 'select',inputClass: "form-control",type: 'info',inputOptions: dictFromParse(parsing),inputPlaceholder: 'Select Engineer',showCancelButton: true,inputValidator: function(value) {
                      return new Promise(function(resolve, reject) {
                        if (!isNaN(value)) resolve();
                      })
                    }
                    }).then(function(result) {
                        if(result.hasOwnProperty('value'))
                        getJSON({"type":"assignEngineerProject","project":id,"engineer":result.value});

                    });
                } else swal('Error!', 'No Engineers Assigned.', 'error');
            } catch (e) {
                swal('Error!', 'Error Ocurred in the backend.', 'error');
            }
        });
      });

    $(".table").on("click", ".btn-project", function(event) {
        var id = $(this).data("id");
        $.post("../defaults/getJSON.php",{"type":"getAvailableProjects","engineer":id,"available":1}, function(data) {
            try {
                parsing = $.parseJSON(data);
                if (parsing.length) {
                    swal({title: 'Choose the Project to Assign',input: 'select',inputClass: "form-control",type: 'info',inputOptions: dictFromParse(parsing),inputPlaceholder: 'Select Project',showCancelButton: true,inputValidator: function(value) {
                      return new Promise(function(resolve, reject) {
                        if (!isNaN(value)) resolve();
                      })
                    }
                    }).then(function(result) {
                        if(result.hasOwnProperty('value'))
                        getJSON({"type":"assignEngineerProject","project":result.value,"engineer":id});

                    });
                } else swal('Error!', 'No Engineers Assigned.', 'error');
            } catch (e) {
                swal('Error!', 'Error Ocurred in the backend.', 'error');
            }
        });
      });




    $(".table").on("click",".btn-mile-done", function(event) {
      var id = $(this).data("id");
      $.post("../defaults/getJSON.php",{"type":"toggleMilestone","mid":id},function(data){
        try {
          parsing = $.parseJSON(data);
          if (parsing.status == 200){
            swal('OK!','Milestone Toggled.','success');
            location.reload();
          }
          else  swal('Error!','Error Ocurred in the backend.','error');
        }
        catch (e){
          swal('Error!','Error Ocurred in the backend.','error');
        }
        });
    });






        $(".table").on("click", ".btn-listprojects", function(event) {
            var id = $(this).data("id");
            $.post("../defaults/getJSON.php",{"type":"getAvailableProjects","engineer":id,"available":0}, function(data) {
                try {
                    parsing = $.parseJSON(data);
                    if (parsing.length) {
                        swal({title: 'Choose the Project to Unassign',input: 'select',inputClass: "form-control",type: 'info',inputOptions: dictFromParse(parsing),inputPlaceholder: 'Select Project',showCancelButton: true,inputValidator: function(value) {
                          return new Promise(function(resolve, reject) {
                            if (!isNaN(value)) resolve();
                          })
                        }
                        }).then(function(result) {
                            if(result.hasOwnProperty('value'))
                            getJSON({"type":"assignEngineerProject","project":result.value,"engineer":id,"remove":1});

                        });
                    } else swal('Error!', 'No Projects Assigned.', 'error');
                } catch (e) {
                    swal('Error!', 'Error Ocurred in the backend.', 'error');
                }
            });
          });






                  $(".table").on("click", ".btn-listengineers", function(event) {
                      var id = $(this).data("id");
                      $.post("../defaults/getJSON.php",{"type":"getAvailableEngineers","project":id,"available":0}, function(data) {
                          try {
                              parsing = $.parseJSON(data);
                              if (parsing.length) {
                                  swal({title: 'Choose the Engineer to Unassign',input: 'select',inputClass: "form-control",type: 'info',inputOptions: dictFromParse(parsing),inputPlaceholder: 'Select Engineer',showCancelButton: true,inputValidator: function(value) {
                                    return new Promise(function(resolve, reject) {
                                      if (!isNaN(value)) resolve();
                                    })
                                  }
                                  }).then(function(result) {
                                      if(result.hasOwnProperty('value'))
                                      getJSON({"type":"assignEngineerProject","engineer":result.value,"project":id,"remove":1});

                                  });
                              } else swal('Error!', 'No Engineers Assigned.', 'error');
                          } catch (e) {
                              swal('Error!', 'Error Ocurred in the backend.', 'error');
                          }
                      });
                    });






                $(".table").on("click", ".btn-tool", function(event) {
                  var id = $(this).data("id");
                  $.post("../defaults/getJSON.php", {"type":"getAvailableTools","project":id,"available":1}, function(data) {
                      try {
                          parsing = $.parseJSON(data);
                          if (parsing.length) {
                              swal({title: 'Choose the Tool to Assign',input: 'select',inputClass: "form-control",type: 'info',inputOptions: dictFromParse(parsing),inputPlaceholder: 'Select Tool',showCancelButton: true,inputValidator: function(value) {
                                return new Promise(function(resolve, reject) {
                                  if (!isNaN(value)) resolve();
                                })
                              }
                              }).then(function(result) {
                                  if(result.hasOwnProperty('value'))
                                  getJSON({"type":"assignToolProject","project":id,"tool":result.value,"remove":0});

                              });
                          } else swal('Error!', 'No Tools Available.', 'error');
                      } catch (e) {
                          swal('Error!', 'Error Ocurred in the backend.', 'error');
                      }
                  });
                });


            $(".table").on("click", ".btn-listtools", function(event) {
              var id = $(this).data("id");
              $.post("../defaults/getJSON.php", {"type":"getAvailableTools","project":id,"available":0}, function(data) {
                  try {
                      parsing = $.parseJSON(data);
                      if (parsing.length) {
                          swal({title: 'Choose the Tool to Unassign',input: 'select',inputClass: "form-control",type: 'info',inputOptions: dictFromParse(parsing),inputPlaceholder: 'Select Tool',showCancelButton: true,inputValidator: function(value) {
                            return new Promise(function(resolve, reject) {
                              if (!isNaN(value)) resolve();
                            })
                          }
                          }).then(function(result) {
                              if(result.hasOwnProperty('value'))
                              getJSON({"type":"assignToolProject","tool":result.value,"project":id,"remove":1});

                          });
                      } else swal('Error!', 'No Tools Assigned.', 'error');
                  } catch (e) {
                      swal('Error!', 'Error Ocurred in the backend.', 'error');
                  }
              });
            });




        $(".table").on("click", ".btn-tproject", function(event) {
          var id = $(this).data("id");
          $.post("../defaults/getJSON.php", {"type":"getAvailableToolsProjects","tool":id,"available":1}, function(data) {
              try {
                  parsing = $.parseJSON(data);
                  if (parsing.length) {
                      swal({title: 'Choose the Project to Assign',input: 'select',inputClass: "form-control",type: 'info',inputOptions: dictFromParse(parsing),inputPlaceholder: 'Select Project',showCancelButton: true,inputValidator: function(value) {
                        return new Promise(function(resolve, reject) {
                          if (!isNaN(value)) resolve();
                        })
                      }
                      }).then(function(result) {
                          if(result.hasOwnProperty('value'))
                          getJSON({"type": "assignToolProject","project": result.value,"tool": id,"remove": 0});

                      });
                  } else swal('Error!', 'No Projects Assigned.', 'error');
              } catch (e) {
                  swal('Error!', 'Error Ocurred in the backend.', 'error');
              }
          });
        });

        $(".table").on("click", ".btn-listtprojects", function(event) {
          var id = $(this).data("id");
          $.post("../defaults/getJSON.php", {"type":"getAvailableToolsProjects","tool":id,"available":0}, function(data) {
              try {
                  parsing = $.parseJSON(data);
                  console.log(parsing);
                  if (parsing.length) {
                      swal({title: 'Choose the Project to Unassign',input: 'select',inputClass: "form-control",type: 'info',inputOptions: dictFromParse(parsing),inputPlaceholder: 'Select Project',showCancelButton: true,inputValidator: function(value) {
                        return new Promise(function(resolve, reject) {
                          if (!isNaN(value)) resolve();
                        })
                      }
                      }).then(function(result) {
                        if(result.hasOwnProperty('value'))
                          getJSON({"type": "assignToolProject","project": result.value,"tool": id,"remove": 1});
                      });
                  } else swal('Error!', 'No Projects Assigned.', 'error');
              } catch (e) {
                  swal('Error!', 'Error Ocurred in the backend.', 'error');
              }
          });
        });

        $(".table").on("click", ".btn-stage", function(event) {
          var id = $(this).data("id");
          $.post("../defaults/getJSON.php", {"type":"getStages","project":id,"available":1}, function(data) {
              try {
                  parsing = $.parseJSON(data);
                  console.log(parsing);
                  if (parsing.length) {
                      swal({title: 'Choose the new stage',input: 'select',inputClass: "form-control",type: 'info',inputOptions: dictFromParse(parsing),inputPlaceholder: 'Select Stage',showCancelButton: true,inputValidator: function(value) {
                        return new Promise(function(resolve, reject) {
                          if (!isNaN(value)) resolve();
                        })
                      }
                      }).then(function(result) {
                        if(result.hasOwnProperty('value'))
                          getJSON({"type": "assignStageProject","stage": result.value,"project": id});
                          location.reload();
                      });
                  } else swal('Error!', 'No stages available.', 'error');
              } catch (e) {
                  swal('Error!', 'Error Ocurred in the backend.', 'error');
              }
          });
        });





  });



  function getJSON(options){
    $.post("../defaults/getJSON.php", options, function(data) {
        parsed = $.parseJSON(data);
        if (parsed.status == 200) swal('Success!', '','success');
        else swal('Error!', 'Something is not right.', 'error');
    });
  }
  function dictFromParse(parsing){
    var dict = {};
    $.each(parsing, function(index, item) {
      dict[item.id] = item.name;
    });
    return dict;
  }
