{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Payment')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Add Payment
</div>
<div class="panel-body">

{{-- form start  --}}
<form method="post" action="{{url('payment/addpaymentsale')}}">
	@csrf
  <input type="hidden" name="type" value="SO">
  <input type="hidden" name="voucher" value="">
  <input type="hidden" name="receipt" value="{{$receipt->id}}">
  <div class="form-group">
    <label for="receipt_no">Receipt No</label>
    <input type="text" value="{{$receipt->receipt_no}}" readOnly class="form-control" id="receipt_no">
  </div>
  <div class="form-group">
    <label for="receipt_no">Customer</label>
    <input type="text" value="{{$customer->customer_name}}" readOnly class="form-control" id="receipt_no">
  </div>
  <div class="form-group">
    <label for="receipt_no">Total Amount</label>
    <input type="text" value="{{$total}}" readOnly class="form-control" id="receipt_no">
  </div>
  <div class="form-group">
    <label for="amount">Amount <span class="text-danger">*</span></label>
    <input type="number" name="amount" value="{{old('amount')}}" class="form-control" id="amount" aria-describedby="amount" placeholder="enter the amount">
    <small id="amount" class="form-text text-muted text-danger">{{$errors->first('amount')}}</small>
  </div>
  <div class="form-group">
    <label for="method">Method</label>
    <select name="method" class="form-control" id="method" aria-describedby="method">
      <option value=""> Select Method</option>
      <option value="cheque"> Cheque</option>
      <option value="cash"> Chash</option>
    </select>
    <small id="method" class="form-text text-muted text-danger">{{$errors->first('method')}}</small>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button> <a href="{{url('payment/paymentlisting')}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection
