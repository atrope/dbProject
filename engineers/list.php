<?php
include "../defaults/header.php";
$menuItems = [
  (object) ["name"=> "Back","href"=> "../index.php",  "color"=>"danger", "icon"=>"arrow-left","active"=>false],
  (object) ["name"=> "List","href"=> "list.php",  "color"=>"primary", "icon"=>"list","active"=>true],
  (object) ["name"=> "Add","href"=> "add.php",  "color"=>"info", "icon"=>"plus","active"=>false]];
  $query = "select e.id,name,birthday,zeut,specialization,phone,street,zip,city,country from engineer e INNER JOIN engineerPhones ep on e.id = ep.engineerId INNER JOIN engineerAddress ea on e.id = ea.engineerId";
 include "../defaults/list.php";
 include "../defaults/footer.php";
?>
