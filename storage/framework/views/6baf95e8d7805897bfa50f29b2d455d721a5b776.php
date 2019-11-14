<?php $__env->startSection('title', 'Groups'); ?>
<?php $__env->startSection('pagetitle', 'Groups'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
<div class="panel-heading">
    Add New Group
</div>
<div class="panel-body">


<form method="post" action="<?php echo e(url('group/addgroup')); ?>">
	<?php echo csrf_field(); ?>
  <div class="form-group">
    <label for="groupname">Group Name <span class="text-danger">*</span></label>
    <input type="text" name="group_name" value="<?php echo e(old('group_name')); ?>" class="form-control" id="groupname" aria-describedby="groupname" placeholder="Company Name">
    <small id="groupname" class="form-text text-muted text-danger"><?php echo e($errors->first('group_name')); ?></small>
  </div>
  
  <div class="checkbox">
    <label>
      <input type="checkbox" data-toggle="toggle" name="is_active" value="yes" <?php echo e((old('is_active') == 'yes') ? 'checked' : ''); ?> data-on="Active" data-off="Inactive">
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="<?php echo e(url('group/grouplisting')); ?>" class="btn btn-default">Back</a>
</form>


</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\sb_solution\resources\views/pages/groups/add_group_form.blade.php ENDPATH**/ ?>