<?php
include "../defaults/functions.php";
$type = $_POST['type'];
$output = ["status"=>400];
if ($type === "new"){
  $name = $_POST['name'];
  $spec = $_POST['specialization'];
  $birthday = $_POST['birthday'];
  $zeut = $_POST['zeut'];
  $phone = $_POST['phone'];
  $street = $_POST['street'];
  $street = $_POST['street'];
  $zip = $_POST['zip'];
  $city = $_POST['city'];
  $country = $_POST['country'];
  if (strlen($name)>4 &&  strlen($birthday)>4  &&  strlen($zeut)>4  &&  strlen($phone)>4 &&  strlen($street)>4 &&  strlen($street)>4 &&  strlen($zip)>4 &&  strlen($city)>4 &&  strlen($country)>4) {
    $output = ["status"=>300];
    $sql = 'INSERT INTO engineer( name,birthday,zeut,specialization ) VALUES(:name,:birthday,:zeut,:spec)';
    $vals = [':name' => $name, ':birthday' => date('Y-m-d', strtotime(str_replace('-', '/', $birthday))) ,':zeut' => $zeut, ':spec' => null ];
    $engineerid = execSQL($sql,$vals);
    if($engineerid){
      $sql = 'INSERT INTO engineerPhones(phone,engineerId ) VALUES(:phone,:engineerId)';
      $vals = [':phone' => $phone, ':engineerId'=>$engineerid];
      if (execSQL($sql,$vals)){
        $sql = 'INSERT INTO engineerAddress(city,street,country,zip,engineerId ) VALUES(:city,:street,:country,:zip,:engineerId)';
        $vals = [':city' => $city,':street'=>$street,":country"=>$country, ":zip"=>$zip, ':engineerId'=>$engineerid];
        if (execSQL($sql,$vals)) $output = ["status"=>200];
      }
      if($output["status"]!=200){
        $sql = 'DELETE FROM engineer where id = :id';
        $vals = [':id' => $engineerid];
        execSQL($sql,$vals);
      }
    }
  }
}
else if ($type === "delete"){
  $id = $_POST['id'];
  if(is_numeric($id)){
    $sql = 'DELETE FROM engineer where id = :id';
    $vals = [':id' => $id];
    if (execSQL($sql,$vals)) $output = ["status"=>200];
    else $output = ["status"=>300];
  }
}
echo json_encode($output);
?>
