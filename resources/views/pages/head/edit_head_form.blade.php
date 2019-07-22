{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Edit Head')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Edit Head
</div>
<div class="panel-body">

{{-- form start  --}}
<form method="post" action="{{url('expenditure/updatehead')}}">
	@csrf
  <div class="form-group">
    <label for="head">Head Name <span class="text-danger">*</span></label>
    <input type="text" name="head_name" value="{{ $head->name }}" class="form-control" id="head" aria-describedby="head" placeholder="Head Name">
    <input type="hidden" name="id" value="{{ $head->id }}">
    <small id="head" class="form-text text-muted text-danger">{{$errors->first('head_name')}}</small>
  </div>
 
  <div class="checkbox">
    <label>
      <input type="checkbox" data-toggle="toggle" name="is_active" value="yes" {{ ($head->is_active == 'yes') ? 'checked' : '' }} data-on="Active" data-off="Inactive">
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="{{url('expenditure/headlisting')}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection