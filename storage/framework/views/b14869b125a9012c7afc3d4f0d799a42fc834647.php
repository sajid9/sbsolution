<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('pagetitle', 'Voucher'); ?>
<?php $__env->startSection('header'); ?>
##parent-placeholder-594fd1615a341c77829e83ed988f137e1ba96231##
<style>
  fieldset { 
    display: block;
    margin-left: 2px;
    margin-right: 2px;
    padding-top: 0.35em;
    padding-bottom: 0.625em;
    padding-left: 0.75em;
    padding-right: 0.75em;
    border: 2px solid #ccc;
  }
  legend{
    width:inherit; /* Or auto */
    padding:0 10px; /* To give a bit of padding on the left and right */
    border-bottom:none;
  }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
<div class="panel-heading">
    Add New Voucher
</div>
<div class="panel-body">


  <div class="row">
    <div class="col-md-6">
      <fieldset>
        <legend>Voucher:</legend>
          
        <form id="vendor_form">
          <?php echo csrf_field(); ?>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="vouchernumber">Voucher Number <span class="text-danger">*</span></label>
              <input type="text" readonly="readonly" name="voucher_number" value="<?php echo e(old('voucher_number')); ?>" class="form-control" id="vouchernumber" aria-describedby="voucher_number" placeholder="voucher number">
              <small id="voucher_number" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
              <label for="vendorvoucher">Vendor Voucher Number <span class="text-danger">*</span></label>
              <input type="text" name="vendor_voucher" value="<?php echo e(old('vendor_voucher')); ?>" class="form-control" id="vendorvoucher" aria-describedby="vendor_voucher" placeholder="receipt number">
              <small id="vendor_voucher" class="form-text text-muted text-danger"></small>
            </div>
          </div>
          <div class="col-md-6">
           <div class="form-group">
              <label for="voucher_date">Voucher Date <span class="text-danger">*</span></label>
              <input type="date" name="voucher_date" value="<?php echo e(old('voucher_date')); ?>" class="form-control" id="voucher_date" placeholder="Short Code" aria-describedby="voucher_date">
              <small id="voucherdate" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
              <label for="supplier">Supplier </label>
              <select name="supplier" class="form-control" id="supplier" aria-describedby="supplier">
                <option value="">Select supplier</option>
                <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($supplier->id); ?>"><?php echo e($supplier->supplier_name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
              <small id="supplier_msg" class="form-text text-muted text-danger"></small>
            </div>
            
          </div>
          
        </div>
        <div class="row">
          <div class="col-md-12">
            <button type="submit" class="btn btn-primary" id="save_vendor">Save Voucher</button>
          </div>
        </div>
        </form>
      </fieldset>
    </div>
    <div class="col-md-6">
      <fieldset>
        <legend>Add Item:</legend>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <input type="hidden" name="item_id" id="itemId">
              <label for="barcode">Barcode <span class="text-danger">*</span></label>
              <div class="input-group">
                <input type="text" disabled name="barcode" value="<?php echo e(old('barcode')); ?>" class="form-control" id="barcode" aria-describedby="barcode_msg" placeholder="voucher number">
                <span class="input-group-addon"><i data-toggle="modal" data-target="#myModal" class="glyphicon glyphicon-list"></i></span>
              </div>
              <small id="barcode_msg" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
              <label for="quantity">Quantity <span class="text-danger">*</span></label>
              <input type="number" disabled name="quantity" value="<?php echo e(old('quantity')); ?>" class="form-control" id="quantity" aria-describedby="quantity" placeholder="Quantity">
              <small id="quantity_msg" class="form-text text-muted text-danger"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="purchase_price">Purchase Price <span class="text-danger">*</span></label>
              <input type="text" disabled readonly="readonly" name="purchase_price" value="<?php echo e(old('purchase_price')); ?>" class="form-control" id="purchase_price" aria-describedby="purchaseprice" placeholder="purchase price">
              <small id="purchaseprice" class="form-text text-muted text-danger"></small>
            </div>
            <div id="tile_attr"></div>
            
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <button disabled class="btn btn-primary" id="addItem">Add Item</button>
          </div>
        </div>
      </fieldset>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <fieldset>
        <legend>Items:</legend>
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
          <thead>
            <tr>
              <th>Id</th>
              <th>Item Name</th>
              <th>Purchase Price</th>
              <th>Sale Price</th>
              <th>Boxes</th>
              <th>Meter</th>
              <th>Action</th>
            </tr>
          </thead>
         <tbody id="items_append">
          
         </tbody>
        </table>
      </fieldset>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12" style="padding-top: 20px">
      <button disabled type="button" id="submit" class="btn btn-primary">Submit</button> <a href="<?php echo e(url('voucher/voucherlisting')); ?>" class="btn btn-default">Back</a>
    </div>
  </div>


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
<template id="tile_temp">
  
  <div class="form-group">
    <label for="meter">Meter Per Box<span class="text-danger">*</span></label>
    <input type="text" readonly="readonly" name="meter" value="" class="form-control" id="meter" aria-describedby="meter_msg" placeholder="Meter Per Box">
    <small id="meter_msg" class="form-text text-muted text-danger"></small>
  </div>
  <div class="form-group">
    <label for="pieces">Pieces Per Box<span class="text-danger">*</span></label>
    <input type="text" readonly="readonly" name="pieces" value="" class="form-control" id="pieces" aria-describedby="pieces_msg" placeholder="pieces Per Box">
    <small id="pieces_msg" class="form-text text-muted text-danger"></small>
  </div>
  <div class="form-group">
    <label for="totalMeter">totalMeter<span class="text-danger">*</span></label>
    <input type="text" readonly="readonly" name="totalMeter" class="form-control" id="totalMeter" aria-describedby="totalMeter_msg" placeholder="Total Meter">
    <small id="totalMeter_msg" class="form-text text-muted text-danger"></small>
  </div>
