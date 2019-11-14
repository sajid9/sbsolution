<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('pagetitle', 'Edit Month'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
<div class="panel-heading">
    Edit Month
</div>
<div class="panel-body">


<form method="post" action="<?php echo e(url('expenditure/updatemonth')); ?>">
	<?php echo csrf_field(); ?>
  <div class="form-group">
    <label for="month">Company Name <span class="text-danger">*</span></label>
    <input type="text" name="month_name" value="<?php echo e($month->name); ?>" class="form-control" id="month" aria-describedby="month" placeholder="Month Name">
    <input type="hidden" name="id" value="<?php echo e($month->id); ?>">
    <small id="month" class="form-text text-muted text-danger"><?php echo e($errors->first('month_name')); ?></small>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" data-toggle="toggle" name="is_active" value="yes" <?php echo e(($month->is_active == 'yes') ? 'checked' : ''); ?> data-on="Active" data-off="Inactive">
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="<?php echo e(url('expenditure/monthlisting')); ?>" class="btn btn-default">Back</a>
</form>


</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\sb_solution\resources\views/pages/month/edit_month_form.blade.php ENDPATH**/ ?>