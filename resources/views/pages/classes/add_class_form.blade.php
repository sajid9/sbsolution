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
    Add New Class
</div>
<div class="panel-body">

{{-- form start  --}}
<form method="post" action="{{url('class/addclass')}}">
	@csrf
  <div class="form-group">
    <label for="categoryname">Class Name <span class="text-danger">*</span></label>
    <input type="text" name="class_name" value="{{old('class_name')}}" class="form-control" id="classname" aria-describedby="classname" placeholder="class Name">
    <small id="classname" class="form-text text-muted text-danger">{{$errors->first('class_name')}}</small>
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
  <button type="submit" class="btn btn-primary">Submit</button> <a href="{{url('class/classlisting')}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection