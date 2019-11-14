<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('pagetitle', 'Edit Sub Head'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
<div class="panel-heading">
    Edit Sub Head
</div>
<div class="panel-body">


<form method="post" action="<?php echo e(url('expenditure/updatesubhead')); ?>">
	<?php echo csrf_field(); ?>
  <div class="form-group">
    <label for="head">Sub Head Name <span class="text-danger">*</span></label>
    <input type="text" name="head_name" value="<?php echo e($subhead->name); ?>" class="form-control" id="head" aria-describedby="head" placeholder="Sub Head Name">
    <input type="hidden" name="id" value="<?php echo e($subhead->id); ?>">
    <small id="head" class="form-text text-muted text-danger"><?php echo e($errors->first('head_name')); ?></small>
  </div>
 
  <div class="checkbox">
    <label>
      <input type="checkbox" data-toggle="toggle" name="is_active" value="yes" <?php echo e(($subhead->is_active == 'yes') ? 'checked' : ''); ?> data-on="Active" data-off="Inactive">
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="<?php echo e(url('expenditure/subheadlisting/'.$subhead->head_id)); ?>" class="btn btn-default">Back</a>
</form>


</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\sb_solution\resources\views/pages/head/subhead/edit_subhead_form.blade.php ENDPATH**/ ?>