{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Dashboard')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Add New Company
</div>
<div class="panel-body">

{{-- form start  --}}
<form method="post" action="{{url('company/addcompany')}}">
	@csrf
  <div class="form-group">
    <label for="companyname">Company Name <span class="text-danger">*</span></label>
    <input type="text" name="company_name" value="{{old('company_name')}}" class="form-control" id="companyname" aria-describedby="companyname" placeholder="Company Name">
    <small id="companyname" class="form-text text-muted text-danger">{{$errors->first('company_name')}}</small>
  </div>
  <div class="form-group">
    <label for="discount">Discount</label>
    <input type="number" name="discount" value="{{old('discount')}}" class="form-control" id="discount" placeholder="discount in percentage(%)" aria-describedby="discount">
  </div>
  <div class="form-group">
    <label for="discription">Description</label>
    <textarea class="form-control" name="description" id="description" rows="3" aria-describedby="description">{{old('description')}}</textarea>
  </div>
  <div class="form-check">
    <input type="checkbox" name="is_active" value="yes" {{ (old('is_active') == 'yes') ? 'checked' : '' }} class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Active</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="{{url('company/companylisting')}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection