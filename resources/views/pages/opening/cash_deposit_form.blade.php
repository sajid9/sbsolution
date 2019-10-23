{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

{{-- page titles --}}
@section('title', 'Deposit / withdraw')
@section('pagetitle', 'Cash Deposit / Withdraw')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Cash Deposit / Withdraw
</div>
<div class="panel-body">
@if(Session::has('message'))
<div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong>Record Added Successfully
</div>
@endif
{{-- form start  --}}
<form method="post" action="{{url('opening/savedeposit')}}">
	@csrf
  
  <div class="row">
      <div class="form-group col-md-4">
        <label for="account">Account<span class="text-danger">*</span></label>
        <select tabindex="1"  name="account" class="form-control" id="account" aria-describedby="account_msg">
          <option value="">Select Account</option>
          @foreach($accounts as $account)
          <option value="{{$account->id}}">{{$account->account_title}}</option>
          @endforeach
        </select>
        <small id="account_msg" class="form-text text-muted text-danger">{{$errors->first('account')}}</small>
      </div>
      <div class="form-group col-md-4">
        <label for="amount">Amount <span class="text-danger">*</span></label>
        <input type="number" tabindex="2"  name="amount" value="{{old('amount')}}" class="form-control" id="amount" aria-describedby="amount_msg" placeholder="enter the amount">
        <small id="amount_msg" class="form-text text-muted text-danger">{{$errors->first('amount')}}</small>
      </div>
      <div class="form-group col-md-4">
        <label for="type">Type<span class="text-danger">*</span></label>
        <select tabindex="1"  name="type" class="form-control" id="type" aria-describedby="type_msg">
          <option value="">Select type</option>
          <option value="withdraw">Cash Withdraw</option>
          <option value="deposit">Cash Deposit</option>
          
        </select>
        <small id="type_msg" class="form-text text-muted text-danger">{{$errors->first('type')}}</small>
      </div>
  </div>
  <div class="row">
    <div class="form-group col-md-4">
        <label for="date">Date<span class="text-danger">*</span></label>
        <input type="date" tabindex="3"  name="date" value="{{old('date')}}" class="form-control" id="date" aria-describedby="date_msg" placeholder="enter the date">
        <small id="date_msg" class="form-text text-muted text-danger">{{$errors->first('date')}}</small>
      </div>
    <div class="form-group col-md-4">
      <label for="remarks">Remarks<span class="text-danger">*</span></label>
      <textarea tabindex="4"  name="remarks" class="form-control" id="remarks" aria-describedby="remarks_msg">{{old('date')}}</textarea>
      <small id="remarks_msg" class="form-text text-muted text-danger">{{$errors->first('remarks')}}</small>
    </div>
    <div class="col-md-4" style="padding-top: 35px;">
      <button type="submit" tabindex="5" class="btn btn-primary">submit</button> <a href="{{url('opening/accountlisting')}}" tabindex="6" class="btn btn-default">Back</a>
    </div>
  </div>
  
  
</form>
{{-- form end --}}

</div>
</div>
@endsection
