<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('pagetitle', 'Add Customer'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
<div class="panel-heading">
    Add New Customer
</div>
<div class="panel-body">


<form method="post" action="<?php echo e(url('customer/addcustomer')); ?>">
	<?php echo csrf_field(); ?>
  <div class="row">
    <div class="form-group col-md-4">
      <label for="customername">Customer Name <span class="text-danger">*</span></label>
      <input type="text" name="customer_name" value="<?php echo e(old('customer_name')); ?>" class="form-control" id="customername" aria-describedby="customername" placeholder="Customer name">
      <small id="customername" class="form-text text-muted text-danger"><?php echo e($errors->first('customer_name')); ?></small>
    </div>
    <div class="form-group col-md-4">
      <label for="mobile">Mobile <span class="text-danger">*</span></label>
      <input type="text" name="mobile" value="<?php echo e(old('mobile')); ?>" class="form-control" id="mobile" placeholder="Enter customer mobile" aria-describedby="mobile">
      <small id="mobile" class="form-text text-muted text-danger"><?php echo e($errors->first('mobile')); ?></small>
    </div>
    <div class="form-group col-md-4">
      <label for="occupation">Occupation</label>
      <input type="occupation" name="occupation" value="<?php echo e(old('occupation')); ?>" class="form-control" id="occupation" placeholder="Enter occupation" aria-describedby="occupation">
    </div>
  </div>
  <div class="row">
    <div class="form-group col-md-4">
    <label for="standing_instruction">Standing Insruction</label>
    <input type="standing_instruction" name="standing_instruction" value="<?php echo e(old('standing_instruction')); ?>" class="form-control" id="standing_instruction" placeholder="Enter standing instruction" aria-describedby="standing_instruction">
  </div>
  <div class="form-group col-md-4">
    <label for="email">Email</label>
    <input type="email" name="email" value="<?php echo e(old('email')); ?>" class="form-control" id="email" placeholder="Enter customer email" aria-describedby="email">
  </div>
  <div class="form-group col-md-4">
    <label for="phone">Phone</label>
    <input type="text" name="phone" value="<?php echo e(old('phone')); ?>" class="form-control" id="phone" placeholder="Enter customer phone" aria-describedby="phone">
  </div>
  </div>
  <div class="row">
    <div class="form-group col-md-4">
    <label for="cnic">Cnic</label>
    <input type="text" name="cnic" value="<?php echo e(old('cnic')); ?>" class="form-control" id="cnic" placeholder="Enter customer cnic" aria-describedby="cnic">
  </div>
  <div class="form-group col-md-4">
    <label for="website">Website</label>
    <input type="url" name="website" value="<?php echo e(old('website')); ?>" class="form-control" id="website" placeholder="Enter customer website" aria-describedby="website">
  </div>
  <div class="form-group col-md-4">
    <label for="gst">GST</label>
    <input type="gst" name="gst" value="<?php echo e(old('gst')); ?>" class="form-control" id="gst" placeholder="Enter GST" aria-describedby="gst">
  </div>
  </div>
  <div class="row">
    <div class="form-group col-md-4">
    <label for="ntn">NTN</label>
    <input type="ntn" name="ntn" value="<?php echo e(old('ntn')); ?>" class="form-control" id="ntn" placeholder="Enter NTN" aria-describedby="ntn">
  </div>
  <div class="form-group col-md-4">
    <label for="address">Address</label>
    <textarea class="form-control" name="address" id="address" rows="3" aria-describedby="address"><?php echo e(old('address')); ?></textarea>
  </div>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="<?php echo e(url('customer/customerlisting')); ?>" class="btn btn-default">Back</a>
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