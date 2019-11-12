{{-- extend  --}}
@extends('layout.app2')
@extends('includes.header2')
@extends('includes.footer2')
@extends('includes.sidebar2')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'SubClass')

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
		<a href="{{ url('subclass/addsubclassform' )}}/{{ Request::segment(3) }}" class="btn btn-social btn-bitbucket pull-right">
		    <i class="fa fa-plus"></i> Add Sub-Class
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
		        Class Listing
		    </div>
		    <div class="panel-body">
			    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
			        <thead>
			            <tr>
			                <th>Sr#</th>
			                <th>Class Name</th>
			                <th>Description</th>
			                <th>Status</th>
			                <th>Action</th>
			            </tr>
			        </thead>
			        <tbody>
			        	<?php $count = 0; ?>
			        	@foreach($classes as $class)
			            <tr class="odd gradeX">
			                <td>{{ ++$count }}</td>
			                <td>{{ $class->class_name }}</td>
			                <td>{{ $class->description }}</td>
			                <td>{!!($class->is_active == 'yes')? '<span class="label label-primary">active</span>' :'<span class="label label-danger">unactive</span>'!!}</td>
			                <td><a href="{{url('subclass/editclass/'.$class->id)}}"><i class="fa fa-edit" data-toggle="tooltip" title="Edit"></i></a> {{-- <a onclick="deleteClass('{{$class->id}}')"><i class="fa fa-trash" data-toggle="tooltip" title="delete"></i></a> --}}</td>
			                
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
	    function deleteClass(id){
	    	if(window.confirm('do you really wanna delete this record?')){
	    		var url = '{{url('subclass/deleteclass')}}';
	    		var parentId = '{{Request::segment(3)}}';
	    		window.location.href = url+'/'+parentId+'/'+id;
	    	}
	    }
	</script>
@endsection