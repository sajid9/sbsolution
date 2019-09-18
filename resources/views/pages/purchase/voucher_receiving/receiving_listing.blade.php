{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

{{-- page titles --}}
@section('title', 'Voucher Receiving')
@section('pagetitle', 'Voucher Receiving')

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
		<a href="{{url('voucher/editvoucher/'.Request::segment(3))}}" class="btn btn-default">Back</a>
		<a href="{{url('voucher/add_receiving_form/'.Request::segment(3).'/'.Request::segment(4))}}" class="btn btn-social btn-bitbucket pull-right">
		    <i class="fa fa-plus"></i> Add Receiving
		</a>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		{{-- alets messages --}}		
		@include('includes.alerts')
		<div class="panel panel-default">
		    <div class="panel-heading">
		        Item Detail
		    </div>
		    <div class="panel-body">
		    	<table class="table table-striped table-bordered table-hover" >
			        <thead>
			            <tr>
			                <th>Sr #</th>
			                <th>Voucher</th>
			                <th>Item</th>
			                <th>Quantity</th>
			                <th>Boxes</th>
			                <th>Pieces</th>
			                <th>Meter</th>
			                <th>Date</th>
			            </tr>
			        </thead>
			        <tbody>
			            <tr class="odd gradeX">
			            	<?php $obj = CH::convert_box($item_s->qty,$item_s->pieces,$item_s->meter)?>
			                <td>1</td>
			                <td>{{ $item_s->voucher_no }}</td>
			                <td>{{ $item_s->item_name }}</td>
			                <td>{{ $item_s->qty}}</td>
			                <td>{{ $obj['boxes'] }}</td>
			                <td>{{ $obj['pieces'] }}</td>
			                <td>{{ $obj['meter'] }}</td>
			                <td>{{ $item_s->created_at }}</td>
			            </tr>
			            
			        </tbody>
			    </table>
			</div>
		</div>
		{{-- panel start --}}
		<div class="panel panel-default">
		    <div class="panel-heading">
		        Receiving Listing
		    </div>
		    <div class="panel-body">
			    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
			        <thead>
			            <tr>
			                <th>Sr #</th>
			                <th>Voucher</th>
			                <th>Item</th>
			                <th>Quantity</th>
			                <th>Date</th>
			                <th>Action</th>
			            </tr>
			        </thead>
			        <tbody>
			        	<?php $count = 0; ?>
			        	@foreach($receivings as $receiving)
			            <tr class="odd gradeX">
			                <td>{{ ++$count }}</td>
			                <td>{{ $receiving->voucher->voucher_no }}</td>
			                <td>{{ $receiving->item->item_name }}</td>
			                <td>{{ $receiving->qty / $receiving->item->pieces}}</td>
			                <td>{{ $receiving->date }}</td>
			                <td><a href="{{url('voucher/receivingstore/'.$receiving->voucher_id.'/'.$receiving->item_id.'/'.$receiving->qty.'/'.$receiving->id)}}"><i class="fa fa-plus" title="Add to Store" data-toggle="tooltip"></i></a> {{-- <a onclick="deletestore('{{$store->id}}')"><i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i></a> --}}</td>
			                
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
	    		var url = '{{url('group/deletegroup')}}';
	    		window.location.href = url+'/'+id;
	    	}
	    }
	</script>
@endsection