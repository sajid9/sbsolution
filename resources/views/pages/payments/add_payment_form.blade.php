{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Payments')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Payment
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
    <select name="voucher" class="form-control" id="voucherId" aria-describedby="voucher_msg">
      <option value=""> Select Voucher</option>
      @foreach($vouchers as $voucher)
      <option value="{{$voucher->id}}"> {{$voucher->voucher_no}}</option>
      @endforeach
    </select>
    <small id="voucher_msg" class="form-text text-muted text-danger">{{$errors->first('voucher')}}</small>
  </div>
  <div class="form-group">
    <label for="supplier">supplier</label>
    <input type="hidden" name="supplier" value="" id="supplier_id">
    <input type="text" class="form-control" id="supplier" readonly="readonly">
    <small id="supplier_msg" class="form-text text-muted text-danger">{{$errors->first('supplier')}}</small>
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
    <label for="amount">Amount <span class="text-danger">*</span></label>
    <input type="number" name="amount" value="{{old('amount')}}" class="form-control" id="amount" aria-describedby="amount" placeholder="enter the amount">
    <small id="amount" class="form-text text-muted text-danger">{{$errors->first('amount')}}</small>
  </div>
  <div class="form-group">
    <label for="type">Type</label>
    <select name="type" class="form-control" id="type" aria-describedby="type">
      <option value=""> Select type</option>
      <option value="to">Payment to Supplier</option>
      <option value="from">Payment from Supplier</option>
    </select>
    <small id="type" class="form-text text-muted text-danger">{{$errors->first('type')}}</small>
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
    <label for="fn_year">Fianancial Year</label>
    <select name="fn_year" class="form-control" id="fn_year" aria-describedby="fn_year">
      <option value=""> Select Fianancial Year</option>
      @foreach($years as $year)
      <option>{{$year->year}}</option>
      @endforeach
    </select>
    <small id="fn_year" class="form-text text-muted text-danger">{{$errors->first('fn_year')}}</small>
  </div>
  <div class="form-group">
    <label for="type">Type</label>
    <select name="type" class="form-control" id="type" aria-describedby="type">
      <option value=""> Select type</option>
      <option value="to"> Payment to Customer</option>
      <option value="from"> Payment from Customer</option>
    </select>
    <small id="type" class="form-text text-muted text-danger">{{$errors->first('type')}}</small>
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
      @foreach($months as $month)
      <option value="{{$month->id}}">{{$month->name}}</option>
      @endforeach
    </select>
    <small id="month" class="form-text text-muted text-danger">{{$errors->first('month')}}</small>
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
  <div class="form-group">
    <label for="description">Description <span class="text-danger">*</span></label>
    <textarea name="description" class="form-control" id="description" aria-describedby="description" placeholder="enter the description">{{old('description')}}</textarea>
    <small id="description" class="form-text text-muted text-danger">{{$errors->first('description')}}</small>
  </div>
  <div class="form-group">
    <label for="head">Exp Head</label>
    <select name="head" class="form-control" id="head" aria-describedby="head">
      <option value=""> Select Head</option>
      @foreach($heads as $head)
      <option value="{{$head->id}}">{{$head->name}}</option>
      @endforeach
    </select>
    <small id="head" class="form-text text-muted text-danger">{{$errors->first('head')}}</small>
  </div>
  <div class="form-group">
    <label for="subhead">Exp Subhead</label>
    <select name="subhead" class="form-control" id="subhead" aria-describedby="subhead">
      <option value=""> Select Subhead</option>
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
});
$(document).on('change','#voucherId',function(){
  var val = $(this).val();
  $.ajax({
    url:"{{url('voucher/selectsupplier')}}",
    data:{id:val,_token:"{{csrf_token()}}"},
    type:"post",
    dataType:"json",
    success:function(res){
      $('#supplier').val(res.supplier_name);
      $('#supplier_id').val(res.id);
    }
  })
});
$(document).on('change','#head',function(){
  var val = $(this).val();
  $.ajax({
    url:"{{url('expenditure/getsubhead')}}",
    data:{id:val,_token:"{{csrf_token()}}"},
    type:"post",
    dataType:"json",
    success:function(res){
      var template = "<option value=''>Select Subhead </option>";
      for( var i = 0; i < res.length; i++ ){
        template += "<option value='"+res[i].id+"'>"+res[i].name+"</option>";
      }
      $("#subhead").html(template);
    }
  })
});

</script>
@endsection