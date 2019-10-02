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
  <div class="row">
    <div class="form-group col-md-3">
    <label for="total_boxes">Total Quantity </label>
    <input type="text" readonly="" value="<?php echo e((isset($item->item) && $item->item->type == 'tile') ? $item->qty / $item->item->pieces : $item->qty); ?>" class="form-control" id="total_boxes">
  </div>
  <div class="form-group col-md-3">
    <label for="received_boxes">Received Quantity </label>
    <input type="text" readonly="" value="<?php echo e(($item->item->type == 'tile')? $check->total / $item->item->pieces : $check->total); ?>" class="form-control" id="received_boxes">
  </div>
  <div class="form-group col-md-3">
    <input type="hidden" name="voucher" value="<?php echo e(Request::segment(3)); ?>">
    <input type="hidden" name="item" value="<?php echo e(Request::segment(4)); ?>">
    <label for="receivingQty">Receiving Quantity <span class="text-danger">*</span></label>
    <input type="text"autofocus name="quantity" value="<?php echo e(old('quantity')); ?>" class="form-control" id="receivingQty" aria-describedby="receivingQty_msg" placeholder="Receiving Quantity">
    <small id="receivingQty_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('quantity')); ?></small>
  </div>
  <div class="form-group col-md-3">
    <label for="date">Receiving Date <span class="text-danger">*</span></label>
    <input type="date" name="date" value="<?php echo e(old('date')); ?>" class="form-control" id="date" aria-describedby="date_msg" placeholder="Receiving Date">
    <small id="date_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('date')); ?></small>
  </div>
  </div>
  
  <button type="submit" id="submit" class="btn btn-primary">Submit</button> <a href="<?php echo e(url('voucher/receivinglisting/'.Request::segment(3).'/'.Request::segment(4))); ?>" class="btn btn-default">Back</a>
</form>


</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
##parent-placeholder-d7eb6b340a11a367a1bec55e4a421d949214759f##
<script> 
$('#receivingQty').on('blur',function(){
  var boxes      = parseInt($(this).val()) + parseInt($('#received_boxes').val());
  var totalBoxes = parseInt($('#total_boxes').val());
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
<?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>