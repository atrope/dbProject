<?php
/*************************************************************
projects/list.php
**************************************************************/
include "../defaults/header.php";
$menuItems = [
  (object) ["name"=> "Back","href"=> "../index.php",  "color"=>"danger", "icon"=>"arrow-left","active"=>false],
  (object) ["name"=> "List","href"=> "list.php",  "color"=>"primary", "icon"=>"list","active"=>true],
  (object) ["name"=> "Add","href"=> "add.php",  "color"=>"info", "icon"=>"plus","active"=>false]];
  $query = "select p.id,p.name,p.startdate,p.description,s.name as stage from project p  INNER JOIN stages s on p.stage = s.id  ORDER BY p.id ASC";
include "../defaults/list.php";
include "../defaults/footer.php";

?>
