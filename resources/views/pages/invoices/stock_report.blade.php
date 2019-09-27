
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
			<th>Boxes</th>
			<th>Pieces</th>
			<th>Meter</th>
			<th>Total Meter</th>
		</tr>
	</thead>
	<tbody>
		<?php $count = 0;$counter = 0; $last_item = 0;?>
		@foreach($items as $item)
			<?php 
				++$counter;
				if($item->type == 'tile'){
					$obj = CH::convert_box($item->qty,$item->pieces,$item->meter);
				}
			?>
			<tr> 
				<td>{{++$count}}</td>
				<td>{{$item->barcode}}</td>
				<td>{{$item->item_name}}</td>
				<td>{{$item->name}}</td>
				@if($item->type == 'tile')
				<td>{{$obj['boxes']}}</td>
				<td>{{$obj['pieces']}}</td>
				<td>{{$obj['meter']}}</td>
				@else
				<td>{{$item->qty}}</td>
				<td></td>
				<td></td>
				@endif
				@if($item->item_id != $last_item)
				<td rowspan="{{$counter}}" style="vertical-align : middle;text-align:center;"><strong>{{($item->type == 'tile') ? ($item->total->total_item / $item->pieces) * $item->meter : $item->total->total_item}}</strong></td>
				@endif
			</tr>
			<?php $counter = 0?>
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