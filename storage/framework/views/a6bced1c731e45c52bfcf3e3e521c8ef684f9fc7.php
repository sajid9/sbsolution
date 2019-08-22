<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('pagetitle', 'Supplier Payable'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
<div class="panel-heading">
    Supplier Payable
</div>
<div class="panel-body">


<form method="post" action="<?php echo e(url('invoice/supplierpayableinvoice')); ?>" target="_blank">
	<?php echo csrf_field(); ?>
  <div class="form-group">
    <label for="supplier">Supplier <span class="text-danger">*</span></label>
    <select name="supplier_id" class="form-control" id="supplier" aria-describedby="supplier">
      <option value="">Select Supplier</option>
      <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <option value="<?php echo e($supplier->id); ?>"><?php echo e($supplier->supplier_name); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <small id="supplier" class="form-text text-muted text-danger"><?php echo e($errors->first('supplier_id')); ?></small>
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button> <a href="<?php echo e(url('/')); ?>" class="btn btn-default">Back</a>
</form>


</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>