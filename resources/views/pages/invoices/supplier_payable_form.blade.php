{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Supplier Payable')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Supplier Payable
</div>
<div class="panel-body">

{{-- form start  --}}
<form method="post" action="{{url('invoice/supplierpayableinvoice')}}">
	@csrf
  <div class="form-group">
    <label for="supplier">Supplier <span class="text-danger">*</span></label>
    <select name="supplier_id" class="form-control" id="supplier" aria-describedby="supplier">
      <option value="">Select Supplier</option>
      @foreach($suppliers as $supplier)
      <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
      @endforeach
    </select>
    <small id="supplier" class="form-text text-muted text-danger">{{$errors->first('supplier_id')}}</small>
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button> <a href="{{url('category/categorylisting')}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection