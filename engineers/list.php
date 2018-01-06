<?php include "../defaults/header.php"; ?>
<div class="wrapper">
  <div class="container-fluid">
    <div class="row mt-4">
      <div class="col-1">
        <?php
        $menuItems = [
          (object) ["name"=> "Back","href"=> "../index.php",  "color"=>"danger", "icon"=>"arrow-left","active"=>false],
          (object) ["name"=> "List","href"=> "list.php",  "color"=>"primary", "icon"=>"list","active"=>true],
          (object) ["name"=> "Add","href"=> "add.php",  "color"=>"info", "icon"=>"plus","active"=>false]];
        include "../defaults/sideMenu.php";
        ?>
    </div>
    <div class="col-11">
      <?php
      $query = "select e.id,name,specialization,phone from engineer e INNER JOIN engineerPhones ep on e.id = ep.engineerId";
      echo createTable($query);
      ?>
      </div>
    </div>

  </div>
</div>

<?php include "../defaults/footer.php"; ?>
