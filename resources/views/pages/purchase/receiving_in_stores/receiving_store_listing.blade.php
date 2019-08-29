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
			                <td>{{ $item->voucher_id }}</td>
			                <td>{{ $item->item_id }}</td>
			                <td>{{ $item->purchase }}</td>
			                <td>{{ $item->store }}</td>
			                <td><i class="glyphicon glyphicon-share" onclick="returnItem('{{$item->voucher_id}}','{{$item->item_id}}','{{$item->purchase}}','{{$item->purchase_price}}')"></i></td>
			                
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
            <input type="hidden" name="voucher_id" id="voucher_id">
            <input type="hidden" name="item_id" id="item_id">
            <input type="hidden" name="purchase_price" id="purchase_price_modal">
            <div class="form-group">
              <label for="t_qty">Total Quantity</label>
              <input type="number" name="total_quantity" disabled="disabled" class="form-control" id="t_qty">
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
	          var qty = parseInt($('#qty').val());
	          if(qty > total_qty){
	            $('#qty_msg').text('Quantity should be less then total quantity');
	            $('#qty_sub').prop('disabled',true);
	          }else{
	            $('#qty_msg').text('');
	            $('#qty_sub').prop('disabled',false);
	          }
	        })
	    });
	    function returnItem(voucherId,itemId,qty,purchasePrice){
    	  $('#returnItem').modal('show');
    	  $('#t_qty').val(qty);
    	  $('#voucher_id').val(voucherId);
    	  $('#item_id').val(itemId);
    	  $('#purchase_price_modal').val(purchasePrice);
    	}
	    function deletestore(id){
	    	if(window.confirm('do you really wanna delete this record?')){
	    		var url = '{{url('group/deletegroup')}}';
	    		window.location.href = url+'/'+id;
	    	}
	    }
	</script>
@endsection