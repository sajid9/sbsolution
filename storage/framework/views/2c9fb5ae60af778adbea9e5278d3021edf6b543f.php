<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('pagetitle', 'Reset Password'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
<div class="panel-heading">
   Update Password
</div>
<div class="panel-body">
<?php echo $__env->make('includes.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<form method="post" action="<?php echo e(url('user/updatepassword')); ?>" enctype="multipart/form-data">
	<?php echo csrf_field(); ?>
  <div class="form-group">
    <label for="password">New Password <span class="text-danger">*</span></label>
    <input type="password" name="password" value="<?php echo e(old('password')); ?>" class="form-control" id="name" aria-describedby="password_msg" placeholder="New Password">
    <small id="password_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('password')); ?></small>
  </div>
  <div class="form-group">
    <label for="con_password">Confirm Password <span class="text-danger">*</span></label>
    <input type="password" name="password_confirmation" value="<?php echo e(old('con_password')); ?>" class="form-control" id="email" aria-describedby="email" placeholder="Confirm Password">
    <small id="con_pass_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('con_password')); ?></small>
  </div>
  <button type="submit" class="btn btn-primary">Update</button> <a href="<?php echo e(url('/')); ?>" class="btn btn-default">Back</a>
</form>


</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\sb_solution\resources\views/pages/user/update_password_form.blade.php ENDPATH**/ ?>