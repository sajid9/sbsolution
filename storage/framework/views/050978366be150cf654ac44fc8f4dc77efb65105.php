<?php $__env->startSection('title', 'Edit Size'); ?>
<?php $__env->startSection('pagetitle', 'Edit Size'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
<div class="panel-heading">
    Edit Size
</div>
<div class="panel-body">


<form method="post" action="<?php echo e(url('size/updatesize')); ?>">
	<?php echo csrf_field(); ?>
  <div class="form-group">
    <label for="size">Group Name <span class="text-danger">*</span></label>
    <input type="text" name="size" value="<?php echo e($size->size); ?>" class="form-control" id="size" aria-describedby="size_msg" placeholder="Size">
    <input type="hidden" name="id" value="<?php echo e($size->id); ?>">
    <small id="size_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('size')); ?></small>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" data-toggle="toggle" name="is_active" value="yes" <?php echo e(($size->is_active == 'yes') ? 'checked' : ''); ?> data-on="Active" data-off="Inactive">
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="<?php echo e(url('size/sizelisting')); ?>" class="btn btn-default">Back</a>
</form>


</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>