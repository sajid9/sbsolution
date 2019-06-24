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