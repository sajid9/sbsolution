

<?php if(session('message')): ?>
<div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> <?php echo e(session('message')); ?>

</div>
<?php endif; ?>


<?php if(session('error')): ?>
<div class="alert alert-danger alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Alert!</strong> <?php echo e(session('error')); ?>

</div>
<?php endif; ?>
