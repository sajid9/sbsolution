{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Opening Cash')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Add Opening Cash
</div>
<div class="panel-body">
<div class="alert alert-dismissible" id="alert" style="display: none">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> <span id="alert-msg">Record Added Successfully</span>
</div>
{{-- form start  --}}
<form id="supplierForm">
	@csrf
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="amount">Amount <span class="text-danger">*</span></label>
        <input type="number"  name="amount" value="{{old('amount')}}" class="form-control" id="amount" aria-describedby="amount_msg" placeholder="enter the amount">
        <small id="amount_msg" class="form-text text-muted text-danger"></small>
      </div>
      <div class="form-group">
        <label for="description">Description <span class="text-danger">*</span></label>
        <textarea name="description" class="form-control" id="description" aria-describedby="description_msg" placeholder="enter the description"></textarea>
        <small id="description_msg" class="form-text text-muted text-danger"></small>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="type">Type<span class="text-danger">*</span></label>
        <select name="type" class="form-control" id="type" aria-describedby="type_msg">
          <option value="">Select Type</option>
          <option value="debit">Debit</option>
          <option value="credit">Credit</option>
        </select>
        <small id="type_msg" class="form-text text-muted text-danger"></small>
      </div>
    </div>
  </div>
  
  <button type="submit" class="btn btn-primary">submit</button> <a href="{{url('item/itemlisting')}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection
@section('footer')
@parent
<script>
  $('#supplierForm').on('submit',function(e){
    e.preventDefault();
    var data = $(this).serialize();
    $.ajax({
      url:"{{url('opening/savecash')}}",
      data:data,
      type:"post",
      dataType:"json",
      success:function(res){
        if(res.message =='exsist'){
          $('#alert-msg').text('Opening Cash Already Exsist');
          $('#alert').removeClass('alert-success');
          $('#alert').addClass('alert-danger');
          $('#alert').css('display','block');
          document.getElementById("supplierForm").reset();
        }else{
          $('#alert-msg').text('Data Added Successfully');
          $('#alert').removeClass('alert-danger');
          $('#alert').addClass('alert-success');
          $('#alert').css('display','block');
          document.getElementById("supplierForm").reset();
        }
        
      }
    });
  })
</script>

@endsection