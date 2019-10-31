{{-- extend  --}}
@extends('layout.app2')
@extends('includes.header2')
@extends('includes.footer2')
@extends('includes.sidebar2')

{{-- page titles --}}
@section('title', 'Taxes')
@section('pagetitle', 'Taxes')

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
		<a href="{{url('tax/addtaxform')}}" class="btn btn-social btn-bitbucket pull-right">
		    <i class="fa fa-plus"></i> Add Tax
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
		        Tax Listing
		    </div>
		    <div class="panel-body">
			    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
			        <thead>
			            <tr>
			                <th>Sr #</th>
			                <th>Tax Name</th>
			                <th>Price</th>
			                <th>Status</th>
			                <th>Action</th>
			            </tr>
			        </thead>
			        <tbody>
			        	<?php $count = 0; ?>
			        	@foreach($taxes as $tax)
			            <tr class="odd gradeX">
			                <td>{{ ++$count }}</td>
			                <td>{{ $tax->name }}</td>
			                <td>{{ $tax->price }}</td>
			                <td>{!!($tax->is_active == 'yes')? '<span class="label label-primary">active</span>' :'<span class="label label-danger">inactive</span>'!!}</td>
			                <td><a href="{{url('tax/edittax/'.$tax->id)}}"><i class="fa fa-edit" title="Edit" data-toggle="tooltip"></i></a> {{-- <a onclick="deletestore('{{$store->id}}')"><i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i></a> --}}</td>
			                
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
	                responsive: true
	        });
	        $('[data-toggle="tooltip"]').tooltip();
	    });
	    function deletestore(id){
	    	if(window.confirm('do you really wanna delete this record?')){
	    		var url = '{{url('store/deletestore')}}';
	    		window.location.href = url+'/'+id;
	    	}
	    }
	</script>
@endsection