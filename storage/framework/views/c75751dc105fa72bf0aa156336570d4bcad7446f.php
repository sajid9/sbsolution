<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('pagetitle', 'Customer Receivable'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
<div class="panel-heading">
    Customer Reveivable
</div>
<div class="panel-body">


<form method="post" action="<?php echo e(url('invoice/customerreceivableinvoice')); ?>" target="_blank">
	<?php echo csrf_field(); ?>
  <div class="form-group">
    <label for="customer">Customer <span class="text-danger">*</span></label>
    <select name="customer_id" class="form-control" id="customer" aria-describedby="customer">
      <option value="">Select Customer</option>
      <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <option value="<?php echo e($customer->id); ?>"><?php echo e($customer->customer_name); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <small id="scustomer" class="form-text text-muted text-danger"><?php echo e($errors->first('customer_id')); ?></small>
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button> <a href="<?php echo e(url('category/categorylisting')); ?>" class="btn btn-default">Back</a>
</form>


</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>