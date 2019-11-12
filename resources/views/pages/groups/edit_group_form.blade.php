{{-- extend  --}}
@extends('layout.app2')
@extends('includes.header2')
@extends('includes.footer2')
@extends('includes.sidebar2')

{{-- page titles --}}
@section('title', 'Edit Group')
@section('pagetitle', 'Edit Group')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Edit group
</div>
<div class="panel-body">

{{-- form start  --}}
<form method="post" action="{{url('group/updategroup')}}">
	@csrf
  <div class="form-group">
    <label for="groupname">Group Name <span class="text-danger">*</span></label>
    <input type="text" name="group_name" value="{{ $group->name }}" class="form-control" id="groupname" aria-describedby="groupname" placeholder="group Name">
    <input type="hidden" name="id" value="{{ $group->id }}">
    <small id="groupname" class="form-text text-muted text-danger">{{$errors->first('group_name')}}</small>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" data-toggle="toggle" name="is_active" value="yes" {{ ($group->is_active == 'yes') ? 'checked' : '' }} data-on="Active" data-off="Inactive">
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="{{url('group/grouplisting')}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection