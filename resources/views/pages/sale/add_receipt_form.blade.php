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
    Add New Receipt
</div>
<div class="panel-body">

{{-- form start  --}}
<div class="alert alert-success alert-dismissible" id="alert" style="display: none">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> Receipt Add Successfully
</div>
  <div class="row">
    <div class="col-md-6">
      <fieldset>
        <legend>Receipt:</legend>
          
        <form id="vendor_form">
          @csrf
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="vouchernumber">Receipt Id <span class="text-danger">*</span></label>
              <input type="text" readonly="readonly" name="receipt_id" value="{{old('receipt_id')}}" class="form-control" id="receiptid" aria-describedby="receipt_id" placeholder="receipt id">
              <small id="receipt_id" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
              <label for="receiptnumber">Receipt Number <span class="text-danger">*</span></label>
              <input type="text" name="receipt_number" value="{{old('receipt_number')}}" class="form-control" id="receiptnumber" aria-describedby="receipt_number" placeholder="receipt number">
              <small id="receipt_number" class="form-text text-muted text-danger"></small>
            </div>
          </div>
          <div class="col-md-6">
           <div class="form-group">
              <label for="receipt_date">Receipt Date <span class="text-danger">*</span></label>
              <input type="date" name="receipt_date" value="{{old('receipt_date')}}" class="form-control" id="receipt_date" placeholder="Short Code" aria-describedby="receipt_date">
              <small id="receiptdate" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
              <label for="customer">Customer </label>
              <select name="customer" class="form-control" id="customer" aria-describedby="customer">
                <option value="">Select Customer</option>
                @foreach($customers as $customer)
                <option value="{{$customer->id}}"> {{$customer->customer_name}}</option>
                @endforeach
              </select>
              <small id="customer_msg" class="form-text text-muted text-danger"></small>
            </div>
            
          </div>
          
        </div>
        <div class="row">
          <div class="col-md-12">
            <button type="submit" class="btn btn-primary" id="save_receipt">Save Receipt</button>
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
                <input type="text" disabled name="barcode" value="{{old('barcode')}}" class="form-control" id="barcode" aria-describedby="barcode_msg" placeholder="voucher number">
                <span class="input-group-addon"><i data-toggle="modal" data-target="#myModal" class="glyphicon glyphicon-list"></i></span>
              </div>
              <small id="barcode_msg" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
              <label for="quantity">Quantity <span class="text-danger">*</span></label>
              <input type="number" disabled name="quantity" value="{{old('quantity')}}" class="form-control" id="quantity" aria-describedby="quantity" placeholder="voucher number">
              <small id="quantity_msg" class="form-text text-muted text-danger"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="purchase_price">Purchase Price <span class="text-danger">*</span></label>
              <input type="text" disabled name="purchase_price" value="{{old('purchase_price')}}" class="form-control" id="purchase_price" aria-describedby="purchaseprice" placeholder="purchase price">
              <small id="purchaseprice" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
              <label for="sale_price">Sale Price <span class="text-danger">*</span></label>
              <input type="text" disabled name="sale_price" value="{{old('sale_price')}}" class="form-control" id="sale_price" aria-describedby="saleprice" placeholder="sale price">
              <small id="saleprice" class="form-text text-muted text-danger">{{$errors->first('sale_price')}}</small>
            </div>
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
              <th>Quantity</th>
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
      <button disabled type="button" id="submit" class="btn btn-primary">Submit</button> <a href="{{url('item/itemlisting')}}" class="btn btn-default">Back</a>
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
</div>
</div>
@endsection
@section('footer')
  @parent
  <!-- DataTables JavaScript -->
  <script src="{{asset('js/dataTables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('js/dataTables/dataTables.bootstrap.min.js')}}"></script>
  <script>
      $(document).ready(function() {
          $('#dataTables-example').DataTable({
                  responsive: true,
          });
          $('#items-datatable').DataTable({
                  responsive: true,
          });
          $('[data-toggle="tooltip"]').tooltip();
      });
      
    $('#vendor_form').on('submit',function(e){
      e.preventDefault();
      var data = $(this).serialize();
       
      if($('#receiptnumber').val() == ''){
        $('#receipt_number').text('This field is required');
      }else{
        $('#receipt_number').text('');
      } 
      if($('#receipt_date').val() == ''){
        $('#receiptdate').text('This field is required');
      }else{
        $('#receiptdate').text('');
      }
      if($('#customer').val() == ''){
        $('#customer_msg').text('This field is required');
      }else{
        $('#customer_msg').text('');
      }
      if($('#receiptnumber').val() != '' && $('#receipt_date').val() != '' && $('#customer').val() != ''){
        $.ajax({
          url:"{{url('sale/addreceipt')}}",
          type:"post",
          dataType:"json",
          data:data,
          success:function(res){
            $('#receiptid').val(res.id);
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
      data.receipt_id = $('#receiptid').val();
      data.type      = "sale";
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
          url:"{{url('sale/additem')}}",
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
                template += "<td>"+res[i].qty+"</td><td><i class='glyphicon glyphicon-trash cursor' onclick='itemRemove("+data.voucherId+","+res[i].item.id+","+data.quantity+")'></i></td></tr>";
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
      var receipt_id = $('#receiptid').val();
      $.ajax({
        url:"{{url('sale/savereceipt')}}",
        type:"post",
        data:{receipt_id:receipt_id,_token:"{{csrf_token()}}"},
        dataType:"json",
        success:function(res){
          if(res != null){
            window.location.href = '{{url("payment/addsopayment")}}/'+res.id+'/'+res.total_amount+'/'+res.customer_id;
            $('#alert').css('display','block');
            $('#purchase_price').val('');
            $('#sale_price').val('');
            $('#itemId').val('');
            $('#receiptid').val('');
            $('#receiptnumber').val('');
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
    function itemRemove(voucherId,itemId,qty){
      $.ajax({
        url: "{{url('voucher/removeitem')}}",
        type:"post",
        datatype:"json",
        data:{voucherId:voucherId,itemId:itemId,qty:qty,_token:"{{csrf_token()}}"},
        success:function(res){
          var data = JSON.parse(res);
          if(data.message != 'empty'){
            var template = "";
            for(var i = 0; i < data.length; i++){
              template += "<tr><td>"+data[i].item.id+"</td>";
              template += "<td>"+data[i].item.item_name+"</td>";
              template += "<td>"+data[i].item.purchase_price+"</td>";
              template += "<td>"+data[i].item.sale_price+"</td>";
              template += "<td>"+data[i].qty+"</td><td><i class='glyphicon glyphicon-trash cursor' onclick='itemRemove("+data[i].voucher_id+","+data[i].item_id+","+data[i].qty+")'></i></td></tr>";
            }
            $('#items_append').html(template);
          }else{
            $('#items_append').html('<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty">No data available in table</td></tr>')
          }
        }
      });
    }
  </script>
@endsection