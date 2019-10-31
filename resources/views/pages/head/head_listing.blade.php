{{-- extend  --}}
@extends('layout.app2')
@extends('includes.header2')
@extends('includes.footer2')
@extends('includes.sidebar2')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Head')

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
		<a href="{{url('expenditure/addhead')}}" class="btn btn-social btn-bitbucket pull-right">
		    <i class="fa fa-plus"></i> Add Head
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
		        Head Listing
		    </div>
		    <div class="panel-body">
			    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
			        <thead>
			            <tr>
			                <th>Sr#</th>
			                <th>name</th>
			                <th>Status</th>
			                <th>Action</th>
			            </tr>
			        </thead>
			        <tbody>
			        	<?php $count = 0; ?>
			        	@foreach($heads as $head)
			            <tr class="odd gradeX">
			                <td>{{ ++$count }}</td>
			                <td>{{ $head->name }}</td>
			                <td>{!!($head->is_active == 'yes')? '<span class="label label-primary">active</span>' :'<span class="label label-danger">inactive</span>'!!}</td>
			                <td><a class="btn btn-xs btn-warning" href="{{url('expenditure/edithead/'.$head->id)}}"><i class="fa fa-edit" title="Edit" data-toggle="tooltip"></i></a> <a class="btn btn-xs btn-success" href="{{url('expenditure/subheadlisting/'.$head->id)}}"><i class="fa fa-plus" data-toggle="tooltip" title="Add Subhead"></i></a></td>
			                
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
	    function deleteCompany(id){
	    	if(window.confirm('do you really wanna delete this record?')){
	    		var url = '{{url('company/deletecompany')}}';
	    		window.location.href = url+'/'+id;
	    	}
	    }
	</script>
@endsection