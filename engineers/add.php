<?php
/*************************************************************
engineers/add.php
**************************************************************/

$id = isset($_REQUEST["id"])?$_REQUEST["id"]:0;

 isset($_REQUEST["id"])?$_REQUEST["id"]:0;
include "../defaults/header.php";
$menuItems = [
  (object) ["name"=> "Back","href"=> "../index.php",  "color"=>"danger", "icon"=>"arrow-left","active"=>false],
  (object) ["name"=> "List","href"=> "list.php",  "color"=>"primary", "icon"=>"list","active"=>false],
  (object) ["name"=> "Add","href"=> "add.php",  "color"=>"info", "icon"=>"plus","active"=>true]];
    $query = "select e.id,name,birthday,zeut,specialization from engineer e";
    if($id) $query.= " where e.id=$id";
 include "../defaults/add.php";
 include "../defaults/footer.php";
?>
