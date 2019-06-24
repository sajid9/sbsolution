{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Dashboard')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Add New Category
</div>
<div class="panel-body">

{{-- form start  --}}
<form method="post" action="{{url('payment/addpayment')}}">
	@csrf
  <div class="form-group">
    <label for="type">Select Receipt Type</label>
    <select name="type" class="form-control" id="type" aria-describedby="type">
      <option value=""> Select type</option>
      <option value="SO">Receipt (SO)</option>
      <option value="PO">Voucher (PO)</option>
    </select>
    <small id="type" class="form-text text-muted text-danger">{{$errors->first('type')}}</small>
  </div>
  <div class="form-group" id="voucher_con">
    <label for="voucher">Voucher</label>
    <select name="voucher" class="form-control" id="voucher" aria-describedby="voucher">
      <option value=""> Select Voucher</option>
      @foreach($vouchers as $voucher)
      <option value="{{$voucher->id}}"> {{$voucher->voucher_no}}</option>
      @endforeach
    </select>
    <small id="voucher" class="form-text text-muted text-danger">{{$errors->first('voucher')}}</small>
  </div>
  <div class="form-group" id="receipt_con">
    <label for="receipt">Receipt</label>
    <select name="receipt" class="form-control" id="receipt" aria-describedby="receipt_msg">
      <option value=""> Select Receipt</option>
      @foreach($receipts as $receipt)
      <option value="{{$receipt->id}}"> {{$receipt->receipt_no}}</option>
      @endforeach
    </select>
    <small id="receipt_msg" class="form-text text-muted text-danger">{{$errors->first('receipt')}}</small>
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
@section('footer')
@parent
<script>
$('#type').on('change',function(){
  var type = $(this).val();
  if(type == 'SO'){
    $('#voucher_con').css('display','none');
    $('#receipt_con').css('display','block');
  }else{
    $('#receipt_con').css('display','none');
    $('#voucher_con').css('display','block');
  }
  console.log(type);
})

</script>
@endsection