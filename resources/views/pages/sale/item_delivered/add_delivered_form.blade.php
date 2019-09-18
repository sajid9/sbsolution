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
  <?php $obj = CH::convert_box($item->qty,$item->item->pieces,$item->item->meter);?>
  
  <div class="row">
    <div class="form-group col-md-4">
    <label for="total_boxes">Total Pieces </label>
    <input type="text" readonly="" value="{{$item->qty}}" class="form-control" id="total_boxes">
  </div>
  <div class="form-group col-md-4">
    <label for="total_boxes">Boxes </label>
    <input type="text" readonly="" value="{{$obj['boxes']}}" class="form-control" id="total_boxes">
  </div>
  <div class="form-group col-md-4">
    <label for="total_boxes">Pieces </label>
    <input type="text" readonly="" value="{{$obj['pieces']}}" class="form-control" id="total_boxes">
  </div>
  </div>
  <div class="form-group">
    <label>Delivered Pieces </label>
    <input type="text" readonly="" value="{{ ($check->total == null)? 0 : $check->total}}" class="form-control" id="delivered_pieces">
  </div>
  
  <div class="row">
    <div class="form-group col-md-4">
    <input type="hidden" name="receipt" value="{{Request::segment(3)}}">
    <input type="hidden" name="item" value="{{Request::segment(4)}}">
    <label for="receivingQty">Delivering Pieces <span class="text-danger">*</span></label>
    <input type="text" autofocus="" tabindex="1" name="quantity" value="{{old('quantity')}}" class="form-control" id="receivingQty" aria-describedby="receivingQty_msg" placeholder="Delivered Pieces">
    <small id="receivingQty_msg" class="form-text text-muted text-danger">{{$errors->first('quantity')}}</small>
  </div>
  <div class="form-group col-md-4">
    <label for="total_boxes">Boxes <span class="text-danger">*</span></label>
    <input type="text" readonly="" class="form-control" id="delivered_boxes">
  </div>
  <div class="form-group col-md-4" >
    <label for="total_boxes">Pieces <span class="text-danger">*</span></label>
    <input type="text" readonly=""  class="form-control" id="delivering_pieces">
  </div>
  </div>
  <div class="form-group">
    <label for="date">Delivered Date <span class="text-danger">*</span></label>
    <input type="date" tabindex="2" name="date" value="{{old('date')}}" class="form-control" id="date" aria-describedby="date_msg" placeholder="Receiving Date">
    <small id="date_msg" class="form-text text-muted text-danger">{{$errors->first('date')}}</small>
  </div>
  <button type="submit" tabindex="3" id="submit" class="btn btn-primary">Submit</button> <a href="{{url('sale/deliverylisting/'.Request::segment(3).'/'.Request::segment(4))}}" tabindex="4" class="btn btn-default">Back</a>
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
  
  var check = deliveredPieces + parseInt($('#delivered_pieces').val());
  if(check > totalBoxes){
    $('#submit').attr('disabled',true);
    alert('Number of delivering pieces should be less then total pieces total Pieces are '+totalBoxes+' and your are delivering '+check);
    $(this).val('');
  }else{
    $('#delivered_boxes').val(boxes);
    $('#delivering_pieces').val(pieces);
    $('#submit').attr('disabled',false);
  }
})

</script>
@endsection