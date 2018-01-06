<?php include "../defaults/header.php"; ?>
<div class="wrapper">
  <div class="container-fluid">
    <div class="row mt-4">
      <div class="col-1">
        <?php
        $menuItems = [
          (object) ["name"=> "Back","href"=> "../index.php",  "color"=>"danger", "icon"=>"arrow-left","active"=>false],
          (object) ["name"=> "List","href"=> "list.php",  "color"=>"primary", "icon"=>"list","active"=>false],
          (object) ["name"=> "Add","href"=> "add.php",  "color"=>"info", "icon"=>"plus","active"=>true]];
        include "../defaults/sideMenu.php";
        ?>
    </div>
    <div class="col-11">
      <?php $query = "select * from project";
      echo createForm($query,"post.php");
      ?>
    </div>
    </div>
  </div>
</div>
<?php include "../defaults/footer.php"; ?>
