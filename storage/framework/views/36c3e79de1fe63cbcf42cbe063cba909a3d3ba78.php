<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('pagetitle', 'SubClass'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
<div class="panel-heading">
    Add Sub Class
</div>
<div class="panel-body">


<form method="post" action="<?php echo e(url('subclass/addclass')); ?>">
	<?php echo csrf_field(); ?>
  <input type="hidden" name="parent_id" value="<?php echo e($id); ?>">
  <div class="form-group">
    <label for="categoryname">Class Name <span class="text-danger">*</span></label>
    <input type="text" name="class_name" value="<?php echo e(old('class_name')); ?>" class="form-control" id="classname" aria-describedby="classname" placeholder="class Name">
    <small id="classname" class="form-text text-muted text-danger"><?php echo e($errors->first('class_name')); ?></small>
  </div>
  
  <div class="form-group">
    <label for="discription">Description</label>
    <textarea class="form-control" name="description" id="description" rows="3" aria-describedby="description"><?php echo e(old('description')); ?></textarea>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" data-toggle="toggle" name="is_active" value="yes" <?php echo e((old('is_active') == 'yes') ? 'checked' : ''); ?> data-on="Active" data-off="Inactive">
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="<?php echo e(url('subclass/classlisting/'.$id)); ?>" class="btn btn-default">Back</a>
</form>


</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\sb_solution\resources\views/pages/classes/subClasses/add_class_form.blade.php ENDPATH**/ ?>