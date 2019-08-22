<?php $__env->startSection('title', 'Add Unit'); ?>
<?php $__env->startSection('pagetitle', 'Add Unit'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
<div class="panel-heading">
    Add New Unit
</div>
<div class="panel-body">


<form method="post" action="<?php echo e(url('measuring/addunit')); ?>">
	<?php echo csrf_field(); ?>
  <div class="form-group">
    <label for="unit">Unit <span class="text-danger">*</span></label>
    <input type="text" name="unit" value="<?php echo e(old('unit')); ?>" class="form-control" id="unit" aria-describedby="unit_msg" placeholder="Company Name">
    <small id="unit_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('unit')); ?></small>
  </div>
  
  <div class="checkbox">
    <label>
      <input type="checkbox" data-toggle="toggle" name="is_active" value="yes" <?php echo e((old('is_active') == 'yes') ? 'checked' : ''); ?> data-on="Active" data-off="Inactive">
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