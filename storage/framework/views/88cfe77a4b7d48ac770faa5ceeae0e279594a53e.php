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


<div class="alert alert-success alert-dismissible" id="alert" style="display: none">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> Voucher Update Successfully
</div>
  <div class="row">
    <div class="col-md-6">
      <fieldset>
        <legend>Add Item:</legend>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <input type="hidden" name="voucher_number" id="vouchernumber" value="<?php echo e($voucherId); ?>">
              <input type="hidden" name="item_id" id="itemId">
              <label for="barcode">Barcode <span class="text-danger">*</span></label>
              <div class="input-group">
                <input type="text" name="barcode" value="<?php echo e(old('barcode')); ?>" class="form-control" id="barcode" aria-describedby="barcode_msg" placeholder="voucher number">
                <span class="input-group-addon"><i data-toggle="modal" data-target="#myModal" class="glyphicon glyphicon-list"></i></span>
              </div>
              <small id="barcode_msg" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
              <label for="quantity">Quantity <span class="text-danger">*</span></label>
              <input type="number" name="quantity" value="<?php echo e(old('quantity')); ?>" class="form-control" id="quantity" aria-describedby="quantity" placeholder="voucher number">
              <small id="quantity_msg" class="form-text text-muted text-danger"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="purchase_price">Purchase Price <span class="text-danger">*</span></label>
              <input type="text" name="purchase_price" value="<?php echo e(old('purchase_price')); ?>" class="form-control" id="purchase_price" aria-describedby="purchaseprice" placeholder="purchase price">
              <small id="purchaseprice" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
              <label for="sale_price">Sale Price <span class="text-danger">*</span></label>
              <input type="text" name="sale_price" value="<?php echo e(old('sale_price')); ?>" class="form-control" id="sale_price" aria-describedby="saleprice" placeholder="sale price">
              <small id="saleprice" class="form-text text-muted text-danger"><?php echo e($errors->first('sale_price')); ?></small>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <button class="btn btn-primary" id="addItem">Add Item</button>
          </div>
        </div>
      </fieldset>
    </div>
     <div class="col-md-6">
      <fieldset>
        <legend>Voucher Detail:</legend>
        <div class="table-responsive">
          <table class="table" style="font-size: 12px">
            <tr>
              <td>Voucher No:</td>
              <td><?php echo e($voucher->id); ?></td>
              <td>Vendor Voucher No:</td>
              <td><?php echo e($voucher->voucher_no); ?></td>
            </tr>
            <tr>
              <td>Voucher Date:</td>
              <td><?php echo e($voucher->voucher_date); ?></td>
              <td>Amount:</td>
              <td><?php echo e($voucher->total_amount); ?></td>
            </tr>
            <tr>
              <td>Retun Item Amount:</td>
              <td><?php echo e($voucher->return_amount); ?></td>
              <td>Total Amount:</td>
              <td><?php echo e($voucher->total_amount); ?></td>
            </tr>
            <tr>
              <td>Paid Amount:</td>
              <td><?php echo e($voucher->paid_amount); ?></td>
              <td>Balance Amount:</td>
              <td><?php echo e($voucher->total_amount - ($voucher->return_amount + $voucher->paid_amount)); ?></td>
            </tr>
            <tr>
              <td>Supplier Name:</td>
              <td><?php echo e($supplier->supplier_name); ?></td>
              <td>Mobile:</td>
              <td><?php echo e($supplier->mobile); ?></td>
            </tr>
          </table>
        </div>
      </fieldset>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <fieldset>
        <legend>Purchased Items :</legend>
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
          <thead>
            <tr>
              <th>Id</th>
              <th>Item Name</th>
              <th>Purchase Price</th>
              <th>Sale Price</th>
              <th>Quantity</th>
              <th>Action</th>
            </tr>
          </thead>
         <tbody id="items_append">
          <?php $__currentLoopData = $purchase_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($item->id); ?></td>
              <td><?php echo e($item->item->item_name); ?></td>
              <td><?php echo e($item->item->purchase_price); ?></td>
              <td><?php echo e($item->item->sale_price); ?></td>
              <td><?php echo e($item->qty); ?></td>
              <td><a href="<?php echo e(url('voucher/receivinglisting/'.$item->voucher_id.'/'.$item->item_id)); ?>"><i class="glyphicon glyphicon-plus cursor" data-toggle="tooltip" title="voucher receive"></i></a></td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </tbody>
        </table>
      </fieldset>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <fieldset>
        <legend>Returned Items :</legend>
        <table class="table table-striped table-bordered table-hover" id="dataTables-return">
          <thead>
            <tr>
              <th>Id</th>
              <th>Item Name</th>
              <th>Purchase Price</th>
              <th>Sale Price</th>
              <th>Quantity</th>
              <th>Action</th>
            </tr>
          </thead>
         <tbody id="return_item">
          <?php $__currentLoopData = $return_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($item->id); ?></td>
              <td><?php echo e($item->item->item_name); ?></td>
              <td><?php echo e($item->item->purchase_price); ?></td>
              <td><?php echo e($item->item->sale_price); ?></td>
              <td><?php echo e($item->qty); ?></td>
              <td><a target="_blank" href="<?php echo e(url('invoice/purchasereturn/'.$voucherId)); ?>"><i class="fa fa-print" title="Print" data-toggle="tooltip"></i></a> <i class="glyphicon glyphicon-trash cursor" onclick='removeReturnItem("<?php echo e($item->id); ?>","<?php echo e($voucherId); ?>","<?php echo e($item->item->id); ?>","<?php echo e($item->qty); ?>")'></i></td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </tbody>
        </table>
      </fieldset>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12" style="padding-top: 20px">
      <button type="button" id="submit" class="btn btn-primary">Update</button> <a href="<?php echo e(url('voucher/voucherlisting')); ?>" class="btn btn-default">Back</a>
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
            <tbody>
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
  <!-- DataTables JavaScript -->
  <script src="<?php echo e(asset('js/dataTables/jquery.dataTables.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/dataTables/dataTables.bootstrap.min.js')); ?>"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script>
      $(document).ready(function() {
          $('#dataTables-example').DataTable({
                  responsive: true,
          });
          $('#items-datatable').DataTable({
                  responsive: true,
          });
          $('#dataTables-return').DataTable({
                  responsive: true,
                  dom: 'Bfrtip',
                  buttons: [
                      'copy', 'csv', 'excel', 'pdf', 'print'
                  ],
          });
          $('[data-toggle="tooltip"]').tooltip();
      });
    function returnItem(voucherId,itemId,qty,purchasePrice){
      $('#returnItem').modal('show');
      $('#t_qty').val(qty);
      $('#voucher_id').val(voucherId);
      $('#item_id').val(itemId);
      $('#purchase_price_modal').val(purchasePrice);
    } 
    
    
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
    $("#barcode").on('blur',function(){
      var barcode = $(this).val();
      var voucher_id = $('#vouchernumber').val();
      $.ajax({
        url:"<?php echo e(url('voucher/searchbarcode')); ?>",
        type:"post",
        dataType:"json",
        data:{barcode:barcode,voucher_id:voucher_id,_token:"<?php echo e(csrf_token()); ?>"},
        success:function(res){
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
            }else{
              $('#purchase_price').val('');
              $('#sale_price').val('');
              $('#itemId').val('');
            }  
          }
        }
      });
    });
    $('#addItem').on('click',function(){
      var data  = {};
      data.itemId         = $('#itemId').val();
      data.quantity       = $('#quantity').val();
      data.voucherId      = $('#vouchernumber').val();
      data.purchasePrice = $('#purchase_price').val();
      data.type           = "purchase";
      data._token         = "<?php echo e(csrf_token()); ?>";
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
                template += "<td>"+res[i].qty+"</td><td><i class='glyphicon glyphicon-share' onclick='returnItem("+res[i].voucher_id+","+res[i].item.id+","+res[i].qty+")'></i><i class='glyphicon glyphicon-trash cursor' onclick='itemRemove("+res[i].id+","+res[i].voucher_id+","+res[i].item.id+","+res[i].qty+")'></i></td></tr>";
              }

              $('#items_append').html(template);
              $('#itemId').val('');
              $('#barcode').val('');
              $('#quantity').val('');
              $('#purchase_price').val('');
              $('#sale_price').val('');
              $('#submit').prop('disabled',false);
            }
          }
        });
      }
    })
    $("#submit").on('click',function(){
      var voucherId = $('#vouchernumber').val();
      $.ajax({
        url:"<?php echo e(url('voucher/updatevoucher')); ?>",
        type:"post",
        data:{voucherId:voucherId,_token:"<?php echo e(csrf_token()); ?>"},
        dataType:"json",
        success:function(res){
          if(res != null){
            $('#alert').css('display','block');
          }
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
          var data = JSON.parse(res);
          if(data.message != 'empty'){
            var template = "";
            for(var i = 0; i < data.length; i++){
              template += "<tr><td>"+data[i].item.id+"</td>";
              template += "<td>"+data[i].item.item_name+"</td>";
              template += "<td>"+data[i].item.purchase_price+"</td>";
              template += "<td>"+data[i].item.sale_price+"</td>";
              template += "<td>"+data[i].qty+"</td><td><i class='glyphicon glyphicon-share'></i><i class='glyphicon glyphicon-trash cursor' onclick='itemRemove("+data[i].id+","+data[i].voucher_id+","+data[i].item_id+","+data[i].qty+")'></i></td></tr>";
            }
            $('#items_append').html(template);
          }else{
            $('#items_append').html('<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty">No data available in table</td></tr>')
          }
        }
      });
    }
    function removeReturnItem(id,voucherId,itemId,qty){
      $.ajax({
        url: "<?php echo e(url('voucher/removereturnitem')); ?>",
        type:"post",
        datatype:"json",
        data:{id:id,voucherId:voucherId,itemId:itemId,qty:qty,_token:"<?php echo e(csrf_token()); ?>"},
        success:function(res){
          var data = JSON.parse(res);
          if(data.message != 'empty'){
            var template = "";
            for(var i = 0; i < data.length; i++){
              template += "<tr><td>"+data[i].item.id+"</td>";
              template += "<td>"+data[i].item.item_name+"</td>";
              template += "<td>"+data[i].item.purchase_price+"</td>";
              template += "<td>"+data[i].item.sale_price+"</td>";
              template += "<td>"+data[i].qty+"</td><td><i class='glyphicon glyphicon-share'></i><i class='glyphicon glyphicon-trash cursor' onclick='itemRemove("+data[i].id+","+data[i].voucher_id+","+data[i].item_id+","+data[i].qty+")'></i></td></tr>";
            }
            $('#return_item').html(template);
          }else{
            $('#return_item').html('<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty">No data available in table</td></tr>')
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