<?php
 include "functions.php";
$type = isset($_REQUEST["type"])?$_REQUEST["type"]:"";

if ($type == "getAvailableEngineers"){
  $pid = isset($_REQUEST["project"])?$_REQUEST["project"]:0;
  $group = isset($_REQUEST["group"])?$_REQUEST["group"]:0;
  $available = isset($_REQUEST["available"])?$_REQUEST["available"]:0;
  if ($available) $sql = "SELECT * from engineer where id not in (SELECT engineerId from works where projectId = :pid)";
  else $sql = "SELECT * from engineer where id in (SELECT engineerId from works where projectId = :pid)";
  if($group) $sql = "SELECT e.id,e.name,e.birthday,e.zeut,s.specialization from engineer e inner join softwareField s on e.specialization = s.id  where e.id in (SELECT engineerId from works where projectId = :pid) order by e.specialization;";
  $val = [":pid" => $pid];
  $result = execSQL($sql,$val,true);
  $output = [];
  foreach ($result as $t) $output[] = $t;
}
else if ($type == "getAvailableProjects"){
  $eid = isset($_REQUEST["engineer"])?$_REQUEST["engineer"]:0;
  $available = isset($_REQUEST["available"])?$_REQUEST["available"]:0;
  if ($available) $sql = "SELECT * from project where id not in (SELECT projectId from works where engineerId = :eid)";
  else $sql = "SELECT * from project where id in (SELECT projectId from works where engineerId = :eid)";

  $val = [":eid" => $eid];
  $result = execSQL($sql,$val,true);
  $output = [];
  if ($result)
  foreach ($result as $t) $output[] = $t;
}
else if ($type == "getAvailableToolsProjects"){
  $tid = isset($_REQUEST["tool"])?$_REQUEST["tool"]:0;
  $available = isset($_REQUEST["available"])?$_REQUEST["available"]:0;
  if ($available) $sql = "SELECT * from project where id not in (SELECT p.id from project p LEFT JOIN toolsProjects tp on p.id = tp.projectId and p.stage = tp.stageId where toolsId = :tid)";
  else $sql = "SELECT p.id,p.name from project p INNER JOIN toolsProjects tp on p.id = tp.projectId and p.stage = tp.stageId where toolsId = :tid;";

  $val = [":tid" => $tid];
  $result = execSQL($sql,$val,true);
  $output = [];
  if ($result)
  foreach ($result as $t) $output[] = $t;
}
else if ($type == "getAvailableTools"){
  $pid = isset($_REQUEST["project"])?$_REQUEST["project"]:0;
  $available = isset($_REQUEST["available"])?$_REQUEST["available"]:0;
  if ($available) $sql = "SELECT * from tools where id not in (SELECT toolsId from toolsProjects where projectId = :pid and stageId = (SELECT stage from project where id =:pid))";
  else $sql = "SELECT * from tools where id in (SELECT toolsId from toolsProjects where projectId = :pid and stageId = (SELECT stage from project where id =:pid))";
  $val = [":pid" => $pid];
  $result = execSQL($sql,$val,true);
  $output = [];
  if ($result)
  foreach ($result as $t) $output[] = $t;
}
else if ($type == "assignEngineerProject"){
  $pid = isset($_REQUEST["project"])?$_REQUEST["project"]:0;
  $eid = isset($_REQUEST["engineer"])?$_REQUEST["engineer"]:0;
  $remove = isset($_REQUEST["remove"])?$_REQUEST["remove"]:0;
  if ($pid && $eid){
    if ($remove) $sql = "DELETE FROM works where engineerId=:eid and projectId=:pid";
    else $sql = "INSERT INTO works(engineerId,projectId) values (:eid,:pid)";
    $val = [":pid" => $pid,":eid" => $eid];
    if ($result = execSQL($sql,$val)) $output = ["status"=>200];
    else  $output = ["status"=>300];
  }
}
else if ($type == "assignToolProject"){
  $pid = isset($_REQUEST["project"])?$_REQUEST["project"]:0;
  $tid = isset($_REQUEST["tool"])?$_REQUEST["tool"]:0;
  $remove = isset($_REQUEST["remove"])?$_REQUEST["remove"]:0;
  if ($pid && $tid){
    if ($remove) $sql = "DELETE FROM toolsProjects where toolsId=:tid and projectId=:pid and stageId = (SELECT stage from project where id=:pid)";
    else $sql = "INSERT INTO toolsProjects(toolsId,projectId,stageId) SELECT :tid,id,stage from project where id=:pid";
    $val = [":pid" => $pid,":tid" => $tid];
    if ($result = execSQL($sql,$val)) $output = ["status"=>200];
    else  $output = ["status"=>300];
  }
}
else if ($type == "getStages"){
  $pid = isset($_REQUEST["project"])?$_REQUEST["project"]:0;
  $available = isset($_REQUEST["available"])?$_REQUEST["available"]:0;
  if ($available) $sql = "SELECT * from stages where id not in (SELECT stage from project where id = :pid)";
  else $sql = "SELECT * from stages where id in (SELECT stage from project where id = :pid)";;
  $val = [":pid" => $pid];
  $result = execSQL($sql,$val,true);
  $output = [];
  if ($result)
  foreach ($result as $t) $output[] = $t;
}
else if ($type == "assignStageProject"){
  $pid = isset($_REQUEST["project"])?$_REQUEST["project"]:0;
  $sid = isset($_REQUEST["stage"])?$_REQUEST["stage"]:0;
  if ($pid && $sid){
    $sql = "UPDATE project set stage = :sid where id = :pid";
    $val = [":pid" => $pid,":sid" => $sid];
    if ($result = execSQL($sql,$val)) $output = ["status"=>200];
    else  $output = ["status"=>300];
  }
}

else if ($type == "toggleMilestone"){
  $mid = isset($_REQUEST["mid"])?$_REQUEST["mid"]:0;
  if ($mid){
    $sql = "UPDATE milestone SET done = 1 - done where id = :mid";
    $val = [":mid" => $mid];
    if ($result = execSQL($sql,$val)) $output = ["status"=>200];
    else  $output = ["status"=>300];
  }
}
else if ($type == "budgetNextMonth"){
    $sql = "select m.name as Milestone, p.name as Project,m.moneysum as Budget from milestone m INNER JOIN project p on m.projectId = p.id  where m.startdate <= date(NOW()) and m.enddate >= date(NOW()) order by Budget DESC";
    $result = execSQL($sql,[],true);
    $output = [];
    if ($result)
    foreach ($result as $t) $output[] = $t;
}
else if ($type == "busyEngineer"){
    $sql = "select id,name,birthday,zeut from engineer where id in (select engineerId from works group by engineerId having count(*) >= (select count(*) from project where startdate<=NOW()));";
    $result = execSQL($sql,[],true);
    $output = [];
    if ($result)
    foreach ($result as $t) $output[] = $t;
}
else if ($type == "stageTools"){
    $id = isset($_REQUEST["stage"])?$_REQUEST["stage"]:0;
    if($id){
    $sql = "select p.name as project,p.startdate,t.name as tool,s.name as stage from project p INNER JOIN toolsProjects tp on p.id = tp.projectId INNER JOIN stages s on tp.stageId = s.id INNER JOIN tools t on t.id = tp.toolsId where tp.stageId = :id;";
    $val = [":id" => $id];

    $result = execSQL($sql,$val,true);
  }
    $output = [];
    if ($result)
    foreach ($result as $t) $output[] = $t;
}








echo json_encode($output);
