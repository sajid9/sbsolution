{{-- extend  --}}
@extends('layout.app2')
@extends('includes.header2')
@extends('includes.footer2')
@extends('includes.sidebar2')

{{-- page titles --}}
@section('title', 'Voucher Receiving')
@section('pagetitle', 'Receiving to Store')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Add Receiving to Store
</div>
<div class="panel-body">

{{-- form start  --}}
<form method="post" action="{{url('voucher/addreceivingstore')}}">
	@csrf
  <div class="form-group">
    <label for="total_qty">Total Quantity </label>
    <input type="text" readonly="" value="{{($item->type == 'tile') ? Request::segment(5) / $item->pieces : Request::segment(5)}}" class="form-control" id="total_qty" aria-describedby="total_qty_msg">
    <small id="total_qty_msg" class="form-text text-muted text-danger">{{$errors->first('total_qty')}}</small>
  </div>
  <div class="form-group">
    <label for="received_qty">Received Quantity </label>
    <input type="text" readonly="" value="{{ ($item->type == 'tile') ? $check->total / $item->pieces : $check->total}}" class="form-control" id="received_qty" aria-describedby="received_qty_msg">
    <small id="received_qty_msg" class="form-text text-muted text-danger">{{$errors->first('received_qty')}}</small>
  </div>
  <div class="form-group">

    <input type="hidden" name="total_qty" value="{{Request::segment(5)}}">
    <input type="hidden" name="receiving_id" value="{{Request::segment(6)}}">
    <input type="hidden" name="voucher" value="{{Request::segment(3)}}">
    <input type="hidden" name="item" value="{{Request::segment(4)}}">
    <label for="qty">Quantity <span class="text-danger">*</span></label>
    <input type="text" autofocus="" tabindex="1" name="quantity" value="{{old('quantity')}}" class="form-control" id="qty" aria-describedby="qty_msg" placeholder="Receiving Quantity">
    <small id="qty_msg" class="form-text text-muted text-danger">{{$errors->first('quantity')}}</small>
  </div>
  <div class="form-group">
    <label for="store">Store <span class="text-danger">*</span></label>
    <select name="store" tabindex="2" class="form-control" id="store" aria-describedby="store_msg">
      <option value="">Select Store</option>
      @foreach($stores as $store)
      <option value="{{$store->id}}">{{$store->name}}</option>
      @endforeach
    </select>
    <small id="store_msg" class="form-text text-muted text-danger">{{$errors->first('store')}}</small>
  </div>
  <div class="form-group">
    <label for="date">Date <span class="text-danger">*</span></label>
    <input type="date" tabindex="3" name="date" value="{{old('date')}}" class="form-control" id="date" aria-describedby="date_msg" placeholder="Receiving Date">
    <small id="date_msg" class="form-text text-muted text-danger">{{$errors->first('date')}}</small>
  </div>
  <button type="submit" id="submit" tabindex="4" class="btn btn-primary">Submit</button> <a href="{{url('voucher/receivingstore/'.Request::segment(3).'/'.Request::segment(4).'/'.Request::segment(5)).'/'.Request::segment(6)}}" tabindex="5" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection
@section('footer')
@parent
<script> 
$('#qty').on('blur',function(){
  var boxes      = parseInt($(this).val()) + parseInt($('#received_qty').val());
  var totalBoxes = parseInt($('#total_qty').val());
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