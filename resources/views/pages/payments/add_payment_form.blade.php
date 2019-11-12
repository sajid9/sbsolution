{{-- extend  --}}
@extends('layout.app2')
@extends('includes.header2')
@extends('includes.footer2')
@extends('includes.sidebar2')

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
    <select name="paytype" required="required" class="form-control" id="paytype" aria-describedby="paytype_msg">
      <option value=""> Select type</option>
      <option value="SO">Receipt (SO)</option>
      <option value="PO">Voucher (PO)</option>
      <option value="EX">Expenditure (EXP)</option>
      <option value="DPTS">Direct payment to supplier</option>
      <option value="DPFC">Direct payment from customer</option>
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
    <label for="voucher">Voucher <span class="text-danger">*</span></label>
    <select name="voucher" required="required" class="form-control" id="voucherId" aria-describedby="voucher_msg">
      <option value=""> Select Voucher</option>
      @foreach($vouchers as $voucher)
      <option value="{{$voucher->id}}"> {{$voucher->voucher_no}}</option>
      @endforeach
    </select>
    <small id="voucher_msg" class="form-text text-muted text-danger">{{$errors->first('voucher')}}</small>
  </div>
  <div class="form-group">
    <label for="supplier">supplier</label>
    <input type="hidden" required="required" name="supplier" value="" id="supplier_id">
    <input type="text" class="form-control" id="supplier" readonly="readonly">
    <small id="supplier_msg" class="form-text text-muted text-danger">{{$errors->first('supplier')}}</small>
  </div>
  <div class="form-group">
    <label for="bal_amount">Balance Amount of Voucher</label>
    <input type="number" disabled="disabled" name="bal_amount" value="" class="form-control" id="bal_amount">
  </div>
  <div class="form-group">
    <label for="account">Account <span class="text-danger">*</span></label>
    <select name="account" required="required" class="form-control" id="account" aria-describedby="account_msg">
      <option value=""> Select Account</option>
      @foreach($accounts as $account)
      <option value="{{$account->id}}">{{$account->account_title}}</option>
      @endforeach
    </select>
    <small id="account_msg" class="form-text text-muted text-danger">{{$errors->first('account')}}</small>
  </div>
   <div class="form-group">
    <label for="bal_amount_account">Balance Amount of Account</label>
    <input type="number" disabled="disabled" name="bal_amount_account" value="" class="form-control" id="bal_amount_account">
  </div>
  
  <div class="form-group">
    <label for="amount">Amount <span class="text-danger">*</span></label>
    <input type="number" required="required" name="amount" value="{{old('amount')}}" class="form-control" id="amount" aria-describedby="amount" placeholder="enter the amount">
    <small id="amount" class="form-text text-muted text-danger">{{$errors->first('amount')}}</small>
  </div>
  <div class="form-group">
    <label for="type">Type <span class="text-danger">*</span></label>
    <select name="type" required="required" class="form-control" id="type" aria-describedby="type">
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

{{-- direct payment to supplier --}}

<template id="dpts_con">
  <div class="form-group">
    <label for="supplier">supplier <span class="text-danger">*</span></label>
    <select  class="form-control" required="required" name="supplier" id="supplier">
      <option value="">Select Supplier</option>
      @foreach($suppliers as $supplier)
      <option value="{{$supplier->id}}">{{$supplier->supplier_name}}</option>
      @endforeach
    </select>
    <small id="supplier_msg" class="form-text text-muted text-danger">{{$errors->first('supplier')}}</small>
  </div>
  <div class="form-group">
    <label for="account">Account <span class="text-danger">*</span></label>
    <select name="account" required="required" class="form-control" id="account" aria-describedby="account_msg">
      <option value=""> Select Account</option>
      @foreach($accounts as $account)
      <option value="{{$account->id}}">{{$account->account_title}}</option>
      @endforeach
    </select>
    <small id="account_msg" class="form-text text-muted text-danger">{{$errors->first('account')}}</small>
  </div>
  <div class="form-group">
    <label for="amount">Amount <span class="text-danger">*</span></label>
    <input type="number" required="required" name="amount" value="{{old('amount')}}" class="form-control" id="amount" aria-describedby="amount" placeholder="enter the amount">
    <small id="amount" class="form-text text-muted text-danger">{{$errors->first('amount')}}</small>
  </div>
  <div class="form-group">
    <label for="type">Type <span class="text-danger">*</span></label>
    <select name="type" required="required" class="form-control" id="type" aria-describedby="type">
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
{{-- direct payment from supplier template --}}
<template id="dpfc_con">
  <div class="form-group">
    <label for="customer">customer <span class="text-danger">*</span></label>
    <select  class="form-control" required="required" name="customer" id="customer">
      <option value="">Select customer</option>
      @foreach($customers as $customer)
      <option value="{{$customer->id}}">{{$customer->customer_name}}</option>
      @endforeach
    </select>
    <small id="customer_msg" class="form-text text-muted text-danger">{{$errors->first('customer')}}</small>
  </div>
  <div class="form-group">
    <label for="account">Account <span class="text-danger">*</span></label>
    <select name="account" required="required" class="form-control" id="account" aria-describedby="account_msg">
      <option value=""> Select Account</option>
      @foreach($accounts as $account)
      <option value="{{$account->id}}">{{$account->account_title}}</option>
      @endforeach
    </select>
    <small id="account_msg" class="form-text text-muted text-danger">{{$errors->first('account')}}</small>
  </div>
  <div class="form-group">
    <label>Account Balance</label>
    <input type="number" readonly="" class="form-control" id="bal_amount_account">
  </div>
  <div class="form-group">
    <label for="amount">Amount <span class="text-danger">*</span></label>
    <input type="number" required="required" name="amount" value="{{old('amount')}}" class="form-control" id="amount" aria-describedby="amount" placeholder="enter the amount">
    <small id="amount" class="form-text text-muted text-danger">{{$errors->first('amount')}}</small>
  </div>
  <div class="form-group">
    <label for="type">Type <span class="text-danger">*</span></label>
    <select name="type" required="required" class="form-control" id="type" aria-describedby="type">
      <option value=""> Select type</option>
      <option value="from">Payment from Customer</option>
      <option value="to">Payment to Customer</option>
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
    <label for="receipt">Receipt <span class="text-danger">*</span></label>
    <select name="receipt" required="required" class="form-control" id="receipt" aria-describedby="receipt_msg">
      <option value=""> Select receipt</option>
      @foreach($receipts as $receipt)
      <option value="{{$receipt->id}}"> {{$receipt->receipt_no}}</option>
      @endforeach
    </select>
    <small id="receipt_msg" class="form-text text-muted text-danger">{{$errors->first('receipt')}}</small>
  </div>
  
  <div class="form-group">
    <label for="customer">customer</label>
    <input type="hidden" name="customer" value="" id="customer_id">
    <input type="text" required="required" class="form-control" id="customer" readonly="readonly">
    <small id="customer_msg" class="form-text text-muted text-danger">{{$errors->first('customer')}}</small>
  </div>
  <div class="form-group">
    <label for="bal_amount">Balance Amount</label>
    <input type="number" disabled="disabled" name="bal_amount" value="" class="form-control" id="bal_amount">
  </div>
  <div class="form-group">
    <label for="account">Account <span class="text-danger">*</span></label>
    <select name="account" required="required" class="form-control" id="account" aria-describedby="account_msg">
      <option value=""> Select Account</option>
       @foreach($accounts as $account)
      <option value="{{$account->id}}">{{$account->account_title}}</option>
      @endforeach
    </select>
    <small id="account_msg" class="form-text text-muted text-danger">{{$errors->first('account')}}</small>
  </div>
  <div class="form-group">
    <label for="amount">Amount <span class="text-danger">*</span></label>
    <input type="number" required="required" name="amount" value="{{old('amount')}}" class="form-control" id="amount_receipt" aria-describedby="amount" placeholder="enter the amount">
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
    <label for="type">Type <span class="text-danger">*</span></label>
    <select name="type" required="required" class="form-control" id="type" aria-describedby="type">
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
    <label for="account">Account <span class="text-danger">*</span></label>
    <select name="account" required="required" class="form-control" id="account" aria-describedby="account_msg">
      <option value=""> Select Account</option>
      @foreach($accounts as $account)
      <option value="{{$account->id}}">{{$account->account_title}}</option>
      @endforeach
    </select>
    <small id="account_msg" class="form-text text-muted text-danger">{{$errors->first('account')}}</small>
  </div>
  <div class="form-group">
    <label for="amount">Amount <span class="text-danger">*</span></label>
    <input type="number" required="required" name="amount" value="{{old('amount')}}" class="form-control" id="amount" aria-describedby="amount" placeholder="enter the amount">
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
  }else if(type == 'EX'){
    var temp = $('#exp_con').html();
    $('#append_con').html(temp);
  }else if(type == 'DPFC'){
    var temp = $('#dpfc_con').html();
    $('#append_con').html(temp);
  }else{
    var temp = $('#dpts_con').html();
    $('#append_con').html(temp);
  }
});
$(document).on('change','#account',function(){
  var id = $(this).val();
  $.ajax({
    url:"{{url('payment/getaccountinfo')}}",
    type:"post",
    dataType:"json",
    data:{id:id,_token:"{{csrf_token()}}"},
    success:function(res){
      $('#bal_amount_account').val(res.left_bal);
    }
  });
});
$(document).on('change','#voucherId',function(){
  var val = $(this).val();
  $.ajax({
    url:"{{url('voucher/selectsupplier')}}",
    data:{id:val,_token:"{{csrf_token()}}"},
    type:"post",
    dataType:"json",
    success:function(res){
      $('#supplier').val(res.supplier.supplier_name);
      $('#supplier_id').val(res.supplier.id);
      var bal_amount = res.voucher.total_amount - (res.voucher.paid_amount + res.voucher.return_amount);
      $('#bal_amount').val(bal_amount);
    }
  })
});
$(document).on('change','#receipt',function(){
  var val = $(this).val();
  $.ajax({
    url:"{{url('sale/selectcustomer')}}",
    data:{id:val,_token:"{{csrf_token()}}"},
    type:"post",
    dataType:"json",
    success:function(res){
      $('#customer').val(res.customer.customer_name);
      $('#customer_id').val(res.customer.id);
      var bal_amount = res.receipt.total_amount - (res.receipt.paid_amount + res.receipt.return_amount);
      $('#bal_amount').val(bal_amount);
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
$(document).on('blur','#amount',function(){
  var data = {};
      data.voucher = $('#voucherId').val();
      data.amount  = parseInt($(this).val());
      data._token  = "{{csrf_token()}}";
      if(data.voucher == ''){
        alert('please select the voucher first');
        $('#amount').val('');
        return 0;
      }
  $.ajax({
    url:'{{url("payment/checkamount")}}',
    type:'post',
    dataType:'json',
    data:data,
    success:function(res){
      var paid = parseInt(res.paid_amount + res.return_amount);
      var bal  = parseInt(res.total_amount - paid);
      if(data.amount > bal){
        alert('paid amount should be less then balance amount.Balance amount is '+bal);
        $('#amount').val('');
      }
    }
  });
});
$(document).on('blur','#amount_receipt',function(){
  var data = {};
      data.receipt = $('#receipt').val();
      data.amount  = I= parseInt($(this).val());
      if(data.receipt == ''){
        alert('please select the receipt first');
        $('#amount_receipt').val('');
        return 0;
      }
      var bal = parseInt($('#bal_amount').val());
      if(data.amount > bal){
        alert('paid amount should be less then balance amount.Balance amount is '+bal);
        $('#amount').val('');
      }
})

</script>
@endsection