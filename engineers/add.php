<?php
include "../defaults/header.php";
$menuItems = [
  (object) ["name"=> "Back","href"=> "../index.php",  "color"=>"danger", "icon"=>"arrow-left","active"=>false],
  (object) ["name"=> "List","href"=> "list.php",  "color"=>"primary", "icon"=>"list","active"=>false],
  (object) ["name"=> "Add","href"=> "add.php",  "color"=>"info", "icon"=>"plus","active"=>true]];
$query = "select engineer.id,name,birthday,zeut,specialization,phone,street,zip,city,country from engineer INNER JOIN engineerPhones ep on engineer.id = ep.engineerId INNER JOIN engineerAddress ea on engineer.id = ea.engineerId";
 include "../defaults/add.php";
 include "../defaults/footer.php";
?>
