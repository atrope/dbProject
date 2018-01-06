<?php foreach ($menuItems as $mi) { ?>
<div class="col-12 mb-4">
  <a href="<?php echo $mi->href;?>" class="btn btn-sq-sm btn-<?php echo $mi->active?$mi->color." selected":$mi->color;?>"><i class="fa fa-<?php echo $mi->icon;?> fa-3x"></i><br/><?php echo $mi->name;?></a>
</div>
<?php } ?>
