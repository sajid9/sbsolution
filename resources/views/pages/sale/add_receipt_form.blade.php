{{-- extend  --}}
@extends('layout.app2')
@extends('includes.header2')
@extends('includes.footer2')
@extends('includes.sidebar2')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Receipt')
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
@include('includes.alerts')
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
    <div class="col-md-5">
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
              <input type="text" tabindex="1" name="receipt_number" value="{{old('receipt_number')}}" class="form-control" id="receiptnumber" aria-describedby="receipt_number" placeholder="receipt number">
              <small id="receipt_number" class="form-text text-muted text-danger"></small>
            </div>
          </div>
          <div class="col-md-6">
           <div class="form-group">
              <label for="receipt_date">Receipt Date <span class="text-danger">*</span></label>
              <input type="date" name="receipt_date" value ="{{date('Y-m-d')}}" class="form-control" id="receipt_date" placeholder="Short Code" aria-describedby="receipt_date">
              <small id="receiptdate" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
              <label for="customer">Customer <span title="Add Customer" data-toggle="tooltip"><a data-toggle="modal" data-target="#createCustomer"> ( add Customer )</a></span></label>
              <select tabindex="2" name="customer" class="form-control customer-dropdown" id="customer" aria-describedby="customer">
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
          <div class="col-md-6">
            <div class="checkbox" style="margin-top:0px;">
              <label>
                <input type="checkbox" id="check" data-toggle="toggle" name="type" value="quotation" {{ (old('type') == 'quotation') ? 'checked' : '' }} data-on="Quotation" data-off="Sale">
              </label>
            </div>
          </div>
          <div class="col-md-6">
            <button type="submit" tabindex="3" class="btn btn-primary" id="save_receipt">Save Receipt</button>
          </div>
        </div>
        </form>
      </fieldset>
    </div>
    <div class="col-md-7">
      <fieldset>
        <legend>Add Item:</legend>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <input type="hidden" name="type" id="typ">
              <input type="hidden" name="item_id" id="itemId">
              <label for="barcode">Barcode <span class="text-danger">*</span></label>
              <div class="input-group">
                <input type="text" disabled="" tabindex="4"  name="barcode" value="{{old('barcode')}}" class="form-control" id="barcode" aria-describedby="barcode_msg" placeholder="voucher number">
                <span class="input-group-addon">
                  <span title="Load Item" data-toggle="tooltip"><i data-toggle="modal" data-target="#myModal" class="glyphicon glyphicon-list"></i></span>
                </span>
              </div>
              <small id="barcode_msg" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
              <label for="quantity"> Quantity <span class="text-danger">*</span></label>
              <input type="number" disabled="" tabindex="5"  name="quantity" value="{{old('quantity')}}" class="form-control" id="quantity" aria-describedby="quantity" placeholder="Quantity">
              <small id="quantity_msg" class="form-text text-muted text-danger"></small>
            </div>
            <div class="form-group">
              <label for="discount">Discount </label>
              <input type="text" disabled="" name="discount" value="{{old('discount')}}" class="form-control" id="discount" aria-describedby="discount_msg" placeholder="Discount">
              <small id="discount_msg" class="form-text text-muted text-danger">{{$errors->first('discount')}}</small>
            </div>
          </div>
          <div class="col-md-8">
            @if(env('TILE_MODULE') == 'yes')
            <div><img data-toggle="modal" data-target="#calculator" style="width: 22px; margin-bottom: 5px" src="{{ asset('images/Icon-calulator.png') }}" alt=""> <strong>Calculator</strong></div>
            @endif
            <table class="table" style="font-size: 12px">
            @if(env('TILE_MODULE') == 'yes')
            <tr>
              <td>Pieces Box:</td>
              <td id="pieces"></td>
              <td>Meter Box:</td>
              <td id="meter"></td>
            </tr>
            @endif
            <tr>
              <td>Sale Price:</td>
              <td id="sale_price"></td>
              <td>Total Price:</td>
              <td id="total_price"></td>
            </tr>
            <tr>
              <td>Discounted Price:</td>
              <td id="discounted_price"></td>
              <td>Total Discount:</td>
              <td id="total_discount"></td>
            </tr>
            <tr>
              <td>Discount (%):</td>
              <td id="discounted_meter"></td>
              <td></td>
              <td></td>
            </tr>
          </table>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <button disabled tabindex="6" class="btn btn-primary" id="addItem">Add Item</button><div id="box"></div>
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
      <button tabindex="7" disabled type="button" id="submit" class="btn btn-primary">Submit</button> <a href="{{url('sale/saleorder')}}" class="btn btn-default">Back</a>
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
            <tbody id="table-body">
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
  {{-- create customer modal --}}
  <div class="modal fade" id="createCustomer" role="dialog">
    <div class="modal-full">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Items</h4>
        </div>
        <div class="modal-body">
          <form method="post" action="{{url('customer/addcustomerreceipt')}}">
            @csrf
            <div class="row">
              <div class="form-group col-md-4">
                <label for="customername">Customer Name <span class="text-danger">*</span></label>
                <input type="text" autofocus="" name="customer_name" value="{{old('customer_name')}}" class="form-control" id="customername" aria-describedby="customername" placeholder="Customer name">
                <small id="customername" class="form-text text-muted text-danger">{{$errors->first('customer_name')}}</small>
              </div>
              <div class="form-group col-md-4">
                <label for="mobile">Mobile <span class="text-danger">*</span></label>
                <input type="text" name="mobile" value="{{old('mobile')}}" class="form-control" id="mobile" placeholder="Enter customer mobile" aria-describedby="mobile">
                <small id="mobile" class="form-text text-muted text-danger">{{$errors->first('mobile')}}</small>
              </div>
              <div class="form-group col-md-4">
                <label for="occupation">Occupation</label>
                <input type="occupation" name="occupation" value="{{old('occupation')}}" class="form-control" id="occupation" placeholder="Enter occupation" aria-describedby="occupation">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-4">
              <label for="standing_instruction">Standing Insruction</label>
              <input type="standing_instruction" name="standing_instruction" value="{{old('standing_instruction')}}" class="form-control" id="standing_instruction" placeholder="Enter standing instruction" aria-describedby="standing_instruction">
            </div>
            <div class="form-group col-md-4">
              <label for="email">Email</label>
              <input type="email" name="email" value="{{old('email')}}" class="form-control" id="email" placeholder="Enter customer email" aria-describedby="email">
            </div>
            <div class="form-group col-md-4">
              <label for="phone">Phone</label>
              <input type="text" name="phone" value="{{old('phone')}}" class="form-control" id="phone" placeholder="Enter customer phone" aria-describedby="phone">
            </div>
            </div>
            <div class="row">
            
            <div class="form-group col-md-4">
              <label for="website">Website</label>
              <input type="url" name="website" value="{{old('website')}}" class="form-control" id="website" placeholder="Enter customer website" aria-describedby="website">
            </div>
            <div class="form-group col-md-4">
              <label for="gst">GST</label>
              <input type="gst" name="gst" value="{{old('gst')}}" class="form-control" id="gst" placeholder="Enter GST" aria-describedby="gst">
            </div>
            <div class="form-group col-md-4">
              <label for="address">Address</label>
              <textarea class="form-control" name="address" id="address" rows="3" aria-describedby="address">{{old('address')}}</textarea>
            </div>
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button> <a href="{{url('customer/customerlisting')}}" class="btn btn-default">Back</a>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="calculator" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Items</h4>
        </div>
        <div class="modal-body">
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">Floor</a></li>
            <li><a data-toggle="tab" href="#advanceCal">Wall</a></li>
          </ul>

          <div class="tab-content" style="padding-top: 20px">
            <div id="home" class="tab-pane fade in active">
              <div class="row">
                <div class="form-group col-md-4">
                  <label for="length">Length<span class="text-danger">*</span></label>
                  <input type="text" name="length" value="{{old('length')}}" class="form-control" id="length" aria-describedby="length_msg" placeholder="Enter Length">
                  <small id="length_msg" class="form-text text-muted text-danger"></small>
                </div>
                <div class="form-group col-md-4">
                  <label for="width">Width<span class="text-danger">*</span></label>
                  <input type="text" name="width" value="{{old('width')}}" class="form-control" id="width" aria-describedby="width_msg" placeholder="Enter Width">
                  <small id="width_msg" class="form-text text-muted text-danger"></small>
                </div>
                <div class="form-group col-md-4">
                  <label for="tile">Tile<span class="text-danger">*</span></label>
                  <select name="tile" class="form-control" id="tile" aria-describedby="tile_msg">
                    <option value=""> Select Tile</option>
                    @foreach($items as $item)
                    @if($item->type == 'tile')
                    <option value="{{$item->id}}">{{$item->item_name}}</option>
                    @endif
                    @endforeach
                  </select>
                  <small id="tile_msg" class="form-text text-muted text-danger"></small>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <button class="btn btn-primary pull-right" id="cal">Calculate</button>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <h4>Calculations</h4>
                  <hr>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-3">
                  <label for="area_ft">Total Area ft<sup>2</sup></label>
                  <input type="text" readonly="" name="area_ft" value="{{old('area_ft')}}" class="form-control" id="area_ft" aria-describedby="area_ft_msg">
                  <small id="area_ft_msg" class="form-text text-muted text-danger"></small>
                </div>
                <div class="form-group col-md-3">
                  <label for="area_mt">Total Area m<sup>2</sup></label>
                  <input type="text" readonly="" name="area_mt" value="{{old('area_mt')}}" class="form-control" id="area_mt" aria-describedby="area_mt_msg">
                  <small id="area_mt_msg" class="form-text text-muted text-danger"></small>
                </div>
                <div class="form-group col-md-3">
                  <label for="boxes">No Boxes</label>
                  <input type="text" readonly="" name="boxes" value="{{old('boxes')}}" class="form-control" id="cal_boxes" aria-describedby="boxes_msg" >
                  <small id="boxes_msg" class="form-text text-muted text-danger"></small>
                </div>
                <div class="form-group col-md-3">
                  <label for="pieces">No pieces</label>
                  <input type="text" readonly="" name="pieces" value="{{old('pieces')}}" class="form-control" id="cal_pieces" aria-describedby="pieces_msg" >
                  <small id="pieces_msg" class="form-text text-muted text-danger"></small>
                </div>
              </div>
            </div>
            <div id="advanceCal" class="tab-pane fade">
              <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#dark">Dark</a></li>
                <li><a data-toggle="tab" href="#light">Light</a></li>
                <li><a data-toggle="tab" href="#motif">Motif</a></li>
              </ul>
              <div class="tab-content" style="padding-top: 20px">
                <div class="form-group">
                  <label for="tile">Tile<span class="text-danger">*</span></label>
                  <select name="tile" class="form-control" id="tile_advance" aria-describedby="tile_msg">
                    <option value=""> Select Tile</option>
                    @foreach($items as $item)
                    @if($item->type == 'tile')
                    <option value="{{$item->id}}">{{$item->item_name}}</option>
                    @endif
                    @endforeach
                  </select>
                  <small id="tile_msg" class="form-text text-muted text-danger"></small>
                </div>
                <div id="dark" class="tab-pane fade in active">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Walls</th>
                        <th>Height</th>
                        <th>Width</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th>Wall 1</th>
                        <td><input type="number" id="d_w1_height" name=""></td>
                        <td><input type="number" id="d_w1_width" name=""></td>
                        <td id="d_w1_total"></td>
                      </tr>
                      <tr>
                        <th>Wall 2</th>
                        <td><input type="number" id="d_w2_height" name=""></td>
                        <td><input type="number" id="d_w2_width" name=""></td>
                        <td id="d_w2_total"></td>
                      </tr>
                      <tr>
                        <th>Wall 3</th>
                        <td><input type="number" id="d_w3_height" name=""></td>
                        <td><input type="number" id="d_w3_width" name=""></td>
                        <td id="d_w3_total"></td>
                      </tr>
                      <tr>
                        <th>Wall 4</th>
                        <td><input type="number" id="d_w4_height" name=""></td>
                        <td><input type="number" id="d_w4_width" name=""></td>
                        <td id="d_w4_total"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div id="light" class="tab-pane fade in">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Walls</th>
                        <th>Height</th>
                        <th>Width</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th>Wall 1</th>
                        <td><input type="number" id="l_w1_height" name=""></td>
                        <td><input type="number" id="l_w1_width" name=""></td>
                        <td id="l_w1_total"></td>
                      </tr>
                      <tr>
                        <th>Wall 2</th>
                        <td><input type="number" id="l_w2_height" name=""></td>
                        <td><input type="number" id="l_w2_width" name=""></td>
                        <td id="l_w2_total"></td>
                      </tr>
                      <tr>
                        <th>Wall 3</th>
                        <td><input type="number" id="l_w3_height" name=""></td>
                        <td><input type="number" id="l_w3_width" name=""></td>
                        <td id="l_w3_total"></td>
                      </tr>
                      <tr>
                        <th>Wall 4</th>
                        <td><input type="number" id="l_w4_height" name=""></td>
                        <td><input type="number" id="l_w4_width" name=""></td>
                        <td id="l_w4_total"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div id="motif" class="tab-pane fade in">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Walls</th>
                        <th>Height</th>
                        <th>Width</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th>Wall 1</th>
                        <td><input type="number" id="m_w1_height" name=""></td>
                        <td><input type="number" id="m_w1_width" name=""></td>
                        <td id="m_w1_total"></td>
                      </tr>
                      <tr>
                        <th>Wall 2</th>
                        <td><input type="number" id="m_w2_height" name=""></td>
                        <td><input type="number" id="m_w2_width" name=""></td>
                        <td id="m_w2_total"></td>
                      </tr>
                      <tr>
                        <th>Wall 3</th>
                        <td><input type="number" id="m_w3_height" name=""></td>
                        <td><input type="number" id="m_w3_width" name=""></td>
                        <td id="m_w3_total"></td>
                      </tr>
                      <tr>
                        <th>Wall 4</th>
                        <td><input type="number" id="m_w4_height" name=""></td>
                        <td><input type="number" id="m_w4_width" name=""></td>
                        <td id="m_w4_total"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <span>Dark = <span id="dark_total"></span>, Light = <span id="light_total"></span></span>, Motif = <span id="motif_total"></span></span>
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
          $(document).on('dblclick','#table-body',function(e){
            var barcode = $(e.target).closest('tr').find('td').eq(2).text();
            $('#barcode').val(barcode).trigger('blur');
            $('#myModal').modal('hide');
          });
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
            $.toast({
                heading: 'SUCCESS',
                text: 'Receipt Added Successfully',
                icon: 'success',
                position: 'top-right', 
                loader: true,        // Change it to false to disable loader
                loaderBg: '#9EC600'  // To change the background
            })
            $('#receiptid').val(res.id);
            $('#sale_price').prop('disabled',false);
            $('#barcode').prop('disabled',false);
            $('#quantity').prop('disabled',false);
            $('#addItem').prop('disabled',false);
            $('#discount').prop('disabled',false);
            $('#discounted_price').prop('disabled',false);
            $('#total_price').prop('disabled',false);
            $('#quantity').val(1);
            $('#save_receipt').removeAttr('autofocus');
            $('#barcode').focus();
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
              $('#sale_price').text(res.sale_price);
              $('#total_price').text(res.sale_price);
              $('#discounted_price').text(res.sale_price);
              $('#itemId').val(res.id);
              $('#addItem').prop('disabled',false);
              $('#barcode_msg').text('');
              $('#typ').val(res.type);
              if(res.type == 'tile'){
                $('#meter').text(res.meter);
                $('#pieces').text(res.pieces);
              }else{
                $('#meter').text('');
                $('#pieces').text('');
                $('#box').html('');
              }
            }else{
              $('#sale_price').val('');
              $('#itemId').val('');
            }  
          }
        }
      });
    });
    $('#addItem').on('click',function(){
      var data  = {};
      data.itemId           = $('#itemId').val();
      data.quantity         = $('#quantity').val();
      data.receipt_id       = $('#receiptid').val();
      data.sale_price       = parseInt($('#sale_price').text());
      data.discounted_price = parseInt($('#discounted_price').text());
      data.total_price      = parseInt($('#total_price').text());
      data.pieces           = parseInt($('#pieces').text());
      data.type             = "sale";
      data._token           = "{{csrf_token()}}";
      if ($('#check').parent().hasClass('off'))
      {
        data.check = "sale";
      }else{
         data.check = "quotation";
      }
      if(data.quantity == ''){
        $('#quantity_msg').text('This field is required');
      }else{
        $('#quantity_msg').text('');
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
              $.toast({
                  heading: 'SUCCESS',
                  text: 'Item Added Successfully',
                  icon: 'success',
                  position: 'top-right', 
                  loader: true,        // Change it to false to disable loader
                  loaderBg: '#9EC600'  // To change the background
              })
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
              $('#quantity').val(1);
              $('#purchase_price').val('');
              $('#sale_price').val('');
              $('#discount').val('');
              $('#discounted_price').val('');
              $('#total_price').val('');
              $('#submit').prop('disabled',false);
              $('#barcode').focus();
            }
          }
        });
      }
    })
    $("#submit").on('click',function(){
      var receipt_id = $('#receiptid').val();
      if ($('#check').parent().hasClass('off'))
      {
        var check = "sale";
      }else{
        var check = "quotation";
      }
      $.ajax({
        url:"{{url('sale/savereceipt')}}",
        type:"post",
        data:{receipt_id:receipt_id,check:check,_token:"{{csrf_token()}}"},
        dataType:"json",
        success:function(res){
          
          if(res != null && check == "sale"){
            window.open(
              '{{url("payment/addsopayment")}}/'+res.id+'/'+res.total_amount+'/'+res.customer_id,'_blank');
            window.location.href = '{{ url('sale/addreceiptform') }}';
          }else{
            window.location.href = '{{url("sale/saleorder")}}';
          }
          
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
    $('#discount').on('blur',function(){
      var salePrice = parseInt($('#sale_price').text());
      var qty = $('#quantity').val();
      if(salePrice == '' || qty == ''){
        alert('please first fill the sale price and quantity field');
        $(this).val('');
      }else{
        var discount  = parseInt($(this).val());
        if($('#typ').val() == 'tile'){
          var meterBox  = parseFloat($('#meter').text());
          var piecesBox = parseInt($('#pieces').text());
          var onePiece  = meterBox / piecesBox;
          var totalMeter = (onePiece * qty).toFixed(2);
          var discountedPrice = parseInt(totalMeter * discount);
          var totalPrice = parseInt(totalMeter * salePrice);
          var givendiscount = parseInt(salePrice - discount);
          var totalDiscount = parseInt(totalPrice - discountedPrice);
          var dispercentage = parseInt(givendiscount * 100 / salePrice);
          $('#total_discount').text(totalDiscount);
        }else{
          @if(env('DiscountPerItem') == 'yes')
          var totalPrice      = qty * salePrice;
          var givendiscount   = parseInt(qty * discount); 
          var discountedPrice = totalPrice - givendiscount;
          var dispercentage   = parseInt(givendiscount * 100 / totalPrice);
          $('#total_discount').text(givendiscount);
          @else
          var totalPrice      = qty * salePrice;
          var givendiscount   = parseInt(totalPrice - discount); 
          var discountedPrice = totalPrice - discount;
          var dispercentage   = parseInt(discount * 100 / totalPrice);
          $('#total_discount').text(discount);
          @endif
        }
        
        $('#discounted_meter').text(dispercentage);
        $('#discounted_price').text(discountedPrice);
        $('#total_price').text(totalPrice);
      }
    });
    $('#quantity').on('blur',function(){
      var SalePieces = $(this).val();
      var SalePrice  = parseInt($('#sale_price').text());
      if($('#typ').val() == 'tile'){
        var meterBox   = parseFloat($('#meter').text());
        var piecesBox  = parseInt($('#pieces').text());
        var onePiece   = meterBox / piecesBox;
        var meter      = parseFloat(onePiece * SalePieces).toFixed(2);
        var totalPrice = meter * SalePrice;
        /*calculate the boxes and pieces from meter*/
        var boxes     = parseInt(SalePieces / piecesBox);
        var num       = piecesBox * boxes;
        var pieces    = SalePieces - num;
        $('#total_price').text(totalPrice);
        $('#discounted_price').text(totalPrice);
        $('#box').html('<h2>Total Meter '+meter+' Boxes '+boxes+' and '+pieces+' Pieces </h2>');
      }else{
        var totalPrice = SalePrice * SalePieces;
        $('#total_price').text(totalPrice);
        $('#discounted_price').text(totalPrice);
        $('#total_discount').text(0);

      }
      
    })
    var guest = '';
    $('.customer-dropdown').select2({
      width: '200px',
      ajax: {
          url: '{{url("customer/getcustomers")}}',
          dataType: 'json',
          processResults: function (data) {
            return {
              "results": data
            };
          }
      }
    });
    $(".customer-dropdown").select2("val","1");

    $('#receiptnumber').val(getCurrentDate()+"-{{CH::countReceipt()}}");
  /* calculator script*/
    $('#cal').on('click',function(){
      var length = $('#length').val();
      var width  = $('#width').val();
      var tile   = $('#tile').val();
      if (length == '' || width == '' || tile == '') {
        alert('please fill the length,width and tile field');
      }else{
        var totalFoot = length * width;
        var totalMeter = parseFloat(totalFoot / 10.764).toFixed(4);
        $.ajax({
          url:"{{url('item/getspecificitem')}}",
          type:"post",
          dataType:"json",
          data:{_token:"{{csrf_token()}}",id:tile},
          success:function(res){
            var meterPerPiece = res.meter / res.pieces;
            var totalpieces = parseInt(totalMeter / meterPerPiece);
            var boxes = parseInt(totalpieces / res.pieces);
            var boxpieces = boxes * res.pieces;
            var pieces = totalpieces - boxpieces;
            $("#area_ft").val(totalFoot);
            $("#area_mt").val(totalMeter);
            $("#cal_boxes").val(boxes);
            $("#cal_pieces").val(pieces);
            $("#barcode").val(res.barcode);
            $("#quantity").val(totalpieces);
          }
        });
      }
    })
    /*advance calculator script*/
    /*Dark tile Wall One Calculation*/
    $("#d_w1_width").on('blur',function(){
      var height = $("#d_w1_height").val();
      var width = $(this).val();
      var totalfoot = height * width;
      var totalmeter = parseFloat(totalfoot / 10.764).toFixed(3);
      $("#d_w1_total").text(totalmeter);
    })

    /*Dark tile Wall Two Calculation*/
    $("#d_w2_width").on('blur',function(){
      var height = $("#d_w2_height").val();
      var width = $(this).val();
      var totalfoot = height * width;
      var totalmeter = parseFloat(totalfoot / 10.764).toFixed(3);
      $("#d_w2_total").text(totalmeter);
    })
    /*Dark tile Wall Three Calculation*/
    $("#d_w3_width").on('blur',function(){
      var height = $("#d_w3_height").val();
      var width = $(this).val();
      var totalfoot = height * width;
      var totalmeter = parseFloat(totalfoot / 10.764).toFixed(3);
      $("#d_w3_total").text(totalmeter);
    })
    /*Dark tile Wall Four Calculation*/
    $("#d_w4_width").on('blur',function(){
      var height = $("#d_w4_height").val();
      var width = $(this).val();
      var totalfoot = height * width;
      var totalmeter = parseFloat(totalfoot / 10.764).toFixed(3);
      $("#d_w4_total").text(totalmeter);
      /*calculate total of dark*/
      var w1_meter = parseFloat($('#d_w1_total').text());
      var w2_meter = parseFloat($('#d_w2_total').text());
      var w3_meter = parseFloat($('#d_w3_total').text());
      var w4_meter = parseFloat($('#d_w4_total').text());
      var d_total  = parseFloat(w1_meter + w2_meter + w3_meter + w4_meter).toFixed(3);
      var tile = $('#tile_advance').val();
      $.ajax({
          url:"{{url('item/getspecificitem')}}",
          type:"post",
          dataType:"json",
          data:{_token:"{{csrf_token()}}",id:tile},
          success:function(res){
            var meterPerPiece = res.meter / res.pieces;
            var totalpieces = parseInt(d_total / meterPerPiece);
            var boxes = parseInt(totalpieces / res.pieces);
            var boxpieces = boxes * res.pieces;
            var pieces = totalpieces - boxpieces;
            $('#dark_total').text('boxes '+boxes+' pieces '+pieces+' Meter '+d_total);
          }
        });
      $('#dark_total').text(d_total);
    })
    /*end dark tile calculation script*/

    /*Light tile Wall One Calculation*/
    $("#l_w1_width").on('blur',function(){
      var height = $("#l_w1_height").val();
      var width = $(this).val();
      var totalfoot = height * width;
      var totalmeter = parseFloat(totalfoot / 10.764).toFixed(3);
      $("#l_w1_total").text(totalmeter);
    })

    /*Light tile Wall Two Calculation*/
    $("#l_w2_width").on('blur',function(){
      var height = $("#l_w2_height").val();
      var width = $(this).val();
      var totalfoot = height * width;
      var totalmeter = parseFloat(totalfoot / 10.764).toFixed(3);
      $("#l_w2_total").text(totalmeter);
    })
    /*Light tile Wall Three Calculation*/
    $("#l_w3_width").on('blur',function(){
      var height = $("#l_w3_height").val();
      var width = $(this).val();
      var totalfoot = height * width;
      var totalmeter = parseFloat(totalfoot / 10.764).toFixed(3);
      $("#l_w3_total").text(totalmeter);
    })
    /*Light tile Wall Four Calculation*/
    $("#l_w4_width").on('blur',function(){
      var height = $("#l_w4_height").val();
      var width = $(this).val();
      var totalfoot = height * width;
      var totalmeter = parseFloat(totalfoot / 10.764).toFixed(3);
      $("#l_w4_total").text(totalmeter);
      /*calculate total of light*/
      var w1_meter = parseFloat($('#l_w1_total').text());
      var w2_meter = parseFloat($('#l_w2_total').text());
      var w3_meter = parseFloat($('#l_w3_total').text());
      var w4_meter = parseFloat($('#l_w4_total').text());
      var l_total  = parseFloat(w1_meter + w2_meter + w3_meter + w4_meter).toFixed(3);
      var tile = $('#tile_advance').val();
      $.ajax({
          url:"{{url('item/getspecificitem')}}",
          type:"post",
          dataType:"json",
          data:{_token:"{{csrf_token()}}",id:tile},
          success:function(res){
            var meterPerPiece = res.meter / res.pieces;
            var totalpieces = parseInt(l_total / meterPerPiece);
            var boxes = parseInt(totalpieces / res.pieces);
            var boxpieces = boxes * res.pieces;
            var pieces = totalpieces - boxpieces;
            $('#light_total').text('boxes '+boxes+' pieces '+pieces+' Meter '+l_total);
          }
        });
    })
    /*end light tile calculation script*/

    /*motif tile Wall One Calculation*/
    $("#m_w1_width").on('blur',function(){
      var height = $("#m_w1_height").val();
      var width = $(this).val();
      var totalfoot = height * width;
      var totalmeter = parseFloat(totalfoot / 10.764).toFixed(3);
      $("#m_w1_total").text(totalmeter);
    })

    /*motif tile Wall Two Calculation*/
    $("#m_w2_width").on('blur',function(){
      var height = $("#m_w2_height").val();
      var width = $(this).val();
      var totalfoot = height * width;
      var totalmeter = parseFloat(totalfoot / 10.764).toFixed(3);
      $("#m_w2_total").text(totalmeter);
    })
    /*motif tile Wall Three Calculation*/
    $("#m_w3_width").on('blur',function(){
      var height = $("#m_w3_height").val();
      var width = $(this).val();
      var totalfoot = height * width;
      var totalmeter = parseFloat(totalfoot / 10.764).toFixed(3);
      $("#m_w3_total").text(totalmeter);
    })
    /*motif tile Wall Four Calculation*/
    $("#m_w4_width").on('blur',function(){
      var height = $("#m_w4_height").val();
      var width = $(this).val();
      var totalfoot = height * width;
      var totalmeter = parseFloat(totalfoot / 10.764).toFixed(3);
      $("#m_w4_total").text(totalmeter);
      /*calculate total of motif*/
      var w1_meter = parseFloat($('#m_w1_total').text());
      var w2_meter = parseFloat($('#m_w2_total').text());
      var w3_meter = parseFloat($('#m_w3_total').text());
      var w4_meter = parseFloat($('#m_w4_total').text());
      var m_total  = parseFloat(w1_meter + w2_meter + w3_meter + w4_meter).toFixed(3);
      var tile = $('#tile_advance').val();
      $.ajax({
          url:"{{url('item/getspecificitem')}}",
          type:"post",
          dataType:"json",
          data:{_token:"{{csrf_token()}}",id:tile},
          success:function(res){
            var meterPerPiece = res.meter / res.pieces;
            var totalpieces = parseInt(m_total / meterPerPiece);
            var boxes = parseInt(totalpieces / res.pieces);
            var boxpieces = boxes * res.pieces;
            var pieces = totalpieces - boxpieces;
            $('#motif_total').text('boxes '+boxes+' pieces '+pieces+' Meter '+m_total);
          }
        });
      
    })
  </script>
@endsection