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
		<a href="{{url('country/addcountryform')}}" class="btn btn-social btn-bitbucket pull-right">
		    <i class="fa fa-plus"></i> Add Country
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
		        Country Listing
		    </div>
		    <div class="panel-body">
			    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
			        <thead>
			            <tr>
			                <th>id</th>
			                <th>Country Name</th>
			                <th>Country Code</th>
			                <th>Status</th>
			                <th>Action</th>
			            </tr>
			        </thead>
			        <tbody>
			        	@foreach($countries as $country)
			            <tr class="odd gradeX">
			                <td>{{ $country->id }}</td>
			                <td>{{ $country->name }}</td>
			                <td>{{ $country->short_code }}</td>
			                <td>{!!($country->is_active == 'yes')? '<span class="label label-primary">active</span>' :'<span class="label label-danger">unactive</span>'!!}</td>
			                <td><a href="{{url('country/editcountry/'.$country->id)}}"><i class="fa fa-edit" title="Edit" data-toggle="tooltip"></i></a> <a onclick="deleteCountry('{{$country->id}}')"><i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i></a></td>
			                
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
	                columnDefs: [ { orderable: false, targets: [4] } ]
	        });
	        $('[data-toggle="tooltip"]').tooltip();
	    });
	    function deleteCountry(id){
	    	if(window.confirm('do you really wanna delete this record?')){
	    		var url = '{{url('country/deletecountry')}}';
	    		window.location.href = url+'/'+id;
	    	}
	    }
	</script>
@endsection