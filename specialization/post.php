<?php
include "../defaults/functions.php";
$type = $_POST['type'];
$output = ["status"=>400];
if ($type === "new" || $type === "edit"){
  $id = $_POST['id'];
  $name = $_POST['name'];
  $spec = $_POST['specialization'];
  if (strlen($name) >2 && strlen($spec)>3){
    if($type === "new"){
      $sql = 'INSERT INTO softwareField( name, specialization ) VALUES(:name,:spec)';
      $vals = [':name' => $name, ':spec' => $spec];
    }
    else{
       $sql = 'UPDATE softwareField set name=:name,specialization=:spec where id = :id';
       $vals = [':name' => $name, ':spec' => $spec,":id"=>$id];
    }
  if (execSQL($sql,$vals)) $output = ["status"=>200];
    else $output = ["status"=>300];
  }
}
else if ($type === "delete"){
  $id = $_POST['id'];
  if(is_numeric($id)){
    $sql = 'DELETE FROM softwareField where id = :id';
    $vals = [':id' => $id];
    if (execSQL($sql,$vals)) $output = ["status"=>200];
    else $output = ["status"=>300];
  }
}
else if ($type === "edit"){
  $id = $_POST['id'];
  if(is_numeric($id)){
    $sql = 'DELETE FROM softwareField where id = :id';
    $vals = [':id' => $id];
    if (execSQL($sql,$vals)) $output = ["status"=>200];
    else $output = ["status"=>300];
  }
}
echo json_encode($output);
?>
