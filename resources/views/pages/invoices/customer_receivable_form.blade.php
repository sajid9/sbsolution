{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Customer Receivable')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Customer Reveivable
</div>
<div class="panel-body">

{{-- form start  --}}
<form method="post" action="{{url('invoice/customerreceivableinvoice')}}">
	@csrf
  <div class="form-group">
    <label for="customer">Customer <span class="text-danger">*</span></label>
    <select name="customer_id" class="form-control" id="customer" aria-describedby="customer">
      <option value="">Select Customer</option>
      @foreach($customers as $customer)
      <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
      @endforeach
    </select>
    <small id="scustomer" class="form-text text-muted text-danger">{{$errors->first('customer_id')}}</small>
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button> <a href="{{url('category/categorylisting')}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection