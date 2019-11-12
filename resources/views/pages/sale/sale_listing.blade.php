{{-- extend  --}}
@extends('layout.app2')
@extends('includes.header2')
@extends('includes.footer2')
@extends('includes.sidebar2')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Sale Order')

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
		<a href="{{url('sale/addreceiptform')}}" class="btn btn-social btn-bitbucket pull-right">
		    <i class="fa fa-plus"></i> Add Receipt
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
		        Receipt Listing
		    </div>
		    <div class="panel-body">
			    <table class="table table-striped table-bordered table-hover" id="dataTables-voucher">
			        <thead>
			            <tr>
			                <th>Sr#</th>
			                <th>Receipt No</th>
			                <th>Customer</th>
			                <th>Total Amount</th>
			                <th>Paid Amount</th>
			                <th>Return Amount</th>
			                <th>Balance Amount</th>
			                <th>Action</th>
			            </tr>
			        </thead>
			        <tbody>
			        	<?php $count = 0; ?>
			        	@foreach($receipts as $receipt)
			            <tr class="odd gradeX">
			                <td>{{ ++$count }}</td>
			                <td>{{ $receipt->receipt_no }}</td>
			                <td>{{ $receipt->customer_id }}</td>
			                <td>{{ $receipt->total_amount }}</td>
			                <td>{{ $receipt->paid_amount }}</td>
			                <td>{{ $receipt->return_amount }}</td>
			                <td>{{ $receipt->total_amount - ($receipt->paid_amount + $receipt->return_amount) }}</td>
			                <td><a href="{{url('invoice/sale/'.$receipt->id)}}"><i class="fa fa-print" title="Print" data-toggle="tooltip"></i></a> <a href="{{url('sale/editreceipt/'.$receipt->id)}}"><i class="fa fa-edit" title="Edit" data-toggle="tooltip"></i></a></td>
			                
			            </tr>
			            @endforeach
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
	        $('#dataTables-voucher').DataTable({
	                responsive: true,
	                columnDefs: [ { orderable: false, targets: [7] } ]
	        });
	        $('[data-toggle="tooltip"]').tooltip();
	    });
	</script>
@endsection