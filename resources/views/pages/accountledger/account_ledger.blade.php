{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Dashboard')

{{-- add css which use only for this page --}}
@section('header')
	@parent
	<!-- Social Buttons CSS -->
	<link href="{{asset('css/bootstrap-social.css')}}" rel="stylesheet">
@endsection

{{-- page content --}}
@section('content')
<div class="row" style="padding-bottom: 10px">
	<div class="col-md-12">
		<a href="{{url('payment/addpaymentform')}}" class="btn btn-social btn-bitbucket pull-right">
		    <i class="fa fa-plus"></i> Add Payment
		</a>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		{{-- alets messages --}}		
		@include('includes.alerts')
		
		{{-- panel start --}}
		<div class="panel panel-default">
		    <div class="panel-heading">
		        Payment Listing
		    </div>
		    <div class="panel-body">
			    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
			        <thead>
			            <tr>
			                <th>Sr#</th>
			                <th>Account</th>
			                <th>Supplier</th>
			                <th>Voucher</th>
			                <th>Customer</th>
			                <th>Receipt</th>
			                <th>Type</th>
			                <th>Debit</th>
			                <th>Credit</th>
			                <th>Date</th>
			                <th>Action</th>
			            </tr>
			        </thead>
			        <tbody>
			        	<tr>
			        		<td></td>
			        		<td></td>
			        		<td></td>
			        		<td></td>
			        		<td></td>
			        		<td></td>
			        		<td></td>
			        		<td>Opening Balance:</td>
			        		<td>{{$payments[0]->account->balance}}</td>
			        		<td></td>
			        		<td></td>
			        	</tr>
			        	<?php $count = 0; ?>
			        	@foreach($payments as $payment)
			            <tr class="odd gradeX">
			                <td>{{ ++$count }}</td>
			                <td>{{($payment->account != null) ? $payment->account->account_title : "null" }}</td>
			                <td>{{ ($payment->supplier != null) ? $payment->supplier->supplier_name : "null" }}</td>
			                <td>{{ ($payment->voucher != null) ? $payment->voucher->voucher_no : "null" }}</td>
			                <td>{{ ($payment->customer != null) ? $payment->customer->customer_name : "null"}}</td>
			                <td>{{ ($payment->receipt != null) ? $payment->receipt->receipt_no : "null" }}</td>
			                <td>{{ $payment->type }}</td>
			                <td>{{ $payment->debit }}</td>
			                <td>{{ $payment->credit }}</td>
			                <td>{{ date_format($payment->created_at,'d M Y') }}</td>
			                <td><a href="{{url('payment/editpayment/'.$payment->id)}}"><i class="fa fa-edit" title="Edit" data-toggle="tooltip"></i>{{-- </a> <a onclick="deletepayment('{{$payment->id}}')"><i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i></a> --}}</td>
			                
			            </tr>
			            @endforeach
			            <tr>
			        		<td></td>
			        		<td></td>
			        		<td></td>
			        		<td></td>
			        		<td></td>
			        		<td></td>
			        		<td></td>
			        		<td>Net Balance:</td>
			        		<td>{{$payments[0]->account->balance - $total->total }}</td>
			        		<td></td>
			        		<td></td>
			        	</tr>
			        </tbody>
			    </table>
		</div>
	</div>
	</div>
</div>

@endsection

{{-- add js files which use only for this current page --}}

@section('footer')
	@parent
	<!-- DataTables JavaScript -->
	<script src="{{asset('js/dataTables/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('js/dataTables/dataTables.bootstrap.min.js')}}"></script>
	<script>
	    $(document).ready(function() {
	        $('#dataTables-example').DataTable({
	                responsive: true
	        });
	        $('[data-toggle="tooltip"]').tooltip();
	    });
	    function deletepayment(id){
	    	if(window.confirm('do you really wanna delete this record?')){
	    		var url = '{{url('payment/deletecategory')}}';
	    		window.location.href = url+'/'+id;
	    	}
	    }
	</script>
@endsection