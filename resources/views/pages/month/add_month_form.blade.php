{{-- extend  --}}
@extends('layout.app2')
@extends('includes.header2')
@extends('includes.footer2')
@extends('includes.sidebar2')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Month')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Add New Month
</div>
<div class="panel-body">

{{-- form start  --}}
<form method="post" action="{{url('expenditure/addmonth')}}">
	@csrf
  <div class="form-group">
    <label for="monthname">Month Name <span class="text-danger">*</span></label>
    <input type="text" name="month_name" value="{{old('month_name')}}" class="form-control" id="monthname" aria-describedby="monthname" placeholder="Company Name">
    <small id="monthname" class="form-text text-muted text-danger">{{$errors->first('month_name')}}</small>
  </div>
 
  <div class="checkbox">
    <label>
      <input type="checkbox" data-toggle="toggle" name="is_active" value="yes" {{ (old('is_active') == 'yes') ? 'checked' : '' }} data-on="Active" data-off="Inactive">
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="{{url('expenditure/monthlisting')}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection