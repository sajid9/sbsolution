<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('pagetitle', 'Opening Item'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
<div class="panel-heading">
    Add Opening Item
</div>
<div class="panel-body">
<?php echo $__env->make('includes.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<form method="post" action="<?php echo e(url('opening/saveitem')); ?>">
	<?php echo csrf_field(); ?>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <input type="hidden" name="item_id" id="itemId">
        <label for="barcode">Barcode <span class="text-danger">*</span></label>
        <div class="input-group">
          <input type="text"  name="barcode" value="<?php echo e(old('barcode')); ?>" class="form-control" id="barcode" aria-describedby="barcode_msg" placeholder="voucher number">
          <span class="input-group-addon"><i data-toggle="modal" data-target="#myModal" class="glyphicon glyphicon-list"></i></span>
        </div>
        <small id="barcode_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('item_id')); ?></small>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="store">Store <span class="text-danger">*</span></label>
        <select name="store" class="form-control" id="store" aria-describedby="store">
          <option value="">Select store</option>
          <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($store->id); ?>"><?php echo e($store->name); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <small id="store" class="form-text text-muted text-danger"><?php echo e($errors->first('store')); ?></small>
      </div>
    </div>
  </div>
  <div id="bp" style="display: none">
    <div class="row">
      <div class="form-group col-md-6">
      <input type="hidden" id="meter_per_box">
      <input type="hidden" id="piece_in_box">
       <label for="boxes">Boxes<span class="text-danger">*</span></label>
       <input type="number" name="boxes" value="<?php echo e(old('boxes')); ?>" class="form-control" id="boxes" placeholder="Boxes" aria-describedby="boxes_msg">
       <small id="boxes_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('boxes')); ?></small>
     </div>
     <div class="form-group col-md-6">
       <label for="pieces">Pieces<span class="text-danger">*</span></label>
       <input type="number" name="pieces" value="<?php echo e(old('pieces')); ?>" class="form-control" id="pieces" placeholder="Pieces" aria-describedby="pieces_msg">
       <small id="pieces_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('pieces')); ?></small>
     </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label for="total_meter">Total Meter</label>
          <input type="number" step="any" readonly="" name="quantity" value="<?php echo e(old('quantity')); ?>" class="form-control" id="meter" placeholder="Opening Item" aria-describedby="total_meter_msg">
          <small id="total_meter_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('quantity')); ?></small>
        </div>
      </div>
     
    </div>
  </div>
  <div class="form-group" id="op" style="display: none">
    <label for="cal_open">Opening Item <span class="text-danger">*</span></label>
    <input type="number" name="cal_open" value="<?php echo e(old('cal_open')); ?>" class="form-control" id="cal_open" placeholder="Opening Item" aria-describedby="cal_open_msg">
    <small id="cal_open_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('cal_open')); ?></small>
  </div>
  <div class="form-group">
    <label for="total_pieces">Total Pieces</label>
    <input type="number" step="any" readonly="" name="quantity" value="<?php echo e(old('quantity')); ?>" class="form-control" id="opening" placeholder="Opening Item" aria-describedby="total_pieces_msg">
    <small id="total_pieces_msg" class="form-text text-muted text-danger"><?php echo e($errors->first('quantity')); ?></small>
  </div>
  <button type="submit"  class="btn btn-primary" id="addItem">Add Item</button> <a href="<?php echo e(url('/')); ?>" class="btn btn-default">Back</a>
</form>

<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-full">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Items</h4>
        </div>
        <div class="modal-body">
          <table class="table table-striped table-bordered table-hover" id="items-datatable">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Item Name</th>
                    <th>Barcode</th>
                    <th>Purchase price</th>
                    <th>Sale Price</th>
                </tr>
            </thead>
            <tbody id="table-body">
              <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($item->id); ?></td>
                <td><?php echo e($item->item_name); ?></td>
                <td><?php echo e($item->barcode); ?></td>
                <td><?php echo e($item->purchase_price); ?></td>
                <td><?php echo e($item->sale_price); ?></td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
##parent-placeholder-d7eb6b340a11a367a1bec55e4a421d949214759f##
<script>
  $(document).on('dblclick','#table-body',function(e){
    var barcode = $(e.target).closest('tr').find('td').eq(2).text();
    $('#barcode').val(barcode).trigger('blur');
    $('#myModal').modal('hide');
  })
  $('#cal_open').on('blur',function(){
    $('#opening').val($(this).val());
  })
  $("#barcode").on('blur',function(){
      var barcode = $(this).val();
      var voucher_id = $('#vouchernumber').val();
      $.ajax({
        url:"<?php echo e(url('voucher/searchbarcode')); ?>",
        type:"post",
        dataType:"json",
        data:{barcode:barcode,voucher_id:voucher_id,_token:"<?php echo e(csrf_token()); ?>"},
        success:function(res){
          console.log(res.message);
          if(res.message){
            $('#barcode_msg').text(res.message);
            $('#addItem').prop('disabled',true);
          }else{
            if(res != null){
              $('#purchase_price').val(res.purchase_price);
              $('#sale_price').val(res.sale_price);
              $('#itemId').val(res.id);
              $('#addItem').prop('disabled',false);
              $('#barcode_msg').text('');
              if(res.type == 'tile'){
                $('#meter_per_box').val(res.meter);
                $('#piece_in_box').val(res.pieces);
                $('#bp').show();
                $('#op').hide();
              }else{
                $('#bp').hide();
                $('#op').show();
              }
            }else{
              $('#purchase_price').val('');
              $('#sale_price').val('');
              $('#itemId').val('');
            }  
          }
        }
      });
    });
  $('#pieces').on('blur',function(){
    var meterPerBox = parseFloat($('#meter_per_box').val());
    var piecesPerBox = parseInt($('#piece_in_box').val());
    var boxes = parseInt($('#boxes').val());
    var pieces = parseInt($('#pieces').val());
    var convertedPieces = boxes * piecesPerBox;
    var totalPieces = convertedPieces + pieces;
    var meterOnePiece = meterPerBox / piecesPerBox;
    var totalMeter = totalPieces * meterOnePiece;

    $('#opening').val(totalPieces);
    $('#meter').val(totalMeter);
  }) 
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>