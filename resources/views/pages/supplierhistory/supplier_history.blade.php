{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Supplier History')

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
		<form class="form-inline" method="post" action="{{url('ledger/searchsupplier')}}">
			@csrf
		  <div class="form-group">
		    <label for="Supplier">Supplier:</label>
		    <select class="items-dropdown form-control" name="supplier" id="Supplier">
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
		        Supplier History
		    </div>
		    <div class="panel-body">
			    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
			        <thead>
			            <tr>
			                <th>id</th>
			                <th>Date</th>
			                <th>Type</th>
			                <th>Supplier</th>
			                <th>Debit</th>
			                <th>Credit</th>
			                <th>Balance</th>
			            </tr>
			        </thead>
			        <tbody>
			        	@foreach($ledgers as $ledger)
			        	<tr>
			        		<td>{{$ledger->id}}</td>
			        		<td>{{date_format(date_create($ledger->created_at),"d M Y H:i:s")}}</td>
			        		<td>{{$ledger->type}}</td>
			        		<td>{{$ledger->supplier->supplier_name}}</td>
			        		<td>{{$ledger->debit}}</td>
			        		<td>{{$ledger->credit}}</td>
			        		<td>{{$ledger->balance}}</td>
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
	         	    url: '{{url("ledger/getsupplier")}}',
	         	    dataType: 'json',
	         	    processResults: function (data) {
         	          	return {
         	            	"results": data
         	          	};
	         	    }
	         	  }
	         });
	    });
	</script>
@endsection