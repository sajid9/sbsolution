{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Supplier')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Edit Supplier
</div>
<div class="panel-body">

{{-- form start  --}}
<form method="post" action="{{url('supplier/updatesupplier')}}">
  @csrf
  <input type="hidden" name="id" value="{{$supplier->id}}">
  <div class="form-group">
    <label for="suppliername">Supplier Name <span class="text-danger">*</span></label>
    <input type="text" name="supplier_name" value="{{old('supplier_name',$supplier->supplier_name)}}" class="form-control" id="suppliername" aria-describedby="suppliername" placeholder="Supplier Name">
    <small id="suppliername" class="form-text text-muted text-danger">{{$errors->first('supplier_name')}}</small>
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" value="{{old('email',$supplier->email)}}" class="form-control" id="email" placeholder="Enter your email" aria-describedby="email">
  </div>
  <div class="form-group">
    <label for="phone">Phone <span class="text-danger">*</span></label>
    <input type="text" name="phone" value="{{old('phone',$supplier->phone)}}" class="form-control" id="phone" placeholder="Enter your phone" aria-describedby="phone">
    <small id="suppliername" class="form-text text-muted text-danger">{{$errors->first('phone')}}</small>
  </div>
  <div class="form-group">
    <label for="mobile">Mobile <span class="text-danger">*</span></label>
    <input type="text" name="mobile" value="{{old('mobile',$supplier->mobile)}}" class="form-control" id="mobile" placeholder="Enter your mobile" aria-describedby="mobile">
    <small id="suppliername" class="form-text text-muted text-danger">{{$errors->first('mobile')}}</small>
  </div>
  <div class="form-group">
    <label for="cnic">Cnic</label>
    <input type="text" name="cnic" value="{{old('cnic',$supplier->cnic)}}" class="form-control" id="cnic" placeholder="Enter your cnic" aria-describedby="cnic">
  </div>
  <div class="form-group">
    <label for="website">Website</label>
    <input type="url" name="website" value="{{old('website',$supplier->website)}}" class="form-control" id="website" placeholder="Enter your website" aria-describedby="website">
  </div>
  <div class="form-group">
    <label for="address">Address</label>
    <textarea class="form-control" name="address" id="address" rows="3" aria-describedby="address">{{old('address',$supplier->address)}}</textarea>
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button> <a href="{{url('supplier/supplierlisting')}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection
@section('footer')
@parent
<script src="{{ asset('js/jquery.maskedinput.js') }}"></script>
<script>
   $("#phone").mask("(999) 9999999");
   $("#mobile").mask("9999-9999999");
   $("#cnic").mask("99999-9999999-9");
</script>
@endsection