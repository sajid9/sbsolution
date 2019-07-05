
<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/custom_style.css') }}" rel="stylesheet">	
</head>
<body>
<h1 style="text-align: center;">SB Software Solution</h1>
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
</div>
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
				<td>{{$item->sale_price}}</td>
				<td>{{$item->sale_price * $item->qty}}</td>
			</tr>
		@endforeach
	</tbody>
</table>
<div class="col-md-4 col-md-offset-7">
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


<!-- jQuery -->
<script src="{{ asset('js/jquery.min.js')}}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
</body>
</html>