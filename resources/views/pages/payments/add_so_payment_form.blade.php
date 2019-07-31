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
  <input type="hidden" name="receipt" value="{{$receipt->id}}">
  <div class="form-group">
    <label for="receipt_no">Receipt No</label>
    <input type="text" value="{{$receipt->receipt_no}}" readOnly class="form-control" id="receipt_no">
  </div>
  <div class="form-group">
    <label for="receipt_no">Customer</label>
    <input type="hidden" name="customer" value="{{$customer->id}}">
    <input type="text" value="{{$customer->customer_name}}" readOnly class="form-control" id="receipt_no">
  </div>
  <div class="form-group">
    <label for="receipt_no">Total Amount</label>
    <input type="number" value="{{$total}}" readOnly class="form-control" id="total_amount">
  </div>
  <div class="form-group">
    <label for="amount">Amount <span class="text-danger">*</span></label>
    <input type="number" name="amount" value="{{old('amount')}}" class="form-control" id="amount" aria-describedby="amount_msg" placeholder="enter the amount">
    <small id="amount_msg" class="form-text text-muted text-danger">{{$errors->first('amount')}}</small>
  </div>
  <div class="form-group">
    <label for="account">Account</label>
    <select name="account" class="form-control" id="account" aria-describedby="account_msg">
      <option value=""> Select Account</option>
       @foreach($accounts as $account)
      <option value="{{$account->id}}">{{$account->account_title}}</option>
      @endforeach
    </select>
    <small id="account_msg" class="form-text text-muted text-danger">{{$errors->first('account')}}</small>
  </div>
  <div class="form-group">
    <label for="fn_year">Fianancial Year</label>
    <select name="fn_year" class="form-control" id="fn_year" aria-describedby="fn_year">
      <option value=""> Select Fianancial Year</option>
      @foreach($years as $year)
      <option>{{$year->year}}</option>
      @endforeach
    </select>
    <small id="fn_year" class="form-text text-muted text-danger">{{$errors->first('fn_year')}}</small>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="{{url('payment/paymentlisting')}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>

@endsection
@section('footer')
@parent
<script type="text/javascript">
  $('#amount').on('blur',function(){
    
    var total  = parseInt($('#total_amount').val());
    var amount = parseInt($(this).val());
    if(amount > total){
      alert('Amount should be less then total amount.Total amount is '+total);
      $(this).val('');
    }
  })

</script>
@endsection