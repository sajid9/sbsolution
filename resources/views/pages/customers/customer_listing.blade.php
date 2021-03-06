{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Customer')

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
		<a href="{{url('customer/addcustomerform')}}" class="btn btn-social btn-bitbucket pull-right">
		    <i class="fa fa-plus"></i> Add Customer
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
		        Customer Listing
		    </div>
		    <div class="panel-body">
			    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
			        <thead>
			            <tr>
			                <th>Sr#</th>
			                <th>Customer Name</th>
			                <th>Address</th>
			                <th>Phone</th>
			                <th>Mobile</th>
			                <th>Email</th>
			                <th>Website</th>
			                <th>Cnic</th>
			                <th>Action</th>
			            </tr>
			        </thead>
			        <tbody>
			        	<?php $count = 0; ?>
			        	@foreach($customers as $customer)
			            <tr class="odd gradeX">
			                <td>{{ ++$count }}</td>
			                <td>{{ $customer->customer_name }}</td>
			                <td>{{ $customer->email }}</td>
			                <td>{{ $customer->address }}</td>
			                <td>{{ $customer->phone }}</td>
			                <td>{{ $customer->mobile }}</td>
			                <td>{{ $customer->website }}</td>
			                <td>{{ $customer->cnic }}</td>
			                <td><a href="{{url('customer/editcustomer/'.$customer->id)}}"><i class="fa fa-edit" title="Edit" data-toggle="tooltip"></i></a> <a onclick="deletecustomer('{{$customer->id}}')"><i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i></a></td>
			                
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
	        $('#dataTables-example').DataTable({
	                responsive: true,
	                columnDefs: [ { orderable: false, targets: [8] } ]
	        });
	        $('[data-toggle="tooltip"]').tooltip();
	    });
	    function deletecustomer(id){
	    	if(window.confirm('do you really wanna delete this record?')){
	    		var url = '{{url('customer/deletecustomer')}}';
	    		window.location.href = url+'/'+id;
	    	}
	    }
	</script>
@endsection