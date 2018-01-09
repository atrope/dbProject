<?php
 include "functions.php";
$type = isset($_REQUEST["type"])?$_REQUEST["type"]:"";

if ($type == "getAvailableEngineers"){
  $pid = isset($_REQUEST["project"])?$_REQUEST["project"]:0;
  $sql = "SELECT * from engineer where id not in (SELECT engineerId from works where projectId = :pid)";
  $val = [":pid" => $pid];
  $result = execSQL($sql,$val,true);
  $output = [];
  foreach ($result as $t) $output[] = $t;
}
if ($type == "getAvailableProjects"){
  $eid = isset($_REQUEST["engineer"])?$_REQUEST["engineer"]:0;
  $sql = "SELECT * from project where id not in (SELECT projectId from works where engineerId = :eid)";
  $val = [":eid" => $eid];
  $result = execSQL($sql,$val,true);
  $output = [];
  if ($result)
  foreach ($result as $t) $output[] = $t;
}

if ($type == "assignEngineerProject"){
  $pid = isset($_REQUEST["project"])?$_REQUEST["project"]:0;
  $eid = isset($_REQUEST["engineer"])?$_REQUEST["engineer"]:0;
  if ($pid && $eid){
    $sql = "INSERT INTO works(engineerId,projectId) values (:eid,:pid)";
    $val = [":pid" => $pid,":eid" => $eid];
    if ($result = execSQL($sql,$val)) $output = ["status"=>200];
    else  $output = ["status"=>300];
  }
}
echo json_encode($output);