</template>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
  ##parent-placeholder-d7eb6b340a11a367a1bec55e4a421d949214759f##
  <!-- DataTables JavaScript -->
  <script src="<?php echo e(asset('js/dataTables/jquery.dataTables.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/dataTables/dataTables.bootstrap.min.js')); ?>"></script>
  <script>
      $(document).ready(function() {
          $('#dataTables-example').DataTable({
                  responsive: true,
          });
          $('#items-datatable').DataTable({
                  responsive: true,
          });
          $('[data-toggle="tooltip"]').tooltip();
          $(document).on('dblclick','#table-body',function(e){
            var barcode = $(e.target).closest('tr').find('td').eq(2).text();
            $('#barcode').val(barcode).trigger('blur');
            $('#myModal').modal('hide');
          });
      });
      
    $('#vendor_form').on('submit',function(e){
      e.preventDefault();
      var data = $(this).serialize();
      if($('#vendorvoucher').val() == ''){
        $('#vendor_voucher').text('This field is required');
      }else{
        $('#vendor_voucher').text('');
      } 
      if($('#voucher_date').val() == ''){
        $('#voucherdate').text('This field is required');
      }else{
        $('#voucherdate').text('');
      }
      if($('#supplier').val() == ''){
        $('#supplier_msg').text('This field is required');
      }else{
        $('#supplier_msg').text('');
      }
      if($('#vendorvoucher').val() != '' && $('#voucher_date').val() != '' && $('#supplier').val() != ''){
        $.ajax({
          url:"<?php echo e(url('voucher/addvoucher')); ?>",
          type:"post",
          dataType:"json",
          data:data,
          success:function(res){
            $.toast({
                heading: 'SUCCESS',
                text: 'Voucher Added Successfully',
                icon: 'success',
                position: 'top-right', 
                loader: true,        // Change it to false to disable loader
                loaderBg: '#9EC600'  // To change the background
            });
            $('#vouchernumber').val(res.id);
            $('#purchase_price').prop('disabled',false);
            $('#sale_price').prop('disabled',false);
            $('#barcode').prop('disabled',false);
            $('#quantity').prop('disabled',false);
            $('#addItem').prop('disabled',false);
          }
        });
      }
      
    });
    
    $("#vendorvoucher").on('blur',function(){
      var voucher = $(this).val();
      $.ajax({
        url:"<?php echo e(url('voucher/searchvoucher')); ?>",
        type:"post",
        dataType:"json",
        data:{voucher:voucher,_token:"<?php echo e(csrf_token()); ?>"},
        success:function(res){
          if(res != null){
            $('#vendor_voucher').text('Voucher already exsist');
            $('#save_vendor').prop('disabled',true);
          }else{
            $('#vendor_voucher').text('');
            $('#save_vendor').prop('disabled',false);
          }
          
        }
      });
    });
    $('#quantity').on('blur',function(){
      var totalMeter = $('#meter').val() * $(this).val();
      $('#totalMeter').val(totalMeter);
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
          if(res.message == 'item already added'){
            $('#barcode_msg').text(res.message);
            $('#addItem').prop('disabled',true);
          }else if(res.message == 'not found'){
            $('#purchase_price').val('');
            $('#sale_price').val('');
            $('#itemId').val('');
          }else{
            $('#purchase_price').val(res.purchase_price);
            $('#sale_price').val(res.sale_price);
            $('#itemId').val(res.id);
            $('#addItem').prop('disabled',false);
            $('#barcode_msg').text('');
            if(res.type == 'tile'){
              $('#tile_attr').html($('#tile_temp').html());
              /*$('#pieces').val(res.pieces);*/
              $('#meter').val(res.meter);
              $('#pieces').val(res.pieces);
            }
            
          }
        }
      });
    });
    $('#addItem').on('click',function(){
      var data  = {};
      data.itemId        = $('#itemId').val();
      data.quantity      = $('#quantity').val();
      data.voucherId     = $('#vouchernumber').val();
      data.purchasePrice = $('#purchase_price').val();
      data.pieces        = $('#pieces').val();
      data.type          = "purchase";
      data._token        = "<?php echo e(csrf_token()); ?>";
      if(data.quantity == ''){
        $('#quantity_msg').text('This field is required');
      }else{
        $('#quantity_msg').text('');
      } 
      if($('#purchase_price').val() == ''){
        $('#purchaseprice').text('This field is required');
      }else{
        $('#purchaseprice').text('');
      }
      if($('#barcode').val() == ''){
        $('#barcode_msg').text('This field is required');
      }else{
        $('#barcode_msg').text('');
      }
      if($('#sale_price').val() == ''){
        $('#saleprice').text('This field is required');
      }else{
        $('#saleprice').text('');
      }
      if(data.quantity != '' && $('purchase_price').val() != '' && $('sale_price').val() != ''){
        $.ajax({
          url:"<?php echo e(url('voucher/additem')); ?>",
          type:"post",
          dataType:"json",
          data:data,
          success:function(res){
            if(res != null){
              var template = "";
              for(var i = 0; i < res.length; i++){
                template += "<tr><td>"+res[i].item.id+"</td>";
                template += "<td>"+res[i].item.item_name+"</td>";
                template += "<td>"+res[i].item.purchase_price+"</td>";
                template += "<td>"+res[i].item.sale_price+"</td>";
                convertBoxPiece(res[i].qty,res[i].item.pieces,res[i].item.meter,function(box,pieces,meter){
                  template += "<td>"+box+"</td>";
                  template += "<td>"+meter+"</td>";
                });
                template +="<td><i class='glyphicon glyphicon-trash cursor' onclick='itemRemove("+res[i].id+","+data.voucherId+","+res[i].item.id+","+data.quantity+")'></i></td></tr>";
              }
              $.toast({
                  heading: 'SUCCESS',
                  text: 'Item Added Successfully',
                  icon: 'success',
                  position: 'top-right', 
                  loader: true,        // Change it to false to disable loader
                  loaderBg: '#9EC600'  // To change the background
              })
              $('#items_append').html(template);
              $('#itemId').val('');
              $('#barcode').val('');
              $('#quantity').val('');
              $('#purchase_price').val('');
              $('#sale_price').val('');
              $('#meter').val('');
              $('#pieces').val('');
              $('#totalMeter').val('');
              $('#submit').prop('disabled',false);
            }
          }
        });
      }
    })
    $("#submit").on('click',function(){
      var voucherId = $('#vouchernumber').val();
      $.ajax({
        url:"<?php echo e(url('voucher/savevoucher')); ?>",
        type:"post",
        data:{voucherId:voucherId,_token:"<?php echo e(csrf_token()); ?>"},
        dataType:"json",
        success:function(res){
          if(res != null){
            window.scrollTo(0, 0);
            $.toast({
                heading: 'SUCCESS',
                text: 'Voucher Added Successfully',
                icon: 'success',
                position: 'top-right', 
                loader: true,        // Change it to false to disable loader
                loaderBg: '#9EC600'  // To change the background
            })
            $('#purchase_price').val('');
            $('#sale_price').val('');
            $('#itemId').val('');
            $('#vouchernumber').val('');
            $('#vendorvoucher').val('');
            $('#barcode').val('');
            $('#quantity').val('');
            $('#items_append').html('<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty">No data available in table</td></tr>');
          }
          $('#purchase_price').prop('disabled',true);
          $('#sale_price').prop('disabled',true);
          $('#barcode').prop('disabled',true);
          $('#quantity').prop('disabled',true);
          $('#addItem').prop('disabled',true);
          $('#submit').prop('disabled',true);
        }
      });
    })
    function itemRemove(id,voucherId,itemId,qty){
      $.ajax({
        url: "<?php echo e(url('voucher/removeitem')); ?>",
        type:"post",
        datatype:"json",
        data:{id:id,voucherId:voucherId,itemId:itemId,qty:qty,_token:"<?php echo e(csrf_token()); ?>"},
        success:function(res){
          
          $.toast({
                  heading: 'INFORMATION',
                  text: 'Item Deleted Successfully',
                  icon: 'error',
                  position: 'top-right', 
                  loader: true,        // Change it to false to disable loader
                  loaderBg: '#9EC600'  // To change the background
              })
          var data = JSON.parse(res);
          if(data.message != 'empty'){
            var template = "";
            for(var i = 0; i < data.length; i++){
              template += "<tr><td>"+data[i].item.id+"</td>";
              template += "<td>"+data[i].item.item_name+"</td>";
              template += "<td>"+data[i].item.purchase_price+"</td>";
              template += "<td>"+data[i].item.sale_price+"</td>";
              template += "<td>"+data[i].qty+"</td>";
              convertBoxPiece(data[i].qty,data[i].item.pieces,data[i].item.meter,function(box,pieces,meter){
                  template += "<td>"+box+"</td>";
                  template += "<td>"+meter+"</td>";
                });
              template += "<td><i class='glyphicon glyphicon-trash cursor' onclick='itemRemove("+data[i].id+","+data[i].voucher_id+","+data[i].item_id+","+data[i].qty+")'></i></td></tr>";
            }
            $('#items_append').html(template);
          }else{
            $('#items_append').html('<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty">No data available in table</td></tr>')
          }
        }
      });
    }
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>