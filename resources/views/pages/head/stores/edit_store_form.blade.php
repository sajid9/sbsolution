{{-- extend  --}}
@extends('layout.app2')
@extends('includes.header2')
@extends('includes.footer2')
@extends('includes.sidebar2')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Edit Store')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Edit Store
</div>
<div class="panel-body">

{{-- form start  --}}
<form method="post" action="{{url('store/updatestore')}}">
	@csrf
  <div class="form-group">
    <label for="storename">Store Name <span class="text-danger">*</span></label>
    <input type="text" name="store_name" value="{{ $store->name }}" class="form-control" id="storename" aria-describedby="storename" placeholder="store Name">
    <input type="hidden" name="id" value="{{ $store->id }}">
    <small id="storename" class="form-text text-muted text-danger">{{$errors->first('store_name')}}</small>
  </div>
  
  <div class="form-group">
    <label for="address">address</label>
    <textarea class="form-control" name="address" id="address" rows="3" aria-describedby="address">{{ old('address',$store->address) }}</textarea>
  </div>
  
  <div class="checkbox">
    <label>
      <input type="checkbox" data-toggle="toggle" name="is_active" value="yes" {{ ($store->is_active == 'yes') ? 'checked' : '' }} data-on="Active" data-off="Inactive">
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="{{url('store/storelisting')}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection