
<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/custom_style.css') }}" rel="stylesheet">	
</head>
<body>

<h1 style="text-align: center;">Amount Receivable</h1>
@if(isset($op_bal))
<h3 style="text-align: right; padding-right: 20px;">Opening Balance: {{(sizeof($op_bal) > 0) ? $op_bal[0]->debit : 0}}</h3>
@endif
<div style="padding:10px;">

<table class="table table-striped">
	<thead>
		<tr>
			<th>Sr#</th>
			<th>Receipt Number</th>
			<th>Customer</th>
			<th>Total Amount</th>
			<th>Paid Amount</th>
			<th>Return Amount</th>
			<th>Balance</th>
		</tr>
	</thead>
	<tbody>
		<?php $count = 0;?>
		@foreach($data as $receipt)
			<tr>
				<td>{{++$count}}</td>
				<td>{{$receipt->receipt_no}}</td>
				<td>{{$receipt->customer_name}}</td>
				<td>{{$receipt->total_amount}}</td>
				<td>{{$receipt->paid_amount}}</td>
				<td>{{$receipt->return_amount}}</td>
				<td>{{$receipt->total_amount - ($receipt->return_amount + $receipt->paid_amount)}}</td>
			</tr>
		@endforeach
	</tbody>
</table>
<div class="col-md-4 col-md-offset-7">
          <table class="table" style="font-size: 12px">
            <tr>
              <td><strong>Total:</strong></td>
              @if(isset($op_bal))
              <td>{{(sizeof($op_bal) > 0) ? $op_bal[0]->debit + $total[0]->total : $total[0]->total}}</td>
              @else
              <td>{{$total[0]->total}}</td>
              @endif
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