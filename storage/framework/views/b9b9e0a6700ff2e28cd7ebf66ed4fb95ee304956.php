<?php $__env->startSection('title', 'Voucher Receiving'); ?>
<?php $__env->startSection('pagetitle', 'Voucher Receiving'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
<div class="panel-heading">
    Add Receiving
</div>
<div class="panel-body">


<form method="post" action="<?php echo e(url('voucher/addreceiving')); ?>">
	<?php echo csrf_field(); ?>
  <div class="form-group">
    <input type="hidden" name="voucher" value="<?php echo e(Request::segment(3)); ?>">
    <input type="hidden" name="item" value="<?php echo e(Request::segment(4)); ?>">
    <label for="receivingQty">Receiving Quantity <span class="text-danger">*</span></label>
    <input type="text" name="quantity" value="<?php echo e(old('quantity')); ?>" class="form-control" id="receivingQty" aria-describedby="receivingQty_msg" placeholder="Receiving Quantity">
    <small id="receivingQty_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('quantity')); ?></small>
  </div>
  <div class="form-group">
    <label for="date">Receiving Date <span class="text-danger">*</span></label>
    <input type="date" name="date" value="<?php echo e(old('date')); ?>" class="form-control" id="date" aria-describedby="date_msg" placeholder="Receiving Date">
    <small id="date_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('date')); ?></small>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="<?php echo e(url('voucher/receivinglisting/'.Request::segment(3).'/'.Request::segment(4))); ?>" class="btn btn-default">Back</a>
</form>


</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>