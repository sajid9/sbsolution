
<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
	<link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/custom_style.css')); ?>" rel="stylesheet">	
</head>
<body>

<h1 style="text-align: center;">Amount Payable</h1>
<?php if(isset($op_bal)): ?>
<h3 style="text-align: right; padding-right: 20px;">Opening Balance: <?php echo e((sizeof($op_bal) > 0) ? $op_bal[0]->credit : 0); ?></h3>
<?php endif; ?>
<div style="padding:10px;">

<table class="table table-striped">
	<thead>
		<tr>
			<th>Sr#</th>
			<th>Voucher Number</th>
			<th>Supplier</th>
			<th>Total Amount</th>
			<th>Paid Amount</th>
			<th>Return Amount</th>
			<th>Balance</th>
		</tr>
	</thead>
	<tbody>
		<?php $count = 0;?>
		<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $voucher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><?php echo e(++$count); ?></td>
				<td><?php echo e($voucher->voucher_no); ?></td>
				<td><?php echo e($voucher->supplier_name); ?></td>
				<td><?php echo e($voucher->total_amount); ?></td>
				<td><?php echo e($voucher->paid_amount); ?></td>
				<td><?php echo e($voucher->return_amount); ?></td>
				<td><?php echo e($voucher->total_amount - ($voucher->return_amount + $voucher->paid_amount)); ?></td>
			</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</tbody>
</table>
<div class="col-md-4 col-md-offset-7">
          <table class="table" style="font-size: 12px">
            <tr>
              <td><strong>Total:</strong></td>
              <?php if(isset($op_bal)): ?>
              <td><?php echo e((sizeof($op_bal) > 0) ? $op_bal[0]->credit + $total[0]->total : $total[0]->total); ?></td>
              <?php else: ?>
              <td><?php echo e($total[0]->total); ?></td>
              <?php endif; ?>
            </tr>
          </table>
        </div>
</div>


<!-- jQuery -->
<script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
</body>
</html><?php /**PATH D:\xampp\htdocs\sb_solution\resources\views/pages/invoices/amount_payable_invoice.blade.php ENDPATH**/ ?>