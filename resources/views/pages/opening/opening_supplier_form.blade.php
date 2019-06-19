{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Opening Supplier')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Add Opening Supplier
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
        <label for="supplier">Supplier <span class="text-danger">*</span></label>
          <select name="supplier" class="form-control" id="supplier" aria-describedby="supplier_msg">
            <option value="">Select Supplier </option>
            @foreach($suppliers as $supplier)
            <option value="{{$supplier->id}}">{{$supplier->supplier_name}}</option>
            @endforeach
          </select>
        <small id="supplier_msg" class="form-text text-muted text-danger"></small>
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
          <option value="debit">Debit</option>
          <option value="credit">Credit</option>
        </select>
        <small id="type_msg" class="form-text text-muted text-danger"></small>
      </div>
    </div>
  </div>
  
  <button type="submit" class="btn btn-primary">submit</button> <a href="{{url('item/itemlisting')}}" class="btn btn-default">Back</a>
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
      url:"{{url('opening/savesupplier')}}",
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