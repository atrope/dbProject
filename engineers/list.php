<?php

include "../defaults/header.php";
$menuItems = [
  (object) ["name"=> "Back","href"=> "../index.php",  "color"=>"danger", "icon"=>"arrow-left","active"=>false],
  (object) ["name"=> "List","href"=> "list.php",  "color"=>"primary", "icon"=>"list","active"=>true],
  (object) ["name"=> "Add","href"=> "add.php",  "color"=>"info", "icon"=>"plus","active"=>false]];
//  $query = "select e.id,e.name,birthday,zeut,IFNULL(s.name, '-') as spec,phone,street,zip,city,country from engineer e INNER JOIN engineerPhones ep on e.id = ep.engineerId INNER JOIN engineerAddress ea on e.id = ea.engineerId LEFT JOIN softwareField s on e.specialization = s.id ORDER BY e.id ASC;";
  $query = "select e.id,e.name,birthday,zeut,IFNULL(s.name, '-') as spec from engineer e LEFT JOIN softwareField s on e.specialization = s.id ORDER BY e.id ASC;";
 include "../defaults/list.php";
 include "../defaults/footer.php";
?>
