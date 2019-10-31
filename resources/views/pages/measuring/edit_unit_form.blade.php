{{-- extend  --}}
@extends('layout.app2')
@extends('includes.header2')
@extends('includes.footer2')
@extends('includes.sidebar2')

{{-- page titles --}}
@section('title', 'Edit Unit')
@section('pagetitle', 'Edit Unit')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Edit Unit
</div>
<div class="panel-body">

{{-- form start  --}}
<form method="post" action="{{url('measuring/updateunit')}}">
	@csrf
  <div class="form-group">
    <label for="unit">Unit<span class="text-danger">*</span></label>
    <input type="text" name="unit" value="{{ $unit->unit }}" class="form-control" id="unit" aria-describedby="unit_msg" placeholder="Unit">
    <input type="hidden" name="id" value="{{ $unit->id }}">
    <small id="unit_msg" class="form-text text-muted text-danger">{{$errors->first('unit')}}</small>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" data-toggle="toggle" name="is_active" value="yes" {{ ($unit->is_active == 'yes') ? 'checked' : '' }} data-on="Active" data-off="Inactive">
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="{{url('measuring/unitlisting')}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection