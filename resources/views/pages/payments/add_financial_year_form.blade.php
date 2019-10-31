{{-- extend  --}}
@extends('layout.app2')
@extends('includes.header2')
@extends('includes.footer2')
@extends('includes.sidebar2')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Financial Year')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Add Financial Year
</div>
<div class="panel-body">

{{-- form start  --}}
<form method="post" action="{{url('payment/addfnyear')}}">
	@csrf
  <div class="form-group">
    <label for="year">Financial Year <span class="text-danger">*</span></label>
    <input type="text" name="fn_year" value="{{old('fn_year')}}" class="form-control" id="year" aria-describedby="year" placeholder="Add Financial Year">
    <small id="year" class="form-text text-muted text-danger">{{$errors->first('fn_year')}}</small>
  <br>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="{{url('payment/financialyear')}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection
@section('footer')
@parent
<script src="{{ asset('js/jquery.maskedinput.js') }}"></script>
<script>
   $("#year").mask("9999-99");
   
</script>
@endsection