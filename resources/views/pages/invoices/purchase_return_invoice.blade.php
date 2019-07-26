
<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/custom_style.css') }}" rel="stylesheet">	
</head>
<body>
	<?php $date=date_create($data->created_at); ?>
<div class="container">
	<div class="row">
		<div class="col-md-6 col-xs-6"><img class="img-responsive"  src="{{ env('APP_URL') }}/storage/app/{{$company->logo}}" alt=""></div>
		<div class="col-md-6 col-xs-6" style="text-align: right;"><h1>Purchase Return INVOICE</h1></div>
	</div>
	<div class="row">
		<div class="col-md-3 col-xs-3">
			<h6>{{$company->name}}</h6>
			<h6>{{$company->address}}</h6>
			<h6>{{$company->phone}}</h6>
			<h6>{{$company->email}}</h6>
			<h6>{{$company->website}}</h6>
		</div>
		<div class="col-md-3 col-xs-3 col-md-offset-6 col-xs-offset-6">
			<div style="background-color: #efefef;text-align: center;">Date</div>
			<div style="text-align: center;">{{date_format($date,'d M Y')}}</div>
			<div style="background-color: #efefef;text-align: center;">Voucher No</div>
			<div style="text-align: center;">{{$data->voucher_no}}</div>
			<div style="background-color: #efefef;text-align: center;">Supplier No</div>
			<div style="text-align: center;">{{$data->supplier_id}}</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 col-xs-3">
			<h4 style="background-color: #efefef;text-align: center;">BILL TO</h4>
			<div>Supplier name: {{$data->supplier_name}}</div>
			<div>Phone: {{$data->mobile}}</div>
			<div>Email: {{$data->email}}</div>
			<div>Address: {{$data->address}}</div>
		</div>
		<div class="col-md-3 col-xs-3 col-xs-offset-6 col-md-offset-6">
			
		</div>
	</div>
</div>

{{-- <h1 style="text-align: center;">SB Software Solution</h1>
<h3 style="text-align: center;">Shop# 1-2 Swan Heights Plaza Sowan Garden Islamabad</h3>
<h1 style="text-align: center;">Invoice</h1>
<div style="padding:10px;">
<div class="row">
	<div class="col-xs-6">
		<div class="row">
			<div class="col-xs-6 col-md-3">
				<strong>Customer Name:</strong>
			</div>
			<div class="col-xs-6 col-md-3">
				{{(isset($data->customer_name)) ? $data->customer_name :$data->supplier_name }}
			</div>
		</div>
	</div>
	<div class="col-xs-6">
		<div class="row">
			<div class="col-xs-6 col-md-3">
				<strong>Date:</strong>
			</div>
			<div class="col-xs-6 col-md-3">
				{{(isset($data->receipt_date)) ? $data->receipt_date : $data->voucher_date }}
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-6">
		<div class="row">
			<div class="col-xs-6 col-md-3">
				<strong>Address:</strong>
			</div>
			<div class="col-xs-6 col-md-3">
				{{$data->address}}
			</div>
		</div>
	</div>
	<div class="col-xs-6">
		<div class="row">
			<div class="col-xs-6 col-md-3">
				<strong>Invoice #:</strong>
			</div>
			<div class="col-xs-6 col-md-3">
				{{(isset($data->receipt_no)) ? $data->receipt_no : $data->voucher_no}}
			</div>
		</div>
	</div>
</div> --}}
<div class="container">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Sr#</th>
				<th>Name</th>
				<th>Qty</th>
				<th>Price</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
			<?php $count = 0;?>
			@foreach($items as $item)
				<tr>
					<td>{{++$count}}</td>
					<td>{{$item->item_name}}</td>
					<td>{{$item->qty}}</td>
					<td>{{$item->purchase_price}}</td>
					<td>{{$item->purchase_price * $item->qty}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<div class="row">
		<div class="col-md-8 col-xs-8">
			
		</div>
		<div class="col-md-4 col-xs-4 ">
		          <table class="table" style="font-size: 12px">
		            <tr>
		              <td><strong>Total:</strong></td>
		              <td>{{$data->total_amount}}</td>
		            </tr>
		            <tr>
		              <td><strong>Received Amount:</strong></td>
		              <td>{{$data->paid_amount}}</td>
		            </tr>
		            <tr>
		              <td><strong>Return Amount:</strong></td>
		              <td>{{$data->return_amount}}</td>
		            </tr>
		            <tr>
		              <td><strong>Balance Amount:</strong></td>
		              <td>{{$data->total_amount - ($data->paid_amount + $data->return_amount)}}</td>
		            </tr>
		            
		          </table>
		        </div>
		</div>
		<div class="row">
			<div class="col-md-12" style="text-align: center;">
				For question concerning this invoice please contact 
				<div>Phone: {{$company->phone}}</div>
				<div>Email: {{$company->email}}</div>
			</div>
		</div>
	</div>
	
	
</div>



<!-- jQuery -->
<script src="{{ asset('js/jquery.min.js')}}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
</body>
</html>