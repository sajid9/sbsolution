<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('pagetitle', 'Supplier'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
<div class="panel-heading">
    Add New Supplier
</div>
<div class="panel-body">


<form method="post" action="<?php echo e(url('supplier/addsupplier')); ?>">
	<?php echo csrf_field(); ?>
  <div class="form-group">
    <label for="suppliername">Supplier Name <span class="text-danger">*</span></label>
    <input type="text" name="supplier_name" value="<?php echo e(old('supplier_name')); ?>" class="form-control" id="suppliername" aria-describedby="suppliername" placeholder="Supplier Name">
    <small id="suppliername" class="form-text text-muted text-danger"><?php echo e($errors->first('supplier_name')); ?></small>
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" value="<?php echo e(old('email')); ?>" class="form-control" id="email" placeholder="Enter your email" aria-describedby="email">
  </div>
  <div class="form-group">
    <label for="phone">Phone <span class="text-danger">*</span></label>
    <input type="text" name="phone" value="<?php echo e(old('phone')); ?>" class="form-control" id="phone" placeholder="Enter your phone" aria-describedby="phone">
    <small id="suppliername" class="form-text text-muted text-danger"><?php echo e($errors->first('phone')); ?></small>
  </div>
  <div class="form-group">
    <label for="mobile">Mobile <span class="text-danger">*</span></label>
    <input type="text" name="mobile" value="<?php echo e(old('mobile')); ?>" class="form-control" id="mobile" placeholder="Enter your mobile" aria-describedby="mobile">
    <small id="suppliername" class="form-text text-muted text-danger"><?php echo e($errors->first('mobile')); ?></small>
  </div>
  <div class="form-group">
    <label for="cnic">Cnic</label>
    <input type="text" name="cnic" value="<?php echo e(old('cnic')); ?>" class="form-control" id="cnic" placeholder="Enter your cnic" aria-describedby="cnic">
  </div>
  <div class="form-group">
    <label for="website">Website</label>
    <input type="url" name="website" value="<?php echo e(old('website')); ?>" class="form-control" id="website" placeholder="Enter your website" aria-describedby="website">
  </div>
  <div class="form-group">
    <label for="address">Address</label>
    <textarea class="form-control" name="address" id="address" rows="3" aria-describedby="address"><?php echo e(old('address')); ?></textarea>
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button> <a href="<?php echo e(url('supplier/supplierlisting')); ?>" class="btn btn-default">Back</a>
</form>


</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
##parent-placeholder-d7eb6b340a11a367a1bec55e4a421d949214759f##
<script src="<?php echo e(asset('js/jquery.maskedinput.js')); ?>"></script>
<script>
   $("#phone").mask("(999) 9999999");
   $("#mobile").mask("9999-9999999");
   $("#cnic").mask("99999-9999999-9");
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>