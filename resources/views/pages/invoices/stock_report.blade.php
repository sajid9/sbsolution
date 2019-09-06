
<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/custom_style.css') }}" rel="stylesheet">	
</head>
<body>

<h1 style="text-align: center;">Stock Report</h1>

<div style="padding:10px;">

<table class="table">
	<thead>
		<tr>
			<th>Sr#</th>
			<th>Barcode</th>
			<th>Name</th>
			<th>Store</th>
			<th>Quantity</th>
			<th>Total Quantity</th>
		</tr>
	</thead>
	<tbody>
		<?php $count = 0; $last_item = 0;?>
		@foreach($items as $item)
			<tr> 
				<td>{{++$count}}</td>
				<td>{{$item->barcode}}</td>
				<td>{{$item->item_name}}</td>
				<td>{{$item->name}}</td>
				<td>{{$item->qty}}</td>
				@if($item->item_id != $last_item)
				<td rowspan="{{$count}}" style="vertical-align : middle;text-align:center;"><strong>{{$item->total->total_item}}</strong></td>
				@endif
			</tr>
			<?php $last_item = $item->item_id; ?>
		@endforeach
	</tbody>
</table>

</div>


<!-- jQuery -->
<script src="{{ asset('js/jquery.min.js')}}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
</body>
</html>