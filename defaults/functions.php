<?php

function getColumnsfromResult($result){
  $columns=[];
  for ($i = 0; $i < $result->columnCount(); $i++) {
    $col = $result->getColumnMeta($i);
    $columns[] = (object) ["name"=>$col['name'],"type"=>$col['native_type'], "disabled"=>isPrimaryKey($col['flags']),"table"=>$col['table']];
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
function execSQL($query,$values){
  $db = getDB();
  $st = $db->prepare($query);
  if ($st->execute($values)){
    if(stripos($query, "INSERT INTO") !== false) return $db->lastInsertId();
    return true;
  }
  return false;
}
function createTable($query){
  $db = getDB();
  $result = $db->query($query);
  $columns = getColumnsfromResult($result);
  $html= '<table class="table"><thead><tr>';
  foreach ($columns as $col) $html.= "<th>$col->name</th>";
  $html.= "<th>Actions</th></tr></thead><tbody>";
  foreach ($result as $key){
    $recordID=0;
    $html.= "<tr>";
    foreach ($key as $name => $val) {
      if ($name === "id") $recordID=$val;
      $html.= "<td> $val </td>";
    }
    $html.= '<td><button type="button" class="btn btn-info btn-sm btn-edit" data-id="'.$recordID.'">Edit</button> <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="'.$recordID.'">Delete</button></td></tr>';
  }
  $html.= '</tbody></table>';
  return $html;
}
function isPrimaryKey($flags){
  foreach ($flags as $tmp) if ($tmp === "primary_key") return true;
  return false;
}

function createSelect($query,$objeto){
  $html = '<select class="form-control" name="'.$objeto->name.'"><option value="0">Select '.$objeto->name.'</option>';
  $db = getDB();
  $result = $db->query($query);
  foreach ($result as $value) $html.='<option value="'.$value->id.'">'.$value->name.'</option>';
  $html.='</select>';
  return $html;
}
function inputFromType($objeto){
  $html = '<label for="'.$objeto->name.'">'.$objeto->name.'</label>';
  if ($objeto->type === "DATE")
  $html .= '<input class="form-control" id="'.$objeto->name.'" name="'.$objeto->name.'" type="date" value="" required />';
  else if ($objeto->table === "engineer" && $objeto->name === "specialization")
    $html.= createSelect("SELECT * FROM softwareField",$objeto);
  else
    $html .= '<input class="form-control" id="'.$objeto->name.'" name="'.$objeto->name.'" type="text" value=""/>';
    return $objeto->disabled? str_replace("/>","disabled />",$html): $html;
}
function createForm($query,$page){
  $db = getDB();
  $result = $db->query($query);
  $columns = getColumnsfromResult($result);
  $html= '<form class="" action="'.$page.'" method="post"><div class="row">';
  foreach ($columns as $col) $html.= '<div class="form-group col-6">'.inputFromType($col).'</div>';
  $html.= '<div class="col-12 text-center"><button type="submit" class="btn btn-lg btn-primary submit">Save</button></div></div><input type="hidden" name="type" value="new"></form>';
  return $html;
}
