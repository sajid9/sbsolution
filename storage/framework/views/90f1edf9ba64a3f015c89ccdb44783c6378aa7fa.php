<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('pagetitle', 'Stores'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
<div class="panel-heading">
    Add New Store
</div>
<div class="panel-body">


<form method="post" action="<?php echo e(url('store/addstore')); ?>">
	<?php echo csrf_field(); ?>
  <div class="form-group">
    <label for="storename">Store Name <span class="text-danger">*</span></label>
    <input type="text" name="store_name" value="<?php echo e(old('store_name')); ?>" class="form-control" id="storename" aria-describedby="storename" placeholder="Company Name">
    <small id="storename" class="form-text text-muted text-danger"><?php echo e($errors->first('store_name')); ?></small>
  </div>
  <div class="form-group">
    <label for="address">Address</label>
    <textarea class="form-control" name="address" id="address" rows="3" aria-describedby="address"><?php echo e(old('address')); ?></textarea>
    <small id="address" class="form-text text-muted text-danger"><?php echo e($errors->first('address')); ?></small>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" data-toggle="toggle" name="is_active" value="yes" <?php echo e((old('is_active') == 'yes') ? 'checked' : ''); ?> data-on="Active" data-off="Inactive">
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="<?php echo e(url('store/storelisting')); ?>" class="btn btn-default">Back</a>
</form>


</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>