{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Taxes')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Add New Tax
</div>
<div class="panel-body">

{{-- form start  --}}
<form method="post" action="{{url('tax/addtax')}}">
	@csrf
  <div class="form-group">
    <label for="taxname">Tax Name <span class="text-danger">*</span></label>
    <input type="text" name="name" value="{{old('tax_name')}}" class="form-control" id="taxname" aria-describedby="taxname" placeholder="Tax Name">
    <small id="taxname" class="form-text text-muted text-danger">{{$errors->first('tax_name')}}</small>
  </div>
  <div class="form-group">
    <label for="price">Price</label>
    <input type="number" class="form-control" name="price" id="price" aria-describedby="price" placeholder="Tax Price" value="{{old('price')}}">
    <small id="price" class="form-text text-muted text-danger">{{$errors->first('price')}}</small>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" data-toggle="toggle" name="is_active" value="yes" {{ (old('is_active') == 'yes') ? 'checked' : '' }} data-on="Active" data-off="Inactive">
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="{{url('tax/taxlisting')}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection