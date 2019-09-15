{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

{{-- page titles --}}
@section('title', 'Receipt Delivery')
@section('pagetitle', 'Receipt Delivery')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Add Delivery
</div>
<div class="panel-body">

{{-- form start  --}}
<form method="post" action="{{url('sale/adddevlivery')}}">
	@csrf
  <div class="form-group">
    <label for="total_boxes">Total Pieces <span class="text-danger">*</span></label>
    <input type="text" readonly="" value="{{$item->qty}}" class="form-control" id="total_boxes">
  </div>
  <div class="row">
  <div class="form-group col-md-6">
    <label for="total_boxes">Boxes <span class="text-danger">*</span></label>
    <input type="text" readonly="" value="{{$item->qty / $item->item->pieces}}" class="form-control" id="total_boxes">
  </div>
  <div class="form-group col-md-6" >
    <label for="total_boxes">Pieces <span class="text-danger">*</span></label>
    <input type="text" readonly="" value="{{$item->qty - (($item->qty / $item->item->pieces) * $item->item->pieces)}}" class="form-control" id="total_boxes">
  </div>
  </div>
  <div class="form-group">
    <input type="hidden" name="receipt" value="{{Request::segment(3)}}">
    <input type="hidden" name="item" value="{{Request::segment(4)}}">
    <label for="receivingQty">Delivered Pieces <span class="text-danger">*</span></label>
    <input type="text" name="quantity" value="{{old('quantity')}}" class="form-control" id="receivingQty" aria-describedby="receivingQty_msg" placeholder="Delivered Pieces">
    <small id="receivingQty_msg" class="form-text text-muted text-danger">{{$errors->first('quantity')}}</small>
  </div>
  <div class="row">
  <div class="form-group col-md-6">
    <label for="total_boxes">Boxes <span class="text-danger">*</span></label>
    <input type="text" readonly="" class="form-control" id="delivered_boxes">
  </div>
  <div class="form-group col-md-6" >
    <label for="total_boxes">Pieces <span class="text-danger">*</span></label>
    <input type="text" readonly=""  class="form-control" id="delivered_pieces">
  </div>
  </div>
  <div class="form-group">
    <label for="date">Delivered Date <span class="text-danger">*</span></label>
    <input type="date" name="date" value="{{old('date')}}" class="form-control" id="date" aria-describedby="date_msg" placeholder="Receiving Date">
    <small id="date_msg" class="form-text text-muted text-danger">{{$errors->first('date')}}</small>
  </div>
  <button type="submit" id="submit" class="btn btn-primary">Submit</button> <a href="{{url('sale/deliverylisting/'.Request::segment(3).'/'.Request::segment(4))}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection
@section('footer')
@parent
<script>

$('#receivingQty').on('blur',function(){
  var deliveredPieces   =  parseInt($(this).val());
  var totalBoxes        =  parseInt($('#total_boxes').val());
  var piecesBox         =  parseInt("{{$item->item->pieces}}");
  var boxes             =  parseInt(deliveredPieces / piecesBox);
  var pieces            =  parseInt(deliveredPieces - (boxes * piecesBox));
  $('#delivered_boxes').val(boxes);
  $('#delivered_pieces').val(pieces);
  if(deliveredPieces > totalBoxes){
    $('#submit').attr('disabled',true);
    alert('Number of boxes should be less then total boxes');
  }else{
    $('#submit').attr('disabled',false);
  }
})

</script>
@endsection