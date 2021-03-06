<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('pagetitle', 'Class'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
<div class="panel-heading">
    Edit Class
</div>
<div class="panel-body">


<form method="post" action="<?php echo e(url('class/updateclass')); ?>">
	<?php echo csrf_field(); ?>
  <div class="form-group">
    <label for="classname">class Name <span class="text-danger">*</span></label>
    <input type="text" name="class_name" value="<?php echo e($class->class_name); ?>" class="form-control" id="classname" aria-describedby="classname" placeholder="class Name">
    <input type="hidden" name="id" value="<?php echo e($class->id); ?>">
    <small id="classname" class="form-text text-muted text-danger"><?php echo e($errors->first('class_name')); ?></small>
  </div>
  
  <div class="form-group">
    <label for="discription">Description</label>
    <textarea class="form-control" name="description" id="description" rows="3" aria-describedby="description"><?php echo e(old('description',$class->description)); ?></textarea>
  </div>
  
  <div class="checkbox">
    <label>
      <input type="checkbox" data-toggle="toggle" name="is_active" value="yes" <?php echo e(($class->is_active == 'yes') ? 'checked' : ''); ?> data-on="Active" data-off="Inactive">
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="<?php echo e(url('class/classlisting')); ?>" class="btn btn-default">Back</a>
</form>


</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>