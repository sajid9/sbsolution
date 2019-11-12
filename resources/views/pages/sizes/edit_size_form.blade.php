{{-- extend  --}}
@extends('layout.app2')
@extends('includes.header2')
@extends('includes.footer2')
@extends('includes.sidebar2')

{{-- page titles --}}
@section('title', 'Edit Size')
@section('pagetitle', 'Edit Size')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Edit Size
</div>
<div class="panel-body">

{{-- form start  --}}
<form method="post" action="{{url('size/updatesize')}}">
	@csrf
  <div class="form-group">
    <label for="size">Group Name <span class="text-danger">*</span></label>
    <input type="text" name="size" value="{{ $size->size }}" class="form-control" id="size" aria-describedby="size_msg" placeholder="Size">
    <input type="hidden" name="id" value="{{ $size->id }}">
    <small id="size_msg" class="form-text text-muted text-danger">{{$errors->first('size')}}</small>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" data-toggle="toggle" name="is_active" value="yes" {{ ($size->is_active == 'yes') ? 'checked' : '' }} data-on="Active" data-off="Inactive">
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="{{url('size/sizelisting')}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection