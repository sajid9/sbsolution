{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

{{-- page titles --}}
@section('title', 'Voucher Receiving')
@section('pagetitle', 'Add to Stores')

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
		<a href="{{url('voucher/receivinglisting/'.Request::segment(3).'/'.Request::segment(4))}}" class="btn btn-default">Back</a>
		<a href="{{url('voucher/addreceivingstoreform/'.Request::segment(3).'/'.Request::segment(4).'/'.Request::segment(5).'/'.Request::segment(6))}}" class="btn btn-social btn-bitbucket pull-right">
		    <i class="fa fa-plus"></i> Add Receiving to Stores
		</a>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		{{-- alets messages --}}		
		@include('includes.alerts')
		<div class="panel panel-default">
		    <div class="panel-heading">
		        Delivered Item Detail
		    </div>
		    <div class="panel-body">
			    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
			        <thead>
			            <tr>
			                <th>Sr #</th>
			                <th>voucher</th>
			                <th>Item</th>
			                <th>Pieces</th>
			                <th>Boxes</th>
			                <th>Pieces</th>
			                <th>Meter</th>
			            </tr>
			        </thead>
			        <tbody>
			        	<?php $obj = CH::convert_box($received_item->qty,$received_item->pieces,$received_item->meter)?>
			            <tr class="odd gradeX">
			                <td>1</td>
			                <td>{{ $received_item->voucher_no }}</td>
			                <td>{{ $received_item->item_name }}</td>
			                <td>{{ $received_item->qty}}</td>
			                <td>{{ $obj['boxes'] }}</td>
			                <td>{{ $obj['pieces'] }}</td>
			                <td>{{ $obj['meter'] }}</td>
			            </tr>
			        </tbody>
			    </table>
		</div>
		{{-- panel start --}}
		<div class="panel panel-default">
		    <div class="panel-heading">
		        Receiving Store Listing
		    </div>
		    <div class="panel-body">
			    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
			        <thead>
			            <tr>
			                <th>Sr #</th>
			                <th>Voucher</th>
			                <th>Item</th>
			                <th>Quantity</th>
			                <th>Store</th>
			                <th>Action</th>
			            </tr>
			        </thead>
			        <tbody>
			        	<?php $count = 0; ?>
			        	@foreach($items as $item)
			            <tr class="odd gradeX">
			                <td>{{ ++$count }}</td>
			                <td>{{ $item->voucher->voucher_no }}</td>
			                <td>{{ $item->item->item_name }}</td>
			                <td>{{ ($item->return_item->returnitem != null) ? ($item->purchase - $item->return_item->returnitem) / $item->item->pieces : $item->purchase / $item->item->pieces}}</td>
			                <td>{{ $item->storeobj->name }}</td>
			                <td><i class="glyphicon glyphicon-share" onclick="returnItem('{{$item->id}}','{{$item->voucher_id}}','{{$item->item_id}}','{{ ($item->return_item->returnitem != null) ? ($item->purchase - $item->return_item->returnitem) / $item->item->pieces : $item->purchase / $item->item->pieces}}','{{Request::segment(6)}}','{{ $item->store }}')"></i></td>
			            </tr>
			            @endforeach
			        </tbody>
			    </table>
		</div>
	</div>
	</div>
</div>
<div class="modal fade" id="returnItem" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Items</h4>
        </div>
        <div class="modal-body">
          <form id="return_form">
            @csrf
            <input type="hidden" name="parent_id" id="parent_id">
            <input type="hidden" name="voucher_id" id="voucher_id">
            <input type="hidden" name="item_id" id="item_id">
            <input type="hidden" name="receiving_id" id="receiving_id">
            <input type="hidden" name="store" id="store">
            <div class="form-group">
              <label for="t_qty">Total Quantity</label>
              <input type="number" name="total_quantity" disabled="disabled" class="form-control" id="t_qty">
            </div>
            <div class="form-group">
              <label for="return_pieces">Returned Pieces</label>
              <input type="number" disabled="disabled" value="" class="form-control" id="return_pieces">
            </div>
            <div class="form-group">
              <label for="qty">Quantity</label>
              <input type="number" name="quantity" class="form-control" id="qty" placeholder="Enter the quantity to return">
              <small id="qty_msg" class="form-text text-muted text-danger"></small>
            </div>
            <button type="submit" id="qty_sub" class="btn btn-default">Submit</button>
          </form>
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
	        $('#qty').on('keyup',function(){
	          var total_qty = parseInt($('#t_qty').val());
	          var qty = parseInt($('#qty').val()) + parseInt($('#return_pieces').val());
	          if(qty > total_qty){
	            $('#qty_msg').text('Quantity should be less then total quantity');
	            $('#qty_sub').prop('disabled',true);
	          }else{
	            $('#qty_msg').text('');
	            $('#qty_sub').prop('disabled',false);
	          }
	        })
	    });
	    function returnItem(parentId,voucherId,itemId,qty,receivingId,store){
    	  $('#returnItem').modal('show');
    	  $('#t_qty').val(qty);
    	  $('#voucher_id').val(voucherId);
    	  $('#item_id').val(itemId);
    	  $('#receiving_id').val(receivingId);
    	  $('#store').val(store);
    	  $('#parent_id').val(parentId);
    	  $.ajax({
    	  	url:"{{url('voucher/getreturned')}}",
    	  	type:"post",
    	  	dataType:"json",
    	  	data:{_token:"{{csrf_token()}}",voucher:voucherId,item:itemId,receiving_id:receivingId,parentId:parentId},
    	  	success:function(res){
    	  		var pieces = parseInt("{{$received_item->pieces}}");
    	  		console.log(res.total / pieces);
    	  		$('#return_pieces').val(res.total / pieces);
    	  	}
    	  });
    	}
    	$('#return_form').on('submit',function(e){
    	  e.preventDefault();
    	  var data = $(this).serialize();
    	  $.ajax({
    	    url:"{{url('voucher/returnitem')}}",
    	    type:"post",
    	    dataType:"json",
    	    data:data,
    	    success:function(res){
    	      if(res.message == 'successfully'){
    	        $('#return_form')[0].reset();
    	        $('#returnItem').modal('hide');
    	        $.toast({
	                        heading: 'SUCCESS',
	                        text: 'Item Returned Successfully',
	                        icon: 'success',
	                        position: 'top-right', 
	                        loader: true,        // Change it to false to disable loader
	                        loaderBg: '#9EC600'  // To change the background
	                    })
    	      }
    	    }
    	  });
    	})
	    function deletestore(id){
	    	if(window.confirm('do you really wanna delete this record?')){
	    		var url = '{{url('group/deletegroup')}}';
	    		window.location.href = url+'/'+id;
	    	}
	    }
	</script>
@endsection