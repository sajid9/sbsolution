{{-- extend  --}}
@extends('layout.app2')
@extends('includes.header2')
@extends('includes.footer2')
@extends('includes.sidebar2')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Item Ledger')

{{-- add css which use only for this page --}}
@section('header')
	@parent
	<!-- Social Buttons CSS -->
	<link href="{{asset('css/bootstrap-social.css')}}" rel="stylesheet">
@endsection

{{-- page content --}}
@section('content')
<div class="row" style="margin-bottom: 10px;">
	<div class="col-md-12">
		<form class="form-inline" method="post" action="{{url('ledger/searchitem')}}">
			@csrf
		  <div class="form-group">
		    <label for="Item">Item:</label>
		    <select class="items-dropdown form-control" name="item" id="Item">
		    </select>
		  </div>
		  <div class="form-group">
		    <label for="store">Stores:</label>
		    <select class="form-control" name="store" id="store">
		    	<option value="">Select Store</option>
		    	@foreach($stores as $store)
		    	<option value="{{$store->id}}">{{$store->name}}</option>
		    	@endforeach
		    </select>
		  </div>
		  <div class="form-group">
		    <label for="frm">From:</label>
		    <input type="date" class="form-control" id="frm" name="from">
		  </div>
		  <div class="form-group">
		    <label for="to">To:</label>
		    <input type="date" class="form-control" id="to" name="to">
		  </div>
		  <button type="submit" class="btn btn-success">Search</button>
		</form>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		{{-- panel start --}}
		<div class="panel panel-default">
		    <div class="panel-heading">
		        Item Ledger
		    </div>
		    <div class="panel-body">
			    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
			        <thead>
			            <tr>
			                <th>Sr #</th>
			                <th>Date</th>
			                <th>Voucher No</th>
			                <th>Receipt No</th>
			                <th>Desc</th>
			                <th>Item Name</th>
			                <th>Group</th>
			                <th>Store</th>
			                <th>In</th>
			                <th>Out</th>
			                <th>Total</th>
			            </tr>
			        </thead>
			        <tbody>
			        	<?php $count = 0; ?>
			        	@foreach($ledgers as $ledger)
			        	<tr>

			        		<td>{{ ++$count }}</td>
			        		<td>{{date_format(date_create($ledger->created_at),"d M Y H:i:s")}}</td>
			        		<td>{{(isset($ledger->voucher))?$ledger->voucher->voucher_no:''}}</td>
			        		<td>{{$ledger->receipt_id}}</td>
			        		<td>{{$ledger->description}}</td>
			        		<td>{{(isset($ledger->items)) ? $ledger->items->item_name : ""}}</td>
			        		<td>{{(isset($ledger->items->groups)) ? $ledger->items->groups->name : ""}}</td>
			        		<td>{{(isset($ledger->stores)) ? $ledger->stores->name : ""}}</td>
			        		<td>{{($ledger->items->type == 'tile') ? $ledger->purchase / $ledger->items->pieces : $ledger->purchase}}</td>
			        		<td>{{($ledger->items->type == 'tile') ? $ledger->sale / $ledger->items->pieces : $ledger->sale}}</td>
			        		<td>{{($ledger->items->type == 'tile')? intval($ledger->left / $ledger->items->pieces) :$ledger->left}}</td>
			        		
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
	<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script>
	    $(document).ready(function() {
	        $('#dataTables-example').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
         	            'copy', 'csv', 'excel', 'pdf', 'print'
         	        ],
	        });
	        $('[data-toggle="tooltip"]').tooltip();
	         $('.items-dropdown').select2({
	         	width: '200px',
	         	ajax: {
	         	    url: '{{url("ledger/getitems")}}',
	         	    dataType: 'json',
	         	    processResults: function (data) {
         	          	return {
         	            	"results": data
         	          	};
	         	    }
	         	  }
	         });
	    });
	    function deleteItem(id){
	    	if(window.confirm('do you really wanna delete this record?')){
	    		var url = '{{url('item/deleteitem')}}';
	    		window.location.href = url+'/'+id;
	    	}
	    }
	</script>
@endsection