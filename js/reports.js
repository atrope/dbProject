$(document).ready(function() {

  $(".wrapper").on("click", ".btn-success", function(e) {
    e.preventDefault();
    $.post("../defaults/getJSON.php", {"type":"budgetNextMonth"}, function(data) {
        parsed = $.parseJSON(data);
        $('.results').html("<h1>Budget for all active milestones </h1>" + tableFromJSON(parsed));
    });
    });
    $(".wrapper").on("click", ".btn-info", function(e) {
      e.preventDefault();
      $.post("../defaults/getJSON.php", {"type":"busyEngineer"}, function(data) {
          parsed = $.parseJSON(data);
          $('.results').html("<h1>Engineers that works in all active projects</h1>" + tableFromJSON(parsed));
      });
      });



function tableFromJSON(parsed){
  var tblSomething = '<table class="table"><thead> <tr>';
  var keys = Object.keys(parsed[0]);
  $.each(keys, function(idx, obj){
    tblSomething += '<td>' + obj + '</td>';
  });
   tblSomething += '</thead> <tbody>'
  $.each(parsed, function(idx, obj){
    tblSomething += '<tr>';
    $.each(obj, function(key, value){
      if( /[0-9][.]+[0-9]/.test(value)) tblSomething += '<td>' + getUSD(value) + '</td>';
      else tblSomething += '<td>' + value + '</td>';
    });
    tblSomething += '</tr>';
  });
  tblSomething += '</tbody></table>';
  return tblSomething;
}
  });

function getUSD(price){
  var formatter = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'USD',
    minimumFractionDigits: 2,
  });
  return formatter.format(price);
}
