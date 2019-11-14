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
    <label for="total_qty">Total Quantity </label>
    <input type="text" readonly="" value="<?php echo e(($item->type == 'tile') ? Request::segment(5) / $item->pieces : Request::segment(5)); ?>" class="form-control" id="total_qty" aria-describedby="total_qty_msg">
    <small id="total_qty_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('total_qty')); ?></small>
  </div>
  <div class="form-group">
    <label for="received_qty">Received Quantity </label>
    <input type="text" readonly="" value="<?php echo e(($item->type == 'tile') ? $check->total / $item->pieces : $check->total); ?>" class="form-control" id="received_qty" aria-describedby="received_qty_msg">
    <small id="received_qty_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('received_qty')); ?></small>
  </div>
  <div class="form-group">

    <input type="hidden" name="total_qty" value="<?php echo e(Request::segment(5)); ?>">
    <input type="hidden" name="receiving_id" value="<?php echo e(Request::segment(6)); ?>">
    <input type="hidden" name="voucher" value="<?php echo e(Request::segment(3)); ?>">
    <input type="hidden" name="item" value="<?php echo e(Request::segment(4)); ?>">
    <label for="qty">Quantity <span class="text-danger">*</span></label>
    <input type="text" autofocus="" tabindex="1" name="quantity" value="<?php echo e(old('quantity')); ?>" class="form-control" id="qty" aria-describedby="qty_msg" placeholder="Receiving Quantity">
    <small id="qty_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('quantity')); ?></small>
  </div>
  <div class="form-group">
    <label for="store">Store <span class="text-danger">*</span></label>
    <select name="store" tabindex="2" class="form-control" id="store" aria-describedby="store_msg">
      <option value="">Select Store</option>
      <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <option value="<?php echo e($store->id); ?>"><?php echo e($store->name); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <small id="store_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('store')); ?></small>
  </div>
  <div class="form-group">
    <label for="date">Date <span class="text-danger">*</span></label>
    <input type="date" tabindex="3" name="date" value="<?php echo e(old('date')); ?>" class="form-control" id="date" aria-describedby="date_msg" placeholder="Receiving Date">
    <small id="date_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('date')); ?></small>
  </div>
  <button type="submit" id="submit" tabindex="4" class="btn btn-primary">Submit</button> <a href="<?php echo e(url('voucher/receivingstore/'.Request::segment(3).'/'.Request::segment(4).'/'.Request::segment(5)).'/'.Request::segment(6)); ?>" tabindex="5" class="btn btn-default">Back</a>
</form>


</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
##parent-placeholder-d7eb6b340a11a367a1bec55e4a421d949214759f##
<script> 
$('#qty').on('blur',function(){
  var boxes      = parseInt($(this).val()) + parseInt($('#received_qty').val());
  var totalBoxes = parseInt($('#total_qty').val());
  if(boxes > totalBoxes){
    $(this).val('');
    $('#submit').attr('disabled',true);
    alert('Number of boxes should be less then total boxes');
  }else{
    $('#submit').attr('disabled',false);
  }
})

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\sb_solution\resources\views/pages/purchase/receiving_in_stores/add_receiving_store_form.blade.php ENDPATH**/ ?>