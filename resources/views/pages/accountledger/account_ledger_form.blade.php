{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Account Ledger')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Account Ledger
</div>
<div class="panel-body">

{{-- form start  --}}
<form method="post" action="{{url('ledger/accountledger')}}">
	@csrf
  <div class="form-group">
    <label for="account">Account <span class="text-danger">*</span></label>
    <select name="account_id" class="form-control" id="account" aria-describedby="account">
      <option value="">Select Account</option>
      @foreach($accounts as $account)
      <option value="{{ $account->id }}">{{ $account->account_title }}</option>
      @endforeach
    </select>
    <small id="account" class="form-text text-muted text-danger">{{$errors->first('account_id')}}</small>
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button> <a href="{{url('category/categorylisting')}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection