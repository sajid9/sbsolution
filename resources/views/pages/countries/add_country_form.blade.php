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
    Add New Country
</div>
<div class="panel-body">

{{-- form start  --}}
<form method="post" action="{{url('country/addcountry')}}">
	@csrf
  <div class="form-group">
    <label for="countryname">Country Name <span class="text-danger">*</span></label>
    <input type="text" name="name" value="{{old('name')}}" class="form-control" id="countryname" aria-describedby="countryname" placeholder="Country Name">
    <small id="countryname" class="form-text text-muted text-danger">{{$errors->first('name')}}</small>
  </div>
  <div class="form-group">
    <label for="short_code">Short Code <span class="text-danger">*</span></label>
    <input type="text" name="short_code" value="{{old('short_code')}}" class="form-control" id="short_code" placeholder="Short Code" aria-describedby="short_code">
    <small id="short_code" class="form-text text-muted text-danger">{{$errors->first('short_code')}}</small>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" data-toggle="toggle" name="is_active" value="yes" {{ (old('is_active') == 'yes') ? 'checked' : '' }} data-on="Active" data-off="Inactive">
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="{{url('country/countrylisting')}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection