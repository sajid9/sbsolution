{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Reset Password')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
   Update Password
</div>
<div class="panel-body">
@include('includes.alerts')
{{-- form start  --}}
<form method="post" action="{{url('user/updatepassword')}}" enctype="multipart/form-data">
	@csrf
  <div class="form-group">
    <label for="password">New Password <span class="text-danger">*</span></label>
    <input type="password" name="password" value="{{old('password')}}" class="form-control" id="name" aria-describedby="password_msg" placeholder="New Password">
    <small id="password_msg" class="form-text text-muted text-danger">{{$errors->first('password')}}</small>
  </div>
  <div class="form-group">
    <label for="con_password">Confirm Password <span class="text-danger">*</span></label>
    <input type="password" name="password_confirmation" value="{{old('con_password')}}" class="form-control" id="email" aria-describedby="email" placeholder="Confirm Password">
    <small id="con_pass_msg" class="form-text text-muted text-danger">{{$errors->first('con_password')}}</small>
  </div>
  <button type="submit" class="btn btn-primary">Update</button> <a href="{{url('/')}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection