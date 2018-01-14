<?php
include "../defaults/functions.php";
$type = $_POST['type'];
$id = $_POST['id'];
$output = ["status"=>400];
if ($type === "new" || $type === "edit"){
  $typeobj = isset($_POST['phone'])?1:0;
  if($typeobj) $phone = $_POST['phone'];
else {
  $street = $_POST['street'];
  $zip = $_POST['zip'];
  $city = $_POST['city'];
  $country = $_POST['country'];
}
if (($typeobj && strlen($phone)>3) || (!$typeobj &&  strlen($street)>3 &&  strlen($street)>3 &&  strlen($zip)>3 &&  strlen($city)>3 &&  strlen($country)>3) ) {
    $output = ["status"=>300];
    if($type ==="new") {
      $eid = $_POST['eid'];

    if($typeobj){
      $sql = 'INSERT INTO engineerPhones(phone,engineerId) VALUES(:phone,:eid)';
      $vals = [':phone' => $phone, ':eid' => $eid];
    }
    else{
      $sql = 'INSERT INTO engineerAddress(city,street,country,zip,engineerId) VALUES(:city,:st,:country,:zip,:eid)';
      $vals = [':city' => $city,':st' => $street,':country' => $country, ':zip' => $zip,':eid' => $eid];
    }
  }
    else {
      if($typeobj){
      $sql = 'UPDATE engineerPhones SET phone=:phone where id=:id';
      $vals = [':phone' => $phone, ':id' => $id];
      }
      else{
        $sql = 'UPDATE engineerAddress SET city=:city,street=:st,country=:country,zip=:zip WHERE id=:id';
        $vals = [':city' => $city,':st' => $street,':country' => $country, ':zip' => $zip,':id' => $id];
      }
    }
    if(execSQL($sql,$vals)) $output = ["status"=>200];
  }
}

else if ($type === "delete"){
  $typeobj = $_POST['typeobj'];
  if(is_numeric($id)){
    if (!$typeobj) $sql = 'DELETE FROM engineerAddress where id = :id';
    else $sql = 'DELETE FROM engineerPhones where id = :id';
    $vals = [':id' => $id];
    if (execSQL($sql,$vals)) $output = ["status"=>200];
    else $output = ["status"=>300];
  }
}
echo json_encode($output);
?>
