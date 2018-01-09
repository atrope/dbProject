<div class="wrapper">
  <div class="container-fluid">
    <div class="row mt-4">
      <div class="col-1">
        <?php include "../defaults/sideMenu.php"; ?>
    </div>
    <div class="col-11">
      <?php
      echo createForm($query,"post.php",$id);
      ?>
      <script type="text/javascript" src ="../js/post.js"></script>
    </div>
    </div>
  </div>
</div>
