<?php
/*************************************************************
milestones/post.php
**************************************************************/
include "../defaults/functions.php";
$type = $_POST['type'];
$output = ["status"=>400];
if ($type === "new" || $type==="edit"){
  $id = $_POST['id'];
  $name = $_POST['name'];
  $startdate = $_POST['startdate'];
  $enddate = $_POST['enddate'];
  $moneysum = $_POST['moneysum'];
  $projectId = $_POST['projectId'];
  $description = $_POST['description'];
  if (strlen($name) >2 && strlen($moneysum)>3 && $projectId>0){
    if ($type=="new"){
      $sql = 'INSERT INTO milestone( name, startdate, enddate,moneysum,projectId,description) VALUES(:name,:sd,:ed,:ms,:pid,:ds)';
    $vals = [':name' => $name, ':sd' => date('Y-m-d', strtotime(str_replace('-', '/', $startdate))),':ed' => date('Y-m-d', strtotime(str_replace('-', '/', $enddate))),':ms'=>$moneysum,':pid'=>$projectId,':ds'=>$description ];
  }else {
    $sql = 'UPDATE milestone SET name=:name, startdate=:sd, enddate=:ed,moneysum=:ms,projectId=:pid,description=:ds where id = :id';
    $vals = [':name' => $name, ':sd' => date('Y-m-d', strtotime(str_replace('-', '/', $startdate))),':ed' => date('Y-m-d', strtotime(str_replace('-', '/', $enddate))),':ms'=>$moneysum,':pid'=>$projectId,':ds'=>$description, ':id'=> $id ];
  }
    if (execSQL($sql,$vals)) $output = ["status"=>200];
    else $output = ["status"=>300];
  }
}
else if ($type === "delete"){
  $id = $_POST['id'];
  if(is_numeric($id)){
    $sql = 'DELETE FROM milestone where id = :id';
    $vals = [':id' => $id];
    if (execSQL($sql,$vals)) $output = ["status"=>200];
    else $output = ["status"=>300];
  }
}
echo json_encode($output);
?>
