<?php
include "../defaults/header.php";
$menuItems = [
  (object) ["name"=> "Back","href"=> "../index.php",  "color"=>"danger", "icon"=>"arrow-left","active"=>false],
  (object) ["name"=> "Budget","href"=> "#",  "color"=>"success", "icon"=>"money","active"=>false],
  (object) ["name"=> "Busiest","href"=> "#",  "color"=>"info", "icon"=>"briefcase","active"=>false],
  (object) ["name"=> "Proj/Eng","href"=> "#",  "color"=>"dark", "icon"=>"user","active"=>false],
  (object) ["name"=> "Rating","href"=> "#",  "color"=>"primary", "icon"=>"star","active"=>false],
  (object) ["name"=> "Tools/Stage","href"=> "#",  "color"=>"warning", "icon"=>"wrench","active"=>false]
];
  ?>
  <div class="wrapper">
    <div class="container-fluid">
      <div class="row mt-4">
        <div class="col-1">
          <?php include "../defaults/sideMenu.php"; ?>
      </div>
      <div class="col-11 results">
      </div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src ="../js/reports.js"></script>

<?php
 include "../defaults/footer.php";
?>
