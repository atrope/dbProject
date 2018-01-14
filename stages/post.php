<?php
include "../defaults/functions.php";
$type = $_POST['type'];
$output = ["status"=>400];
if ($type === "new" || $type === "edit"){
  $id = $_POST['id'];
  $name = $_POST['name'];
  $spec = $_POST['specialization'];
  if (strlen($name) >2){
    if($type === "new"){
      $sql = 'INSERT INTO stages( name ) VALUES(:name)';
      $vals = [':name' => $name];
    }
    else{
       $sql = 'UPDATE stages set name=:name where id = :id';
       $vals = [':name' => $name,":id"=>$id];
    }
  if (execSQL($sql,$vals)) $output = ["status"=>200];
    else $output = ["status"=>300];
  }
}
else if ($type === "delete"){
  $id = $_POST['id'];
  if(is_numeric($id)){
    $sql = 'DELETE FROM stages where id = :id';
    $vals = [':id' => $id];
    if (execSQL($sql,$vals)) $output = ["status"=>200];
    else $output = ["status"=>300];
  }
}
echo json_encode($output);
?>
