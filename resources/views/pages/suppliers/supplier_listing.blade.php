{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Supplier')

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
		<a href="{{url('supplier/addsupplierform')}}" class="btn btn-social btn-bitbucket pull-right">
		    <i class="fa fa-plus"></i> Add Supplier
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
		        Supplier Listing
		    </div>
		    <div class="panel-body">
			    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
			        <thead>
			            <tr>
			                <th>id</th>
			                <th>Supplier Name</th>
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
			        	@foreach($suppliers as $supplier)
			            <tr class="odd gradeX">
			                <td>{{ $supplier->id }}</td>
			                <td>{{ $supplier->supplier_name }}</td>
			                <td>{{ $supplier->email }}</td>
			                <td>{{ $supplier->address }}</td>
			                <td>{{ $supplier->phone }}</td>
			                <td>{{ $supplier->mobile }}</td>
			                <td>{{ $supplier->website }}</td>
			                <td>{{ $supplier->cnic }}</td>
			                <td><a href="{{url('supplier/editsupplier/'.$supplier->id)}}"><i class="fa fa-edit" title="Edit" data-toggle="tooltip"></i></a> {{-- <a onclick="deletesupplier('{{$supplier->id}}')"><i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i></a> --}}</td>
			                
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
	    function deletesupplier(id){
	    	if(window.confirm('do you really wanna delete this record?')){
	    		var url = '{{url('supplier/deletesupplier')}}';
	    		window.location.href = url+'/'+id;
	    	}
	    }
	</script>
@endsection