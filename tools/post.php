<?php
/*************************************************************
tools/post.php
**************************************************************/
include "../defaults/functions.php";
$type = $_POST['type'];
$output = ["status"=>400];
if ($type === "new" || $type === "edit"){
  $id = $_POST['id'];
  $name = $_POST['name'];
  if (strlen($name) >2){
    if($type === "new"){
      $sql = 'INSERT INTO tools( name ) VALUES(:name)';
      $vals = [':name' => $name];
    }
    else{
       $sql = 'UPDATE tools set name=:name where id = :id';
       $vals = [':name' => $name,":id"=>$id];
    }
  if (execSQL($sql,$vals)) $output = ["status"=>200];
    else $output = ["status"=>300];
  }
}
else if ($type === "delete"){
  $id = $_POST['id'];
  if(is_numeric($id)){
    $sql = 'DELETE FROM tools where id = :id';
    $vals = [':id' => $id];
    if (execSQL($sql,$vals)) $output = ["status"=>200];
    else $output = ["status"=>300];
  }
}
echo json_encode($output);
?>
