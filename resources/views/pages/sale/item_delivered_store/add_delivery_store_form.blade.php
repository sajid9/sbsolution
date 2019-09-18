{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

{{-- page titles --}}
@section('title', 'Receipt Delivery')
@section('pagetitle', 'Delivery from Store')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Add delivery from Store
</div>
<div class="panel-body">

{{-- form start  --}}
<form method="post" action="{{url('sale/adddeliverystore')}}">
	@csrf
  <?php $obj = CH::convert_box(Request::segment(5),$item->pieces,$item->meter);?>
  
  <div class="row">
  <div class="form-group col-md-4">
    <label for="total_qty">Total Pieces </label>
    <input type="text" readonly="" value="{{Request::segment(5)}}" class="form-control" id="total_qty" aria-describedby="total_qty_msg">
    <small id="total_qty_msg" class="form-text text-muted text-danger">{{$errors->first('total_qty')}}</small>
  </div>
  <div class="form-group col-md-4">
    <label for="total_boxes">Boxes </label>
    <input type="text" readonly="" value="{{$obj['boxes']}}" class="form-control" id="total_boxes">
  </div>
  <div class="form-group col-md-4" >
    <label for="total_boxes">Pieces </label>
    <input type="text" readonly="" value="{{$obj['pieces']}}" class="form-control" id="total_boxes">
  </div>
  </div>
  <div class="form-group">
    <label>Delivered Pieces </label>
    <input type="text" readonly="" value="{{($check->total == null)? 0 : $check->total}}" class="form-control" id="delivered_pieces">
  </div>
  <div class="row">
    <div class="form-group col-md-4">
    <input type="hidden" name="total_qty" value="{{Request::segment(5)}}">
    <input type="hidden" name="delivery_id" value="{{Request::segment(6)}}">
    <input type="hidden" name="receipt" value="{{Request::segment(3)}}">
    <input type="hidden" name="item" value="{{Request::segment(4)}}">
    <label for="qty">Delivery Pieces <span class="text-danger">*</span></label>
    <input type="text" autofocus="" tabindex="1" name="quantity" value="{{old('quantity')}}" class="form-control" id="qty" aria-describedby="qty_msg" placeholder="Receiving Quantity">
    <small id="qty_msg" class="form-text text-muted text-danger">{{$errors->first('quantity')}}</small>
  </div>
  <div class="form-group col-md-4">
    <label for="total_boxes">Boxes </label>
    <input type="text" readonly="" class="form-control" id="delivered_boxes">
  </div>
  <div class="form-group col-md-4" >
    <label for="total_boxes">Pieces </label>
    <input type="text" readonly=""  class="form-control" id="delivering_pieces">
  </div>
  </div>
  <div class="row">
    <div class="form-group col-md-6">
      <label for="store">Store <span class="text-danger">*</span></label>
      <select name="store" tabindex="2" class="form-control" id="store" aria-describedby="store_msg">
        <option value="">Select Store</option>
        @foreach($stores as $store)
        <option value="{{$store->id}}">{{$store->name}}</option>
        @endforeach
      </select>
      <small id="store_msg" class="form-text text-muted text-danger">{{$errors->first('store')}}</small>
    </div>
    <div class="form-group col-md-6">
      <label for="date">Date <span class="text-danger">*</span></label>
      <input type="date" tabindex="3" name="date" value="{{old('date')}}" class="form-control" id="date" aria-describedby="date_msg" placeholder="Receiving Date">
      <small id="date_msg" class="form-text text-muted text-danger">{{$errors->first('date')}}</small>
    </div>
  </div>
  
  <button type="submit" tabindex="4" id="submit" class="btn btn-primary">Submit</button> <a href="{{url('sale/storelisting/'.Request::segment(3).'/'.Request::segment(4).'/'.Request::segment(5)).'/'.Request::segment(6)}}" tabindex="5" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection
@section('footer')
@parent
<script> 
$('#qty').on('blur',function(){
  var delpieces   = parseInt($(this).val());
  var totalPieces = parseInt($('#total_qty').val());
  var piecesBox   =  parseInt("{{$item->pieces}}");
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
@endsection