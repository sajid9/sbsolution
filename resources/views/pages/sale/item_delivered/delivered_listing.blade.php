{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

{{-- page titles --}}
@section('title', 'Item Delivered')
@section('pagetitle', 'Item  Delivered')

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
		<a href="{{url('sale/editreceipt/'.Request::segment(3))}}" class="btn btn-default">Back</a>
		<a href="{{url('sale/add_delivery_form/'.Request::segment(3).'/'.Request::segment(4))}}" class="btn btn-social btn-bitbucket pull-right">
		    <i class="fa fa-plus"></i> Add Delivery
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
		        Item Detail
		    </div>
		    <div class="panel-body">
		    	<table class="table table-striped table-bordered table-hover" >
			        <thead>
			            <tr>
			                <th>Sr #</th>
			                <th>Receipt</th>
			                <th>Item</th>
			                <th>Quantity</th>
			                @if($item_p->type == 'tile')
			                <th>Boxes</th>
			                <th>Pieces</th>
			                <th>Meter</th>
			                @endif
			                <th>Date</th>
			            </tr>
			        </thead>
			        <tbody>
			            <tr class="odd gradeX">
			            	<?php 
			            	if($item_p->type == 'tile'){
			            		$obj = CH::convert_box($item_p->qty,$item_p->pieces,$item_p->meter);
			            	}?>
			                <td>1</td>
			                <td>{{ $item_p->receipt_no }}</td>
			                <td>{{ $item_p->item_name }}</td>
			                <td>{{ $item_p->qty}}</td>
			                @if($item_p->type == 'tile')
			                <td>{{ $obj['boxes'] }}</td>
			                <td>{{ $obj['pieces'] }}</td>
			                <td>{{ $obj['meter'] }}</td>
			                @endif
			                <td>{{ $item_p->created_at }}</td>
			            </tr>
			            
			        </tbody>
			    </table>
		</div>
	</div>
	<div class="panel panel-default">
		    <div class="panel-heading">
		        Delivered Listing
		    </div>
		    <div class="panel-body">
		    	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
			        <thead>
			            <tr>
			                <th>Sr #</th>
			                <th>Receipt</th>
			                <th>Item</th>
			                <th>Pieces</th>
			                @if($item_p->type == 'tile')
			                <th>Boxes</th>
			                <th>Pieces</th>
			                <th>Meter</th>
			                @endif
			                <th>Date</th>
			                <th>Action</th>
			            </tr>
			        </thead>
			        <tbody>
			        	<?php $count = 0; ?>
			        	@foreach($delivered_items as $item)
				            <tr class="odd gradeX">
				            	<?php 
				            	if($item_p->type == 'tile'){
				            		$obj = CH::convert_box($item->qty,$item->item->pieces,$item->item->meter);
				            	}?>
				                <td>{{ ++$count }}</td>
				                <td>{{ $item->receipt->receipt_no }}</td>
				                <td>{{ $item->item->item_name }}</td>
				                <td>{{ $item->qty}}</td>
				                @if($item_p->type == 'tile')
				                <td>{{ $obj['boxes'] }}</td>
				                <td>{{ $obj['pieces'] }}</td>
				                <td>{{ $obj['meter'] }}</td>
				                @endif
				                <td>{{ $item->date }}</td>
				                <td><a href="{{url('sale/storelisting/'.$item->receipt_id.'/'.$item->item_id.'/'.$item->qty.'/'.$item->id)}}"><i class="fa fa-plus" title="Add to Store" data-toggle="tooltip"></i></a> {{-- <a onclick="deletestore('{{$store->id}}')"><i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i></a> --}}</td>
				                
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