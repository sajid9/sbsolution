{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Voucher')

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
		<a href="{{url('voucher/addvoucherform')}}" class="btn btn-social btn-bitbucket pull-right">
		    <i class="fa fa-plus"></i> Add Voucher
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
		        Voucher Listing
		    </div>
		    <div class="panel-body">
			    <table class="table table-striped table-bordered table-hover" id="dataTables-voucher">
			        <thead>
			            <tr>
			                <th>id</th>
			                <th>Voucher No</th>
			                <th>Supplier</th>
			                <th>Total Amount</th>
			                <th>Paid Amount</th>
			                <th>Balance Amount</th>
			                <th>Action</th>
			            </tr>
			        </thead>
			        <tbody>
			        	@foreach($vouchers as $voucher)
			            <tr class="odd gradeX">
			                <td>{{ $voucher->id }}</td>
			                <td>{{ $voucher->voucher_no }}</td>
			                <td>{{ $voucher->supplier_id }}</td>
			                <td>{{ $voucher->total_amount }}</td>
			                <td>{{ $voucher->paid_amount }}</td>
			                <td>{{ $voucher->balance_amount }}</td>
			                <td><a href="{{url('voucher/editvoucher/'.$voucher->id)}}"><i class="fa fa-edit" title="Edit" data-toggle="tooltip"></i></a> <a onclick="deletevoucher('{{$voucher->id}}')"><i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i></a></td>
			                
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
	                columnDefs: [ { orderable: false, targets: [6] } ]
	        });
	        $('[data-toggle="tooltip"]').tooltip();
	    });
	    function deletevoucher(id){
	    	if(window.confirm('do you really wanna delete this record?')){
	    		var url = '{{url('item/deleteitem')}}';
	    		window.location.href = url+'/'+id;
	    	}
	    }
	</script>
@endsection