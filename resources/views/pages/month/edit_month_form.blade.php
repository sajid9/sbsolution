{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Edit Month')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Edit Month
</div>
<div class="panel-body">

{{-- form start  --}}
<form method="post" action="{{url('expenditure/updatemonth')}}">
	@csrf
  <div class="form-group">
    <label for="month">Company Name <span class="text-danger">*</span></label>
    <input type="text" name="month_name" value="{{ $month->name }}" class="form-control" id="month" aria-describedby="month" placeholder="Month Name">
    <input type="hidden" name="id" value="{{ $month->id }}">
    <small id="month" class="form-text text-muted text-danger">{{$errors->first('month_name')}}</small>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" data-toggle="toggle" name="is_active" value="yes" {{ ($month->is_active == 'yes') ? 'checked' : '' }} data-on="Active" data-off="Inactive">
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="{{url('expenditure/monthlisting')}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection