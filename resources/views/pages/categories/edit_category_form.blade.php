{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Catgeory')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Edit Catgeory
</div>
<div class="panel-body">

{{-- form start  --}}
<form method="post" action="{{url('category/updatecategory')}}">
	@csrf
  <div class="form-group">
    <label for="categoryname">category Name <span class="text-danger">*</span></label>
    <input type="text" name="category_name" value="{{ $category->category_name }}" class="form-control" id="categoryname" aria-describedby="categoryname" placeholder="category Name">
    <input type="hidden" name="id" value="{{ $category->id }}">
    <small id="categoryname" class="form-text text-muted text-danger">{{$errors->first('category_name')}}</small>
  </div>
  {{-- <div class="form-group">
    <label for="discount">Discount</label>
    <input type="number" name="discount" value="{{ old('discount',$category->discount) }}" class="form-control" id="discount" placeholder="discount in percentage(%)" aria-describedby="discount">
  </div> --}}
  <div class="form-group">
    <label for="discription">Description</label>
    <textarea class="form-control" name="description" id="description" rows="3" aria-describedby="description">{{ old('description',$category->description) }}</textarea>
  </div>
  
  <div class="checkbox">
    <label>
      <input type="checkbox" data-toggle="toggle" name="is_active" value="yes" {{ ($category->is_active == 'yes') ? 'checked' : '' }} data-on="Active" data-off="Inactive">
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="{{url('category/categorylisting')}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection