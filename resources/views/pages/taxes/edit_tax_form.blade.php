{{-- extend  --}}
@extends('layout.app2')
@extends('includes.header2')
@extends('includes.footer2')
@extends('includes.sidebar2')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Edit Store')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Edit Store
</div>
<div class="panel-body">

{{-- form start  --}}
<form method="post" action="{{url('tax/updatetax')}}">
	@csrf
  <input type="hidden" name="id" value="{{$tax->id}}">
  <div class="form-group">
    <label for="taxname">Tax Name <span class="text-danger">*</span></label>
    <input type="text" name="name" value="{{old('tax_name',$tax->name)}}" class="form-control" id="taxname" aria-describedby="taxname" placeholder="Tax Name">
    <small id="taxname" class="form-text text-muted text-danger">{{$errors->first('tax_name')}}</small>
  </div>
  <div class="form-group">
    <label for="price">Price</label>
    <input type="number" class="form-control" name="price" id="price" aria-describedby="price" placeholder="Tax Price" value="{{old('price',$tax->price)}}">
    <small id="price" class="form-text text-muted text-danger">{{$errors->first('price')}}</small>
  </div>
  
  <div class="checkbox">
    <label>
      <input type="checkbox" data-toggle="toggle" name="is_active" value="yes" {{ ($tax->is_active == 'yes') ? 'checked' : '' }} data-on="Active" data-off="Inactive">
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="{{url('tax/taxlisting')}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection