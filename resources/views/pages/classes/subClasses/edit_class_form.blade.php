{{-- extend  --}}
@extends('layout.app2')
@extends('includes.header2')
@extends('includes.footer2')
@extends('includes.sidebar2')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'SubClass')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Edit Sub Class
</div>
<div class="panel-body">

{{-- form start  --}}
<form method="post" action="{{url('subclass/updateclass')}}">
	@csrf
  <input type="hidden" name="parent_id" value="{{$class->parent_id}}">
  <div class="form-group">
    <label for="classname">class Name <span class="text-danger">*</span></label>
    <input type="text" name="class_name" value="{{ $class->class_name }}" class="form-control" id="classname" aria-describedby="classname" placeholder="class Name">
    <input type="hidden" name="id" value="{{ $class->id }}">
    <small id="classname" class="form-text text-muted text-danger">{{$errors->first('class_name')}}</small>
  </div>
  {{-- <div class="form-group">
    <label for="discount">Discount</label>
    <input type="number" name="discount" value="{{ old('discount',$class->discount) }}" class="form-control" id="discount" placeholder="discount in percentage(%)" aria-describedby="discount">
  </div> --}}
  <div class="form-group">
    <label for="discription">Description</label>
    <textarea class="form-control" name="description" id="description" rows="3" aria-describedby="description">{{ old('description',$class->description) }}</textarea>
  </div>
 
  <div class="checkbox">
    <label>
      <input type="checkbox" data-toggle="toggle" name="is_active" value="yes" {{ ($class->is_active == 'yes') ? 'checked' : '' }} data-on="Active" data-off="Inactive">
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="{{url('subclass/classlisting/'.$class->parent_id)}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection