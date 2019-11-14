<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('pagetitle', 'Month'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
<div class="panel-heading">
    Add New Month
</div>
<div class="panel-body">


<form method="post" action="<?php echo e(url('expenditure/addmonth')); ?>">
	<?php echo csrf_field(); ?>
  <div class="form-group">
    <label for="monthname">Month Name <span class="text-danger">*</span></label>
    <input type="text" name="month_name" value="<?php echo e(old('month_name')); ?>" class="form-control" id="monthname" aria-describedby="monthname" placeholder="Company Name">
    <small id="monthname" class="form-text text-muted text-danger"><?php echo e($errors->first('month_name')); ?></small>
  </div>
 
  <div class="checkbox">
    <label>
      <input type="checkbox" data-toggle="toggle" name="is_active" value="yes" <?php echo e((old('is_active') == 'yes') ? 'checked' : ''); ?> data-on="Active" data-off="Inactive">
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
<?php echo $__env->make('layout.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\sb_solution\resources\views/pages/month/add_month_form.blade.php ENDPATH**/ ?>