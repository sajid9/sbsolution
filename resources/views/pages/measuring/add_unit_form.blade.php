{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

{{-- page titles --}}
@section('title', 'Add Unit')
@section('pagetitle', 'Add Unit')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Add New Unit
</div>
<div class="panel-body">

{{-- form start  --}}
<form method="post" action="{{url('measuring/addunit')}}">
	@csrf
  <div class="form-group">
    <label for="unit">Unit <span class="text-danger">*</span></label>
    <input type="text" name="unit" value="{{old('unit')}}" class="form-control" id="unit" aria-describedby="unit_msg" placeholder="Company Name">
    <small id="unit_msg" class="form-text text-muted text-danger">{{$errors->first('unit')}}</small>
  </div>
  
  <div class="checkbox">
    <label>
      <input type="checkbox" data-toggle="toggle" name="is_active" value="yes" {{ (old('is_active') == 'yes') ? 'checked' : '' }} data-on="Active" data-off="Inactive">
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="{{url('measuring/unitlisting')}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection