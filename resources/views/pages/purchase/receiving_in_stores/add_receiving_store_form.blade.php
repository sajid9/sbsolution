{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

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
    <label for="total_qty">Total Quantity <span class="text-danger">*</span></label>
    <input type="text" readonly="" name="total_qty" value="{{Request::segment(5)}}" class="form-control" id="total_qty" aria-describedby="total_qty_msg">
    <small id="total_qty_msg" class="form-text text-muted text-danger">{{$errors->first('total_qty')}}</small>
  </div>
  <div class="form-group">
    <input type="hidden" name="receiving_id" value="{{Request::segment(6)}}">
    <input type="hidden" name="voucher" value="{{Request::segment(3)}}">
    <input type="hidden" name="item" value="{{Request::segment(4)}}">
    <label for="qty">Quantity <span class="text-danger">*</span></label>
    <input type="text" name="quantity" value="{{old('quantity')}}" class="form-control" id="qty" aria-describedby="qty_msg" placeholder="Receiving Quantity">
    <small id="qty_msg" class="form-text text-muted text-danger">{{$errors->first('quantity')}}</small>
  </div>
  <div class="form-group">
    <label for="store">Store <span class="text-danger">*</span></label>
    <select name="store" class="form-control" id="store" aria-describedby="store_msg">
      <option value="">Select Store</option>
      @foreach($stores as $store)
      <option value="{{$store->id}}">{{$store->name}}</option>
      @endforeach
    </select>
    <small id="store_msg" class="form-text text-muted text-danger">{{$errors->first('store')}}</small>
  </div>
  <div class="form-group">
    <label for="date">Date <span class="text-danger">*</span></label>
    <input type="date" name="date" value="{{old('date')}}" class="form-control" id="date" aria-describedby="date_msg" placeholder="Receiving Date">
    <small id="date_msg" class="form-text text-muted text-danger">{{$errors->first('date')}}</small>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="{{url('voucher/receivingstore/'.Request::segment(3).'/'.Request::segment(4).'/'.Request::segment(5))}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection