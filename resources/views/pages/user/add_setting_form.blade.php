{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Company Profile')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
   Add / Edit Company Profile
</div>
<div class="panel-body">
@include('includes.alerts')
{{-- form start  --}}
<form method="post" action="{{url('user/addcompanysetting')}}" enctype="multipart/form-data">
	@csrf
  <div class="form-group">
    <label for="companyname">Company Name <span class="text-danger">*</span></label>
    <input type="hidden" name="id" value="{{@$company->id}}">
    <input type="text" name="company_name" value="{{old('company_name',@$company->name)}}" class="form-control" id="companyname" aria-describedby="companyname" placeholder="Company Name">
    <small id="companyname" class="form-text text-muted text-danger">{{$errors->first('company_name')}}</small>
  </div>
  <div class="form-group">
    <label for="email">Email <span class="text-danger">*</span></label>
    <input type="text" name="company_email" value="{{old('company_email',@$company->email)}}" class="form-control" id="email" aria-describedby="email" placeholder="Email">
    <small id="email" class="form-text text-muted text-danger">{{$errors->first('company_email')}}</small>
  </div>
  <div class="form-group">
    <label for="logo">Company Logo <span class="text-danger">*</span></label>
    <input type="file" name="company_logo"  class="form-control" id="logo" aria-describedby="logo" placeholder="Company Logo">
    <small id="logo" class="form-text text-muted text-danger">{{$errors->first('company_logo')}}</small>
    <input type="hidden" name="old_logo" value="{{@$company->logo}}">
    @if(isset($company->logo))
    <br>
    <img src="{{env('APP_URL')}}/storage/app/{{$company->logo}}" width="100" height="100" alt="">
    @endif
  </div>
  <div class="form-group">
    <label for="phone">Phone</label>
    <input type="text" name="company_phone" value="{{old('company_phone',@$company->phone)}}" class="form-control" id="phone" aria-describedby="phone" placeholder="Phone">
    <small id="phone" class="form-text text-muted text-danger">{{$errors->first('company_phone')}}</small>
  </div>
  <div class="form-group">
    <label for="mobile">Mobile</label>
    <input type="text" name="company_mobile" value="{{old('company_mobile',@$company->mobile)}}" class="form-control" id="mobile" aria-describedby="mobile" placeholder="Mobile">
    <small id="mobile" class="form-text text-muted text-danger">{{$errors->first('company_mobile')}}</small>
  </div>
  <div class="form-group">
    <label for="website">Website</label>
    <input type="text" name="company_website" value="{{old('company_website',@$company->website)}}" class="form-control" id="website" aria-describedby="website" placeholder="Website">
    <small id="website" class="form-text text-muted text-danger">{{$errors->first('company_website')}}</small>
  </div>
  <div class="form-group">
    <label for="address">address</label>
    <textarea type="text" name="company_address"class="form-control" id="address" aria-describedby="address">{{old('company_address',@$company->address)}}</textarea>
    <small id="address" class="form-text text-muted text-danger">{{$errors->first('company_address')}}</small>
  </div>
  
  <button type="submit" class="btn btn-primary">{{(isset($company->id)) ? 'Update' : 'Submit' }}</button> <a href="{{url('/')}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection