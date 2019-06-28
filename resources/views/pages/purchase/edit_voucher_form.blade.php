{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Dashboard')
@section('header')
@parent
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
@endsection
@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Add New Voucher
</div>
<div class="panel-body">

{{-- form start  --}}
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
              <input type="hidden" name="voucher_number" id="vouchernumber" value="{{$voucherId}}">
              <input type="hidden" name="item_id" id="itemId">
              <label for="barcode">Barcode <span class="text-danger">*</span></label>
              <div class="input-group">
                <input type="text" name="barcode" value="{{old('barcode')}}" class="form-control" id="barcode" aria-describedby="barcode_msg" placeholder="voucher number">
                <span class="input-group-addon"><i data-toggle="modal" data-target="#myModal" class="glyphicon glyphicon-list"></i></span>
              </div>
              <small id="barcode_msg" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
              <label for="quantity">Quantity <span class="text-danger">*</span></label>
              <input type="number" name="quantity" value="{{old('quantity')}}" class="form-control" id="quantity" aria-describedby="quantity" placeholder="voucher number">
              <small id="quantity_msg" class="form-text text-muted text-danger"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="purchase_price">Purchase Price <span class="text-danger">*</span></label>
              <input type="text" name="purchase_price" value="{{old('purchase_price')}}" class="form-control" id="purchase_price" aria-describedby="purchaseprice" placeholder="purchase price">
              <small id="purchaseprice" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
              <label for="sale_price">Sale Price <span class="text-danger">*</span></label>
              <input type="text" name="sale_price" value="{{old('sale_price')}}" class="form-control" id="sale_price" aria-describedby="saleprice" placeholder="sale price">
              <small id="saleprice" class="form-text text-muted text-danger">{{$errors->first('sale_price')}}</small>
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
              <td>{{$voucher->id}}</td>
              <td>Vendor Voucher No:</td>
              <td>{{$voucher->voucher_no}}</td>
            </tr>
            <tr>
              <td>Voucher Date:</td>
              <td>{{$voucher->voucher_date}}</td>
              <td>Amount:</td>
              <td>{{$voucher->total_amount}}</td>
            </tr>
            <tr>
              <td>Retun Item Amount:</td>
              <td>{{$voucher->return_amount}}</td>
              <td>Total Amount:</td>
              <td>{{$voucher->total_amount}}</td>
            </tr>
            <tr>
              <td>Paid Amount:</td>
              <td>{{$voucher->paid_amount}}</td>
              <td>Balance Amount:</td>
              <td>{{$voucher->total_amount - ($voucher->return_amount + $voucher->paid_amount)}}</td>
            </tr>
            <tr>
              <td>Supplier Name:</td>
              <td>{{$supplier->supplier_name}}</td>
              <td>Mobile:</td>
              <td>{{$supplier->mobile}}</td>
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
          @foreach($purchase_items as $item)
            <tr>
              <td>{{$item->id}}</td>
              <td>{{$item->item->item_name}}</td>
              <td>{{$item->item->purchase_price}}</td>
              <td>{{$item->item->sale_price}}</td>
              <td>{{$item->qty}}</td>
              <td><i class="glyphicon glyphicon-share" onclick="returnItem('{{$voucherId}}','{{$item->item->id}}','{{$item->qty}}')"></i><i class="glyphicon glyphicon-trash cursor" onclick='itemRemove("{{$item->id}}","{{$voucherId}}","{{$item->item->id}}","{{$item->qty}}")'></i></td>
            </tr>
          @endforeach
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
          @foreach($return_items as $item)
            <tr>
              <td>{{$item->id}}</td>
              <td>{{$item->item->item_name}}</td>
              <td>{{$item->item->purchase_price}}</td>
              <td>{{$item->item->sale_price}}</td>
              <td>{{$item->qty}}</td>
              <td><a href="{{url('invoice/purchasereturn/'.$voucherId)}}"><i class="fa fa-print" title="Print" data-toggle="tooltip"></i></a> <i class="glyphicon glyphicon-trash cursor" onclick='removeReturnItem("{{$item->id}}","{{$voucherId}}","{{$item->item->id}}","{{$item->qty}}")'></i></td>
            </tr>
          @endforeach
         </tbody>
        </table>
      </fieldset>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12" style="padding-top: 20px">
      <button type="button" id="submit" class="btn btn-primary">Update</button> <a href="{{url('item/itemlisting')}}" class="btn btn-default">Back</a>
    </div>
  </div>

{{-- form end --}}
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
              @foreach($items as $item)
              <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->item_name}}</td>
                <td>{{$item->barcode}}</td>
                <td>{{$item->purchase_price}}</td>
                <td>{{$item->sale_price}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  <div class="modal fade" id="returnItem" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Items</h4>
        </div>
        <div class="modal-body">
          <form id="return_form">
            @csrf
            <input type="hidden" name="voucher_id" id="voucher_id">
            <input type="hidden" name="item_id" id="item_id">
            <div class="form-group">
              <label for="t_qty">Total Quantity</label>
              <input type="number" name="total_quantity" disabled="disabled" class="form-control" id="t_qty">
            </div>
            <div class="form-group">
              <label for="qty">Quantity</label>
              <input type="number" name="quantity" class="form-control" id="qty" placeholder="Enter the quantity to return">
              <small id="qty_msg" class="form-text text-muted text-danger"></small>
            </div>
            <button type="submit" id="qty_sub" class="btn btn-default">Submit</button>
          </form>
        </div>
      </div>
      
    </div>
  </div>
</div>
</div>
@endsection
@section('footer')
  @parent
  <!-- DataTables JavaScript -->
  <script src="{{asset('js/dataTables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('js/dataTables/dataTables.bootstrap.min.js')}}"></script>
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
    function returnItem(voucherId,itemId,qty){
      $('#returnItem').modal('show');
      $('#t_qty').val(qty);
      $('#voucher_id').val(voucherId);
      $('#item_id').val(itemId);
    } 
    $('#qty').on('keyup',function(){
      var total_qty = parseInt($('#t_qty').val());
      var qty = parseInt($('#qty').val());
      if(qty > total_qty){
        $('#qty_msg').text('Quantity should be less then total quantity');
        $('#qty_sub').prop('disabled',true);
      }else{
        $('#qty_msg').text('');
        $('#qty_sub').prop('disabled',false);
      }
    })
    $('#return_form').on('submit',function(e){
      e.preventDefault();
      var data = $(this).serialize();
      $.ajax({
        url:"{{url('voucher/returnitem')}}",
        type:"post",
        dataType:"json",
        data:data,
        success:function(res){
          if(res !== null){
            $('#return_form')[0].reset();
            $('#returnItem').modal('hide');
             var template = "";
              for(var i = 0; i < res.length; i++){
                template += "<tr><td>"+res[i].item.id+"</td>";
                template += "<td>"+res[i].item.item_name+"</td>";
                template += "<td>"+res[i].item.purchase_price+"</td>";
                template += "<td>"+res[i].item.sale_price+"</td>";
                template += "<td>"+res[i].qty+"</td><td><i class='glyphicon glyphicon-trash cursor' onclick='removeReturnItem("+res[i].id+","+res[i].voucher_id+","+res[i].item.id+","+res[i].qty+")'></i></td></tr>";
              }

              $('#return_item').html(template);
          }
        }
      });
    })
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
          url:"{{url('voucher/addvoucher')}}",
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
        url:"{{url('voucher/searchvoucher')}}",
        type:"post",
        dataType:"json",
        data:{voucher:voucher,_token:"{{csrf_token()}}"},
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
        url:"{{url('voucher/searchbarcode')}}",
        type:"post",
        dataType:"json",
        data:{barcode:barcode,voucher_id:voucher_id,_token:"{{csrf_token()}}"},
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
      data.itemId    = $('#itemId').val();
      data.quantity  = $('#quantity').val();
      data.voucherId = $('#vouchernumber').val();
      data.type      = "purchase";
      data._token    = "{{csrf_token()}}";
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
          url:"{{url('voucher/additem')}}",
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
        url:"{{url('voucher/updatevoucher')}}",
        type:"post",
        data:{voucherId:voucherId,_token:"{{csrf_token()}}"},
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
        url: "{{url('voucher/removeitem')}}",
        type:"post",
        datatype:"json",
        data:{id:id,voucherId:voucherId,itemId:itemId,qty:qty,_token:"{{csrf_token()}}"},
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
        url: "{{url('voucher/removereturnitem')}}",
        type:"post",
        datatype:"json",
        data:{id:id,voucherId:voucherId,itemId:itemId,qty:qty,_token:"{{csrf_token()}}"},
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
@endsection