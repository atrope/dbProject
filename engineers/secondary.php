<?php
/*************************************************************
engineers/secondary.php
**************************************************************/
$eid = isset($_REQUEST["eid"])?$_REQUEST["eid"]:0;
$type = isset($_REQUEST["type"])?$_REQUEST["type"]:0;

include "../defaults/header.php";
$menuItems = [
  (object) ["name"=> "Back","href"=> "../index.php",  "color"=>"danger", "icon"=>"arrow-left","active"=>false],
  (object) ["name"=> "List","href"=> "list.php",  "color"=>"primary", "icon"=>"list","active"=>true],
  (object) ["name"=> "Add","href"=> "adds.php?type=$type&eid=$eid",  "color"=>"info", "icon"=>"plus","active"=>false]];
  if($type) $query = "select id,phone from engineerPhones";
  else $query = "select id,city,street,country,zip from engineerAddress";
  if($eid) $query.= " where engineerId=$eid";
 include "../defaults/list.php";
 include "../defaults/footer.php";
?>
