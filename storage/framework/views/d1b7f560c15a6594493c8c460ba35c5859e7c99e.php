<?php $__env->startSection('title', 'Voucher Receiving'); ?>
<?php $__env->startSection('pagetitle', 'Receiving to Store'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
<div class="panel-heading">
    Add Receiving to Store
</div>
<div class="panel-body">


<form method="post" action="<?php echo e(url('voucher/addreceivingstore')); ?>">
	<?php echo csrf_field(); ?>
  <div class="form-group">
    <label for="total_qty">Total Quantity <span class="text-danger">*</span></label>
    <input type="text" readonly="" name="total_qty" value="<?php echo e(Request::segment(5)); ?>" class="form-control" id="total_qty" aria-describedby="total_qty_msg">
    <small id="total_qty_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('total_qty')); ?></small>
  </div>
  <div class="form-group">
    <input type="hidden" name="receiving_id" value="<?php echo e(Request::segment(6)); ?>">
    <input type="hidden" name="voucher" value="<?php echo e(Request::segment(3)); ?>">
    <input type="hidden" name="item" value="<?php echo e(Request::segment(4)); ?>">
    <label for="qty">Quantity <span class="text-danger">*</span></label>
    <input type="text" name="quantity" value="<?php echo e(old('quantity')); ?>" class="form-control" id="qty" aria-describedby="qty_msg" placeholder="Receiving Quantity">
    <small id="qty_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('quantity')); ?></small>
  </div>
  <div class="form-group">
    <label for="store">Store <span class="text-danger">*</span></label>
    <select name="store" class="form-control" id="store" aria-describedby="store_msg">
      <option value="">Select Store</option>
      <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <option value="<?php echo e($store->id); ?>"><?php echo e($store->name); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <small id="store_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('store')); ?></small>
  </div>
  <div class="form-group">
    <label for="date">Date <span class="text-danger">*</span></label>
    <input type="date" name="date" value="<?php echo e(old('date')); ?>" class="form-control" id="date" aria-describedby="date_msg" placeholder="Receiving Date">
    <small id="date_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('date')); ?></small>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="<?php echo e(url('voucher/receivingstore/'.Request::segment(3).'/'.Request::segment(4).'/'.Request::segment(5))); ?>" class="btn btn-default">Back</a>
</form>


</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>