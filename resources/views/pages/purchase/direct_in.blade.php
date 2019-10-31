{{-- extend  --}}
@extends('layout.app2')
@extends('includes.header2')
@extends('includes.footer2')
@extends('includes.sidebar2')

{{-- page titles --}}
@section('title', 'Direct In')
@section('pagetitle', 'Direct In')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Direct In Item
</div>
<div class="panel-body">
@include('includes.alerts')


{{-- form start  --}}
<form method="post" action="{{url('voucher/saveitem')}}">
	@csrf
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <input type="hidden" name="item_id" id="itemId">
        <label for="barcode">Barcode <span class="text-danger">*</span></label>
        <div class="input-group">
          <input type="text"  name="barcode" value="{{old('barcode')}}" class="form-control" id="barcode" aria-describedby="barcode_msg" placeholder="voucher number">
          <span class="input-group-addon"><i data-toggle="modal" data-target="#myModal" class="glyphicon glyphicon-list"></i></span>
        </div>
        <small id="barcode_msg" class="form-text text-muted text-danger">{{$errors->first('item_id')}}</small>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="store">Store <span class="text-danger">*</span></label>
        <select name="store" class="form-control" id="store" aria-describedby="store">
          <option value="">Select store</option>
          @foreach($stores as $store)
            <option value="{{$store->id}}">{{ $store->name}}</option>
          @endforeach
        </select>
        <small id="store" class="form-text text-muted text-danger">{{$errors->first('store')}}</small>
      </div>
    </div>
  </div>
  <div id="bp" style="display: none">
    <div class="row">
      <div class="form-group col-md-6">
      <input type="hidden" id="meter_per_box">
      <input type="hidden" id="piece_in_box">
       <label for="boxes">Boxes<span class="text-danger">*</span></label>
       <input type="number" name="boxes" value="{{old('boxes')}}" class="form-control" id="boxes" placeholder="Boxes" aria-describedby="boxes_msg">
       <small id="boxes_msg" class="form-text text-muted text-danger">{{$errors->first('boxes')}}</small>
     </div>
     <div class="form-group col-md-6">
       <label for="pieces">Pieces<span class="text-danger">*</span></label>
       <input type="number" name="pieces" value="{{old('pieces')}}" class="form-control" id="pieces" placeholder="Pieces" aria-describedby="pieces_msg">
       <small id="pieces_msg" class="form-text text-muted text-danger">{{$errors->first('pieces')}}</small>
     </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label for="total_meter">Total Meter</label>
          <input type="number" step="any" readonly="" name="quantity" value="{{old('quantity')}}" class="form-control" id="meter" placeholder="Opening Item" aria-describedby="total_meter_msg">
          <small id="total_meter_msg" class="form-text text-muted text-danger">{{$errors->first('quantity')}}</small>
        </div>
      </div>
     
    </div>
  </div>
  <div class="form-group" id="op" style="display: none">
    <label for="cal_open">Opening Item <span class="text-danger">*</span></label>
    <input type="number" name="cal_open" value="{{old('cal_open')}}" class="form-control" id="cal_open" placeholder="Opening Item" aria-describedby="cal_open_msg">
    <small id="cal_open_msg" class="form-text text-muted text-danger">{{$errors->first('cal_open')}}</small>
  </div>
  <div class="form-group">
    <label for="total_pieces">Total Pieces</label>
    <input type="number" step="any" readonly="" name="quantity" value="{{old('quantity')}}" class="form-control" id="opening" placeholder="Opening Item" aria-describedby="total_pieces_msg">
    <small id="total_pieces_msg" class="form-text text-muted text-danger">{{$errors->first('quantity')}}</small>
  </div>
  <button type="submit"  class="btn btn-primary" id="addItem">Add Item</button> <a href="{{url('/')}}" class="btn btn-default">Back</a>
</form>
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
</div>
</div>
@endsection
@section('footer')
@parent
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

@endsection