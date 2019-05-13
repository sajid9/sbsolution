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
    Edit country
</div>
<div class="panel-body">

{{-- form start  --}}
<form method="post" action="{{url('country/updatecountry')}}">
	@csrf
  <div class="form-group">
    <label for="countryname">Country Name <span class="text-danger">*</span></label>
    <input type="text" name="name" value="{{ old('name',$country->name) }}" class="form-control" id="countryname" aria-describedby="countryname" placeholder="country Name">
    <input type="hidden" name="id" value="{{ $country->id }}">
    <small id="countryname" class="form-text text-muted text-danger">{{$errors->first('name')}}</small>
  </div>
  <div class="form-group">
    <label for="short_code">Short Code <span class="text-danger">*</span></label>
    <input type="text" name="short_code" value="{{old('short_code',$country->short_code)}}" class="form-control" id="short_code" placeholder="Short Code" aria-describedby="short_code">
    <small id="short_code" class="form-text text-muted text-danger">{{$errors->first('short_code')}}</small>
  </div>
  <div class="form-check">
    <input type="checkbox" name="is_active" value="yes" {{ ($country->is_active == 'yes') ? 'checked' : '' }} class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Active</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="{{url('country/countrylisting')}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection