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
  $db->exec("SET CHARACTER SET utf8");

  return $db;
}
function execSQL($query,$values,$return=false){
  $db = getDB();
  $st = $db->prepare($query);
  if ($st->execute($values)){
    if($return) return $st;
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

    $html.= '<td>';
    if(stripos($query, "from project") !== false){
      $html.= '<button type="button" class="btn btn-dark btn-sm btn-milestones mr-1" data-id="'.$recordID.'">Milestones</button>';
        $html.= '<button type="button" class="btn btn-primary btn-sm btn-engineer mr-1" data-id="'.$recordID.'">+ Engineer</button>';
        $html.= '<button type="button" class="btn btn-success btn-sm btn-listengineers mr-1" data-id="'.$recordID.'">List Engineers</button>';
        $html.= '<button type="button" class="btn btn-default btn-sm btn-tool mr-1" data-id="'.$recordID.'">+ Tool</button>';
        $html.= '<button type="button" class="btn btn-secondary btn-sm btn-listtools mr-1" data-id="'.$recordID.'">List Tools</button>';
        $html.= '<button type="button" class="btn btn-warning btn-sm btn-stage mr-1" data-id="'.$recordID.'">Change Stage</button>';
    }
    if(stripos($query, "from tool") !== false){
      $html.= '<button type="button" class="btn btn-primary btn-sm btn-tproject mr-1" data-id="'.$recordID.'">Assign Project</button>';
      $html.= '<button type="button" class="btn btn-success btn-sm btn-listtprojects mr-1" data-id="'.$recordID.'">Assigned Projects</button>';

    }
    else if(stripos($query, "from engineer ") !== false){
      $html.= '<button type="button" class="btn btn-secondary btn-sm btn-other mr-1" data-id="'.$recordID.'">Secondary Info</button>';
      $html.= '<button type="button" class="btn btn-dark btn-sm btn-grade mr-1" data-id="'.$recordID.'">Grade</button>';
      $html.= '<button type="button" class="btn btn-primary btn-sm btn-project mr-1" data-id="'.$recordID.'">+Project</button>';
      $html.= '<button type="button" class="btn btn-success btn-sm btn-listprojects mr-1" data-id="'.$recordID.'">Projects</button>';
    }
    else if(stripos($query, "from milestone") !== false){
      $html.= '<button type="button" class="btn btn-dark btn-sm btn-mile-done mr-1" data-id="'.$recordID.'">Toggle Milestone</button>';
    }
    $html.= '<button type="button" class="btn btn-info btn-sm btn-edit mr-1" data-id="'.$recordID.'">Edit</button><button type="button" class="btn btn-danger btn-sm btn-delete mr-1" data-id="'.$recordID.'">Delete</button></td></tr>';
  }
  $html.= '</tbody></table>';
  return $html;
}
function isPrimaryKey($flags){
  foreach ($flags as $tmp) if ($tmp === "primary_key") return true;
  return false;
}

function createSelect($query,$objeto,$selected=0){
  $html = '<select class="form-control" name="'.$objeto->name.'"><option value="0">Select '.$objeto->name.'</option>';
  $db = getDB();
  $result = $db->query($query);
  foreach ($result as $value){

    if ($value->id == $selected) $s = " selected";
    else $s="";
    $html.='<option value="'.$value->id.'"'.$s.'>'.$value->name.'</option>';
  }
  $html.='</select>';
  return $html;
}
function inputFromType($objeto,$result){
  $html = '<label for="'.$objeto->name.'">'.$objeto->name.'</label>';
  $value = is_null($result)?"":$result[$objeto->name];
  if ($objeto->type === "DATE")
  $html .= '<input class="form-control" id="'.$objeto->name.'" name="'.$objeto->name.'" type="date" value="'.$value.'" required />';
  else if ($objeto->table === "e" && $objeto->name === "specialization")
    $html.= createSelect("SELECT * FROM softwareField",$objeto,$value);
  else if ($objeto->table === "project" && $objeto->name === "stage")
      $html.= createSelect("SELECT * FROM stages",$objeto,$value);
  else if ($objeto->table === "milestone" && $objeto->name === "projectId")
      $html.= createSelect("SELECT * FROM project",$objeto,$value);
  else
    $html .= '<input class="form-control" id="'.$objeto->name.'" name="'.$objeto->name.'" type="text" value="'.$value.'"/>';
    return $objeto->disabled? str_replace("/>","readonly />",$html): $html;
}
function createForm($query,$page,$edit=false){
  $db = getDB();

  $result = $db->query($query);
  $val = $edit?"edit":"new";
  $columns = getColumnsfromResult($result);
  if(!$edit) $result = null;
  else $result = $result->fetch(PDO::FETCH_ASSOC);
  $html= '<form class="" action="'.$page.'" method="post"><div class="row">';
  foreach ($columns as $col) $html.= '<div class="form-group col-6">'.inputFromType($col,$result).'</div>';
  $html.= '<div class="col-12 text-center"><button type="submit" class="btn btn-lg btn-primary submit">Save</button></div></div><input type="hidden" name="type" value="'.$val.'"></form>';
  return $html;
}
