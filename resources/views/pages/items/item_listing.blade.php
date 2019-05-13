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
		<a href="{{url('item/additemform')}}" class="btn btn-social btn-bitbucket pull-right">
		    <i class="fa fa-plus"></i> Add Item
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
		        Item Listing
		    </div>
		    <div class="panel-body">
			    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
			        <thead>
			            <tr>
			                <th>id</th>
			                <th>item Name</th>
			                <th>Barcode</th>
			                <th>Purchase Price</th>
			                <th>Sale Price</th>
			                <th>Supplier</th>
			                <th>Category</th>
			                <th>Status</th>
			                <th>Action</th>
			            </tr>
			        </thead>
			        <tbody>
			        	@foreach($items as $item)
			            <tr class="odd gradeX">
			                <td>{{ $item->id }}</td>
			                <td>{{ $item->item_name }}</td>
			                <td>{{ $item->barcode }}</td>
			                <td>{{ $item->purchase_price }}</td>
			                <td>{{ $item->sale_price }}</td>
			                <td>{{ ($item->suppliers)? $item->suppliers->supplier_name: 'NULL' }}</td>
			                <td>{{ ($item->categories)?$item->categories->category_name:'NULL' }}</td>
			                <td>{!!($item->is_active == 'yes')? '<span class="label label-primary">active</span>' :'<span class="label label-danger">unactive</span>'!!}</td>
			                <td><a href="{{url('item/edititem/'.$item->id)}}"><i class="fa fa-edit" title="Edit" data-toggle="tooltip"></i></a> <a onclick="deleteItem('{{$item->id}}')"><i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i></a></td>
			                
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
	    function deleteItem(id){
	    	if(window.confirm('do you really wanna delete this record?')){
	    		var url = '{{url('item/deleteitem')}}';
	    		window.location.href = url+'/'+id;
	    	}
	    }
	</script>
@endsection