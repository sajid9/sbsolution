{{-- extend  --}}
@extends('layout.app2')
@extends('includes.header2')
@extends('includes.footer2')
@extends('includes.sidebar2')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Accounts')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Add Account
</div>
<div class="panel-body">
@if(Session::has('message'))
<div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong>Record Added Successfully
</div>
@endif
{{-- form start  --}}
<form method="post" action="{{url('opening/saveaccount')}}">
	@csrf
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="title">Account Title <span class="text-danger">*</span></label>
        <input type="text" tabindex="1"  name="title" value="{{old('title')}}" class="form-control" id="title" aria-describedby="title_msg" placeholder="enter the title">
        <small id="title_msg" class="form-text text-muted text-danger"></small>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="branchcode">Branch Code </label>
        <input type="text" tabindex="4" name="branchcode" class="form-control" id="branchcode" aria-describedby="branchcode_msg" placeholder="enter the branchcode">
        <small id="branchcode_msg" class="form-text text-muted text-danger"></small>
      </div>
      
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="amount">Amount <span class="text-danger">*</span></label>
        <input type="number" tabindex="2"  name="amount" value="{{old('amount')}}" class="form-control" id="amount" aria-describedby="amount_msg" placeholder="enter the amount">
        <small id="amount_msg" class="form-text text-muted text-danger"></small>
      </div>
      <div class="form-group">
        <label for="date">Date<span class="text-danger">*</span></label>
        <input type="date" tabindex="3"  name="date" value="{{old('date')}}" class="form-control" id="date" aria-describedby="date_msg" placeholder="enter the date">
        <small id="date_msg" class="form-text text-muted text-danger"></small>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
         <label for="branchname">Branch Name</label>
        <input type="text"  name="branchname" value="{{old('branchname')}}" class="form-control" id="branchname" tabindex="5" aria-describedby="branchname_msg" placeholder="enter the branch name">
        <small id="branchname_msg" class="form-text text-muted text-danger"></small>
      </div>
      <div class="form-group">
         <label for="accountno">Account Number </label>
        <input type="number" tabindex="6"  name="accountno" value="{{old('accountno')}}" class="form-control" id="accountno" aria-describedby="accountno_msg" placeholder="enter the branch name">
        <small id="accountno_msg" class="form-text text-muted text-danger"></small>
      </div>
    </div>
  </div>
  
  <button type="submit" tabindex="7" class="btn btn-primary">submit</button> <a href="{{url('opening/accountlisting')}}" tabindex="8" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection
