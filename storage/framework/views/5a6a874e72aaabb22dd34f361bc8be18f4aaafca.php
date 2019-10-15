<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('pagetitle', 'Profile'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
<div class="panel-heading">
   Add / Edit Profile
</div>
<div class="panel-body">
<?php echo $__env->make('includes.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<form method="post" action="<?php echo e(url('user/updateprofile')); ?>" enctype="multipart/form-data">
	<?php echo csrf_field(); ?>
  <div class="form-group">
    <label for="name">User Name <span class="text-danger">*</span></label>
    <input type="text" name="user_name" value="<?php echo e(old('user_name',Auth::user()->name)); ?>" class="form-control" id="name" aria-describedby="name" placeholder="Company Name">
    <small id="name" class="form-text text-muted text-danger"><?php echo e($errors->first('user_name')); ?></small>
  </div>
  <div class="form-group">
    <label for="email">Email <span class="text-danger">*</span></label>
    <input type="text" name="user_email" value="<?php echo e(old('user_email',Auth::user()->email)); ?>" class="form-control" id="email" aria-describedby="email" placeholder="Email">
    <small id="email" class="form-text text-muted text-danger"><?php echo e($errors->first('user_email')); ?></small>
  </div>
  <button type="submit" class="btn btn-primary">Update</button> <a href="<?php echo e(url('/')); ?>" class="btn btn-default">Back</a>
</form>


</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xamp\htdocs\sb_solution\resources\views/pages/user/add_profile_form.blade.php ENDPATH**/ ?>