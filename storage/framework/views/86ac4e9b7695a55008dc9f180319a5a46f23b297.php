<?php $__env->startSection('title', 'Edit Unit'); ?>
<?php $__env->startSection('pagetitle', 'Edit Unit'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
<div class="panel-heading">
    Edit Unit
</div>
<div class="panel-body">


<form method="post" action="<?php echo e(url('measuring/updateunit')); ?>">
	<?php echo csrf_field(); ?>
  <div class="form-group">
    <label for="unit">Unit<span class="text-danger">*</span></label>
    <input type="text" name="unit" value="<?php echo e($unit->unit); ?>" class="form-control" id="unit" aria-describedby="unit_msg" placeholder="Unit">
    <input type="hidden" name="id" value="<?php echo e($unit->id); ?>">
    <small id="unit_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('unit')); ?></small>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" data-toggle="toggle" name="is_active" value="yes" <?php echo e(($unit->is_active == 'yes') ? 'checked' : ''); ?> data-on="Active" data-off="Inactive">
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="<?php echo e(url('measuring/unitlisting')); ?>" class="btn btn-default">Back</a>
</form>


</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>