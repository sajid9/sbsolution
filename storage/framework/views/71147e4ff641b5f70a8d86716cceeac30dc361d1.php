
<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
	<link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/custom_style.css')); ?>" rel="stylesheet">	
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
			<th>Total Meter</th>
		</tr>
	</thead>
	<tbody>
		<?php $count = 0; $last_item = 0;?>
		<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr> 
				<td><?php echo e(++$count); ?></td>
				<td><?php echo e($item->barcode); ?></td>
				<td><?php echo e($item->item_name); ?></td>
				<td><?php echo e($item->name); ?></td>
				<td><?php echo e($item->qty / $item->pieces); ?></td>
				<?php if($item->item_id != $last_item): ?>
				<td rowspan="<?php echo e($count); ?>" style="vertical-align : middle;text-align:center;"><strong><?php echo e(($item->total->total_item / $item->pieces) * $item->meter); ?></strong></td>
				<?php endif; ?>
			</tr>
			<?php $last_item = $item->item_id; ?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</tbody>
</table>

</div>


<!-- jQuery -->
<script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
</body>
</html>