<?php
/*************************************************************
milestones/list.php
**************************************************************/
$pid = isset($_REQUEST["pid"])?$_REQUEST["pid"]:0;

include "../defaults/header.php";
$menuItems = [
  (object) ["name"=> "Back","href"=> "../index.php",  "color"=>"danger", "icon"=>"arrow-left","active"=>false],
  (object) ["name"=> "List","href"=> "list.php",  "color"=>"primary", "icon"=>"list","active"=>true],
  (object) ["name"=> "Add","href"=> "add.php",  "color"=>"info", "icon"=>"plus","active"=>false]];
  $query = "select m.id,m.name,m.startdate,m.enddate,m.moneysum,m.description,p.name as project,IF( m.done =0,'In Progress','Done') AS status from milestone m INNER JOIN project p on m.projectId = p.id ";
  if($pid) $query.= " where projectId=$pid";
  $query.= "  ORDER BY m.id ASC";

include "../defaults/list.php";
include "../defaults/footer.php";

?>
