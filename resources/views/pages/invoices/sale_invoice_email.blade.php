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
	<div>
		<div style="width: 20%;float: left;"><img class="img-responsive"  src="{{ env('APP_URL') }}/storage/app/{{(isset($company->logo))? $company->logo :'default.png'}}" alt=""></div>
		<div style="text-align: right;width: 80%;float: right;"><h1>SALES INVOICE</h1></div>
	</div>
	<div style="clear: both;">
		<div style="width: 25%;float: left">
			<h6>{{(isset($company->name)) ? $company->name : ''}}</h6>
			<h6>{{(isset($company->address)) ? $company->address : ''}}</h6>
			<h6>{{(isset($company->phone)) ? $company->phone : ''}}</h6>
			<h6>{{(isset($company->email)) ? $company->email : ''}}</h6>
			<h6>{{(isset($company->website)) ? $company->website : ''}}</h6>
		</div>
		
		<div style="width: 25%;float: right">
			<div style="background-color: #efefef;text-align: center;">Date</div>
			<div style="text-align: center;">{{date_format($date,'d M Y')}}</div>
			<div style="background-color: #efefef;text-align: center;">Receipt No</div>
			<div style="text-align: center;">{{$data->receipt_no}}</div>
			<div style="background-color: #efefef;text-align: center;">Customer No</div>
			<div style="text-align: center;">{{$data->customer_id}}</div>
		</div>
	</div>
	<div style="clear: both;">
		<div style="width: 24%">
			<h4 style="background-color: #efefef;text-align: center;">BILL TO</h4>
			<div>Customer name: {{$data->customer_name}}</div>
			<div>Phone: {{$data->mobile}}</div>
			<div>Email: {{$data->email}}</div>
			<div>Address: {{$data->address}}</div>
		</div>
		<div class="col-md-3 col-xs-3 col-xs-offset-6 col-md-offset-6">
			
		</div>
	</div>
</div>
<div style="width: 100%;margin-top: 20px;">
	<table style="width: 100%">
		<thead>
			<tr>
				<th>Sr#</th>
				<th>Name</th>
				<th>Qty</th>
				<th>Sale Price / Meter</th>
				<th>Discount Price / Meter</th>
				<th>Total Price</th>
				<th>Total Discount</th>
				<th>Amount</th>
			</tr>
		</thead>
		<tbody>
			<?php $count = 0;?>
			@foreach($items as $item)
			 <?php 
			 	if($item->type == 'tile'){
			 		$obj = CH::convert_box($item->qty,$item->pieces,$item->meter);
			 	}?>
				<tr style="text-align: center">
					<td>{{++$count}}</td>
					<td>{{$item->item_name}}</td>
					<td>{{($item->type == 'tile') ? $obj['meter'] : $item->qty}}</td>
					<td>{{$item->sale_price}}</td>
					<td>{{($item->type == 'tile') ? intval($item->discount / $obj['meter']) : $item->discount / $item->qty}}</td>
					<td>{{$item->total_price}}</td>
					<td>{{$item->total_price - $item->discount}}</td>
					<td>{{$item->discount}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<div style="clear: both;width: 100%;margin-top: 20px;">
		
		<div style="width: 30%;float: right">
		          <table class="table" style="font-size: 12px;width:100%">
		            <tr>
		              <td><strong>Total:</strong></td>
		              <td style="text-align: center">{{$data->total_amount}}</td>
		            </tr>
		            <tr>
		              <td><strong>Received Amount:</strong></td>
		              <td style="text-align: center">{{$data->paid_amount}}</td>
		            </tr>
		            <tr>
		              <td><strong>Return Amount:</strong></td>
		              <td style="text-align: center">{{$data->return_amount}}</td>
		            </tr>
		            <tr>
		              <td><strong>Balance Amount:</strong></td>
		              <td style="text-align: center">{{$data->total_amount - ($data->paid_amount + $data->return_amount)}}</td>
		            </tr>
		            
		          </table>
		        </div>
		</div>
		<div style="clear: both;width: 100%">
			<div style="text-align: center;">
				For question concerning this invoice please contact 
				<div>Phone: {{(isset($company->phone)) ? $company->phone : ""}}</div>
				<div>Email: {{(isset($company->email)) ? $company->email : ""}}</div>
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