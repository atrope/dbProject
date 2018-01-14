<?php
/*************************************************************
stages/list.php
**************************************************************/
include "../defaults/header.php";
$menuItems = [
  (object) ["name"=> "Back","href"=> "../index.php",  "color"=>"danger", "icon"=>"arrow-left","active"=>false],
  (object) ["name"=> "List","href"=> "list.php",  "color"=>"primary", "icon"=>"list","active"=>true],
  (object) ["name"=> "Add","href"=> "add.php",  "color"=>"info", "icon"=>"plus","active"=>false]];
  $query = "select * from stages  ORDER BY id ASC";
include "../defaults/list.php";
include "../defaults/footer.php";

?>
