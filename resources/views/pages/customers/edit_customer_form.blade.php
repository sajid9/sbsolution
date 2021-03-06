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
    Edit Customer
</div>
<div class="panel-body">

{{-- form start  --}}
<form method="post" action="{{url('customer/updatecustomer')}}">
  @csrf
  <input type="hidden" name="id" value="{{$customer->id}}">
  <div class="form-group">
    <label for="customername">Customer Name <span class="text-danger">*</span></label>
    <input type="text" name="customer_name" value="{{old('customer_name',$customer->customer_name)}}" class="form-control" id="customername" aria-describedby="customername" placeholder="Customer name">
    <small id="customername" class="form-text text-muted text-danger">{{$errors->first('customer_name')}}</small>
  </div>
  <div class="form-group">
    <label for="occupation">Occupation</label>
    <input type="occupation" name="occupation" value="{{old('occupation',$customer->occupation)}}" class="form-control" id="occupation" placeholder="Enter occupation" aria-describedby="occupation">
  </div>
  <div class="form-group">
    <label for="standing_instruction">Standing Insruction</label>
    <input type="standing_instruction" name="standing_instruction" value="{{old('standing_instruction',$customer->standing_instruction)}}" class="form-control" id="standing_instruction" placeholder="Enter standing instruction" aria-describedby="standing_instruction">
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" value="{{old('email',$customer->email)}}" class="form-control" id="email" placeholder="Enter customer email" aria-describedby="email">
  </div>
  <div class="form-group">
    <label for="phone">Phone</label>
    <input type="text" name="phone" value="{{old('phone',$customer->phone)}}" class="form-control" id="phone" placeholder="Enter customer phone" aria-describedby="phone">
    
  </div>
  <div class="form-group">
    <label for="mobile">Mobile <span class="text-danger">*</span></label>
    <input type="text" name="mobile" value="{{old('mobile',$customer->mobile)}}" class="form-control" id="mobile" placeholder="Enter customer mobile" aria-describedby="mobile">
    <small id="mobile" class="form-text text-muted text-danger">{{$errors->first('mobile')}}</small>
  </div>
  <div class="form-group">
    <label for="cnic">Cnic</label>
    <input type="text" name="cnic" value="{{old('cnic',$customer->cnic)}}" class="form-control" id="cnic" placeholder="Enter customer cnic" aria-describedby="cnic">
  </div>
  <div class="form-group">
    <label for="website">Website</label>
    <input type="url" name="website" value="{{old('website',$customer->website)}}" class="form-control" id="website" placeholder="Enter customer website" aria-describedby="website">
  </div>
  <div class="form-group">
    <label for="gst">GST</label>
    <input type="gst" name="gst" value="{{old('gst',$customer->gst)}}" class="form-control" id="gst" placeholder="Enter GST" aria-describedby="gst">
  </div>
  <div class="form-group">
    <label for="ntn">NTN</label>
    <input type="ntn" name="ntn" value="{{old('ntn',$customer->ntn)}}" class="form-control" id="ntn" placeholder="Enter NTN" aria-describedby="ntn">
  </div>
  <div class="form-group">
    <label for="address">Address</label>
    <textarea class="form-control" name="address" id="address" rows="3" aria-describedby="address">{{old('address',$customer->address)}}</textarea>
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button> <a href="{{url('customer/customerlisting')}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection
@section('footer')
@parent
<script src="{{ asset('js/jquery.maskedinput.js') }}"></script>
<script>
   $("#phone").mask("(999) 9999999");
   $("#mobile").mask("9999-9999999");
   $("#cnic").mask("99999-9999999-9");
</script>
@endsection