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
      <option value="EX">Expenditure (EXP)</option>
    </select>
    <small id="paytype_msg" class="form-text text-muted text-danger">{{$errors->first('paytype')}}</small>
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
    <label for="supplier">supplier</label>
    <select name="supplier" class="form-control" id="supplier" aria-describedby="supplier_msg">
      <option value=""> Select supplier</option>
      @foreach ($suppliers as $supplier)
        <option value="{{$supplier->id}}" {{($voucher->supplier_id == $supplier->id) ? "selected" : ""}}>{{$supplier->supplier_name}}</option>
      @endforeach
    </select>
    <small id="supplier_msg" class="form-text text-muted text-danger">{{$errors->first('supplier')}}</small>
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
{{-- receipt template --}}
<template id="receipt_con">
  <div class="form-group">
    <label for="receipt">Receipt</label>
    <select name="receipt" class="form-control" id="receipt" aria-describedby="receipt">
      <option value=""> Select receipt</option>
      @foreach($receipts as $receipt)
      <option value="{{$receipt->id}}"> {{$receipt->receipt_no}}</option>
      @endforeach
    </select>
    <small id="receipt" class="form-text text-muted text-danger">{{$errors->first('receipt')}}</small>
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
    <label for="customer">Customer</label>
    <select name="customer" class="form-control" id="customer" aria-describedby="customer_msg">
      <option value=""> Select customer</option>
      @foreach($customers as $customer)
      <option value="{{$customer->id}}" {{($receipt->customer_id == $customer->id) ? "selected" : ""}}>{{$customer->customer_name}}</option>
      @endforeach
    </select>
    <small id="customer_msg" class="form-text text-muted text-danger">{{$errors->first('customer')}}</small>
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
      <option value="S"> Sale</option>
      <option value="SR"> Sale Return</option>
    </select>
    <small id="subtype" class="form-text text-muted text-danger">{{$errors->first('subtype')}}</small>
  </div>
</template>
{{-- expenditure template --}}
<template id="exp_con">
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
    <label for="amount">Amount <span class="text-danger">*</span></label>
    <input type="number" name="amount" value="{{old('amount')}}" class="form-control" id="amount" aria-describedby="amount" placeholder="enter the amount">
    <small id="amount" class="form-text text-muted text-danger">{{$errors->first('amount')}}</small>
  </div>
  <div class="form-group">
    <label for="month">month <span class="text-danger">*</span></label>
    <select name="month" class="form-control" id="month" aria-describedby="month_msg">
      <option value=""> Select Month</option>
      <option value="1">may</option>
      <option value="2">june</option>
      <option value="3">july</option>
    </select>
    <small id="month" class="form-text text-muted text-danger">{{$errors->first('month')}}</small>
  </div>
  <div class="form-group">
    <label for="description">Description <span class="text-danger">*</span></label>
    <textarea name="description" class="form-control" id="description" aria-describedby="description" placeholder="enter the description">{{old('description')}}</textarea>
    <small id="description" class="form-text text-muted text-danger">{{$errors->first('description')}}</small>
  </div>
  <div class="form-group">
    <label for="subhead">Exp Subhead</label>
    <select name="subhead" class="form-control" id="subhead" aria-describedby="subhead">
      <option value=""> Select Subhead</option>
      <option value="1"> utility bill</option>
      <option value="2"> ptcl bill</option>
      <option value="3"> electric city bill</option>
    </select>
    <small id="subhead" class="form-text text-muted text-danger">{{$errors->first('subhead')}}</small>
  </div>
  <div class="form-group">
    <label for="headtype">Headtype</label>
    <select name="headtype" class="form-control" id="headtype" aria-describedby="headtype">
      <option value=""> Select Headtype</option>
      <option value="1">monthly</option>
      <option value="2">setup</option>
    </select>
    <small id="headtype" class="form-text text-muted text-danger">{{$errors->first('headtype')}}</small>
  </div>
  <div class="checkbox">
    <label><input type="checkbox" name="salary" id="salary" value="checked">Salary</label>
  </div>
  <div class="form-group" id="employee" style="display: none">
    <label for="employee">Employee</label>
    <select name="employee" class="form-control" id="employee" aria-describedby="employee">
      <option value=""> Select employee</option>
      <option value="1">muhammad sajid</option>
      <option value="2">muhammad wajid</option>
      <option value="3">khan</option>
    </select>
    <small id="employee" class="form-text text-muted text-danger">{{$errors->first('employee')}}</small>
  </div>
</template>
@endsection
@section('footer')
@parent
<script>
$(document).on('change', '#salary', function() {
  if(this.checked) {
    $('#employee').css('display','block');
  }else{
    $('#employee').css('display','none');
  }
});
$('#paytype').on('change',function(){
  var type = $(this).val();
  if(type == 'PO'){
    var temp = $('#voucher_con').html();
    $('#append_con').html(temp);
  }else if(type == 'SO'){
    var temp = $('#receipt_con').html();
    $('#append_con').html(temp);
  }else{
    var temp = $('#exp_con').html();
    $('#append_con').html(temp);
  }
})

</script>
@endsection