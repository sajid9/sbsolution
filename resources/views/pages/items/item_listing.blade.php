{{-- extend  --}}
@extends('layout.app2')
@extends('includes.header2')
@extends('includes.footer2')
@extends('includes.sidebar2')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Item')

{{-- add css which use only for this page --}}
@section('header')
	@parent
	<!-- Social Buttons CSS -->
	<link href="{{asset('css/bootstrap-social.css')}}" rel="stylesheet">
@endsection

{{-- page content --}}
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-6">
				<form id="fileUploadForm" method="POST" action="{{url('importCsv')}}" enctype="multipart/form-data">
					@csrf
				    <fieldset>
				        <div class="form-horizontal">
				            <div class="form-group">
				                <div class="row">
				                <label class="control-label col-md-3 text-right" for="filename"><span>Import Items</span></label>
				                <div class="col-md-9">
				                    <div class="input-group">
				                        <input type="file" id="uploadedFile" name="file" class="form-control form-control-sm" accept=".csv">
				                        <div class="input-group-btn">
				                            <input type="submit" value="Import" class="rounded-0 btn btn-primary">
				                        </div>
				                    </div>
				                </div>
				                </div>
				            </div>                        
				        </div>
				    </fieldset>    
				</form>
			</div>
			<div class="col-md-2 col-md-offset-4">
				<a href="{{url('item/additemform')}}" class="btn btn-social btn-bitbucket pull-right">
				    <i class="fa fa-plus"></i> Add Item
				</a>
			</div>
		</div>
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
			                <th>Sr #</th>
			                <th>item Name</th>
			                <th>Barcode</th>
			                <th>Purchase Price</th>
			                <th>Sale Price</th>
			                <th>Category</th>
			                <th>Type</th>
			                <th>Status</th>
			                <th>Action</th>
			            </tr>
			        </thead>
			        <tbody>
			        	<?php $count = 0; ?>
			        	@foreach($items as $item)
			            <tr class="odd gradeX">
			                <td>{{ ++$count }}</td>
			                <td>{{ $item->item_name }}</td>
			                <td>{{ $item->barcode }}</td>
			                <td>{{ $item->purchase_price }}</td>
			                <td>{{ $item->sale_price }}</td>
			                
			                <td>{{ ($item->categories)?$item->categories->category_name:'NULL' }}</td>
			                <td>{{$item->type}}</td>
			                <td>{!!($item->is_active == 'yes')? '<span class="label label-primary">active</span>' :'<span class="label label-danger">unactive</span>'!!}</td>
			                <td><a href="{{url('item/edititem/'.$item->id)}}"><i class="fa fa-edit" title="Edit" data-toggle="tooltip"></i></a> {{-- <a onclick="deleteItem('{{$item->id}}')"><i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i></a> --}}</td>
			                
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
	                columnDefs: [ { orderable: false, targets: [7] } ]
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