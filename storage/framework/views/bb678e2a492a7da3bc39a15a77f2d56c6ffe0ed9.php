<?php $__env->startSection('title', 'Receipt Delivery'); ?>
<?php $__env->startSection('pagetitle', 'Delivery from Store'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
<div class="panel-heading">
    Add delivery from Store
</div>
<div class="panel-body">


<form method="post" action="<?php echo e(url('sale/adddeliverystore')); ?>">
	<?php echo csrf_field(); ?>
  <?php if($item->type == 'tile'){
    $obj = CH::convert_box(Request::segment(5),$item->pieces,$item->meter);
  }?>
  
  <div class="row">
  <div class="form-group <?php echo e(($item->type == 'tile')? 'col-md-4' : 'col-md-12'); ?>">
    <label for="total_qty">Total Pieces </label>
    <input type="text" readonly="" value="<?php echo e(Request::segment(5)); ?>" class="form-control" id="total_qty" aria-describedby="total_qty_msg">
    <small id="total_qty_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('total_qty')); ?></small>
  </div>
  <?php if($item->type == 'tile'): ?>
  <div class="form-group col-md-4">
    <label for="total_boxes">Boxes </label>
    <input type="text" readonly="" value="<?php echo e($obj['boxes']); ?>" class="form-control" id="total_boxes">
  </div>
  <div class="form-group col-md-4" >
    <label for="total_boxes">Pieces </label>
    <input type="text" readonly="" value="<?php echo e($obj['pieces']); ?>" class="form-control" id="total_boxes">
  </div>
  <?php endif; ?>
  </div>
  <div class="form-group">
    <label>Delivered Pieces </label>
    <input type="text" readonly="" value="<?php echo e(($check->total == null)? 0 : $check->total); ?>" class="form-control" id="delivered_pieces">
  </div>
  <div class="row">
    <div class="form-group <?php echo e(($item->type == 'tile')? 'col-md-4' : 'col-md-12'); ?>">
    <input type="hidden" name="total_qty" value="<?php echo e(Request::segment(5)); ?>">
    <input type="hidden" name="delivery_id" value="<?php echo e(Request::segment(6)); ?>">
    <input type="hidden" name="receipt" value="<?php echo e(Request::segment(3)); ?>">
    <input type="hidden" name="item" value="<?php echo e(Request::segment(4)); ?>">
    <label for="qty">Delivery Pieces <span class="text-danger">*</span></label>
    <input type="text" autofocus="" tabindex="1" name="quantity" value="<?php echo e(old('quantity')); ?>" class="form-control" id="qty" aria-describedby="qty_msg" placeholder="Receiving Quantity">
    <small id="qty_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('quantity')); ?></small>
  </div>
  <?php if($item->type == 'tile'): ?>
  <div class="form-group col-md-4">
    <label for="total_boxes">Boxes </label>
    <input type="text" readonly="" class="form-control" id="delivered_boxes">
  </div>
  <div class="form-group col-md-4" >
    <label for="total_boxes">Pieces </label>
    <input type="text" readonly=""  class="form-control" id="delivering_pieces">
  </div>
  <?php endif; ?>
  </div>
  <div class="row">
    <div class="form-group col-md-6">
      <label for="store">Store <span class="text-danger">*</span></label>
      <select name="store" tabindex="2" class="form-control" id="store" aria-describedby="store_msg">
        <option value="">Select Store</option>
        <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($store->id); ?>"><?php echo e($store->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
      <small id="store_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('store')); ?></small>
    </div>
    <div class="form-group col-md-6">
      <label for="date">Date <span class="text-danger">*</span></label>
      <input type="date" tabindex="3" name="date" value="<?php echo e(old('date')); ?>" class="form-control" id="date" aria-describedby="date_msg" placeholder="Receiving Date">
      <small id="date_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('date')); ?></small>
    </div>
  </div>
  
  <button type="submit" tabindex="4" id="submit" class="btn btn-primary">Submit</button> <a href="<?php echo e(url('sale/storelisting/'.Request::segment(3).'/'.Request::segment(4).'/'.Request::segment(5)).'/'.Request::segment(6)); ?>" tabindex="5" class="btn btn-default">Back</a>
</form>


</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
##parent-placeholder-d7eb6b340a11a367a1bec55e4a421d949214759f##
<script> 
$('#qty').on('blur',function(){
  var delpieces   = parseInt($(this).val());
  var totalPieces = parseInt($('#total_qty').val());
  var piecesBox   =  parseInt("<?php echo e($item->pieces); ?>");
  var boxes       =  parseInt(delpieces / piecesBox);
  var pieces      =  parseInt(delpieces - (boxes * piecesBox));
  var check       = delpieces + parseInt($('#delivered_pieces').val());
  if(check > totalPieces){
    $('#submit').attr('disabled',true);
    $(this).val('');
    $('#delivered_boxes').val('');
    $('#delivering_pieces').val('');
    alert('Number of delivering pieces should be less then total pieces total Pieces are '+totalPieces+' and your are delivering '+check);
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