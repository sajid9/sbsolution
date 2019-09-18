<?php $__env->startSection('title', 'Receipt Delivery'); ?>
<?php $__env->startSection('pagetitle', 'Receipt Delivery'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
<div class="panel-heading">
    Add Delivery
</div>
<div class="panel-body">


<form method="post" action="<?php echo e(url('sale/adddevlivery')); ?>">
	<?php echo csrf_field(); ?>
  <?php $obj = CH::convert_box($item->qty,$item->item->pieces,$item->item->meter);?>
  
  <div class="row">
    <div class="form-group col-md-4">
    <label for="total_boxes">Total Pieces <span class="text-danger">*</span></label>
    <input type="text" readonly="" value="<?php echo e($item->qty); ?>" class="form-control" id="total_boxes">
  </div>
  <div class="form-group col-md-4">
    <label for="total_boxes">Boxes <span class="text-danger">*</span></label>
    <input type="text" readonly="" value="<?php echo e($obj['boxes']); ?>" class="form-control" id="total_boxes">
  </div>
  <div class="form-group col-md-4">
    <label for="total_boxes">Pieces <span class="text-danger">*</span></label>
    <input type="text" readonly="" value="<?php echo e($obj['pieces']); ?>" class="form-control" id="total_boxes">
  </div>
  </div>
  <div class="form-group">
    <label>Delivered Pieces <span class="text-danger">*</span></label>
    <input type="text" readonly="" value="<?php echo e(($check->total == null)? 0 : $check->total); ?>" class="form-control" id="delivered_pieces">
  </div>
  
  <div class="row">
    <div class="form-group col-md-4">
    <input type="hidden" name="receipt" value="<?php echo e(Request::segment(3)); ?>">
    <input type="hidden" name="item" value="<?php echo e(Request::segment(4)); ?>">
    <label for="receivingQty">Delivering Pieces <span class="text-danger">*</span></label>
    <input type="text" autofocus="" tabindex="1" name="quantity" value="<?php echo e(old('quantity')); ?>" class="form-control" id="receivingQty" aria-describedby="receivingQty_msg" placeholder="Delivered Pieces">
    <small id="receivingQty_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('quantity')); ?></small>
  </div>
  <div class="form-group col-md-4">
    <label for="total_boxes">Boxes <span class="text-danger">*</span></label>
    <input type="text" readonly="" class="form-control" id="delivered_boxes">
  </div>
  <div class="form-group col-md-4" >
    <label for="total_boxes">Pieces <span class="text-danger">*</span></label>
    <input type="text" readonly=""  class="form-control" id="delivering_pieces">
  </div>
  </div>
  <div class="form-group">
    <label for="date">Delivered Date <span class="text-danger">*</span></label>
    <input type="date" tabindex="2" name="date" value="<?php echo e(old('date')); ?>" class="form-control" id="date" aria-describedby="date_msg" placeholder="Receiving Date">
    <small id="date_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('date')); ?></small>
  </div>
  <button type="submit" tabindex="3" id="submit" class="btn btn-primary">Submit</button> <a href="<?php echo e(url('sale/deliverylisting/'.Request::segment(3).'/'.Request::segment(4))); ?>" tabindex="4" class="btn btn-default">Back</a>
</form>


</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
##parent-placeholder-d7eb6b340a11a367a1bec55e4a421d949214759f##
<script>

$('#receivingQty').on('blur',function(){
  var deliveredPieces   =  parseInt($(this).val());
  var totalBoxes        =  parseInt($('#total_boxes').val());
  var piecesBox         =  parseInt("<?php echo e($item->item->pieces); ?>");
  var boxes             =  parseInt(deliveredPieces / piecesBox);
  var pieces            =  parseInt(deliveredPieces - (boxes * piecesBox));
  
  var check = deliveredPieces + parseInt($('#delivered_pieces').val());
  if(check > totalBoxes){
    $('#submit').attr('disabled',true);
    alert('Number of delivering pieces should be less then total pieces total Pieces are '+totalBoxes+' and your are delivering '+check);
    $(this).val('');
  }else{
    $('#delivered_boxes').val(boxes);
    $('#delivering_pieces').val(pieces);
    $('#submit').attr('disabled',false);
  }
})

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>