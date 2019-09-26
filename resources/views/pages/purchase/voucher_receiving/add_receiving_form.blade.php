{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

{{-- page titles --}}
@section('title', 'Voucher Receiving')
@section('pagetitle', 'Voucher Receiving')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Add Receiving
</div>
<div class="panel-body">

{{-- form start  --}}
<form method="post" action="{{url('voucher/addreceiving')}}">
	@csrf
  <div class="form-group">
    <label for="total_boxes">Total Boxes </label>
    <input type="text" readonly="" value="{{(isset($item->item) && $item->item->type == 'tile') ? $item->qty / $item->item->pieces : $item->qty}}" class="form-control" id="total_boxes">
  </div>
  <div class="form-group">
    <label for="received_boxes">Received Boxes </label>
    <input type="text" readonly="" value="{{($item->item->type == 'tile')? $check->total / $item->item->pieces : $check->total}}" class="form-control" id="received_boxes">
  </div>
  <div class="form-group">
    <input type="hidden" name="voucher" value="{{Request::segment(3)}}">
    <input type="hidden" name="item" value="{{Request::segment(4)}}">
    <label for="receivingQty">Receiving Quantity <span class="text-danger">*</span></label>
    <input type="text" name="quantity" value="{{old('quantity')}}" class="form-control" id="receivingQty" aria-describedby="receivingQty_msg" placeholder="Receiving Quantity">
    <small id="receivingQty_msg" class="form-text text-muted text-danger">{{$errors->first('quantity')}}</small>
  </div>
  <div class="form-group">
    <label for="date">Receiving Date <span class="text-danger">*</span></label>
    <input type="date" name="date" value="{{old('date')}}" class="form-control" id="date" aria-describedby="date_msg" placeholder="Receiving Date">
    <small id="date_msg" class="form-text text-muted text-danger">{{$errors->first('date')}}</small>
  </div>
  <button type="submit" id="submit" class="btn btn-primary">Submit</button> <a href="{{url('voucher/receivinglisting/'.Request::segment(3).'/'.Request::segment(4))}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection
@section('footer')
@parent
<script> 
$('#receivingQty').on('blur',function(){
  var boxes      = parseInt($(this).val()) + parseInt($('#received_boxes').val());
  var totalBoxes = parseInt($('#total_boxes').val());
  if(boxes > totalBoxes){
    $(this).val('');
    $('#submit').attr('disabled',true);
    alert('Number of boxes should be less then total boxes');
  }else{
    $('#submit').attr('disabled',false);
  }
})

</script>
@endsection