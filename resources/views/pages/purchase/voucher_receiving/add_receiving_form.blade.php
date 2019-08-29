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
  <button type="submit" class="btn btn-primary">Submit</button> <a href="{{url('voucher/receivinglisting/'.Request::segment(3).'/'.Request::segment(4))}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection