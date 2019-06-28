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
    <label for="paytype">Select Receipt Type</label>
    <select name="paytype" class="form-control" id="paytype" aria-describedby="paytype_msg">
      <option value=""> Select type</option>
      <option value="SO">Receipt (SO)</option>
      <option value="PO">Voucher (PO)</option>
      <option value="EX">Expenditure (PO)</option>
    </select>
    <small id="paytype_msg" class="form-text text-muted text-danger">{{$errors->first('paytype')}}</small>
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
  <div id="append_con">
    
  </div>
  

  <button type="submit" class="btn btn-primary">Submit</button> <a href="{{url('payment/paymentlisting')}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
{{-- voucher template --}}
<template id="voucher_con">
  <div class="form-group">
    <label for="voucher">Voucher</label>
    <select name="voucher" class="form-control" id="voucher" aria-describedby="voucher">
      <option value=""> Select Voucher</option>
      @foreach($vouchers as $voucher)
      <option value="{{$voucher->id}}"> {{$voucher->voucher_no}}</option>
      @endforeach
    </select>
    <small id="voucher" class="form-text text-muted text-danger">{{$errors->first('voucher')}}</small>
  </div>
  <div class="form-group">
    <label for="payer">payer</label>
    <select name="payer" class="form-control" id="payer" aria-describedby="payer_msg">
      <option value=""> Select Payer</option>
    </select>
    <small id="payer_msg" class="form-text text-muted text-danger">{{$errors->first('payer')}}</small>
  </div>
  <div class="form-group">
    <label for="payee">Payee</label>
    <select name="payee" class="form-control" id="payee" aria-describedby="payee_msg">
      <option value=""> Select Payee</option>
    </select>
    <small id="payee_msg" class="form-text text-muted text-danger">{{$errors->first('payee')}}</small>
  </div>
  <div class="form-group">
    <label for="amount">Amount <span class="text-danger">*</span></label>
    <input type="number" name="amount" value="{{old('amount')}}" class="form-control" id="amount" aria-describedby="amount" placeholder="enter the amount">
    <small id="amount" class="form-text text-muted text-danger">{{$errors->first('amount')}}</small>
  </div>
  <div class="form-group">
    <label for="type">Type</label>
    <select name="type" class="form-control" id="type" aria-describedby="type">
      <option value=""> Select type</option>
      <option value="debit"> Debit</option>
      <option value="credit"> Credit</option>
    </select>
    <small id="type" class="form-text text-muted text-danger">{{$errors->first('type')}}</small>
  </div>
    <div class="form-group">
    <label for="subtype">Subtype</label>
    <select name="subtype" class="form-control" id="subtype" aria-describedby="subtype">
      <option value=""> Select Subtype</option>
      <option value="P"> Puchase</option>
      <option value="PR"> Puchase Return</option>
    </select>
    <small id="subtype" class="form-text text-muted text-danger">{{$errors->first('subtype')}}</small>
  </div>
</template>
@endsection
@section('footer')
@parent
<script>
$('#paytype').on('change',function(){
  var type = $(this).val();
  if(type == 'PO'){
    alert();
    var temp = $('#voucher_con').html();
    $('#append_con').html(temp);
  }else{
    $('#receipt_con').css('display','none');
    $('#voucher_con').css('display','block');
  }
  console.log(type);
})

</script>
@endsection