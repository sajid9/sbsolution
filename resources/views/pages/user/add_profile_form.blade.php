{{-- extend  --}}
@extends('layout.app2')
@extends('includes.header2')
@extends('includes.footer2')
@extends('includes.sidebar2')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Profile')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
   Add / Edit Profile
</div>
<div class="panel-body">
@include('includes.alerts')
{{-- form start  --}}
<form method="post" action="{{url('user/updateprofile')}}" enctype="multipart/form-data">
	@csrf
  <div class="form-group">
    <label for="name">User Name <span class="text-danger">*</span></label>
    <input type="text" name="user_name" value="{{old('user_name',Auth::user()->name)}}" class="form-control" id="name" aria-describedby="name" placeholder="Company Name">
    <small id="name" class="form-text text-muted text-danger">{{$errors->first('user_name')}}</small>
  </div>
  <div class="form-group">
    <label for="email">Email <span class="text-danger">*</span></label>
    <input type="text" name="user_email" value="{{old('user_email',Auth::user()->email)}}" class="form-control" id="email" aria-describedby="email" placeholder="Email">
    <small id="email" class="form-text text-muted text-danger">{{$errors->first('user_email')}}</small>
  </div>
  <button type="submit" class="btn btn-primary">Update</button> <a href="{{url('/')}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection