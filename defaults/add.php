<div class="wrapper">
  <div class="container-fluid">
    <div class="row mt-4">
      <div class="col-1">
        <?php include "../defaults/sideMenu.php"; ?>
    </div>
    <div class="col-11">
      <?php
      if (!isset($submit)) $submit="post.php";
      echo createForm($query,$submit,$id);
      ?>
      <script type="text/javascript" src ="../js/post.js"></script>
    </div>
    </div>
  </div>
</div>
