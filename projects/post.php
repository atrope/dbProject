<?php
/*************************************************************
projects/post.php
**************************************************************/
include "../defaults/functions.php";
$type = $_POST['type'];
$output = ["status"=>400];
if ($type === "new" || $type==="edit"){
  $id = $_POST['id'];
  $name = $_POST['name'];
  $startdate = $_POST['startdate'];
  $description = $_POST['description'];
  if (strlen($name) >2 && strlen($description)>3 && strlen($startdate)>5){
    if ($type=="new"){
      $sql = 'INSERT INTO project( name, startdate,description ) VALUES(:name,:sd,:descr)';
    $vals = [':name' => $name, ':sd' => date('Y-m-d', strtotime(str_replace('-', '/', $startdate))),':descr'=>$description ];
  }else {
    $sql = 'UPDATE project SET name=:name,startdate=:sd,description=:descr where id = :id';
    $vals = [':name' => $name, ':sd' => date('Y-m-d', strtotime(str_replace('-', '/', $startdate))),':descr'=>$description , ':id'=> $id];
  }
    if (execSQL($sql,$vals)) $output = ["status"=>200];
    else $output = ["status"=>300];
  }
}
else if ($type === "delete"){
  $id = $_POST['id'];
  if(is_numeric($id)){
    $sql = 'DELETE FROM project where id = :id';
    $vals = [':id' => $id];
    if (execSQL($sql,$vals)) $output = ["status"=>200];
    else $output = ["status"=>300];
  }
}
echo json_encode($output);
?>
