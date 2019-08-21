{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

{{-- page titles --}}
@section('title', 'Sizes')
@section('pagetitle', 'Sizes')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Add New Size
</div>
<div class="panel-body">

{{-- form start  --}}
<form method="post" action="{{url('size/addsize')}}">
	@csrf
  <div class="form-group">
    <label for="size">Size <span class="text-danger">*</span></label>
    <input type="text" name="size" value="{{old('size')}}" class="form-control" id="size" aria-describedby="size_msg" placeholder="Company Name">
    <small id="size_msg" class="form-text text-muted text-danger">{{$errors->first('size')}}</small>
  </div>
  
  <div class="checkbox">
    <label>
      <input type="checkbox" data-toggle="toggle" name="is_active" value="yes" {{ (old('is_active') == 'yes') ? 'checked' : '' }} data-on="Active" data-off="Inactive">
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="{{url('size/sizelisting')}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection