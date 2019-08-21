{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

{{-- page titles --}}
@section('title', 'Groups')
@section('pagetitle', 'Groups')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Add New Group
</div>
<div class="panel-body">

{{-- form start  --}}
<form method="post" action="{{url('group/addgroup')}}">
	@csrf
  <div class="form-group">
    <label for="groupname">Group Name <span class="text-danger">*</span></label>
    <input type="text" name="group_name" value="{{old('group_name')}}" class="form-control" id="groupname" aria-describedby="groupname" placeholder="Company Name">
    <small id="groupname" class="form-text text-muted text-danger">{{$errors->first('group_name')}}</small>
  </div>
  
  <div class="checkbox">
    <label>
      <input type="checkbox" data-toggle="toggle" name="is_active" value="yes" {{ (old('is_active') == 'yes') ? 'checked' : '' }} data-on="Active" data-off="Inactive">
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="{{url('group/grouplisting')}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection