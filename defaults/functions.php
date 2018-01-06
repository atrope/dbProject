<?php

function getColumnsfromResult($result){
  $columns=[];
  for ($i = 0; $i < $result->columnCount(); $i++) {
    $col = $result->getColumnMeta($i);
    $columns[] = $col['name'];
  }
  return $columns;
}
function getDB(){
  $user     = "root";
  $password = "123456";
  $dsn      = 'mysql:host=localhost;dbname=softwareCompany';
  $db       = new PDO($dsn, $user, $password);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
  return $db;
}
function createTable($query){
  $db = getDB();
  $result = $db->query($query);
  $columns = getColumnsfromResult($result);
  $html= '<table class="table"><thead><tr>';
  foreach ($columns as $col) $html.= "<th>$col</th>";
  $html.= "<th>Actions</th></tr></thead><tbody>";
  foreach ($result as $key){
    $html.= "<tr>";
    foreach ($key as $val) $html.= "<td> $val </td>";
    $html.= '<td><button type="button" class="btn btn-info btn-sm">Edit</button> <button type="button" class="btn btn-danger btn-sm">Delete</button></td></tr>';
  }
  $html.= '</tbody></table>';
  return $html;
}
function createForm($query,$page){
  $db = getDB();
  $result = $db->query($query);
  $columns = getColumnsfromResult($result);
  $html= '<form class="" action="'.$page.'" method="post"><div class="row">';
  foreach ($columns as $col) $html.= '<div class="form-group col-6"><label for="'.$col.'">'.$col.'</label><input class="form-control" id="'.$col.'" name="'.$col.'" value=""></div>';
  $html.= '<div class="col-12 text-center"><button type="submit" class="btn btn-lg btn-primary">Save</button></div></div></form>';
  return $html;
}
