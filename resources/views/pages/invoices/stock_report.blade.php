
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
			<th>Purchase Price</th>
			<th>Quantity</th>
			@if(env('TILE_MODULE') == 'yes')
			<th>Boxes</th>
			<th>Pieces</th>
			<th>Meter</th>
			@endif
			<th>Total{{(env('TILE_MODULE') == 'yes')? ' / Meter': ''}}</th>
		</tr>
	</thead>
	<tbody>
		<?php $count = 0;$last_item = 0;?>
		@foreach($items as $item)
			<?php 
				if($item->type == 'tile'){
					$obj = CH::convert_box($item->qty,$item->pieces,$item->meter);
				}
			?>
			<tr> 
				<td>{{++$count}}</td>
				<td>{{$item->barcode}}</td>
				<td>{{$item->item_name}}</td>
				<td>{{$item->name}}</td>
				<td>{{$item->purchase_price}}</td>
				<td>{{$item->qty}}</td>
				@if(env('TILE_MODULE') == 'yes')
				@if($item->type == 'tile')
				<td>{{$obj['boxes']}}</td>
				<td>{{$obj['pieces']}}</td>
				<td>{{$obj['meter']}}</td>
				@else
				<td>null</td>
				<td>null</td>
				<td>null</td>
				@endif

				@endif
				@if($item->item_id != $last_item)
				<td rowspan="{{collect($items)->where('item_id',$item->item_id)->count()}}" style="vertical-align : middle;text-align:center;"><strong>{{($item->type == 'tile') ? ($item->total->total_item / $item->pieces) * $item->meter : $item->total->total_item}}</strong></td>
				@endif
			</tr>
			<?php $last_item = $item->item_id; ?>
		@endforeach
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			@if(env('TILE_MODULE') == 'yes')
			<td></td>
			<td></td>
			<td></td>
			@endif
			<td>Total Price:</td>
			<td>{{collect($items)->sum(function($q){
				return $q->purchase_price * $q->qty;
			})}}</td>
		</tr>
	</tbody>
</table>

</div>


<!-- jQuery -->
<script src="{{ asset('js/jquery.min.js')}}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
</body>
</html>