<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
	<link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/custom_style.css')); ?>" rel="stylesheet">

</head>
<body>
	<?php $date=date_create($data->created_at); ?>
<div class="container">
	<div>
		<div style="width: 20%;float: left;"><img class="img-responsive"  src="<?php echo e(env('APP_URL')); ?>/storage/app/<?php echo e((isset($company->logo))? $company->logo :'default.png'); ?>" alt=""></div>
		<div style="text-align: right;width: 80%;float: right;"><h1>SALES INVOICE</h1></div>
	</div>
	<div style="clear: both;">
		<div style="width: 25%;float: left">
			<h6><?php echo e((isset($company->name)) ? $company->name : ''); ?></h6>
			<h6><?php echo e((isset($company->address)) ? $company->address : ''); ?></h6>
			<h6><?php echo e((isset($company->phone)) ? $company->phone : ''); ?></h6>
			<h6><?php echo e((isset($company->email)) ? $company->email : ''); ?></h6>
			<h6><?php echo e((isset($company->website)) ? $company->website : ''); ?></h6>
		</div>
		
		<div style="width: 25%;float: right">
			<div style="background-color: #efefef;text-align: center;">Date</div>
			<div style="text-align: center;"><?php echo e(date_format($date,'d M Y')); ?></div>
			<div style="background-color: #efefef;text-align: center;">Receipt No</div>
			<div style="text-align: center;"><?php echo e($data->receipt_no); ?></div>
			<div style="background-color: #efefef;text-align: center;">Customer No</div>
			<div style="text-align: center;"><?php echo e($data->customer_id); ?></div>
		</div>
	</div>
	<div style="clear: both;">
		<div style="width: 24%">
			<h4 style="background-color: #efefef;text-align: center;">BILL TO</h4>
			<div>Customer name: <?php echo e($data->customer_name); ?></div>
			<div>Phone: <?php echo e($data->mobile); ?></div>
			<div>Email: <?php echo e($data->email); ?></div>
			<div>Address: <?php echo e($data->address); ?></div>
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
			<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			 <?php 
			 	if($item->type == 'tile'){
			 		$obj = CH::convert_box($item->qty,$item->pieces,$item->meter);
			 	}?>
				<tr style="text-align: center">
					<td><?php echo e(++$count); ?></td>
					<td><?php echo e($item->item_name); ?></td>
					<td><?php echo e(($item->type == 'tile') ? $obj['meter'] : $item->qty); ?></td>
					<td><?php echo e($item->sale_price); ?></td>
					<td><?php echo e(($item->type == 'tile') ? intval($item->discount / $obj['meter']) : $item->discount / $item->qty); ?></td>
					<td><?php echo e($item->total_price); ?></td>
					<td><?php echo e($item->total_price - $item->discount); ?></td>
					<td><?php echo e($item->discount); ?></td>
				</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
	</table>
	<div style="clear: both;width: 100%;margin-top: 20px;">
		
		<div style="width: 30%;float: right">
		          <table class="table" style="font-size: 12px;width:100%">
		            <tr>
		              <td><strong>Total:</strong></td>
		              <td style="text-align: center"><?php echo e($data->total_amount); ?></td>
		            </tr>
		            <tr>
		              <td><strong>Received Amount:</strong></td>
		              <td style="text-align: center"><?php echo e($data->paid_amount); ?></td>
		            </tr>
		            <tr>
		              <td><strong>Return Amount:</strong></td>
		              <td style="text-align: center"><?php echo e($data->return_amount); ?></td>
		            </tr>
		            <tr>
		              <td><strong>Balance Amount:</strong></td>
		              <td style="text-align: center"><?php echo e($data->total_amount - ($data->paid_amount + $data->return_amount)); ?></td>
		            </tr>
		            
		          </table>
		        </div>
		</div>
		<div style="clear: both;width: 100%">
			<div style="text-align: center;">
				For question concerning this invoice please contact 
				<div>Phone: <?php echo e((isset($company->phone)) ? $company->phone : ""); ?></div>
				<div>Email: <?php echo e((isset($company->email)) ? $company->email : ""); ?></div>
			</div>
		</div>
	</div>
	
	
</div>
<!-- jQuery -->
<script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
</body>
</html>