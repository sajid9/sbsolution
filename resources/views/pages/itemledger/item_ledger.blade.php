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
<div class="row">
	<div class="col-md-12">
		<form class="form-inline" action="/action_page.php">
		  <div class="form-group">
		    <label for="Item">Item:</label>
		    <select class="items-dropdown form-control" name="Item" id="Item">
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
		  <button type="submit" class="btn btn-default">Search</button>
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
			                <th>id</th>
			                <th>Date</th>
			                <th>Voucher No</th>
			                <th>Desc</th>
			                <th>In/Dr Qty</th>
			                <th>Out/Cr Qty</th>
			                <th>Balance Qty</th>
			            </tr>
			        </thead>
			        <tbody>
			        	@foreach($ledgers as $ledger)
			        	<tr>
			        		<td>{{$ledger->item_id}}</td>
			        		<td>{{date_format($ledger->created_at,"d M Y H:i:s")}}</td>
			        		<td>{{$ledger->voucher_id}}</td>
			        		<td>{{$ledger->description}}</td>
			        		<td>{{$ledger->purchase}}</td>
			        		<td>{{$ledger->sale}}</td>
			        		<td>{{$ledger->left}}</td>
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