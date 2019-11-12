{{-- extend  --}}
@extends('layout.app2')
@extends('includes.header2')
@extends('includes.footer2')
@extends('includes.sidebar2')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Opening Customer')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Add Opening Customer
</div>
<div class="panel-body">
<div class="alert alert-success alert-dismissible" id="alert" style="display: none">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> Record Added Successfully
</div>
{{-- form start  --}}
<form id="supplierForm">
	@csrf
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="customer">customer <span class="text-danger">*</span></label>
          <select name="customer" class="form-control" id="customer" aria-describedby="customer_msg">
            <option value="">Select customer </option>
            @foreach($customers as $customer)
            <option value="{{$customer->id}}">{{$customer->customer_name}}</option>
            @endforeach
          </select>
        <small id="customer_msg" class="form-text text-muted text-danger"></small>
      </div>
      <div class="form-group">
        <label for="amount">Amount <span class="text-danger">*</span></label>
        <input type="number"  name="amount" value="{{old('amount')}}" class="form-control" id="amount" aria-describedby="amount_msg" placeholder="enter the amount">
        <small id="amount_msg" class="form-text text-muted text-danger"></small>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="type">Type<span class="text-danger">*</span></label>
        <select name="type" class="form-control" id="type" aria-describedby="type_msg">
          <option value="">Select Type</option>
          <option value="debit">To be received from customer</option>
          <option value="credit">To be Paid to customer</option>
        </select>
        <small id="type_msg" class="form-text text-muted text-danger"></small>
      </div>
    </div>
  </div>
  
  <button type="submit" class="btn btn-primary">submit</button> <a href="{{url('/')}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection
@section('footer')
@parent
<script>
  $('#supplierForm').on('submit',function(e){
    e.preventDefault();
    var data = $(this).serialize();
    $.ajax({
      url:"{{url('opening/savecustomer')}}",
      data:data,
      type:"post",
      dataType:"json",
      success:function(res){
        $('#alert').css('display','block');
        document.getElementById("supplierForm").reset();
      }
    });
  })
</script>

@endsection